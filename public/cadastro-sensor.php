<?php
include "../infra/conn.php";
?>

<html lang="pt-BR">
    
    <?php
$paginaAtual = "cadastro";
$submenuAtual = "sensores";
include("../includes/navbar.php");

?>

<body>
    
    <main id="cadastro-sensores">
        
        <h2>Cadastro de Sensores</h2>

        <div class="cadastro-sensores-container">
            
            <form class="cadastro-sensores-card" method="POST">

                <div class="cadastro-sensores-campo">
                    <label for="sensor-nome">Nome:</label>
                    <input
                        type="text"
                        id="sensor-nome"
                        name="nome"
                        placeholder="Ex: Motor Trem"
                        required
                    >
                </div>

                <div class="cadastro-sensores-campo">
                    <label for="sensor-instalacao">Instalação:</label>
                    <select
                        id="sensor-instalacao"
                        name="instalacao"
                        required
                    >
                        <option value="" selected disabled>Selecione</option>
                        <option value="trem">Trem</option>
                        <option value="ferrovia">Ferrovia</option>
                    </select>
                </div>

                <div class="cadastro-sensores-campo">
                    <label for="sensor-tipo">Função:</label>
                    <select
                        id="sensor-tipo"
                        name="tipo"
                        required
                    >
                        <option value="" selected disabled>Selecione</option>
                        <option value="velocidade">Velocidade</option>
                        <option value="temperatura">Temperatura</option>
                        <option value="falhas">Falhas</option>
                        <option value="gasolina">Gasolina</option>
                    </select>
                </div>

                <div class="cadastro-sensores-campo">
                    <label for="sensor-zona">Zona:</label>
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
            </form>
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