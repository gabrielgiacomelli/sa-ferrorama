<?php
include "../infra/conn.php";

?>


<html lang="en">
<?php
$paginaAtual = "gestao";
$submenuAtual = "gestao-usuarios";
include("navbar.php");
?>

    <!-- início da tabela de gestão de usuários -->
<main>
    <div class="tabel">

        <h4 class="textousu">Gestão de Usuários</h4>

        <div class="linhameio"></div>

        <table id="tabela">

            <tr>
                <th>Usuários</th>
                <th>ID</th>
                <th>Email</th>
                <th>Telefone</th>
            </tr>

            <tr>
                <td>Henrique Venso</td>
                <td>usu1</td>
                <td>henrique_venso@gmail.com</td>
                <td>1111-1111</td>
            </tr>

            <tr>
                <td>Gabriel Giacomelli</td>
                <td>usu2</td>
                <td>gabriel_giacomelli@gmail.com</td>
                <td>2222-2222</td>
            </tr>

            <tr>
                <td>Lucas Corrêa</td>
                <td>usu3</td>
                <td>lucas_correa@gmail.com</td>
                <td>3333-3333</td>
            </tr>

            <tr>
                <td>Lara Emília</td>
                <td>usu4</td>
                <td>lara_emilia@gmail.com</td>
                <td>4444-4444</td>
            </tr>

        </table>
    </div>
</main>
    <!-- Fim da tabela de gestão de usuários -->
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