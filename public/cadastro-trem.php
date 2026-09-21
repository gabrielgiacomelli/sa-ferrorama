<?php

include "../infra/conn.php";

$mensagem = "";

/* Cadastrar trem */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $peso = $_POST["peso"];
    $quantidade_vagoes = $_POST["quantidade_vagoes"];
    $id_usuarios = $_POST["id_usuarios"];

    $sql = "INSERT INTO trens (id_usuarios, peso, quantidade_vagoes)
            VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            "dii",
            $peso,
            $id_usuarios,
            $quantidade_vagoes
        );

        if (mysqli_stmt_execute($stmt)) {
            $mensagem = "Trem cadastrado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar o trem.";
        }

        mysqli_stmt_close($stmt);

    } else {
        $mensagem = "Erro ao preparar o cadastro.";
    }
}


/* Buscar usuários cadastrados */
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Trens</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<?php

$paginaAtual = "cadastro";
$submenuAtual = "trens";

include("../includes/navbar.php");

?>

<main id="cadastro-trens">

    <h2>Cadastro de Trens</h2>

    <div class="cadastro-trens-container">

        <div class="cadastro-trens-card">

            <form method="POST">

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


                <div class="cadastro-trens-campo">

                    <label for="id_usuarios">
                        Proprietário
                    </label>

                    <select
                        id="id_usuarios"
                        name="id_usuarios"
                        required
                    >

                        <option value="" selected disabled>
                            Selecione um usuário
                        </option>

                        <?php if ($resultadoUsuarios): ?>

                            <?php while ($usuario = mysqli_fetch_assoc($resultadoUsuarios)): ?>

                                <option value="<?= $usuario["id"] ?>">
                                    <?= htmlspecialchars($usuario["nome"]) ?>
                                </option>

                            <?php endwhile; ?>

                        <?php endif; ?>

                    </select>

                </div>


                <div class="cadastro-trens-botao">

                    <button type="submit">
                        Cadastrar Trem
                    </button>

                </div>

            </form>


            <?php if (!empty($mensagem)): ?>

                <p class="cadastro-trens-mensagem">
                    <?= htmlspecialchars($mensagem) ?>
                </p>

            <?php endif; ?>

        </div>

    </div>

</main>

</body>
</html>

<?php

if ($stmtUsuarios) {
    mysqli_stmt_close($stmtUsuarios);
}

?>