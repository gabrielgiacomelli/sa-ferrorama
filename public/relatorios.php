<?php
include "../infra/conn.php";

$sql = "SELECT * FROM relatorios";
$relatorios = mysqli_query($conn, $sql);

?>

<html lang="en">
<?php
$paginaAtual = "gestao";
$submenuAtual = "gestao-relatorios";
include("../includes/navbar.php");
?>

<main id ="gestao-relatorios">

        <div class="trens" style="margin-top: 80px; justify-self: center; width: 70%;">
            <span style="font-size: 25px; font-weight: 700;"> Histórico de Relatórios </span>
        </div>

        <?php
        while($relatorio = mysqli_fetch_assoc($relatorios)){ ?>


<div class="gestao-relatorios-espaco">

    <div class="gestao-relatorios-flex">
        <div>
            <div class = "gestao-relatorios card">
                <th> ID </th>

                <td> <?php echo $relatorio["id"]?> </td>
            </div>
            

                
                <div class = "gestao-relatorios card">
                <th> Usuário </th>

                <td> <?php echo $relatorio["id_usuarios"]?> </td>
                </div>
            </div>


            <div class = "gestao-relatorios card">
        <th> Conteúdo </th>

        <td> <?php echo $relatorio["conteudo"]?> </td>
    </div>
    </div>

    </div>


        <?php } ?>









</main>
    <!-- POPUP DE SAIR (overlay) -->
        <div class="popup" id="popup">
            <div class="overlay"></div>
            <div class="popup-content">
                <h2>Aviso</h2>
                <p>Você deseja sair da sua conta?</p>
                <h6>(Seu progresso será salvo automaticamente)</h6>
                <div class="controls">
                    <button class="fechar-popup nav-link mx-lg-2"
                        onclick="window.location.href='login.php'">Sim</button>
                    <button class="close-btn nav-link mx-lg-2">Não</button>
                </div>
            </div>
        </div>
    <!-- Scripts -->
    <script src="../scripts/botao-sair.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>