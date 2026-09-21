<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";


/* =========================
   CADASTRAR TREM
========================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $peso = $_POST["peso"];
    $quantidade_vagoes = $_POST["quantidade_vagoes"];
    $id_usuarios = $_POST["id_usuarios"];

    $sql = "INSERT INTO trens
            (id_usuarios, peso, quantidade_vagoes)
            VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            "idi",
            $id_usuarios,
            $peso,
            $quantidade_vagoes
        );

        if (mysqli_stmt_execute($stmt)) {

            $mensagem = "Trem cadastrado com sucesso!";
            $tipoMensagem = "sucesso";

        } else {

            $mensagem = "Erro ao cadastrar o trem.";
            $tipoMensagem = "erro";
        }

        mysqli_stmt_close($stmt);

    } else {

        $mensagem = "Erro ao preparar o cadastro.";
        $tipoMensagem = "erro";
    }
}


/* =========================
   BUSCAR USUÁRIOS
========================= */

$sqlUsuarios = "SELECT id, nome FROM usuarios ORDER BY nome ASC";

$stmtUsuarios = mysqli_prepare($conn, $sqlUsuarios);

$resultadoUsuarios = false;

if ($stmtUsuarios) {

    mysqli_stmt_execute($stmtUsuarios);

    $resultadoUsuarios = mysqli_stmt_get_result($stmtUsuarios);
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

    <title>Cadastro de Trens</title>

    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >

</head>

<?php

$paginaAtual = "cadastro";
$submenuAtual = "trens";

include("../includes/navbar.php");

?>

<body>

<main id="cadastro-trens">

    <h2>Cadastro de Trens</h2>

    <div class="cadastro-trens-container">

        <div class="cadastro-trens-card">

            <form method="POST">


                <!-- PESO -->

                <div class="cadastro-trens-campo">

                    <label for="peso">
                        Peso total
                    </label>

                    <input
                        type="number"
                        id="peso"
                        name="peso"
                        step="0.01"
                        min="0"
                        placeholder="Ex: 400"
                        required
                    >

                </div>


                <!-- QUANTIDADE DE VAGÕES -->

                <div class="cadastro-trens-campo">

                    <label for="quantidade_vagoes">
                        Quantidade de vagões:
                    </label>

                    <input
                        type="number"
                        id="quantidade_vagoes"
                        name="quantidade_vagoes"
                        min="1"
                        placeholder="Ex: 45"
                        required
                    >

                </div>


                <!-- PROPRIETÁRIO -->

                <div class="cadastro-trens-campo">

                    <label for="id_usuarios">
                        Proprietário
                    </label>

                    <select
                        id="id_usuarios"
                        name="id_usuarios"
                        required
                    >

                        <option
                            value=""
                            selected
                            disabled
                        >
                            Selecione um usuário
                        </option>


                        <?php if ($resultadoUsuarios): ?>

                            <?php while ($usuario = mysqli_fetch_assoc($resultadoUsuarios)): ?>

                                <option
                                    value="<?= htmlspecialchars($usuario["id"]) ?>"
                                >
                                    <?= htmlspecialchars($usuario["nome"]) ?>
                                </option>

                            <?php endwhile; ?>

                        <?php endif; ?>

                    </select>

                </div>


                <!-- BOTÃO -->

                <div class="cadastro-trens-botao">

                    <button type="submit">
                        Cadastrar Trem
                    </button>

                </div>


                <!-- MENSAGEM -->

             <?php if ($mensagem !== ""): ?>

    <div class="cadastro-mensagem <?php echo $tipoMensagem; ?>">
        <?php echo htmlspecialchars($mensagem); ?>
    </div>

<?php endif; ?>


            </form>

        </div>

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

<?php

if ($stmtUsuarios) {
    mysqli_stmt_close($stmtUsuarios);
}

?>