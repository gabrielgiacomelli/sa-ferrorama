<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";

$email = "";
$nome = "";
$cpf = "";
$data_nascimento = "";
$cep = "";
$complemento = "";
$telefone = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";
    $confirm_senha = $_POST["confirm_senha"] ?? "";
    $nome = trim($_POST["nome"] ?? "");

    $cpf = preg_replace(
        "/\D/",
        "",
        $_POST["cpf"] ?? ""
    );

    $data_nascimento = $_POST["data_nascimento"] ?? "";

    $cep = preg_replace(
        "/\D/",
        "",
        $_POST["cep"] ?? ""
    );

    $complemento = trim(
        $_POST["complemento"] ?? ""
    );

    $telefone = preg_replace(
        "/\D/",
        "",
        $_POST["telefone"] ?? ""
    );


    /*
    VALIDAÇÕES
    */

    if (
        $email === "" ||
        $senha === "" ||
        $confirm_senha === "" ||
        $nome === "" ||
        $cpf === "" ||
        $data_nascimento === "" ||
        $cep === "" ||
        $telefone === ""
    ) {

        $mensagem = "Preencha todos os campos obrigatórios.";
        $tipoMensagem = "erro";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $mensagem = "Digite um email válido.";
        $tipoMensagem = "erro";

    } elseif (strlen($senha) < 8) {

        $mensagem = "A senha deve possuir pelo menos 8 caracteres.";
        $tipoMensagem = "erro";

    } elseif (!preg_match("/[A-Za-z]/", $senha)) {

        $mensagem = "A senha deve possuir pelo menos uma letra.";
        $tipoMensagem = "erro";

    } elseif (!preg_match("/[0-9]/", $senha)) {

        $mensagem = "A senha deve possuir pelo menos um número.";
        $tipoMensagem = "erro";

    } elseif ($senha !== $confirm_senha) {

        $mensagem = "As senhas não são iguais.";
        $tipoMensagem = "erro";

    } elseif (strlen($cpf) !== 11) {

        $mensagem = "Digite um CPF válido.";
        $tipoMensagem = "erro";

    } elseif (strlen($cep) !== 8) {

        $mensagem = "Digite um CEP válido.";
        $tipoMensagem = "erro";

    } elseif (
        strlen($telefone) < 10 ||
        strlen($telefone) > 11
    ) {

        $mensagem = "Digite um telefone válido.";
        $tipoMensagem = "erro";

    } else {

        /*
        VERIFICA DATA
        */

        $data = DateTime::createFromFormat(
            "Y-m-d",
            $data_nascimento
        );

        if (
            !$data ||
            $data->format("Y-m-d") !== $data_nascimento
        ) {

            $mensagem = "Digite uma data de nascimento válida.";
            $tipoMensagem = "erro";

        } elseif ($data > new DateTime()) {

            $mensagem = "A data de nascimento não pode ser futura.";
            $tipoMensagem = "erro";

        } else {

            /*
            VERIFICA EMAIL E CPF
            */

            $sql = "SELECT id, email, cpf
                    FROM usuarios
                    WHERE email = ? OR cpf = ?";

            $stmt = mysqli_prepare(
                $conn,
                $sql
            );

            if ($stmt) {

                mysqli_stmt_bind_param(
                    $stmt,
                    "ss",
                    $email,
                    $cpf
                );

                mysqli_stmt_execute($stmt);

                $resultado = mysqli_stmt_get_result($stmt);

                if (
                    $resultado &&
                    mysqli_num_rows($resultado) > 0
                ) {

                    $usuarioExistente =
                        mysqli_fetch_assoc($resultado);

                    if (
                        $usuarioExistente["email"] === $email
                    ) {

                        $mensagem =
                            "Este email já está cadastrado.";

                        $tipoMensagem = "erro";

                    } elseif (
                        $usuarioExistente["cpf"] === $cpf
                    ) {

                        $mensagem =
                            "Este CPF já está cadastrado.";

                        $tipoMensagem = "erro";

                    } else {

                        $mensagem =
                            "Email ou CPF já cadastrado.";

                        $tipoMensagem = "erro";
                    }

                } else {

                    /*
                    TRANSFORMA A SENHA EM HASH
                    */

                    $senha_hash = password_hash(
                        $senha,
                        PASSWORD_DEFAULT
                    );


                    /*
                    CADASTRA O USUÁRIO

                    A tabela antiga possui:
                    email
                    senha
                    confirm_senha
                    nome
                    cpf
                    data_nascimento
                    cep
                    complemento
                    telefone
                    */

                    $sqlInsert = "INSERT INTO usuarios
                    (
                        email,
                        senha,
                        confirm_senha,
                        nome,
                        cpf,
                        data_nascimento,
                        cep,
                        complemento,
                        telefone
                    )
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

                    $stmtInsert = mysqli_prepare(
                        $conn,
                        $sqlInsert
                    );

                    if ($stmtInsert) {

                        /*
                        A confirmação também recebe o hash.
                        Ela não é utilizada para o login.
                        */

                        $confirm_senha_hash = $senha_hash;

                        mysqli_stmt_bind_param(
                            $stmtInsert,
                            "sssssssss",
                            $email,
                            $senha_hash,
                            $confirm_senha_hash,
                            $nome,
                            $cpf,
                            $data_nascimento,
                            $cep,
                            $complemento,
                            $telefone
                        );

                        try {

                            if (
                                mysqli_stmt_execute(
                                    $stmtInsert
                                )
                            ) {

                                $mensagem =
                                    "Usuário cadastrado com sucesso!";

                                $tipoMensagem =
                                    "sucesso";

                                /*
                                LIMPA OS CAMPOS
                                */

                                $email = "";
                                $nome = "";
                                $cpf = "";
                                $data_nascimento = "";
                                $cep = "";
                                $complemento = "";
                                $telefone = "";

                            } else {

                                $mensagem =
                                    "Erro ao cadastrar o usuário.";

                                $tipoMensagem =
                                    "erro";
                            }

                        } catch (mysqli_sql_exception $e) {

                            if (
                                $e->getCode() == 1062
                            ) {

                                $mensagem =
                                    "Email ou CPF já cadastrado.";

                            } else {

                                $mensagem =
                                    "Não foi possível cadastrar o usuário.";
                            }

                            $tipoMensagem =
                                "erro";
                        }

                        mysqli_stmt_close(
                            $stmtInsert
                        );

                    } else {

                        $mensagem =
                            "Erro ao preparar o cadastro.";

                        $tipoMensagem =
                            "erro";
                    }
                }

                mysqli_stmt_close($stmt);

            } else {

                $mensagem =
                    "Erro ao verificar os dados.";

                $tipoMensagem =
                    "erro";
            }
        }
    }
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Cadastro de Usuários</title>

    <link
        rel="stylesheet"
        href="../assets/css/cadastro-usuarios.css"
    >

