<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");

    if ($email === "") {

        $mensagem = "Digite o email da sua conta.";
        $tipoMensagem = "erro";

    } else {

        $sql = "SELECT id, nome
                FROM usuarios
                WHERE email = ?
                LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            $resultado = mysqli_stmt_get_result($stmt);

            if ($resultado && mysqli_num_rows($resultado) === 1) {

                $usuario = mysqli_fetch_assoc($resultado);

                $mensagem = "Conta encontrada! Entre em contato com o suporte para recuperar sua senha.";
                $tipoMensagem = "sucesso";

            } else {

                $mensagem = "Nenhuma conta foi encontrada com esse email.";
                $tipoMensagem = "erro";
            }

            mysqli_stmt_close($stmt);

        } else {

            $mensagem = "Erro ao consultar o banco de dados.";
            $tipoMensagem = "erro";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Recuperar conta</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .recuperar-pagina {
            width: 100%;
            min-height: 100vh;

            display: flex;
            flex-direction: column;
            align-items: center;

            padding-top: 48px;
        }

        .recuperar-logo {
            color: #193655;

            font-size: 64px;
            font-weight: 900;

            line-height: 1;

            margin-bottom: 70px;
        }

        .recuperar-card {
            width: 300px;

            padding: 20px 22px 22px;

            background: #ffffff;

            border-radius: 14px;

            box-shadow:
                0 12px 30px rgba(0, 0, 0, 0.14);
        }

        .recuperar-titulo {
            margin: 0 0 20px;

            color: #111111;

            text-align: center;

            font-size: 24px;
            font-weight: 400;
        }

        .recuperar-campo {
            width: 100%;

            margin-bottom: 14px;
        }

        .recuperar-campo label {
            display: block;

            margin-bottom: 5px;

            color: #111111;

            font-size: 14px;
        }

        .recuperar-campo input {
            width: 100%;
            height: 38px;

            padding: 0 9px;

            border: 2px solid #111111;
            border-radius: 6px;

            background: #ffffff;

            color: #111111;

            font-size: 14px;

            outline: none;
        }

        .recuperar-campo input:focus {
            border-color: #111111;

            box-shadow: none;
        }

        .recuperar-botao {
            width: 100%;
            height: 37px;

            margin-top: 1px;

            border: none;
            border-radius: 9px;

            background: #193655;

            color: #ffffff;

            font-size: 14px;
            font-weight: bold;

            cursor: pointer;
        }

        .recuperar-botao:hover {
            background: #193655;
        }

        .resultado {
            width: 100%;

            margin-top: 12px;

            padding: 11px 12px;

            border-radius: 9px;

            text-align: center;

            font-size: 13px;

            line-height: 1.4;
        }

        .resultado p {
            margin: 0;
        }

        .resultado.sucesso {
            background: #e8f7ed;

            border: 1px solid #6fbe83;

            color: #26733b;
        }

        .resultado.erro {
            background: #fdeaea;

            border: 1px solid #d66b6b;

            color: #a52b2b;
        }

        .voltar-login {
            display: flex;

            width: 100%;
            height: 38px;

            margin-top: 10px;

            align-items: center;
            justify-content: center;

            border: none;
            border-radius: 9px;

            background: #f7f7f7;

            color: #111111;

            font-size: 14px;
            font-weight: bold;

            text-decoration: none;

            cursor: pointer;

            box-shadow:
                0 4px 12px rgba(0, 0, 0, 0.04);
        }

        .voltar-login:hover {
            background: #eeeeee;

            color: #111111;
        }

        @media (max-width: 500px) {

            .recuperar-pagina {
                padding: 35px 20px;
            }

            .recuperar-logo {
                font-size: 52px;

                margin-bottom: 50px;
            }

            .recuperar-card {
                width: 100%;
                max-width: 300px;
            }

        }

    </style>

</head>

<body>

    <main class="recuperar-pagina">

        <div class="recuperar-logo">
            HLGL
        </div>

        <div class="recuperar-card">

            <h1 class="recuperar-titulo">
                Recuperar conta
            </h1>

            <form method="POST">

                <div class="recuperar-campo">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Digite o email de sua conta"
                        value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"
                        required
                    >

                </div>

                <button
                    type="submit"
                    class="recuperar-botao"
                >
                    Recuperar sua conta
                </button>

            </form>

            <?php if ($mensagem !== ""): ?>

                <div class="resultado <?= $tipoMensagem ?>">

                    <p>
                        <?= htmlspecialchars($mensagem) ?>
                    </p>

                </div>

            <?php endif; ?>

            <a
                href="login.php"
                class="voltar-login"
            >
                Voltar para o login
            </a>

        </div>

    </main>

</body>

</html>