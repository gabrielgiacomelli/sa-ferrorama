<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";

$conteudo = "";
$id_usuarios = "";


/*
CADASTRO DO RELATÓRIO
*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $conteudo = trim($_POST["conteudo"] ?? "");

    $id_usuarios = $_POST["id_usuarios"] ?? "";


    /*
    VALIDA CAMPOS
    */

    if ($conteudo === "") {

        $mensagem = "Preencha o relatório.";

        $tipoMensagem = "erro";

    } elseif ($id_usuarios === "") {

        $mensagem = "Selecione o usuário relacionado.";

        $tipoMensagem = "erro";

    } else {

        /*
        VERIFICA SE O USUÁRIO EXISTE
        */

        $sqlUsuario = "SELECT id
                       FROM usuarios
                       WHERE id = ?";

        $stmtUsuario = mysqli_prepare(
            $conn,
            $sqlUsuario
        );


        if ($stmtUsuario) {

            mysqli_stmt_bind_param(
                $stmtUsuario,
                "i",
                $id_usuarios
            );

            mysqli_stmt_execute(
                $stmtUsuario
            );

            $resultadoUsuario =
                mysqli_stmt_get_result(
                    $stmtUsuario
                );


            if (
                !$resultadoUsuario ||
                mysqli_num_rows($resultadoUsuario) === 0
            ) {

                $mensagem =
                    "O usuário selecionado não existe.";

                $tipoMensagem = "erro";

            } else {

                /*
                CADASTRA O RELATÓRIO
                */

                $sql = "INSERT INTO relatorios
                        (
                            conteudo,
                            id_usuarios
                        )
                        VALUES (?, ?)";


                $stmt = mysqli_prepare(
                    $conn,
                    $sql
                );


                if ($stmt) {

                    mysqli_stmt_bind_param(
                        $stmt,
                        "si",
                        $conteudo,
                        $id_usuarios
                    );


                    try {

                        if (
                            mysqli_stmt_execute($stmt)
                        ) {

                            $mensagem =
                                "Relatório cadastrado com sucesso!";

                            $tipoMensagem =
                                "sucesso";


                            /*
                            LIMPA OS CAMPOS
                            */

                            $conteudo = "";

                            $id_usuarios = "";

                        } else {

                            $mensagem =
                                "Erro ao cadastrar o relatório.";

                            $tipoMensagem =
                                "erro";
                        }

                    } catch (mysqli_sql_exception $e) {

                        $mensagem =
                            "Não foi possível cadastrar o relatório.";

                        $tipoMensagem =
                            "erro";
                    }


                    mysqli_stmt_close(
                        $stmt
                    );

                } else {

                    $mensagem =
                        "Erro ao preparar o cadastro.";

                    $tipoMensagem =
                        "erro";
                }
            }


            mysqli_stmt_close(
                $stmtUsuario
            );

        } else {

            $mensagem =
                "Erro ao verificar o usuário.";

            $tipoMensagem =
                "erro";
        }
    }
}


/*
BUSCA OS USUÁRIOS
*/

$sqlUsuarios = "SELECT id, nome
                FROM usuarios
                ORDER BY nome ASC";


$resultadoUsuarios = mysqli_query(
    $conn,
    $sqlUsuarios
);

?>


<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Cadastro de Relatórios</title>


    <link
        rel="stylesheet"
        href="../styles/styles.css"
    >

</head>


<?php

$paginaAtual = "cadastro";

$submenuAtual = "relatorios";

include("../includes/navbar.php");

?>


<body>


<div id="cadastro-relatorios">


    <main class="cadastro-relatorios-main">


        <h1>
            Cadastro de Relatórios
        </h1>


        <div class="cadastro-relatorios-container">


            <div class="cadastro-relatorios-card">


                <form method="POST">


                    <!-- RELATÓRIO -->

                    <div class="cadastro-relatorios-campo">


                        <textarea
                            name="conteudo"
                            id="conteudo"
                            placeholder="Escreva seu relatório"
                            maxlength="5000"
                            required
                        ><?= htmlspecialchars($conteudo) ?></textarea>


                    </div>


                    <!-- USUÁRIO -->

                    <div class="cadastro-relatorios-usuario">


                        <label for="id_usuarios">
                            Usuário relacionado:
                        </label>


                        <select
                            name="id_usuarios"
                            id="id_usuarios"
                            required
                        >

                            <option
                                value=""
                                disabled
                                <?= $id_usuarios === "" ? "selected" : "" ?>
                            >
                                Selecione o usuário
                            </option>


                            <?php if ($resultadoUsuarios): ?>

                                <?php while (
                                    $usuario =
                                    mysqli_fetch_assoc(
                                        $resultadoUsuarios
                                    )
                                ): ?>

                                    <option
                                        value="<?= $usuario["id"] ?>"
                                        <?= $id_usuarios == $usuario["id"] ? "selected" : "" ?>
                                    >
                                        <?= htmlspecialchars($usuario["nome"]) ?>
                                    </option>

                                <?php endwhile; ?>

                            <?php endif; ?>


                        </select>


                    </div>


                    <!-- BOTÃO -->

                    <div class="cadastro-relatorios-botao">


                        <button type="submit">
                            Cadastrar
                        </button>


                    </div>


                    <!-- MENSAGEM -->

                    <?php if ($mensagem !== ""): ?>

                        <div
                            class="cadastro-relatorios-mensagem <?= htmlspecialchars($tipoMensagem) ?>"
                        >

                            <?= htmlspecialchars($mensagem) ?>

                        </div>

                    <?php endif; ?>


                </form>


            </div>


        </div>


    </main>


</div>


<script src="../scripts/botao-sair.js"></script>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>