<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";


/*
|----------------------------------------------------------
| EXCLUIR USUÁRIO
|----------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["excluir"])) {

    $id = filter_input(
        INPUT_POST,
        "id",
        FILTER_VALIDATE_INT
    );

    if (!$id || $id <= 0) {

        $mensagem = "Usuário inválido.";
        $tipoMensagem = "erro";

    } else {

        /*
        | Verifica se o usuário realmente existe
        */

        $sql = "SELECT id FROM usuarios WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param(
                $stmt,
                "i",
                $id
            );

            mysqli_stmt_execute($stmt);

            $resultado = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultado) === 0) {

                $mensagem = "Usuário não encontrado.";
                $tipoMensagem = "erro";

                mysqli_stmt_close($stmt);

            } else {

                mysqli_stmt_close($stmt);


                /*
                |------------------------------------------------------
                | EXCLUIR
                |------------------------------------------------------
                */

                $sql = "DELETE FROM usuarios WHERE id = ?";

                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {

                    mysqli_stmt_bind_param(
                        $stmt,
                        "i",
                        $id
                    );

                    try {

                        if (mysqli_stmt_execute($stmt)) {

                            if (mysqli_stmt_affected_rows($stmt) > 0) {

                                $mensagem = "Usuário excluído com sucesso!";
                                $tipoMensagem = "sucesso";

                            } else {

                                $mensagem = "Não foi possível excluir o usuário.";
                                $tipoMensagem = "erro";
                            }

                        } else {

                            $mensagem = "Não foi possível excluir o usuário.";
                            $tipoMensagem = "erro";
                        }

                    } catch (mysqli_sql_exception $e) {

                        /*
                        | Erro de chave estrangeira
                        */

                        if ($e->getCode() == 1451) {

                            $mensagem = "Não é possível excluir este usuário porque ele possui registros relacionados.";
                            $tipoMensagem = "erro";

                        } else {

                            $mensagem = "Não foi possível excluir o usuário.";
                            $tipoMensagem = "erro";
                        }
                    }

                    mysqli_stmt_close($stmt);

                } else {

                    $mensagem = "Erro ao preparar a exclusão.";
                    $tipoMensagem = "erro";
                }
            }

        } else {

            $mensagem = "Erro ao verificar o usuário.";
            $tipoMensagem = "erro";
        }
    }
}


/*
|----------------------------------------------------------
| BUSCAR USUÁRIOS
|----------------------------------------------------------
*/

$sql = "SELECT
            id,
            nome,
            email,
            telefone
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

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Usuários Cadastrados</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>


<?php

$paginaAtual = "gestao";
$submenuAtual = "gestao-usuarios";

include("../includes/navbar.php");

?>


<body>

<main id="gestao-usuarios">

    <h1>USUÁRIOS CADASTRADOS</h1>


    <div class="gestao-container">

        <div class="gestao-card">

            <h2>Gestão de Usuários</h2>

            <div class="gestao-linha"></div>


            <?php if ($mensagem !== ""): ?>

                <div
                    class="gestao-mensagem <?php echo htmlspecialchars($tipoMensagem); ?>"
                >

                    <?php echo htmlspecialchars($mensagem); ?>

                </div>

            <?php endif; ?>


            <div class="gestao-tabela-container">

                <table class="gestao-tabela">

                    <thead>

                        <tr>

                            <th>Usuário</th>

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

                                    <?php
                                    echo htmlspecialchars(
                                        $usuario["nome"],
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );
                                    ?>

                                </td>


                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $usuario["id"],
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );
                                    ?>

                                </td>


                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $usuario["email"],
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );
                                    ?>

                                </td>


                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $usuario["telefone"],
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );
                                    ?>

                                </td>


                                <td>

                                    <div class="gestao-acoes">


                                        <!-- ATUALIZAR -->

                                        <a
                                            href="editar-usuario.php?id=<?php echo (int) $usuario["id"]; ?>"
                                            class="gestao-btn atualizar"
                                        >
                                            Atualizar
                                        </a>


                                        <!-- EXCLUIR -->

                                        <button
                                            type="button"
                                            class="gestao-btn excluir"
                                            onclick="abrirPopup(<?php echo (int) $usuario["id"]; ?>)"
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
></script>


</body>

</html>