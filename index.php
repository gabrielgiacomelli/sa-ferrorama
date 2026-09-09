<?php


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Página Inicial </title>
</head>
<body>

    <main>
        <body id="body2">

    <!-- Início do header -->

<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand me-auto">
                <img class="logo navbar-brand me-auto" src="../assets/icons/logo.png" alt="LOGO">
            </a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <img class="logo" src="../assets/icons/logo.png" alt="LOGO">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">

                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="home.php">Home</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link mx-lg-2">Sensores</a>

                            <div class="dropdown-menu">
                                <a class="nav-link mx-lg-2" href="sensores-ferrovia.php"> Visualizar Sensores Ferrovia
                                </a>
                                <a class="nav-link mx-lg-2" href="sensores-trem.php"> Visualizar Sensores Trem </a>
                            </div>

                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link mx-lg-2">Cadastro</a>

                            <div class="dropdown-menu">

                                <a class="nav-link mx-lg-2" href="cadastro-sensor.php"> Cadastro de Sensores </a>
                                <a class="nav-link mx-lg-2" href="cadastro-trem.php"> Cadastro de Trens </a>
                                <a class="nav-link mx-lg-2" href="cadastro-rota.php"> Cadastro de Rotas </a>
                                <a class="nav-link mx-lg-2" href="cadastro-usuario.php"> Cadastro de Usuários </a>

                            </div>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="monitoramento.php">Monitoramento</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link mx-lg-2 active fw-bold" aria-current="page">Relatorios</a>

                            <div class="dropdown-menu">

                                <a class="nav-link mx-lg-2 active fw-bold" aria-current="page" href="cadastro-relatorio.php"> Cadastro de Relatórios </a>
                                <a class="nav-link mx-lg-2" href="relatorios.php"> Visualizar Relatórios </a>

                            </div>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link mx-lg-2" href="usuarios.php">Usuários</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="sair-headder">
                <img id="img-3" src="../assets/icons/sair.png" alt="Imagem sair">
                <button id="open-popup" class="nav-link mx-lg-2">Sair</button>
            </div>
        </div>
        </div>
    </nav>

    <!-- Fim do header -->





    </main>

</body>
</html>