<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";


/* Excluir relatório */

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["excluir"])) {

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if ($id) {

        $sql = "DELETE FROM relatorios WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $id);

            if (mysqli_stmt_execute($stmt)) {

                if (mysqli_stmt_affected_rows($stmt) > 0) {

                    $mensagem = "Relatório excluído com sucesso!";
                    $tipoMensagem = "sucesso";

                } else {

                    $mensagem = "Relatório não encontrado.";
                    $tipoMensagem = "erro";
                }

            } else {

                $mensagem = "Não foi possível excluir o relatório.";
                $tipoMensagem = "erro";
            }

            mysqli_stmt_close($stmt);
        }
    }
}


/* Buscar relatórios */

$sql = "SELECT
            relatorios.id,
            relatorios.conteudo,
            usuarios.nome AS usuario
        FROM relatorios
        INNER JOIN usuarios
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

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Gestão de Relatórios</title>

    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >

</head>


<?php

$paginaAtual = "gestao";
$submenuAtual = "relatorios";

include("../includes/navbar.php");

?>


<body>

<main id="gestao-relatorios">

    <h1>RELATÓRIOS CADASTRADOS</h1>


    <div class="gestao-relatorios-container">

        <div class="gestao-relatorios-card">

            <h2>Gestão de Relatórios</h2>


            <div class="gestao-relatorios-linha"></div>


            <?php if ($mensagem !== ""): ?>

                <div
                    class="gestao-mensagem <?php echo $tipoMensagem; ?>"
                >

                    <?php echo htmlspecialchars($mensagem); ?>

                </div>

            <?php endif; ?>


            <div class="gestao-relatorios-tabela-container">

                <table class="gestao-relatorios-tabela">

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
                                    <?php
                                    echo htmlspecialchars(
                                        $relatorio["id"]
                                    );
                                    ?>
                                </td>


                                <td class="gestao-relatorio-conteudo">

                                    <?php
                                    echo nl2br(
                                        htmlspecialchars(
                                            $relatorio["conteudo"]
                                        )
                                    );
                                    ?>

                                </td>


                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $relatorio["usuario"]
                                    );
                                    ?>

                                </td>


                                <td>

                                    <div class="gestao-relatorios-acoes">

                                        <a
                                            href="editar-relatorio.php?id=<?php echo $relatorio["id"]; ?>"
                                            class="gestao-btn-atualizar"
                                        >
                                            Atualizar
                                        </a>


                                        <form method="POST">

                                            <input
                                                type="hidden"
                                                name="id"
                                                value="<?php
                                                echo $relatorio["id"];
                                                ?>"
                                            >


                                            <button
                                                type="submit"
                                                name="excluir"
                                                class="gestao-btn-excluir"
                                                onclick="return confirm('Tem certeza que deseja excluir este relatório?');"
                                            >
                                                Excluir
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="4"
                                class="gestao-relatorios-vazio"
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


<script src="../scripts/botao-sair.js"></script>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9H9JcYn3nv7wiPVlz7YYwJrVwcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
</script>

</body>

</html>