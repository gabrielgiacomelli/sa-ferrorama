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

            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            $resultado = mysqli_stmt_get_result($stmt);

            if ($resultado && mysqli_num_rows($resultado) === 1) {

                $usuario = mysqli_fetch_assoc($resultado);

                if ($senha === $usuario["senha"]) {

                    $_SESSION["usuario_id"] = $usuario["id"];
                    $_SESSION["usuario_nome"] = $usuario["nome"];
                    $_SESSION["usuario_email"] = $usuario["email"];

                    mysqli_stmt_close($stmt);

                    header("Location: ../public/home.php");
                    exit;

                } else {

                    $erro = "Email ou senha incorretos!";
                }

            } else {

                $erro = "Email ou senha incorretos!";
            }

            mysqli_stmt_close($stmt);

        } else {

            $erro = "Erro ao consultar o banco de dados.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

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

        .login-pagina {
            width: 100%;
            min-height: 100vh;

            display: flex;
            flex-direction: column;
            align-items: center;

            padding-top: 48px;
        }

        .login-logo {
            color: #193655;

            font-size: 64px;
            font-weight: 900;

            line-height: 1;

            margin-bottom: 70px;
        }

        .login-card {
            width: 300px;

            padding: 20px 22px 22px;

            background: #ffffff;

            border-radius: 14px;

            box-shadow:
                0 12px 30px rgba(0, 0, 0, 0.14);
        }

        .login-titulo {
            margin: 0 0 20px;

            color: #111111;

            text-align: center;

            font-size: 24px;
            font-weight: 400;
        }

        .login-campo {
            width: 100%;

            margin-bottom: 12px;
        }

        .login-campo label {
            display: block;

            margin-bottom: 5px;

            color: #111111;

            font-size: 14px;
        }

        .login-campo input {
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

        .login-campo input:focus {
            border-color: #111111;

            box-shadow: none;
        }

        .login-entrar {
            width: 100%;
            height: 37px;

            margin-top: 1px;

            border: none;
            border-radius: 9px;

            background: #193655;

            color: #ffffff;

            font-size: 15px;
            font-weight: bold;

            cursor: pointer;
        }

        .login-entrar:hover {
            background: #193655;
        }

        .login-recuperar {
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

            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }

        .login-recuperar:hover {
            background: #eeeeee;

            color: #111111;
        }

        .login-erro {
            width: 100%;

            margin-top: 12px;

            padding: 11px;

            border: 1px solid #d66b6b;
            border-radius: 9px;

            background: #fdeaea;

            color: #a52b2b;

            text-align: center;

            font-size: 13px;
        }

        .login-erro p {
            margin: 0;
        }

        @media (max-width: 500px) {

            .login-pagina {
                padding: 35px 20px;
            }

            .login-logo {
                font-size: 52px;

                margin-bottom: 50px;
            }

            .login-card {
                width: 100%;
                max-width: 300px;
            }

        }

    </style>

</head>

<body>

    <main class="login-pagina">

        <div class="login-logo">
            HLGL
        </div>

        <div class="login-card">

            <h1 class="login-titulo">
                Login
            </h1>

            <form method="POST">

                <div class="login-campo">

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

                <div class="login-campo">

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
                    class="login-entrar"
                >
                    Entrar
                </button>

                <a
                    href="recuperar-senha.php"
                    class="login-recuperar"
                >
                    Esqueceu sua senha?
                </a>

            </form>

            <?php if ($erro !== ""): ?>

                <div class="login-erro">

                    <p>
                        <?= htmlspecialchars($erro) ?>
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </main>

</body>

</html>