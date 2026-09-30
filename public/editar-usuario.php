<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";

if (!isset($_GET["id"])) {
    die("ID do usuário não informado.");
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id <= 0) {
    die("ID de usuário inválido.");
}


/*
|--------------------------------------------------------------------------
| BUSCAR USUÁRIO
|--------------------------------------------------------------------------
*/

$sql = "SELECT
            id,
            email,
            senha,
            nome,
            cpf,
            data_nascimento,
            cep,
            complemento,
            telefone,
            acesso
        FROM usuarios
        WHERE id = ?";

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
|--------------------------------------------------------------------------
| ATUALIZAR USUÁRIO
|--------------------------------------------------------------------------
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

    $acesso = trim($_POST["acesso"] ?? "");


    /*
    |--------------------------------------------------------------------------
    | VALIDAÇÕES
    |--------------------------------------------------------------------------
    */

    if (
        empty($email) ||
        empty($nome) ||
        empty($cpf) ||
        empty($data_nascimento) ||
        empty($cep) ||
        empty($telefone) ||
        empty($acesso)
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

    } elseif (
        $acesso !== "Funcionário" &&
        $acesso !== "Administrador"
    ) {

        $mensagem = "Selecione um nível de acesso válido.";
        $tipoMensagem = "erro";

    } else {

        /*
        |--------------------------------------------------------------------------
        | VALIDAR DATA
        |--------------------------------------------------------------------------
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
            |--------------------------------------------------------------------------
            | VERIFICAR EMAIL OU CPF DUPLICADO
            |--------------------------------------------------------------------------
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
                    |--------------------------------------------------------------------------
                    | SENHA
                    |--------------------------------------------------------------------------
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
                    |--------------------------------------------------------------------------
                    | ATUALIZAR
                    |--------------------------------------------------------------------------
                    */

                    if ($mensagem === "") {

                        $sql = "UPDATE usuarios SET
                                    email = ?,
                                    senha = ?,
                                    confirm_senha = ?,
                                    nome = ?,
                                    cpf = ?,
                                    data_nascimento = ?,
                                    cep = ?,
                                    complemento = ?,
                                    telefone = ?,
                                    acesso = ?
                                WHERE id = ?";

                        $stmt = mysqli_prepare($conn, $sql);

                        if (!$stmt) {

                            $mensagem = "Erro ao preparar a atualização.";
                            $tipoMensagem = "erro";

                        } else {

                            /*
                            | Se a senha não foi alterada,
                            | mantém a senha atual.
                            */

                            mysqli_stmt_bind_param(
                                $stmt,
                                "ssssssssssi",
                                $email,
                                $senha_hash,
                                $senha_hash,
                                $nome,
                                $cpf,
                                $data_nascimento,
                                $cep,
                                $complemento,
                                $telefone,
                                $acesso,
                                $id
                            );

                            try {

                                if (mysqli_stmt_execute($stmt)) {

                                    $mensagem = "Usuário atualizado com sucesso!";
                                    $tipoMensagem = "sucesso";

                                    $usuario["email"] = $email;
                                    $usuario["nome"] = $nome;
                                    $usuario["cpf"] = $cpf;
                                    $usuario["data_nascimento"] = $data_nascimento;
                                    $usuario["cep"] = $cep;
                                    $usuario["complemento"] = $complemento;
                                    $usuario["telefone"] = $telefone;
                                    $usuario["senha"] = $senha_hash;
                                    $usuario["acesso"] = $acesso;

                                } else {

                                    $mensagem = "Não foi possível atualizar o usuário.";
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

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Editar Usuário</title>

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }

        body {
            background: #f1f3f6;
            font-family: Arial, sans-serif;
            color: #1d3557;
        }


        /* =========================================================
           ÁREA PRINCIPAL
        ========================================================= */

        #editar-usuarios {
            width: 100%;
            min-height: 100vh;
            background: #f1f3f6;
        }

        .editar-usuarios-main {
            width: 100%;
            min-height: 100vh;

            display: flex;
            flex-direction: column;
            align-items: center;

            padding-top: 75px;
            padding-bottom: 50px;
        }


        /* =========================================================
           TÍTULO
        ========================================================= */

        .editar-usuarios-main h1 {
            margin: 0 0 35px 0;

            color: #193655;

            font-family: Arial, sans-serif;
            font-size: 52px;
            font-weight: 900;

            text-align: center;
            text-transform: uppercase;

            letter-spacing: 1px;
        }


        /* =========================================================
           CARD
        ========================================================= */

        .editar-usuarios-container {
            width: 100%;

            display: flex;
            justify-content: center;
        }

        .editar-usuarios-card {
            width: 850px;

            background: #ffffff;

            border-radius: 15px;

            padding: 55px 28px 30px;

            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }


        /* =========================================================
           FORMULÁRIO
        ========================================================= */

        .editar-usuarios-card form {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .editar-usuarios-colunas {
            width: 100%;

            display: flex;
            gap: 20px;
        }

        .editar-usuarios-coluna {
            width: calc(33.333% - 13.333px);
        }


        /* =========================================================
           CAMPOS
        ========================================================= */

        .editar-usuarios-campo {
            width: 100%;
            margin-bottom: 18px;
        }

        .editar-usuarios-campo label {
            display: block;

            margin-bottom: 5px;

            color: #193655;

            font-size: 14px;
            font-weight: 400;
        }

        .editar-usuarios-campo input,
        .editar-usuarios-campo select {
            width: 100%;
            height: 35px;

            padding: 6px 8px;

            border: 2px solid #28558d;
            border-radius: 6px;

            background: #ffffff;

            color: #333333;

            font-family: Arial, sans-serif;
            font-size: 14px;

            outline: none;
        }

        .editar-usuarios-campo input:focus,
        .editar-usuarios-campo select:focus {
            border-color: #193655;
            box-shadow: 0 0 0 1px #193655;
        }

        .editar-usuarios-campo input::placeholder {
            color: #555555;
        }


        /* =========================================================
           ACESSO
        ========================================================= */

        .editar-usuarios-acesso {
            width: 100%;
            margin-top: 0;
            margin-bottom: 18px;
        }

        .editar-usuarios-acesso label {
            display: block;

            margin-bottom: 5px;

            color: #193655;

            font-size: 14px;
            font-weight: 400;
        }

        .editar-usuarios-acesso select {
            width: 100%;
            height: 35px;

            padding: 5px 10px;

            border: 2px solid #28558d;
            border-radius: 6px;

            background: #ffffff;

            color: #333333;

            font-family: Arial, sans-serif;
            font-size: 14px;

            outline: none;

            cursor: pointer;
        }

        .editar-usuarios-acesso select:focus {
            border-color: #193655;
            box-shadow: 0 0 0 1px #193655;
        }


        /* =========================================================
           BOTÃO SALVAR
        ========================================================= */

        .editar-usuarios-botao {
            width: 100%;

            display: flex;
            justify-content: center;
            align-items: center;

            margin-top: 18px;
        }

        .editar-usuarios-botao button {
            width: 130px;
            height: 34px;

            border: none;
            border-radius: 16px;

            background: #193655;
            color: #ffffff;

            font-size: 14px;
            font-weight: bold;

            cursor: pointer;

            box-shadow: 0 5px 14px rgba(0, 0, 0, 0.18);

            transition: 0.2s;
        }

        .editar-usuarios-botao button:hover {
            background: #24486d;
            transform: translateY(-1px);
        }


        /* =========================================================
           BOTÃO VOLTAR
        ========================================================= */

        .editar-usuarios-botao-voltar {
            width: 100%;

            display: flex;
            justify-content: center;
            align-items: center;

            margin-top: 10px;
        }

        .editar-usuarios-botao-voltar a {
            width: 130px;
            height: 34px;

            display: flex;
            justify-content: center;
            align-items: center;

            border-radius: 16px;

            background: #193655;
            color: #ffffff;

            text-decoration: none;

            font-size: 14px;
            font-weight: bold;

            box-shadow: 0 5px 14px rgba(0, 0, 0, 0.18);

            transition: 0.2s;
        }

        .editar-usuarios-botao-voltar a:hover {
            background: #24486d;
            transform: translateY(-1px);
        }


        /* =========================================================
           MENSAGEM
        ========================================================= */

        .editar-mensagem {
            width: 100%;

            margin-top: 18px;
            padding: 10px;

            border-radius: 6px;

            text-align: center;

            font-size: 14px;
            font-weight: bold;
        }

        .editar-mensagem.sucesso {
            color: #1d6b3a;
            background: #e8f5ec;
            border: 1px solid #b7dfc4;
        }

        .editar-mensagem.erro {
            color: #b3261e;
            background: #fdecea;
            border: 1px solid #f2b8b5;
        }


        /* =========================================================
           RESPONSIVO
        ========================================================= */

        @media (max-width: 900px) {

            .editar-usuarios-card {
                width: 90%;
            }

        }


        @media (max-width: 700px) {

            .editar-usuarios-main {
                padding-top: 45px;
            }

            .editar-usuarios-main h1 {
                font-size: 34px;
                margin-bottom: 30px;
            }

            .editar-usuarios-card {
                width: 90%;
                padding: 35px 25px;
            }

            .editar-usuarios-colunas {
                flex-direction: column;
                gap: 0;
            }

            .editar-usuarios-coluna {
                width: 100%;
            }

        }

    </style>

</head>


<body>

<div id="editar-usuarios">

    <main class="editar-usuarios-main">

        <h1>EDITAR USUÁRIO</h1>


        <div class="editar-usuarios-container">

            <div class="editar-usuarios-card">

                <form method="POST">


                    <!-- =====================================================
                         TRÊS COLUNAS
                    ====================================================== -->

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
                                    value="<?php echo htmlspecialchars($usuario["email"], ENT_QUOTES, "UTF-8"); ?>"
                                    placeholder="Digite seu email"
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
                                    value="<?php echo htmlspecialchars($usuario["nome"], ENT_QUOTES, "UTF-8"); ?>"
                                    placeholder="Digite seu nome completo"
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
                                    value="<?php echo htmlspecialchars($usuario["cpf"], ENT_QUOTES, "UTF-8"); ?>"
                                    placeholder="Digite seu CPF"
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
                                    value="<?php echo htmlspecialchars($usuario["data_nascimento"], ENT_QUOTES, "UTF-8"); ?>"
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
                                    value="<?php echo htmlspecialchars($usuario["cep"], ENT_QUOTES, "UTF-8"); ?>"
                                    placeholder="Digite seu CEP"
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
                                    value="<?php echo htmlspecialchars($usuario["complemento"], ENT_QUOTES, "UTF-8"); ?>"
                                    placeholder="Digite um complemento"
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
                                    value="<?php echo htmlspecialchars($usuario["telefone"], ENT_QUOTES, "UTF-8"); ?>"
                                    placeholder="Digite seu telefone"
                                    maxlength="15"
                                    required
                                >

                            </div>

                        </div>

                    </div>


                    <!-- =====================================================
                         ACESSO
                    ====================================================== -->

                    <div class="editar-usuarios-acesso">

                        <label for="usuario-acesso">
                            Acesso
                        </label>

                        <select
                            name="acesso"
                            id="usuario-acesso"
                            required
                        >

                            <option value="" disabled>
                                Selecione
                            </option>

                            <option
                                value="Funcionário"
                                <?php
                                echo ($usuario["acesso"] === "Funcionário")
                                    ? "selected"
                                    : "";
                                ?>
                            >
                                Funcionário
                            </option>

                            <option
                                value="Administrador"
                                <?php
                                echo ($usuario["acesso"] === "Administrador")
                                    ? "selected"
                                    : "";
                                ?>
                            >
                                Administrador
                            </option>

                        </select>

                    </div>


                    <!-- =====================================================
                         SALVAR
                    ====================================================== -->

                    <div class="editar-usuarios-botao">

                        <button type="submit">
                            Salvar Alterações
                        </button>

                    </div>


                    <!-- =====================================================
                         VOLTAR
                    ====================================================== -->

                    <div class="editar-usuarios-botao-voltar">

                        <a href="gestao-usuarios.php">
                            Voltar
                        </a>

                    </div>


                    <!-- =====================================================
                         MENSAGEM
                    ====================================================== -->

                    <?php if ($mensagem !== ""): ?>

                        <div
                            class="editar-mensagem <?php echo htmlspecialchars($tipoMensagem); ?>"
                        >

                            <?php
                            echo htmlspecialchars(
                                $mensagem,
                                ENT_QUOTES,
                                "UTF-8"
                            );
                            ?>

                        </div>

                    <?php endif; ?>


                </form>

            </div>

        </div>

    </main>

</div>


</body>

</html>