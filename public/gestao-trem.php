<?php
include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";


/* Ativar trem */

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ativar"])) {

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if ($id){

$sql = "UPDATE trens SET status = 'Ativo' WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $id);

            try {

                if (mysqli_stmt_execute($stmt)) {

                    if (mysqli_stmt_affected_rows($stmt) > 0) {

                        $mensagem = "Trem ativado com sucesso!";
                        $tipoMensagem = "sucesso";

                    } else {

                        $mensagem = "Trem não encontrada.";
                        $tipoMensagem = "erro";
                    }

                } else {

                    $mensagem = "Não foi possível ativar o trem.";
                    $tipoMensagem = "erro";
                }

                } catch (mysqli_sql_exception $e) {

                $mensagem = "Não é possível ativar este trem porque ele possui registros relacionados.";
                $tipoMensagem = "erro";
            }

            mysqli_stmt_close($stmt);
        }
    }
}





/* Desativar trem */

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["desativar"])) {

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if ($id){

$sql = "UPDATE trens SET status = 'Inativo' WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $id);

            try {

                if (mysqli_stmt_execute($stmt)) {

                    if (mysqli_stmt_affected_rows($stmt) > 0) {

                        $mensagem = "Trem desativado com sucesso!";
                        $tipoMensagem = "sucesso";

                    } else {

                        $mensagem = "Trem não encontrado.";
                        $tipoMensagem = "erro";
                    }

                } else {

                    $mensagem = "Não foi possível desativar o trem.";
                    $tipoMensagem = "erro";
                }

                } catch (mysqli_sql_exception $e) {

                $mensagem = "Não é possível desativar este trem porque ele possui registros relacionados.";
                $tipoMensagem = "erro";
            }

            mysqli_stmt_close($stmt);
        }
    }
}

/* Excluir trem */

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["excluir"])) {

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if ($id) {

        $sql = "DELETE FROM trens WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $id);

            try {

                if (mysqli_stmt_execute($stmt)) {

                    if (mysqli_stmt_affected_rows($stmt) > 0) {

                        $mensagem = "Trem excluído com sucesso!";
                        $tipoMensagem = "sucesso";

                    } else {

                        $mensagem = "Trem não encontrado.";
                        $tipoMensagem = "erro";
                    }

                } else {

                    $mensagem = "Não foi possível excluir o trem.";
                    $tipoMensagem = "erro";
                }

            } catch (mysqli_sql_exception $e) {

                $mensagem = "Não é possível excluir este trem porque ele possui registros relacionados.";
                $tipoMensagem = "erro";
            }

            mysqli_stmt_close($stmt);
        }
    }
}

/* Buscar trens */

$sql = "SELECT id, id_usuarios, peso, quantidade_vagoes, status
        FROM trens
        ORDER BY id ASC";

$stmt = mysqli_prepare($conn, $sql);

$trens = [];

if ($stmt) {

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    while ($trem = mysqli_fetch_assoc($resultado)) {

        $trens[] = $trem;
    }

    mysqli_stmt_close($stmt);
}

?>

<html lang="pt-BR">
<?php
$paginaAtual = "gestao";
$submenuAtual = "gestao-trens";
include("../includes/navbar.php");
?>

<head>
    <title>Trens Cadastrados</title>
</head>

<body>
    
<main id="gestao-trens">

    <h1>TRENS CADASTRADOS</h1>


    <div class="gestao-container">

        <div class="gestao-card">

            <h2>Gestão de Trens</h2>

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

                            <th>ID_Usuários</th>

                            <th>Peso</th>

                            <th>Quantidade de Vagões</th>

                            <th>Status</th>

                            <th>Ações</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if (count($trens) > 0): ?>

                        <?php foreach ($trens as $trem): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($trem["id"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($trem["id_usuarios"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($trem["peso"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($trem["quantidade_vagoes"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($trem["status"]) ?>
                                </td>

                                <td>

                                    <div class="gestao-acoes">

                                        <a
                                            href="editar-trem.php?id=<?= $trem["id"] ?>"
                                            class="gestao-btn atualizar"
                                        >
                                            Atualizar
                                        </a>

                                        <?php
                                        if($trem["status"] === "Ativo"): ?>
                                        <button
                                            type="button"
                                            class="gestao-btn desativar"
                                            onclick="abrirPopup_2(<?= $trem["id"] ?>)"
                                        >
                                            Desativar
                                            
                                        </button>

                                        <?php else: ?>

                                        <button
                                            type="button"
                                            class="gestao-btn ativar"
                                            onclick="abrirPopup_3(<?= $trem["id"] ?>)"
                                        >
                                            Ativar
                                            
                                        </button>

                                        <button
                                            type="button"
                                            class="gestao-btn excluir"
                                            onclick="abrirPopup_1(<?= $trem["id"] ?>)"
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
                                Nenhum trem cadastrado.
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

        <h3>Excluir trem?</h3>

        <p>
            Tem certeza que deseja excluir este trem?
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

        <h3>Ativar trem?</h3>

        <p>
            Tem certeza que deseja ativar este trem?
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

        <h3>Desativar trem?</h3>

        <p>
            Tem certeza que deseja desativar este trem?
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

            fecharPopup_1();
        }

    });

</script>

</main>

</body>

</html>