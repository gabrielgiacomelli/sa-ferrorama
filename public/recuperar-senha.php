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
        rel="stylesheet"
        href="../styles/style.css"
    >

</head>

<body id="body2">

    <main class="login-container">

        <div class="logo-top">
            HLGL
        </div>

        <div class="login-card recuperar-card">

            <h2>Recuperar conta</h2>

            <form method="POST">

                <div class="campo">

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
                    class="btn-entrar"
                >
                    Recuperar sua conta
                </button>

            </form>

            <?php if ($mensagem !== ""): ?>

                <div class="recuperar-resultado <?= $tipoMensagem ?>">

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