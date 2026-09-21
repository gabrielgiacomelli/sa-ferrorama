<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conteudo = $_POST["conteudo"];
    $id_usuarios = $_POST["id_usuarios"];

    $sql = "INSERT INTO relatorios (conteudo, id_usuarios)
            VALUES (?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $conteudo,
            $id_usuarios
        );

        if (mysqli_stmt_execute($stmt)) {

            $mensagem = "Relatório cadastrado com sucesso!";
            $tipoMensagem = "sucesso";

        } else {

            $mensagem = "Erro ao cadastrar o relatório.";
            $tipoMensagem = "erro";
        }

        mysqli_stmt_close($stmt);

    } else {

        $mensagem = "Erro ao preparar o cadastro.";
        $tipoMensagem = "erro";
    }
}


/* Buscar usuários para preencher o select */

$sqlUsuarios = "SELECT id, nome FROM usuarios ORDER BY nome";

$stmtUsuarios = mysqli_prepare($conn, $sqlUsuarios);

$usuarios = [];

if ($stmtUsuarios) {

    mysqli_stmt_execute($stmtUsuarios);

    $resultado = mysqli_stmt_get_result($stmtUsuarios);

    while ($usuario = mysqli_fetch_assoc($resultado)) {

        $usuarios[] = $usuario;
    }

    mysqli_stmt_close($stmtUsuarios);
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

    <title>Cadastro de Relatórios</title>

</head>

<?php

$paginaAtual = "cadastro";
$submenuAtual = "relatorios";

include("../includes/navbar.php");

?>

<body>

    <main id="cadastro-relatorios">

        <h2>Cadastro de Relatórios</h2>

        <div class="container">

            <div class="col-lg-11">

                <div class="card">

                    <form method="POST">

                        <div class="row">

                            <div class="col-md-4">

                                <textarea
                                    id="conteudo"
                                    name="conteudo"
                                    placeholder="Escreva seu relatório"
                                    required
                                ></textarea>


                                <label for="id_usuarios">
                                    Usuário relacionado:
                                </label>


                                <select
                                    id="id_usuarios"
                                    name="id_usuarios"
                                    required
                                >

                                    <option
                                        value=""
                                        selected
                                        disabled
                                    >
                                        Selecione o usuário
                                    </option>


                                    <?php foreach ($usuarios as $usuario): ?>

                                        <option
                                            value="<?= $usuario['id'] ?>"
                                        >
                                            <?= htmlspecialchars($usuario['nome']) ?>
                                        </option>

                                    <?php endforeach; ?>

                                </select>


                                <button type="submit">
                                    Cadastrar
                                </button>

<?php if ($mensagem !== ""): ?>

    <div class="cadastro-mensagem <?php echo $tipoMensagem; ?>">
        <?php echo htmlspecialchars($mensagem); ?>
    </div>

<?php endif; ?>


                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>


    <script src="../scripts/botao-sair.js"></script>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9H9JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>

</body>

</html>