<?php
include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";

/* Desativar rota */



/* Excluir rota */

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["excluir"])) {

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if ($id) {

        $sql = "DELETE FROM rotas WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $id);

            try {

                if (mysqli_stmt_execute($stmt)) {

                    if (mysqli_stmt_affected_rows($stmt) > 0) {

                        $mensagem = "Rota excluída com sucesso!";
                        $tipoMensagem = "sucesso";

                    } else {

                        $mensagem = "Rota não encontrada.";
                        $tipoMensagem = "erro";
                    }

                } else {

                    $mensagem = "Não foi possível excluir a rota.";
                    $tipoMensagem = "erro";
                }

            } catch (mysqli_sql_exception $e) {

                $mensagem = "Não é possível excluir esta rota porque ele possui registros relacionados.";
                $tipoMensagem = "erro";
            }

            mysqli_stmt_close($stmt);
        }
    }
}

/* Buscar rota */

$sql = "SELECT id, nome, saida, destino, status
        FROM rotas
        ORDER BY id ASC";

$stmt = mysqli_prepare($conn, $sql);

$rotas = [];

if ($stmt) {

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    while ($rota = mysqli_fetch_assoc($resultado)) {

        $rotas[] = $rota;
    }

    mysqli_stmt_close($stmt);
}

?>



<html lang="pt-BR">
<?php
$paginaAtual = "gestao";
$submenuAtual = "gestao-rotas";
include("../includes/navbar.php");
?>

<head>
    <title>Rotas cadastradas</title>
</head>

<body>
    
<main id="gestao-rotas">

    <h1>ROTAS CADASTRADAS</h1>


    <div class="gestao-container">

        <div class="gestao-card">

            <h2>Gestão de Rotas</h2>

            <div class="gestao-linha"></div>


            <?php if ($mensagem !== ""): ?>

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

                            <th>Nome</th>

                            <th>Saída</th>

                            <th>Destino</th>

                            <th>Status</th>

                            <th>Ações</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if (count($rotas) > 0): ?>

                        <?php foreach ($rotas as $rota): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($rota["id"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($rota["nome"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($rota["saida"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($rota["destino"]) ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars($rota["status"]) ?>
                                </td>

                                <td>

                                    <div class="gestao-acoes">

                                        <a
                                            href="editar-rota.php?id=<?= $rota["id"] ?>"
                                            class="gestao-btn atualizar"
                                        >
                                            Atualizar
                                        </a>

                                        <button
                                            type="button"
                                            class="gestao-btn desativar"
                                            onclick="abrirPopup_2(<?= $rota["id"] ?>)"
                                        >
                                            Desativar
                                        </button>


                                        <button
                                            type="button"
                                            class="gestao-btn excluir"
                                            onclick="abrirPopup_1(<?= $rota["id"] ?>)"
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
                                colspan="7"
                                class="gestao-vazio"
                            >
                                Nenhuma rota cadastrada.
                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</main>


<!-- POP-UP DE CONFIRMAÇÃO -->

<!-- POP-UP DE EXCLUIR -->

<div
    id="popup-excluir"
    class="popup-overlay"
>

    <div class="popup-card">

        <h3>Excluir rota?</h3>

        <p>
            Tem certeza que deseja excluir esta rota?
        </p>


        <div class="popup-acoes">

            <button
                type="button"
                class="popup-btn cancelar"
                onclick="fecharPopup_1()"
            >
                Cancelar
            </button>


            <form
                method="POST"
                id="form-excluir"
            >

                <input
                    type="hidden"
                    name="id"
                    id="excluir_id"
                >

                <input
                    type="hidden"
                    name="excluir"
                    value="1"
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

<!-- POP-UP DE DESATIVAR -->

<div
    id="popup-desativar"
    class="popup-overlay"
>

    <div class="popup-card">

        <h3>Desativar rota?</h3>

        <p>
            Tem certeza que deseja desativar esta rota?
        </p>


        <div class="popup-acoes">

            <button
                type="button"
                class="popup-btn cancelar"
                onclick="fecharPopup_2()"
            >
                Cancelar
            </button>


            <form
                method="POST"
                id="form-desativar"
            >

                <input
                    type="hidden"
                    name="id"
                    id="desativar_id"
                >

                <input
                    type="hidden"
                    name="desativar"
                    value="1"
                >


                <button
                    type="submit"
                    class="popup-btn confirmar"
                >
                    Desativar
                </button>

            </form>

        </div>

    </div>

</div>

<script>

function abrirPopup_1(id) {

    document.getElementById("excluir_id").value = id;

    document
        .getElementById("popup-excluir")
        .classList.add("ativo");
}

function abrirPopup_2(id) {

    document.getElementById("desativar_id").value = id;

    document
        .getElementById("popup-desativar")
        .classList.add("ativo");
}

function fecharPopup_1() {

    document
        .getElementById("popup-excluir")
        .classList.remove("ativo");
}

function fecharPopup_2() {

    document
        .getElementById("popup-desativar")
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

</main>
    <!-- POPUP DE SAIR (overlay) -->
        <div class="popup" id="popup">
            <div class="overlay"></div>
            <div class="popup-content">
                <h2>Aviso</h2>
                <p>Você deseja sair da sua conta?</p>
                <h6>(Seu progresso será salvo automaticamente)</h6>
                <div class="controls">
                    <button class="fechar-popup nav-link mx-lg-2"
                        onclick="window.location.href='login.php'">Sim</button>
                    <button class="close-btn nav-link mx-lg-2">Não</button>
                </div>
            </div>
        </div>
    <!-- Scripts -->
    <script src="../scripts/botao-sair.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>