<?php

include "../infra/conn.php";

// busca relatório
$id = $_GET["id"];
$sql = "SELECT * FROM relatorios WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$relatorio = mysqli_fetch_assoc($resultado);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Relatório</title>
</head>

<body>

    <main id="cadastro-relatorios">

        <h2>Editar Relatório</h2>

        <div class="container">

            <div class="col-lg-11">

                <div class="card">

                    <form
                        action="atualizar-relatorio.php"
                        method="POST"
                    >

                        <input
                            type="hidden"
                            name="id"
                            value="<?php echo $relatorio["id"]; ?>"
                        >

                        <div class="row">

                            <div class="col-md-4">

                                <textarea
                                    id="conteudo"
                                    name="conteudo"
                                    placeholder="Escreva seu relatório"
                                    required
                                ><?php echo htmlspecialchars($relatorio["conteudo"]); ?></textarea>


                                <button type="submit">
                                    Atualizar
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>


    <script src="../scripts/botao-sair.js"></script>

</body>
</html>
