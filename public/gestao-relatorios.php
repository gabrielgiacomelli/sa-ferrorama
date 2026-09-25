<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";

// mensagem de sucesso no editar relatório 
if (isset($_GET["sucesso"]) && $_GET["sucesso"] === "relatorio") {

    $mensagem = "Relatório atualizado com sucesso!";
    $tipoMensagem = "sucesso";

}


/* EXCLUIR RELATÓRIO */

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["excluir_id"])) {

    $id = (int) $_POST["excluir_id"];

    $sql = "DELETE FROM relatorios WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            $mensagem = "Relatório excluído com sucesso!";
            $tipoMensagem = "sucesso";
        } else {
            $mensagem = "Erro ao excluir o relatório.";
            $tipoMensagem = "erro";
        }

        mysqli_stmt_close($stmt);

    } else {

        $mensagem = "Erro ao preparar a exclusão.";
        $tipoMensagem = "erro";
    }
}


/* BUSCAR RELATÓRIOS */

$sql = "SELECT
            relatorios.id,
            relatorios.conteudo,
            usuarios.nome AS usuario
        FROM relatorios
        LEFT JOIN usuarios
            ON relatorios.id_usuarios = usuarios.id
        ORDER BY relatorios.id ASC";

$stmt = mysqli_prepare($conn, $sql);

$relatorios = [];

if ($stmt) {

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    while ($relatorio = mysqli_fetch_assoc($resultado)) {
        $relatorios[] = $relatorio;
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<?php
$paginaAtual = "gestao";
$submenuAtual = "gestao-relatorios";

include("../includes/navbar.php");

?>
<head>
    <title>Relatórios Cadastrados</title>
</head>

<body>


<main id="gestao-relatorios">

    <h1>RELATÓRIOS CADASTRADOS</h1>


    <div class="gestao-container">

        <div class="gestao-card">

            <h2>Gestão de Relatórios</h2>

            <div class="gestao-linha"></div>


            <?php if (!empty($mensagem)): ?>

                <div
                    class="gestao-mensagem <?= htmlspecialchars($tipoMensagem) ?>"
                >

                    <?= htmlspecialchars($mensagem) ?>

                </div>

            <?php endif; ?>


            <div class="gestao-tabela-container">

                <table class="gestao-tabela">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Relatório</th>

                            <th>Usuário</th>

                            <th>Ações</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php if (count($relatorios) > 0): ?>

                            <?php foreach ($relatorios as $relatorio): ?>

                                <tr>

                                    <td>
                                        <?= htmlspecialchars($relatorio["id"]) ?>
                                    </td>

                                    <td class="gestao-conteudo">

                                        <?= htmlspecialchars($relatorio["conteudo"]) ?>

                                    </td>

                                    <td>

                                        <?= htmlspecialchars(
                                            $relatorio["usuario"] ?? "Não informado"
                                        ) ?>

                                    </td>

                                    <td>

                                        <div class="gestao-acoes">

                                            <a
                                                href="editar-relatorio.php?id=<?= $relatorio["id"] ?>"
                                                class="gestao-btn atualizar"
                                            >
                                                Atualizar
                                            </a>


                                            <button
                                                type="button"
                                                class="gestao-btn excluir"
                                                onclick="abrirPopup(<?= $relatorio["id"] ?>)"
                                            >
                                                Excluir
                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td
                                    colspan="4"
                                    class="gestao-vazio"
                                >
                                    Nenhum relatório cadastrado.
                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</main>


<!-- POP-UP -->

<div
    id="popup-excluir"
    class="popup-overlay"
>

    <div class="popup-card">

        <h3>Excluir relatório?</h3>

        <p>
            Tem certeza que deseja excluir este relatório?
        </p>

        <div class="popup-acoes">

            <button
                type="button"
                class="popup-btn cancelar"
                onclick="fecharPopup()"
            >
                Cancelar
            </button>


            <form
                method="POST"
                id="form-excluir"
            >

                <input
                    type="hidden"
                    name="excluir_id"
                    id="excluir_id"
                >

                <button
                    type="submit"
                    class="popup-btn confirmar"
                >
                    Excluir
                </button>

            </form>

        </div>

    </div>

</div>


<script>

function abrirPopup(id) {

    document.getElementById("excluir_id").value = id;

    document.getElementById("popup-excluir").classList.add("ativo");
}

function fecharPopup() {

    document
        .getElementById("popup-excluir")
        .classList.remove("ativo");
}


document
    .getElementById("popup-excluir")
    .addEventListener("click", function(event) {

        if (event.target === this) {
            fecharPopup();
        }

    });

</script>


<script src="../scripts/botao-sair.js"></script>

</body>

</html>