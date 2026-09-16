<?php
include "../infra/conn.php";
?>

<html lang="pt-BR">

<?php
$paginaAtual = "cadastro";
$submenuAtual = "sensores";
include("navbar.php");
?>

<body>

    <main id="cadastro-sensores">
        <div class="cadastro-sensores-container">

            <div class="cadastro-sensores-card">

                <div class="cadastro-sensores-campo">
                    <label for="sensor-nome">Nome:</label>
                    <input
                        type="text"
                        id="sensor-nome"
                        placeholder="Ex: ROTA_01"
                    >
                </div>

                <div class="cadastro-sensores-campo">
                    <label for="sensor-tipo">Tipo:</label>
                    <select id="sensor-tipo">
                        <option selected disabled>Selecione</option>
                        <option value="1">Velocidade</option>
                        <option value="2">Temperatura</option>
                        <option value="3">Falhas</option>
                        <option value="4">Gasolina</option>
                    </select>
                </div>

                <div class="cadastro-sensores-campo">
                    <label for="sensor-instalacao">Instalação:</label>
                    <select id="sensor-instalacao">
                        <option selected disabled>Selecione</option>
                        <option value="1">Trem</option>
                        <option value="2">Ferrovia</option>
                    </select>
                </div>

                <div class="cadastro-sensores-botao">
                    <button type="button">
                        Cadastrar
                    </button>
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
