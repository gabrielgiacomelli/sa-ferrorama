
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="../styles/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
</head>

<body id="body2">

    <main class="login-container">

        <div class="logo-top">
            HLGL
        </div>

        <div class="login-card">

            <h2>Login</h2>

            <form id="FormLogin">

                <div class="campo">
                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        class="form-control"
                        placeholder="Digite seu email">
                </div>

                <div class="campo">
                    <label for="senha">
                        Senha
                    </label>

                    <input
                        type="password"
                        id="senha"
                        class="form-control"
                        placeholder="Digite sua senha">
                </div>

                <button
                    class="btn-entrar"
                    type="submit">
                    Entrar
                </button>

                <button
                    class="btn-esqueci"
                    type="button"
                    onclick="esqueceuSenha()">
                    Esqueceu sua senha?
                </button>

            </form>

            <div class="text-danger text-center">
                <p id="problema"></p>
            </div>

        </div>

    </main>

    <script src="../scripts/login.js"></script>

</body>

</html>