<?php

include "../infra/conn.php";

// Verifica se o ID foi informado
if (!isset($_GET["id"])) {
    die("ID do sensor não informado.");
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("ID de sensor inválido.");
}


// Busca o sensor
$sql = "SELECT * FROM sensores WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Erro ao preparar a consulta.");
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$sensor = mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);


// Verifica se o sensor existe
if (!$sensor) {
    die("Sensor não encontrado.");
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

    <title>Editar Sensor</title>

    <link
        rel="stylesheet"
        href="../styles/style.css"
    >

</head>

<body>

<main id="editar-sensores">

    <h2>Editar Sensor</h2>

    <div class="editar-sensores-container">

        <div class="editar-sensores-card">

            <form
                action="atualizar-sensor.php"
                method="POST"
            >

                <!-- ID -->
                <input
                    type="hidden"
                    name="id"
                    value="<?php echo htmlspecialchars($sensor["id"]); ?>"
                >


                <!-- Nome -->
                <div class="editar-sensores-campo">

                    <label for="sensor-nome">
                        Nome:
                    </label>

                    <input
                        type="text"
                        id="sensor-nome"
                        name="nome"
                        placeholder="Ex: Motor Trem"
                        value="<?php echo htmlspecialchars($sensor["nome"]); ?>"
                        required
                    >

                </div>


                <!-- Instalação -->
                <div class="editar-sensores-campo">

                    <label for="sensor-instalacao">
                        Instalação:
                    </label>

                    <select
                        id="sensor-instalacao"
                        name="instalacao"
                        required
                    >

                        <option
                            value="Trem"
                            <?php
                            echo $sensor["instalacao"] === "Trem"
                                ? "selected"
                                : "";
                            ?>
                        >
                            Trem
                        </option>

                        <option
                            value="Ferrovia"
                            <?php
                            echo $sensor["instalacao"] === "Ferrovia"
                                ? "selected"
                                : "";
                            ?>
                        >
                            Ferrovia
                        </option>

                    </select>

                </div>


                <!-- Função -->
                <div class="editar-sensores-campo">

                    <label for="sensor-funcao">
                        Função:
                    </label>

                    <select
                        id="sensor-funcao"
                        name="funcao"
                        required
                    >

                        <option
                            value="Velocidade"
                            <?php
                            echo $sensor["funcao"] === "Velocidade"
                                ? "selected"
                                : "";
                            ?>
                        >
                            Velocidade
                        </option>

                        <option
                            value="Temperatura"
                            <?php
                            echo $sensor["funcao"] === "Temperatura"
                                ? "selected"
                                : "";
                            ?>
                        >
                            Temperatura
                        </option>

                        <option
                            value="Falhas"
                            <?php
                            echo $sensor["funcao"] === "Falhas"
                                ? "selected"
                                : "";
                            ?>
                        >
                            Falhas
                        </option>

                        <option
                            value="Gasolina"
                            <?php
                            echo $sensor["funcao"] === "Gasolina"
                                ? "selected"
                                : "";
                            ?>
                        >
                            Gasolina
                        </option>

                    </select>

                </div>


                <!-- Zona -->
                <div class="editar-sensores-campo">

                    <label for="sensor-zona">
                        Zona:
                    </label>

                    <input
                        type="text"
                        id="sensor-zona"
                        name="zona"
                        placeholder="Ex: Zona 01"
                        value="<?php echo htmlspecialchars($sensor["zona"]); ?>"
                        required
                    >

                </div>


                <!-- Status -->
                <div class="editar-sensores-campo">

                    <label for="sensor-status">
                        Status:
                    </label>

                    <select
                        id="sensor-status"
                        name="status"
                        required
                    >

                        <option
                            value="Ativo"
                            <?php
                            echo $sensor["status"] === "Ativo"
                                ? "selected"
                                : "";
                            ?>
                        >
                            Ativo
                        </option>

                        <option
                            value="Inativo"
                            <?php
                            echo $sensor["status"] === "Inativo"
                                ? "selected"
                                : "";
                            ?>
                        >
                            Inativo
                        </option>

                    </select>

                </div>


                <!-- Atualizar -->
                <div class="editar-sensores-botao">

                    <button type="submit">
                        Atualizar Sensor
                    </button>

                </div>


                <!-- Voltar -->
                <div class="editar-sensores-botao-voltar">

                    <a href="gestao-sensores.php">
                        Voltar
                    </a>

                </div>

            </form>

        </div>

    </div>

</main>

<script src="../scripts/botao-sair.js"></script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwxX9H9JcYn3nv7wiPVlz7YYwJrVwcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"
></script>

</body>

</html>