
<html lang="pt-BR">
<?php
$paginaAtual = "home";
include("../includes/navbar.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - HLGL</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body id="home-page-body">

    <main>

    <div class="container-principal">

        <p class="bem-vindo-inicial">BEM-VINDO!</p>

        <!-- PRIMEIRA PARTE DA HOME -->
        <div class="home-superior">

            <!-- NOTÍCIAS -->
            <div class="card-noticias-home">

                <p id="noticias-recentes">Notícias Recentes</p>

                <div class="scroll-noticias-home">

                    <div class="amarelo-flex">
                        <div class="dia-noticias">
                            Abr
                            <p>15</p>
                        </div>

                        <div class="flex-column">
                            <p>Dia amanhece chuvoso</p>
                        </div>
                    </div>

                    <div class="amarelo-flex">
                        <div class="dia-noticias">
                            Abr
                            <p>27</p>
                        </div>

                        <div class="flex-column">
                            <p>Professora passa atividade para alunos do SESI</p>
                        </div>
                    </div>

                    <div class="amarelo-flex">
                        <div class="dia-noticias">
                            Abr
                            <p>29</p>
                        </div>

                        <div class="flex-column">
                            <p>Alunos do SESI continuam a atividade</p>
                        </div>
                    </div>

                    <div class="amarelo-flex">
                        <div class="dia-noticias">
                            Abr
                            <p>30</p>
                        </div>

                        <div class="flex-column">
                            <p>Feriado nacional Dia do Trabalho</p>
                        </div>
                    </div>

                    <div class="amarelo-flex">
                        <div class="dia-noticias">
                            Mai
                            <p>15</p>
                        </div>

                        <div class="flex-column">
                            <p>Férias!</p>
                        </div>
                    </div>

                </div>
            </div>


            <!-- MOSAICO HLGL -->
            <section class="right-side-home">

                <div class="mosaic-home">

                    <div class="col-home">
                        <div class="block-home h-large bg-light"></div>
                        <div class="block-home h-smedium bg-dark"></div>
                        <div class="block-home h-xlarge bg-light"></div>
                    </div>

                    <div class="col-home">
                        <div class="block-home h-xlarge bg-light"></div>
                        <div class="block-home h-medium bg-dark letra-mosaico">H</div>
                        <div class="block-home h-large bg-light"></div>
                    </div>

                    <div class="col-home">
                        <div class="block-home h-xlarge bg-light"></div>
                        <div class="block-home h-smedium bg-dark letra-mosaico">L</div>
                        <div class="block-home h-smedium bg-light"></div>
                    </div>

                    <div class="col-home">
                        <div class="block-home h-xlarge bg-light"></div>
                        <div class="block-home h-medium bg-dark letra-mosaico">G</div>
                        <div class="block-home h-small bg-light"></div>
                    </div>

                    <div class="col-home">
                        <div class="block-home h-xlarge bg-light"></div>
                        <div class="block-home h-medium bg-dark letra-mosaico">L</div>
                        <div class="block-home h-smedium bg-light"></div>
                    </div>

                    <div class="col-home">
                        <div class="block-home h-large bg-light"></div>
                        <div class="block-home h-smedium bg-dark"></div>
                        <div class="block-home h-xlarge bg-light"></div>
                    </div>

                </div>

            </section>

        </div>


        <!-- SEGUNDA PARTE -->
        <div class="home-inferior">

            <!-- CLIMA -->
            <div class="card-clima-home">

                <h2>Clima e Previsão do Tempo</h2>

                <div class="clima-principal">

                    <div class="icone-sol">☀</div>

                    <div class="temperatura-home">
                        <strong>19</strong>
                        <span>°C | °F</span>
                    </div>

                    <div class="informacoes-tempo-home">
                        <p>Chuva: 0%</p>
                        <p>Umidade: 43%</p>
                        <p>Vento: 3 km/h</p>
                    </div>

                </div>

                <div class="clima-legendas">
                    <strong>Clima</strong>
                    <strong>Ensolarado</strong>
                </div>

                <hr>

                <h2>Alertas de Riscos Naturais</h2>

                <div class="alerta-home">
                    <strong>Status</strong>
                    <p>Condições climáticas ideais para circulação.</p>
                </div>

                <div class="alerta-home">
                    <strong>Umidade baixa</strong>
                    <p>Risco moderado de incêndios em áreas de vegetação.</p>
                </div>

                <div class="alerta-home">
                    <strong>Possibilidade de Neblina</strong>
                    <p>E se o sol se puser, a queda de temperatura rápida pode afetar a visibilidade.</p>
                </div>

            </div>


            <!-- LADO DIREITO -->
            <div class="home-direita-inferior">

                <!-- PLANETA -->
                <div class="card-planeta-home">

                    <h2>Planeta e Meio Ambiente</h2>

                    <div class="planeta-item">

                        <div class="icone-planta">🌱</div>

                        <div>
                            <h3>Redução de Gases do Efeito Estufa</h3>

                            <p>
                                Ao optar pelo transporte ferroviário em vez do rodoviário,
                                nossa operação evitou a emissão de 12.500 toneladas de gás
                                carbônico na atmosfera apenas neste mês. Isso representa
                                uma redução significativa no impacto ambiental, equivalente
                                ao plantio de aproximadamente 87.000 árvores.
                            </p>
                        </div>

                    </div>

                    <div class="planeta-texto">

                        <h3>Eficiência Energética por Quilômetro</h3>

                        <p>
                            Nossas locomotivas modernas conseguem transportar uma tonelada
                            de carga por mais de 400 quilômetros com apenas um litro de
                            combustível. Isso faz do transporte ferroviário uma das
                            alternativas terrestres mais eficientes e sustentáveis do mercado.
                        </p>

                    </div>

                </div>


                <!-- DADOS -->
                <div class="dados-home">

                    <h2>Dados Gerais da Ferrovia</h2>

                    <div class="dados-grid">

                        <div class="dado-item">
                            <div class="imagem-dado trem"></div>

                            <div>
                                <h3>Trens em circulação hoje</h3>
                                <p>45 trens em movimento.</p>
                            </div>
                        </div>

                        <div class="dado-item">
                            <div class="imagem-dado trilhos"></div>

                            <div>
                                <h3>Tamanho da linha</h3>
                                <p>850 km de trilhos.</p>
                            </div>
                        </div>

                        <div class="dado-item">
                            <div class="imagem-dado cidade"></div>

                            <div>
                                <h3>Cidades atendidas</h3>
                                <p>12 municípios.</p>
                            </div>
                        </div>

                        <div class="dado-item">
                            <div class="imagem-dado funcionarios"></div>

                            <div>
                                <h3>Total de funcionários</h3>
                                <p>1.200 colaboradores.</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

</body>
</html>

