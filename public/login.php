<?php

session_start();

include "../infra/conn.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if ($email === "" || $senha === "") {

        $erro = "Preencha todos os campos!";

    } else {

        $sql = "SELECT id, nome, email, senha
                FROM usuarios
                WHERE email = ?
                LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param(
                $stmt,
                "s",
                $email
            );

            mysqli_stmt_execute($stmt);

            $resultado = mysqli_stmt_get_result($stmt);

            if (
                $resultado &&
                mysqli_num_rows($resultado) === 1
            ) {

                $usuario = mysqli_fetch_assoc($resultado);

                if (
                    password_verify(
                        $senha,
                        $usuario["senha"]
                    )
                ) {

                    $_SESSION["usuario_id"] =
                        $usuario["id"];

                    $_SESSION["usuario_nome"] =
                        $usuario["nome"];

                    $_SESSION["usuario_email"] =
                        $usuario["email"];

                    mysqli_stmt_close($stmt);

                    header(
                        "Location: ../public/home.php"
                    );

                    exit;

                } else {

                    $erro =
                        "Email ou senha incorretos!";
                }

            } else {

                $erro =
                    "Email ou senha incorretos!";
            }

            mysqli_stmt_close($stmt);

        } else {

            $erro =
                "Erro ao consultar o banco de dados.";
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

    <title>Login</title>

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;

            background: #f3f5f8;

            font-family: Arial, sans-serif;
        }

        .login-container {
            width: 100%;
            min-height: 100vh;

            display: flex;
            flex-direction: column;

            align-items: center;

            padding-top: 35px;
        }

        .logo-top {
            margin: 0 0 55px 0;

            color: #193655;

            font-size: 64px;
            font-weight: 900;

            line-height: 1;
        }

        .login-card {
            width: 300px;

            padding: 18px 20px 20px;

            background: #ffffff;

            border-radius: 14px;

            box-shadow:
                0 12px 30px rgba(0, 0, 0, 0.14);
        }

        .login-card h2 {
            margin: 0 0 20px 0;

            padding: 0;

            text-align: center;

            color: #111111;

            font-family: Arial, sans-serif;

            font-size: 24px;
            font-weight: 400;

            line-height: 1.2;
        }

        .campo {
            width: 100%;

            margin: 0 0 12px 0;
            padding: 0;
        }

        .campo label {
            display: block;

            width: 100%;

            margin: 0 0 5px 0;
            padding: 0;

            color: #111111;

            font-family: Arial, sans-serif;

            font-size: 14px;
            font-weight: 400;

            line-height: 1;
        }

        .campo input {
            display: block;

            width: 100%;
            height: 34px;

            margin: 0;
            padding: 0 9px;

            border: 2px solid #222222;
            border-radius: 6px;

            background: #ffffff;

            color: #111111;

            font-family: Arial, sans-serif;

            font-size: 13px;

            outline: none;

            box-shadow: none;
        }

        .campo input:focus {
            border-color: #222222;

            outline: none;

            box-shadow: none;
        }

        .campo input::placeholder {
            color: #75808c;

            opacity: 1;
        }

        .btn-entrar {
            display: flex;

            width: 100%;
            height: 33px;

            margin: 0;
            padding: 0;

            align-items: center;
            justify-content: center;

            border: none;
            border-radius: 8px;

            background: #193655;

            color: #ffffff;

            font-family: Arial, sans-serif;

            font-size: 13px;
            font-weight: bold;

            cursor: pointer;
        }

        .btn-entrar:hover {
            background: #193655;
        }

        .btn-esqueci {
            display: flex;

            width: 100%;
            height: 34px;

            margin: 9px 0 0 0;
            padding: 0;

            align-items: center;
            justify-content: center;

            border: none;
            border-radius: 8px;

            background: #f7f7f7;

            color: #111111;

            font-family: Arial, sans-serif;

            font-size: 13px;
            font-weight: bold;

            text-decoration: none;

            cursor: pointer;

            box-shadow:
                0 4px 12px rgba(0, 0, 0, 0.04);
        }

        .btn-esqueci:hover {
            background: #eeeeee;

            color: #111111;
        }

        #problema {
            width: 100%;

            margin: 12px 0 0 0;
            padding: 10px;

            background: #fdeaea;

            border: 1px solid #d66b6b;
            border-radius: 8px;

            color: #a52b2b;

            text-align: center;

            font-family: Arial, sans-serif;

            font-size: 12px;

            line-height: 1.4;
        }

        #problema p {
            margin: 0;
            padding: 0;
        }

        @media (max-width: 500px) {

            .login-container {
                padding: 35px 20px;
            }

            .logo-top {
                margin-bottom: 45px;

                font-size: 52px;
            }

            .login-card {
                width: 100%;
                max-width: 300px;
            }

        }

    </style>

</head>

<body>

    <main class="login-container">

        <div class="logo-top">
            HLGL
        </div>

        <div class="login-card">

            <h2>
                Login
            </h2>

            <form method="POST">

                <div class="campo">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Digite seu email"
                        value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"
                        required
                    >

                </div>

                <div class="campo">

                    <label for="senha">
                        Senha
                    </label>

                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Digite sua senha"
                        required
                    >

                </div>

                <button
                    type="submit"
                    class="btn-entrar"
                >
                    Entrar
                </button>

                <a
                    href="recuperar-senha.php"
                    class="btn-esqueci"
                >
                    Esqueceu sua senha?
                </a>

            </form>

            <?php if ($erro !== ""): ?>

                <div id="problema">

                    <p>
                        <?= htmlspecialchars($erro) ?>
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </main>

</body>

</html>