</head>

<?php

$paginaAtual = "cadastro";
$submenuAtual = "usuarios";

include("../includes/navbar.php");

?>

<body>

<div id="cadastro-usuarios">

    <main class="cadastro-usuarios-main">

        <h1>
            Cadastro de usuários
        </h1>

        <div class="cadastro-usuarios-container">

            <div class="cadastro-usuarios-card">

                <form method="POST">

                    <div class="cadastro-usuarios-colunas">


                        <!-- COLUNA 1 -->

                        <div class="cadastro-usuarios-coluna">

                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-email">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    id="usuario-email"
                                    name="email"
                                    placeholder="Digite seu email"
                                    value="<?= htmlspecialchars($email) ?>"
                                    maxlength="255"
                                    required
                                >

                            </div>


                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-senha">
                                    Senha
                                </label>

                                <input
                                    type="password"
                                    id="usuario-senha"
                                    name="senha"
                                    placeholder="Digite sua senha"
                                    minlength="8"
                                    required
                                >

                            </div>


                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-confirm-senha">
                                    Confirmar senha
                                </label>

                                <input
                                    type="password"
                                    id="usuario-confirm-senha"
                                    name="confirm_senha"
                                    placeholder="Confirme sua senha"
                                    minlength="8"
                                    required
                                >

                            </div>

                        </div>


                        <!-- COLUNA 2 -->

                        <div class="cadastro-usuarios-coluna">

                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-nome">
                                    Nome Completo
                                </label>

                                <input
                                    type="text"
                                    id="usuario-nome"
                                    name="nome"
                                    placeholder="Digite seu nome completo"
                                    value="<?= htmlspecialchars($nome) ?>"
                                    maxlength="255"
                                    required
                                >

                            </div>


                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-cpf">
                                    CPF
                                </label>

                                <input
                                    type="text"
                                    id="usuario-cpf"
                                    name="cpf"
                                    placeholder="Digite seu CPF"
                                    value="<?= htmlspecialchars($cpf) ?>"
                                    maxlength="14"
                                    required
                                >

                            </div>


                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-data">
                                    Data de Nascimento
                                </label>

                                <input
                                    type="date"
                                    id="usuario-data"
                                    name="data_nascimento"
                                    value="<?= htmlspecialchars($data_nascimento) ?>"
                                    required
                                >

                            </div>

                        </div>


                        <!-- COLUNA 3 -->

                        <div class="cadastro-usuarios-coluna">

                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-cep">
                                    CEP
                                </label>

                                <input
                                    type="text"
                                    id="usuario-cep"
                                    name="cep"
                                    placeholder="Digite seu CEP"
                                    value="<?= htmlspecialchars($cep) ?>"
                                    maxlength="9"
                                    required
                                >

                            </div>


                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-complemento">
                                    Complemento
                                </label>

                                <input
                                    type="text"
                                    id="usuario-complemento"
                                    name="complemento"
                                    placeholder="Digite um complemento"
                                    value="<?= htmlspecialchars($complemento) ?>"
                                    maxlength="100"
                                >

                            </div>


                            <div class="cadastro-usuarios-campo">

                                <label for="usuario-telefone">
                                    Telefone
                                </label>

                                <input
                                    type="text"
                                    id="usuario-telefone"
                                    name="telefone"
                                    placeholder="Digite seu telefone"
                                    value="<?= htmlspecialchars($telefone) ?>"
                                    maxlength="15"
                                    required
                                >

                            </div>

                        </div>

                    </div>


                    <!-- BOTÃO -->

                    <div class="cadastro-usuarios-botao">

                        <button type="submit">
                            Cadastrar
                        </button>

                    </div>


                    <!-- MENSAGEM -->

                    <?php if ($mensagem !== ""): ?>

                        <div
                            class="cadastro-mensagem <?= htmlspecialchars($tipoMensagem) ?>"
                        >

                            <?= htmlspecialchars($mensagem) ?>

                        </div>

                    <?php endif; ?>

                </form>

            </div>

        </div>

    </main>

</div>


<script src="../scripts/botao-sair.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>