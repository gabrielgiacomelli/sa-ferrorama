<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";


/* Excluir sensor */

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["excluir"])) {

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if ($id) {

        $sql = "DELETE FROM sensores WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $id);

            try {

                if (mysqli_stmt_execute($stmt)) {

                    if (mysqli_stmt_affected_rows($stmt) > 0) {

                        $mensagem = "Sensor excluído com sucesso!";
                        $tipoMensagem = "sucesso";

                    } else {

                        $mensagem = "Sensor não encontrado.";
                        $tipoMensagem = "erro";
                    }

                } else {

                    $mensagem = "Não foi possível excluir o sensor.";
                    $tipoMensagem = "erro";
                }

            } catch (mysqli_sql_exception $e) {

                $mensagem = "Não é possível excluir este sensor porque ele possui registros relacionados.";
                $tipoMensagem = "erro";
            }

            mysqli_stmt_close($stmt);
        }
    }
}

/* Buscar sensores */

$sql = "SELECT id, nome, instalacao, funcao, zona, status
        FROM sensores
        ORDER BY id ASC";

$stmt = mysqli_prepare($conn, $sql);

$sensores = [];

if ($stmt) {

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    while ($sensor = mysqli_fetch_assoc($resultado)) {

        $sensores[] = $sensor;
    }

    mysqli_stmt_close($stmt);
}

?>

<html lang="pt-BR">
<?php
$paginaAtual = "gestao";
$submenuAtual = "gestao-sensores";
include("../includes/navbar.php");
?>

<head>
    <title>Sensores Cadastrados</title>
</head>

<body>
    
<main id="gestao-sensores">

    <h1>SENSORES CADASTRADOS</h1>


    <div class="gestao-container">

        <div class="gestao-card">

            <h2>Gestão de Sensores</h2>

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

                            <th>Nome</th>

                            <th>ID</th>

                            <th>Instalação</th>

                            <th>Função</th>

                            <th>Zona</th>

                            <th>Status</th>

                            <th>Ações</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if (count($sensores) > 0): ?>

                        <?php foreach ($sensores as $sensor): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($sensor["nome"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($sensor["id"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($sensor["instalacao"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($sensor["funcao"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($sensor["zona"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($sensor["status"]) ?>
                                </td>

                                <td>

                                    <div class="gestao-acoes">

                                        <a
                                            href="editar-sensor.php?id=<?= $sensor["id"] ?>"
                                            class="gestao-btn atualizar"
                                        >
                                            Atualizar
                                        </a>


                                        <button
                                            type="button"
                                            class="gestao-btn excluir"
                                            onclick="abrirPopup(<?= $sensor["id"] ?>)"
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
                                Nenhum sensor cadastrado.
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

<div
    id="popup-excluir"
    class="popup-overlay"
>

    <div class="popup-card">

        <h3>Excluir sensor?</h3>

        <p>
            Tem certeza que deseja excluir este sensor?
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

<script>

function abrirPopup(id) {

    document.getElementById("excluir_id").value = id;

    document
        .getElementById("popup-excluir")
        .classList.add("ativo");
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