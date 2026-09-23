<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";


/* Excluir usuário */

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["excluir"])) {

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if ($id) {

        $sql = "DELETE FROM usuarios WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $id);

            try {

                if (mysqli_stmt_execute($stmt)) {

                    if (mysqli_stmt_affected_rows($stmt) > 0) {

                        $mensagem = "Usuário excluído com sucesso!";
                        $tipoMensagem = "sucesso";

                    } else {

                        $mensagem = "Usuário não encontrado.";
                        $tipoMensagem = "erro";
                    }

                } else {

                    $mensagem = "Não foi possível excluir o usuário.";
                    $tipoMensagem = "erro";
                }

            } catch (mysqli_sql_exception $e) {

                $mensagem = "Não é possível excluir este usuário porque ele possui registros relacionados.";
                $tipoMensagem = "erro";
            }

            mysqli_stmt_close($stmt);
        }
    }
}


/* Buscar usuários */

$sql = "SELECT id, nome, email, telefone
        FROM usuarios
        ORDER BY id ASC";

$stmt = mysqli_prepare($conn, $sql);

$usuarios = [];

if ($stmt) {

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    while ($usuario = mysqli_fetch_assoc($resultado)) {

        $usuarios[] = $usuario;
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>

<html lang="pt-BR">
<?php

$paginaAtual = "gestao";
$submenuAtual = "usuarios";

include("../includes/navbar.php");

?>
<head>
    <title>Usuários Cadastrados</title>
</head>

<body>



<main id="gestao-usuarios">

    <h1>USUÁRIOS CADASTRADOS</h1>


    <div class="gestao-container">

        <div class="gestao-card">

            <h2>Gestão de Usuários</h2>

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

                            <th>Usuários</th>

                            <th>ID</th>

                            <th>Email</th>

                            <th>Telefone</th>

                            <th>Ações</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if (count($usuarios) > 0): ?>

                        <?php foreach ($usuarios as $usuario): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($usuario["nome"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($usuario["id"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($usuario["email"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($usuario["telefone"]) ?>
                                </td>

                                <td>

                                    <div class="gestao-acoes">

                                        <a
                                            href="editar-usuario.php?id=<?= $usuario["id"] ?>"
                                            class="gestao-btn atualizar"
                                        >
                                            Atualizar
                                        </a>


                                        <button
                                            type="button"
                                            class="gestao-btn excluir"
                                            onclick="abrirPopup(<?= $usuario["id"] ?>)"
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
                                colspan="5"
                                class="gestao-vazio"
                            >
                                Nenhum usuário cadastrado.
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

        <h3>Excluir usuário?</h3>

        <p>
            Tem certeza que deseja excluir este usuário?
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


<script src="../scripts/botao-sair.js"></script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9H9JcYn3nv7wiPVlz7YYwJrVwcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
</script>

</body>

</html>