<?php
include "../infra/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conteudo = $_POST["conteudo"];
    $id_usuarios = $_POST["id_usuarios"];

    $sql = "INSERT INTO relatorios (conteudo, id_usuarios)
            VALUES ('$conteudo', '$id_usuarios')";

    mysqli_query($conn, $sql);
}

$usuarios = mysqli_query($conn, "SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="pt-BR">

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

                                    <option value="" selected disabled>
                                        Selecione o usuário
                                    </option>

                                    <?php
                                    while ($usuario = mysqli_fetch_assoc($usuarios)) {
                                    ?>

                                        <option value="<?php echo $usuario['id']; ?>">
                                            <?php echo $usuario['nome']; ?>
                                        </option>

                                    <?php
                                    }
                                    ?>

                                </select>

                                <button type="submit">
                                    Cadastrar
                                </button>

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