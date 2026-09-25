<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";

if (!isset($_GET["id"])) {
    die("ID do usuário não informado.");
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("ID de usuário inválido.");
}


/*
|----------------------------------------------------------
| BUSCAR USUÁRIO
|----------------------------------------------------------
*/

$sql = "SELECT * FROM usuarios WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Erro ao preparar a consulta.");
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);

if (!$usuario) {
    die("Usuário não encontrado.");
}


/*
|----------------------------------------------------------
| ATUALIZAR USUÁRIO
|----------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";
    $confirm_senha = $_POST["confirm_senha"] ?? "";
    $nome = trim($_POST["nome"] ?? "");
    $cpf = preg_replace("/\D/", "", $_POST["cpf"] ?? "");
    $data_nascimento = $_POST["data_nascimento"] ?? "";
    $cep = preg_replace("/\D/", "", $_POST["cep"] ?? "");
    $complemento = trim($_POST["complemento"] ?? "");
    $telefone = preg_replace("/\D/", "", $_POST["telefone"] ?? "");


    /*
    |----------------------------------------------------------
    | VALIDAÇÕES
    |----------------------------------------------------------
    */

    if (
        empty($email) ||
        empty($nome) ||
        empty($cpf) ||
        empty($data_nascimento) ||
        empty($cep) ||
        empty($telefone)
    ) {

        $mensagem = "Preencha todos os campos obrigatórios.";
        $tipoMensagem = "erro";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $mensagem = "Digite um email válido.";
        $tipoMensagem = "erro";

    } elseif (strlen($cpf) !== 11) {

        $mensagem = "Digite um CPF válido.";
        $tipoMensagem = "erro";

    } elseif (strlen($cep) !== 8) {

        $mensagem = "Digite um CEP válido.";
        $tipoMensagem = "erro";

    } elseif (strlen($telefone) < 10 || strlen($telefone) > 11) {

        $mensagem = "Digite um telefone válido.";
        $tipoMensagem = "erro";

    } else {

        /*
        |----------------------------------------------------------
        | VALIDAR DATA
        |----------------------------------------------------------
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
            |----------------------------------------------------------
            | VERIFICAR EMAIL OU CPF DUPLICADO
            |----------------------------------------------------------
            */

            $sql = "SELECT id, email, cpf
                    FROM usuarios
                    WHERE (email = ? OR cpf = ?)
                    AND id != ?";

            $stmt = mysqli_prepare($conn, $sql);

            if (!$stmt) {

                $mensagem = "Erro ao verificar os dados.";
                $tipoMensagem = "erro";

            } else {

                mysqli_stmt_bind_param(
                    $stmt,
                    "ssi",
                    $email,
                    $cpf,
                    $id
                );

                mysqli_stmt_execute($stmt);

                $resultado = mysqli_stmt_get_result($stmt);

                $emailDuplicado = false;
                $cpfDuplicado = false;

                while ($existente = mysqli_fetch_assoc($resultado)) {

                    if ($existente["email"] === $email) {
                        $emailDuplicado = true;
                    }

                    if ($existente["cpf"] === $cpf) {
                        $cpfDuplicado = true;
                    }
                }

                mysqli_stmt_close($stmt);


                if ($emailDuplicado) {

                    $mensagem = "Este email já está cadastrado.";
                    $tipoMensagem = "erro";

                } elseif ($cpfDuplicado) {

                    $mensagem = "Este CPF já está cadastrado.";
                    $tipoMensagem = "erro";

                } else {

                    /*
                    |------------------------------------------------------
                    | SENHA
                    |------------------------------------------------------
                    |
                    | Se o usuário deixou a senha vazia,
                    | mantém a senha atual.
                    |
                    | Se digitou uma nova senha,
                    | valida e cria um novo hash.
                    */

                    if ($senha !== "" || $confirm_senha !== "") {

                        if (strlen($senha) < 8) {

                            $mensagem = "A nova senha deve possuir pelo menos 8 caracteres.";
                            $tipoMensagem = "erro";

                        } elseif (!preg_match("/[A-Za-z]/", $senha)) {

                            $mensagem = "A nova senha deve possuir pelo menos uma letra.";
                            $tipoMensagem = "erro";

                        } elseif (!preg_match("/[0-9]/", $senha)) {

                            $mensagem = "A nova senha deve possuir pelo menos um número.";
                            $tipoMensagem = "erro";

                        } elseif ($senha !== $confirm_senha) {

                            $mensagem = "As senhas não são iguais.";
                            $tipoMensagem = "erro";

                        } else {

                            $senha_hash = password_hash(
                                $senha,
                                PASSWORD_DEFAULT
                            );
                        }

                    } else {

                        $senha_hash = $usuario["senha"];
                    }


                    /*
                    |------------------------------------------------------
                    | ATUALIZAR
                    |------------------------------------------------------
                    */

                    if ($mensagem === "") {

                        $sql = "UPDATE usuarios SET
                                email = ?,
                                senha = ?,
                                nome = ?,
                                cpf = ?,
                                data_nascimento = ?,
                                cep = ?,
                                complemento = ?,
                                telefone = ?
                                WHERE id = ?";

                        $stmt = mysqli_prepare($conn, $sql);

                        if (!$stmt) {

                            $mensagem = "Erro ao preparar a atualização.";
                            $tipoMensagem = "erro";

                        } else {

                            mysqli_stmt_bind_param(
                                $stmt,
                                "ssssssssi",
                                $email,
                                $senha_hash,
                                $nome,
                                $cpf,
                                $data_nascimento,
                                $cep,
                                $complemento,
                                $telefone,
                                $id
                            );

                            try {

                                if (mysqli_stmt_execute($stmt)) {

                                    $mensagem = "Usuário atualizado com sucesso!";
                                    $tipoMensagem = "sucesso";

                                    /*
                                    | Atualiza os dados exibidos
                                    */

                                    $usuario["email"] = $email;
                                    $usuario["nome"] = $nome;
                                    $usuario["cpf"] = $cpf;
                                    $usuario["data_nascimento"] = $data_nascimento;
                                    $usuario["cep"] = $cep;
                                    $usuario["complemento"] = $complemento;
                                    $usuario["telefone"] = $telefone;
                                    $usuario["senha"] = $senha_hash;

                                } else {

                                    $mensagem = "Erro ao atualizar usuário.";
                                    $tipoMensagem = "erro";
                                }

                            } catch (mysqli_sql_exception $e) {

                                if ($e->getCode() == 1062) {

                                    $mensagem = "Email ou CPF já cadastrado.";
                                    $tipoMensagem = "erro";

                                } else {

                                    $mensagem = "Não foi possível atualizar o usuário.";
                                    $tipoMensagem = "erro";
                                }
                            }

                            mysqli_stmt_close($stmt);
                        }
                    }
                }
            }
        }
    }
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link
        rel="stylesheet"
        href="../styles/style.css?v=1.1"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <title>Editar Usuário</title>

