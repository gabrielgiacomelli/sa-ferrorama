<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";

/* Ativar sensor */

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ativar"])) {

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if ($id){

$sql = "UPDATE sensores SET status = 'Ativo' WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $id);

            try {

                if (mysqli_stmt_execute($stmt)) {

                    if (mysqli_stmt_affected_rows($stmt) > 0) {

                        $mensagem = "Sensor ativado com sucesso!";
                        $tipoMensagem = "sucesso";

                    } else {

                        $mensagem = "Sensor não encontrado.";
                        $tipoMensagem = "erro";
                    }

                } else {

                    $mensagem = "Não foi possível ativar o sensor.";
                    $tipoMensagem = "erro";
                }

                } catch (mysqli_sql_exception $e) {

                $mensagem = "Não é possível ativar este sensor porque ele possui registros relacionados.";
                $tipoMensagem = "erro";
            }

            mysqli_stmt_close($stmt);
        }
    }
}





/* Desativar rota */

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["desativar"])) {

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if ($id){

$sql = "UPDATE sensores SET status = 'Inativo' WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $id);

            try {

                if (mysqli_stmt_execute($stmt)) {

                    if (mysqli_stmt_affected_rows($stmt) > 0) {

                        $mensagem = "Sensor desativado com sucesso!";
                        $tipoMensagem = "sucesso";

                    } else {

                        $mensagem = "Sensor não encontrado.";
                        $tipoMensagem = "erro";
                    }

                } else {

                    $mensagem = "Não foi possível desativar o sensor.";
                    $tipoMensagem = "erro";
                }

                } catch (mysqli_sql_exception $e) {

                $mensagem = "Não é possível desativar este sensor porque ele possui registros relacionados.";
                $tipoMensagem = "erro";
            }

            mysqli_stmt_close($stmt);
        }
    }
}


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


                                        <?php
                                        if($sensor["status"] === "Ativo"): ?>
                                        <button
                                            type="button"
                                            class="gestao-btn desativar"
                                            onclick="abrirPopup_2(<?= $sensor["id"] ?>)"
                                        >
                                            Desativar
                                            
                                        </button>

                                        <?php else: ?>

                                        <button
                                            type="button"
                                            class="gestao-btn ativar"
                                            onclick="abrirPopup_3(<?= $sensor["id"] ?>)"
                                        >
                                            Ativar
                                            
                                        </button>

                                        <button
                                            type="button"
                                            class="gestao-btn excluir"
                                            onclick="abrirPopup_1(<?= $sensor["id"] ?>)"
                                        >
                                            Excluir

                                        </button>

                                            <?php endif; ?>

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

<!-- POP-UP DE EXCLUIR -->

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

<!-- POP-UP DE ATIVAR -->

<div
    id="popup-ativar"
    class="popup-overlay"
>

    <div class="popup-card">

        <h3>Ativar sensor?</h3>

        <p>
            Tem certeza que deseja ativar este sensor?
        </p>


        <div class="popup-acoes">

            <button
                type="button"
                class="popup-btn cancelar"
                onclick="fecharPopup_3()"
            >
                Cancelar
            </button>


            <form
                method="POST"
                id="form-ativar"
            >

                <input
                    type="hidden"
                    name="id"
                    id="ativar_id"
                >

                <input
                    type="hidden"
                    name="ativar"
                    value="1"
                >


                <button
                    type="submit"
                    class="popup-btn confirmar"
                >
                    Ativar
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

        <h3>Desativar sensor?</h3>

        <p>
            Tem certeza que deseja desativar este sensor?
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

function abrirPopup_3(id) {

    document.getElementById("ativar_id").value = id;

    document
        .getElementById("popup-ativar")
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

function fecharPopup_3() {

    document
        .getElementById("popup-ativar")
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

</body>

</html>