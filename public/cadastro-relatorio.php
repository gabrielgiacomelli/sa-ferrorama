<?php
include "../infra/conn.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$conteudo = $_POST["conteudo"];



$sql = "INSERT INTO usuarios(conteudo) VALUES ('$conteudo')";

mysqli_query($conn, $sql);

}

?>



<html lang="en">
<?php
$paginaAtual = "cadastro";
$submenuAtual = "relatorios";
include("navbar.php");
?>

<body>


<main>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <!--define o layout responsivo de um elemento.-->
        <div class="col-lg-11">

            <!--card estilizado com espaçamento interno, borda cinza, cantos arredondados e sombra projetada-->
            <div class="card p-5 shadow-lg border-color: gray  rounded-4">

                <!--título do cadastro, centralizado horizontalmente e com espaçamento inferior-->
                <h2 class="text-center mb-4">Cadastro de Usuários</h2>

                <!--formulário de cadastro, organizado em uma grade com espaçamento entre os elementos-->
                <form method = "POST">
                    <div class="row g-4">

                        <div class="col-md-4">

                            <!--campo de email-->

                            <label for="conteudo" class="form-label"> Relatórios </label>
                            <input id="conteudo" type="text" placeholder="Digite seu relatório" name = "conteudo">
                            </input>

                        <button>Cadastrar</button>

                </form>

</main>

</body>

</html>