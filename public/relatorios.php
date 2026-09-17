<?php
include "../infra/conn.php";

?>

<html lang="en">
<?php
$paginaAtual = "gestao";
$submenuAtual = "gestao-relatorios";
include("../includes/navbar.php");
?>

<main>

        <div class="trens" style="margin-top: 80px; justify-self: center; width: 70%;">
            <span style="font-size: 25px; font-weight: 700;"> Histórico de Relatórios </span>

            <input type="text" class="form-control" placeholder="12/04/2026, o motor apresentou falha às 18:56"
                style="width: 100%; border-radius: 0%; border: 1px solid #353535; margin-bottom: 30px;">

            </input>

            <input type="text" class="form-control" placeholder="15/04/2026, chuva intensa piora o atrito entre os trilhos e danifica uma das rodas, entretanto, não há a necessidade de conserto, já que os danos são mínimos."
                style="width: 100%; border-radius: 0%; border: 1px solid #353535; margin-bottom: 30px;">

            </input>

            <input type="text" class="form-control"
                placeholder="16/04/2026, o motor é avaliado e consertado pelos engenheiros da equipe."
                style="width: 100%; border-radius: 0%; border: 1px solid #353535; margin-bottom: 30px;">

            </input>

            <input type="text" class="form-control"
                placeholder="17/04/2026, o motor apresenta falhas novamente. Não é possível consertar."
                style="width: 100%; border-radius: 0%; border: 1px solid #353535; margin-bottom: 30px;">

            </input>

            <input type="text" class="form-control" placeholder="18/04/2026, o motor é trocado por um novo."
                style="width: 100%; border-radius: 0%; border: 1px solid #353535; margin-bottom: 30px;">

            </input>

        </div>

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