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

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login</title>

    <link
        rel="stylesheet"
        href="../styles/style.css"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body id="body2">

    <main class="login-container">

        <div class="logo-top">
            HLGL
        </div>

        <div class="login-card">

            <h2>Login</h2>

            <form method="POST">

                <div class="campo">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Digite seu email"
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
                        class="form-control"
                        placeholder="Digite sua senha"
                        required
                    >

                </div>

                <button
                    class="btn-entrar"
                    type="submit"
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

                <p id="problema">
                    <?= htmlspecialchars($erro) ?>
                </p>

            <?php endif; ?>

        </div>

    </main>

</body>

</html>