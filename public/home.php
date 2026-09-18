
<html lang="pt-BR">
<?php
$paginaAtual = "home";
include("../includes/navbar.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - HLGL</title>
    <!-- Corrigido o sinal menor-que duplicado -->
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body id="home-page-body">

    <main>
        <div class="popup" id="popup">
            <div class="overlay"></div>
            <div class="popup-content">
                <h2>Aviso</h2>
                <p>Você deseja sair da sua conta?</p>
                <h6>(Seu progresso será salvo automaticamente)</h6>
                <div class="controls">
                    <button class="fechar-popup nav-link mx-lg-2" onclick="window.location.href='login.php'">Sim</button>
                    <button class="close-btn nav-link mx-lg-2">Não</button>
                </div>
            </div>
        </div>

        <div class="container-principal">
            
            <div class="amarelo-sz2">
                <p class="bem-vindo-inicial">BEM-VINDO!</p>
            </div>

            <div class="flex">
                <!-- Esquerda: notícias com caixa de scroll interna -->
                <div class="card-sz sz">
                    <p id="noticias-recentes">Notícias recentes</p>
                    
                    <div class="scroll-noticias-home">
                        <div class="amarelo-flex">
                            <div class="dia-noticias">Abr<p>15</p></div>
                            <div class="flex-column">
                                <p>Dia amanhece chuvoso</p>
                            </div>
                        </div>

                        <div class="amarelo-flex">
                            <div class="dia-noticias">Abr<p>27</p></div>
                            <div class="flex-column">
                                <p>Professora passa atividade para alunos do SESI</p>
                            </div>
                        </div>

                        <div class="amarelo-flex">
                            <div class="dia-noticias">Abr<p>29</p></div>
                            <div class="flex-column">
                                <p>Alunos do SESI continuam a atividade</p>
                            </div>
                        </div>

                        <div class="amarelo-flex">
                            <div class="dia-noticias">Abr<p>30</p></div>
                            <div class="flex-column">
                                <p>Feriado nacional Dia do Trabalho</p>
                            </div>
                        </div>

                        <div class="amarelo-flex">
                            <div class="dia-noticias">Mai<p>15</p></div>
                            <div class="flex-column">
                                <p>Ferias!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Direita: Mosaico HLGL no lugar do Blog conforme mockup -->
                <section class="right-side-home">
                    <div class="mosaic-home">
                        <div class="col-home"><div class="block-home h-large bg-light"></div><div class="block-home h-smedium bg-dark"></div><div class="block-home h-xlarge bg-light"></div></div>
                        <div class="col-home"><div class="block-home h-xlarge bg-light"></div><div class="block-home h-medium bg-dark"></div><div class="block-home h-large bg-light"></div></div>
                        <div class="col-home"><div class="block-home h-xlarge bg-light"></div><div class="block-home h-smedium bg-dark letra-mosaico">H</div><div class="block-home h-smedium bg-light"></div></div>
                        <div class="col-home"><div class="block-home h-xlarge bg-light"></div><div class="block-home h-smedium bg-dark letra-mosaico">L</div><div class="block-home h-small bg-light"></div></div>
                        <div class="col-home"><div class="block-home h-xlarge bg-light"></div><div class="block-home h-medium bg-dark letra-mosaico">G</div><div class="block-home h-smedium bg-light"></div></div>
                        <div class="col-home"><div class="block-home h-large bg-light"></div><div class="block-home h-smedium bg-dark letra-mosaico">L</div><div class="block-home h-xlarge bg-light"></div></div>
                    </div>
                </section>

            </div>
        </div>
    </main>
</body>
</html>

