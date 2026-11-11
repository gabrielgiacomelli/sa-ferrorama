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


        $sql = "SELECT id, nome, email, senha, acesso
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


                    $_SESSION["usuario_acesso"] =
                        $usuario["acesso"];


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
    <link rel="stylesheet" href="../styles/style.css">

    <title>Login</title>

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

