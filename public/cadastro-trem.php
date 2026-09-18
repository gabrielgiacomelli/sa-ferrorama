<?php
include "../infra/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $peso_total = $_POST["peso_total"];
    $quantidade_vagoes = $_POST["quantidade_vagoes"];
    $proprietario = $_POST["proprietario"];

    $sql = "INSERT INTO trens (peso_total, quantidade_vagoes, proprietario)
            VALUES ('$peso_total', '$quantidade_vagoes', '$proprietario')";

    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<?php
$paginaAtual = "cadastro";
$submenuAtual = "trens";
include("../includes/navbar.php");
?>

<body>

    <main id="cadastro-trens">

        <h2>Cadastro de Trens</h2>

        <div class="cadastro-trens-container">

            <form class="cadastro-trens-card" method="POST">

                <div class="cadastro-trens-campo">

                    <label for="peso-total">
                        Peso total
                    </label>

                    <input
                        type="text"
                        id="peso-total"
                        name="peso_total"
                        placeholder="Ex: 400T"
                        required
                    >

                </div>


                <div class="cadastro-trens-campo">

                    <label for="quantidade-vagoes">
                        Quantidade de vagões:
                    </label>

                    <input
                        type="number"
                        id="quantidade-vagoes"
                        name="quantidade_vagoes"
                        placeholder="Ex: 45"
                        required
                    >

                </div>


                <div class="cadastro-trens-campo">

                    <label for="proprietario">
                        Proprietário
                    </label>

                    <input
                        type="text"
                        id="proprietario"
                        name="proprietario"
                        placeholder="Ex: Funcionario_01"
                        required
                    >

                </div>


                <div class="cadastro-trens-botao">

                    <button type="submit">
                        Cadastrar Trem
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