<?php
// php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - HLGL</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body id="home-page-body">
<?php
$paginaAtual = "home";
include("../includes/navbar.php");
?>

<main>

    <div class="home-container">
        <div class="home-parte-superior">

            <div class="home-esquerda">
                <p class="home-titulo">BEM-VINDO!</p>

                <div class="home-noticias">
                    <p class="home-noticias-titulo">
                        Notícias Recentes
                    </p>
                    <div class="home-noticias-lista">

                        <div class="home-noticia">
                            <div class="home-noticia-data">
                                Abr
                                <p>15</p>
                            </div>
                            <div class="home-noticia-texto">
                                Dia amanhece chuvoso
                            </div>
                        </div>

                        <div class="home-noticia">
                            <div class="home-noticia-data">
                                Abr
                                <p>27</p>
                            </div>
                            <div class="home-noticia-texto">
                                Professora passa atividade para alunos do SESI
                            </div>
                        </div>

                        <div class="home-noticia">
                            <div class="home-noticia-data">
                                Abr
                                <p>29</p>
                            </div>
                            <div class="home-noticia-texto">
                                Alunos do SESI continuam a atividade
                            </div>
                        </div>

                        <div class="home-noticia">
                            <div class="home-noticia-data">
                                Abr
                                <p>30</p>
                            </div>
                            <div class="home-noticia-texto">
                                Feriado nacional Dia do Trabalho
                            </div>
                        </div>

                        <div class="home-noticia">
                            <div class="home-noticia-data">
                                Mai
                                <p>15</p>
                            </div>
                            <div class="home-noticia-texto">
                                Férias!
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="home-mosaico-container">

                <div class="mosaico">

                    <div class="mosaico-coluna">
                        <div class="mosaico-bloco cor-clara altura-p"></div>
                        <div class="mosaico-bloco cor-escura altura-p"></div>
                        <div class="mosaico-bloco cor-clara altura-g"></div>
                    </div>

                    <div class="mosaico-coluna">
                        <div class="mosaico-bloco cor-clara altura-m"></div>
                        <div class="mosaico-bloco cor-escura altura-p mosaico-letra">H</div>
                        <div class="mosaico-bloco cor-clara altura-m"></div>
                    </div>

                    <div class="mosaico-coluna">
                        <div class="mosaico-bloco cor-clara altura-g"></div>
                        <div class="mosaico-bloco cor-escura altura-p mosaico-letra">L</div>
                        <div class="mosaico-bloco cor-clara altura-p"></div>
                    </div>

                    <div class="mosaico-coluna">
                        <div class="mosaico-bloco cor-clara altura-gg"></div>
                        <div class="mosaico-bloco cor-escura altura-p mosaico-letra">G</div>
                        <div class="mosaico-bloco cor-clara altura-pp"></div>
                    </div>

                    <div class="mosaico-coluna">
                        <div class="mosaico-bloco cor-clara altura-g"></div>
                        <div class="mosaico-bloco cor-escura altura-p mosaico-letra">L</div>
                        <div class="mosaico-bloco cor-clara altura-p"></div>
                    </div>

                    <div class="mosaico-coluna">
                        <div class="mosaico-bloco cor-clara altura-m"></div>
                        <div class="mosaico-bloco cor-escura altura-p"></div>
                        <div class="mosaico-bloco cor-clara altura-m"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>