</head>

<body>

<div id="editar-usuarios">

    <main class="editar-usuarios-main">

        <h1>Editar Usuário</h1>

        <div class="editar-usuarios-container">

            <div class="editar-usuarios-card">

                <form method="POST">

                    <div class="editar-usuarios-colunas">


                        <!-- PRIMEIRA COLUNA -->

                        <div class="editar-usuarios-coluna">

                            <div class="editar-usuarios-campo">

                                <label for="usuario-email">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    id="usuario-email"
                                    name="email"
                                    value="<?php echo htmlspecialchars($usuario["email"]); ?>"
                                    maxlength="255"
                                    required
                                >

                            </div>


                            <div class="editar-usuarios-campo">

                                <label for="usuario-senha">
                                    Nova Senha
                                </label>

                                <input
                                    type="password"
                                    id="usuario-senha"
                                    name="senha"
                                    placeholder="Deixe vazio para manter a senha"
                                    minlength="8"
                                >

                            </div>


                            <div class="editar-usuarios-campo">

                                <label for="usuario-confirm-senha">
                                    Confirmar Nova Senha
                                </label>

                                <input
                                    type="password"
                                    id="usuario-confirm-senha"
                                    name="confirm_senha"
                                    placeholder="Confirme a nova senha"
                                    minlength="8"
                                >

                            </div>

                        </div>


                        <!-- SEGUNDA COLUNA -->

                        <div class="editar-usuarios-coluna">

                            <div class="editar-usuarios-campo">

                                <label for="usuario-nome">
                                    Nome Completo
                                </label>

                                <input
                                    type="text"
                                    id="usuario-nome"
                                    name="nome"
                                    value="<?php echo htmlspecialchars($usuario["nome"]); ?>"
                                    maxlength="255"
                                    required
                                >

                            </div>


                            <div class="editar-usuarios-campo">

                                <label for="usuario-cpf">
                                    CPF
                                </label>

                                <input
                                    type="text"
                                    id="usuario-cpf"
                                    name="cpf"
                                    value="<?php echo htmlspecialchars($usuario["cpf"]); ?>"
                                    maxlength="14"
                                    required
                                >

                            </div>


                            <div class="editar-usuarios-campo">

                                <label for="usuario-data">
                                    Data de Nascimento
                                </label>

                                <input
                                    type="date"
                                    id="usuario-data"
                                    name="data_nascimento"
                                    value="<?php echo htmlspecialchars($usuario["data_nascimento"]); ?>"
                                    required
                                >

                            </div>

                        </div>


                        <!-- TERCEIRA COLUNA -->

                        <div class="editar-usuarios-coluna">

                            <div class="editar-usuarios-campo">

                                <label for="usuario-cep">
                                    CEP
                                </label>

                                <input
                                    type="text"
                                    id="usuario-cep"
                                    name="cep"
                                    value="<?php echo htmlspecialchars($usuario["cep"]); ?>"
                                    maxlength="9"
                                    required
                                >

                            </div>


                            <div class="editar-usuarios-campo">

                                <label for="usuario-complemento">
                                    Complemento
                                </label>

                                <input
                                    type="text"
                                    id="usuario-complemento"
                                    name="complemento"
                                    value="<?php echo htmlspecialchars($usuario["complemento"]); ?>"
                                    maxlength="100"
                                >

                            </div>


                            <div class="editar-usuarios-campo">

                                <label for="usuario-telefone">
                                    Telefone
                                </label>

                                <input
                                    type="text"
                                    id="usuario-telefone"
                                    name="telefone"
                                    value="<?php echo htmlspecialchars($usuario["telefone"]); ?>"
                                    maxlength="15"
                                    required
                                >

                            </div>

                        </div>

                    </div>


                    <div class="editar-usuarios-botao">

                        <button type="submit">
                            Salvar Alterações
                        </button>

                    </div>


                    <div class="editar-usuarios-botao-voltar">

                        <a href="gestao-usuarios.php">
                            Voltar
                        </a>

                    </div>


                    <?php if ($mensagem !== ""): ?>

                        <div class="cadastro-mensagem <?php echo htmlspecialchars($tipoMensagem); ?>">

                            <?php echo htmlspecialchars($mensagem); ?>

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