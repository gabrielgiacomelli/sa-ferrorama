<?php

include "../infra/conn.php";

$mensagem = "";
$tipoMensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $instalacao = $_POST["instalacao"];
    $funcao = $_POST["tipo"];
    $zona = $_POST["zona"];

    $sql = "INSERT INTO sensores
            (nome, instalacao, funcao, zona)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $nome,
            $instalacao,
            $funcao,
            $zona
        );

        if (mysqli_stmt_execute($stmt)) {

            $mensagem = "Sensor cadastrado com sucesso!";
            $tipoMensagem = "sucesso";

        } else {

            $mensagem = "Erro ao cadastrar o sensor.";
            $tipoMensagem = "erro";
        }

        mysqli_stmt_close($stmt);

    } else {

        $mensagem = "Erro ao preparar o cadastro.";
        $tipoMensagem = "erro";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Sensores</title>

</head>

<?php

$paginaAtual = "cadastro";
$submenuAtual = "sensores";

include("../includes/navbar.php");

?>

<body>

    <main id="cadastro-sensores">

        <h2>Cadastro de Sensores</h2>

        <div class="cadastro-sensores-container">

            <form
                class="cadastro-sensores-card"
                method="POST"
            >

                <div class="cadastro-sensores-campo">

                    <label for="sensor-nome">
                        Nome:
                    </label>

                    <input
                        type="text"
                        id="sensor-nome"
                        name="nome"
                        placeholder="Ex: Motor Trem"
                        required
                    >

                </div>


                <div class="cadastro-sensores-campo">

                    <label for="sensor-instalacao">
                        Instalação:
                    </label>

                    <select
                        id="sensor-instalacao"
                        name="instalacao"
                        required
                    >

                        <option value="" selected disabled>
                            Selecione
                        </option>

                        <option value="Trem">
                            Trem
                        </option>

                        <option value="Ferrovia">
                            Ferrovia
                        </option>

                    </select>

                </div>


                <div class="cadastro-sensores-campo">

                    <label for="sensor-tipo">
                        Função:
                    </label>

                    <select
                        id="sensor-tipo"
                        name="tipo"
                        required
                    >

                        <option value="" selected disabled>
                            Selecione
                        </option>

                        <option value="Velocidade">
                            Velocidade
                        </option>

                        <option value="Temperatura">
                            Temperatura
                        </option>

                        <option value="Falhas">
                            Falhas
                        </option>

                        <option value="Gasolina">
                            Gasolina
                        </option>

                    </select>

                </div>


                <div class="cadastro-sensores-campo">

                    <label for="sensor-zona">
                        Zona:
                    </label>

                    <input
                        type="text"
                        id="sensor-zona"
                        name="zona"
                        placeholder="Ex: Zona 01"
                        required
                    >

                </div>


                <div class="cadastro-sensores-botao">

                    <button type="submit">
                        Cadastrar Sensor
                    </button>

                </div>

<?php if ($mensagem !== ""): ?>

    <div class="cadastro-mensagem <?php echo $tipoMensagem; ?>">
        <?php echo htmlspecialchars($mensagem); ?>
    </div>

<?php endif; ?>

            </form>

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