<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $saida = $_POST["saida"];
    $destino = $_POST["destino"];

    $sql = "INSERT INTO rotas (nome, saida, destino)
            VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            "sss",
            $nome,
            $saida,
            $destino
        );

        if (mysqli_stmt_execute($stmt)) {

            $mensagem = "Rota cadastrada com sucesso!";
            $tipoMensagem = "sucesso";

        } else {

            $mensagem = "Erro ao cadastrar a rota.";
            $tipoMensagem = "erro";
        }

        mysqli_stmt_close($stmt);

    } else {

        $mensagem = "Erro ao preparar o cadastro.";
        $tipoMensagem = "erro";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Rotas</title>

</head>

<?php

$paginaAtual = "cadastro";
$submenuAtual = "rotas";

include("../includes/navbar.php");

?>

<body>

    <main id="cadastro-rotas">

        <h2>Cadastro de Rotas</h2>

        <div class="cadastro-rotas-container">

            <form
                class="cadastro-rotas-card"
                method="POST"
            >

                <div class="cadastro-rotas-campo">

                    <label for="rota-nome">
                        Nome:
                    </label>

                    <input
                        type="text"
                        id="rota-nome"
                        name="nome"
                        placeholder="Ex: ROTA_01"
                        required
                    >

                </div>


                <div class="cadastro-rotas-campo">

                    <label for="rota-saida">
                        Saída:
                    </label>

                    <input
                        type="text"
                        id="rota-saida"
                        name="saida"
                        placeholder="Ex: São Paulo"
                        required
                    >

                </div>


                <div class="cadastro-rotas-campo">

                    <label for="rota-destino">
                        Destino:
                    </label>

                    <input
                        type="text"
                        id="rota-destino"
                        name="destino"
                        placeholder="Ex: Rio de Janeiro"
                        required
                    >

                </div>


                <div class="cadastro-rotas-botao">

                    <button type="submit">
                        Cadastrar Rota
                    </button>

                </div>


                <?php if (!empty($mensagem)): ?>

                    <p
                        id="rota-resultado"
                        class="<?= $tipoMensagem ?>"
                    >
                        <?= htmlspecialchars($mensagem) ?>
                    </p>

                <?php endif; ?>

            </form>

        </div>

    </main>


    <script src="../scripts/botao-sair.js"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9H9JcYn3nv7wiPVlz7YYwJrVwcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>

</body>

</html>