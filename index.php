<?php
// PHP
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial - HLGL</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body id="index-page">

    <div class="topbar">
        <div class="topbar-stripe"></div>
        <div class="login-box">
            <a href="public/login.php" class="btn-login">Login</a>
        </div>
    </div>
    <div id="navbar-ferroviario-contraste-linha">
        <div id="topbar-direita"></div>
    </div>    
    


    <main class="main-grid">
        
        <section class="left-side">
            <div class="brand">
                <span>Ferrovia</span>
                <img src="assets/icons/logo.png" alt="HLGL" class="logo">
            </div>
            
            <div class="slogan">
                <h2>Informações sobre trens, clima e muito mais!</h2>
            </div>

            <div class="footer-msg">
                <p>Siga nosso portal de notícias</p>
            </div>
        </section>

                <!-- mosaico -->
        <section class="right-side">
            <div class="mosaic">
                
                <!-- Coluna 1 -->
                <div class="col">
                    <div class="block h-smedium bg-light"></div>
                    <div class="block h-smedium bg-dark"></div>
                    <div class="block h-large bg-light"></div>
                </div>
                
                <!-- Coluna 2 -->
                <div class="col">
                    <div class="block h-medium bg-light"></div>
                    <div class="block h-smedium bg-dark"></div>
                    <div class="block h-medium bg-light"></div>
                </div>
                
                <!-- Coluna 3 -->
                <div class="col">
                    <div class="block h-large bg-light"></div>
                    <div class="block h-smedium bg-dark"></div>
                    <div class="block h-smedium bg-light"></div>
                </div>
                
                <!-- Coluna 4 (Contém os 4 blocos da base do print) -->
                <div class="col">
                    <div class="block h-xlarge bg-light"></div>
                    <div class="block h-smedium bg-dark"></div>
                    <div class="block h-small bg-light"></div>
                </div>
                
                <!-- Coluna 5 -->
                <div class="col">
                    <div class="block h-large bg-light"></div>
                    <div class="block h-smedium bg-dark"></div>
                    <div class="block h-smedium bg-light"></div>
                </div>
                
                <!-- Coluna 6 -->
                <div class="col">
                    <div class="block h-medium bg-light"></div>
                    <div class="block h-smedium bg-dark"></div>
                    <div class="block h-medium bg-light"></div>
                </div>

            </div>
        </section>

    </main>

</body>
</html>
