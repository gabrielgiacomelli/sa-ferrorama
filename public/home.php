<?php

$latitude = -26.3044;
$longitude = -48.8487;

$url = "https://api.open-meteo.com/v1/forecast"
     . "?latitude=" . $latitude
     . "&longitude=" . $longitude
     . "&current=temperature_2m,weather_code,relative_humidity_2m"
     . "&timezone=America%2FSao_Paulo";

$contexto = stream_context_create([
    "http" => [
        "timeout" => 5
    ]
]);

$resposta = @file_get_contents($url, false, $contexto);

$climaDisponivel = false;
$temperatura = "--";
$umidade = "--";
$condicao = "Não disponível";
$dataAtualizacao = "--";

// Converte o código da Open-Meteo para uma descrição
function obterCondicaoClima($codigo)
{
    $condicoes = [
        0 => "Céu limpo",
        1 => "Principalmente limpo",
        2 => "Parcialmente nublado",
        3 => "Nublado",

        45 => "Neblina",
        48 => "Neblina com geada",

        51 => "Garoa fraca",
        53 => "Garoa moderada",
        55 => "Garoa intensa",

        56 => "Garoa congelante fraca",
        57 => "Garoa congelante intensa",

        61 => "Chuva fraca",
        63 => "Chuva moderada",
        65 => "Chuva intensa",

        66 => "Chuva congelante fraca",
        67 => "Chuva congelante intensa",

        71 => "Neve fraca",
        73 => "Neve moderada",
        75 => "Neve intensa",

        77 => "Granizo",

        80 => "Pancadas de chuva fracas",
        81 => "Pancadas de chuva moderadas",
        82 => "Pancadas de chuva intensas",

        85 => "Pancadas de neve fracas",
        86 => "Pancadas de neve intensas",

        95 => "Trovoada",
        96 => "Trovoada com granizo fraco",
        99 => "Trovoada com granizo intenso"
    ];

    return $condicoes[$codigo] ?? "Condição desconhecida";
}

if ($resposta !== false) {

    $dadosClima = json_decode($resposta, true);

    if (
        isset($dadosClima["current"]["temperature_2m"]) &&
        isset($dadosClima["current"]["weather_code"])
    ) {

        $climaDisponivel = true;

        $temperatura = round($dadosClima["current"]["temperature_2m"]);
        $umidade = $dadosClima["current"]["relative_humidity_2m"] ?? "--";

        $codigoClima = $dadosClima["current"]["weather_code"];

        $condicao = obterCondicaoClima($codigoClima);

        if (isset($dadosClima["current"]["time"])) {
            $dataHora = new DateTime(
                $dadosClima["current"]["time"],
                new DateTimeZone("America/Sao_Paulo")
            );

            $dataAtualizacao = $dataHora->format("d/m/Y H:i");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>

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

            <!-- ========================= -->
            <!-- PARTE ESQUERDA -->
            <!-- ========================= -->

            <div class="home-esquerda">

                <p class="home-titulo">
                    BEM-VINDO!
                </p>


                <!-- ========================= -->
                <!-- CARD DO CLIMA -->
                <!-- ========================= -->

                <div class="home-clima">

                    <div class="home-clima-cabecalho">

                        <div class="home-clima-titulo">

                            <span class="home-clima-icone">
                                ☁
                            </span>

                            <span>
                                Clima em Joinville - SC
                            </span>

                        </div>

                        <div class="home-clima-atualizacao">

                            Última atualização<br>

                            <strong>
                                <?php echo htmlspecialchars($dataAtualizacao); ?>
                            </strong>

                        </div>

                    </div>


                    <?php if ($climaDisponivel): ?>

                        <div class="home-clima-conteudo">

                            <div class="home-clima-principal">

                                <div class="home-clima-temperatura">

                                    <?php echo htmlspecialchars($temperatura); ?>°C

                                </div>

                                <div class="home-clima-condicao">

                                    <?php echo htmlspecialchars($condicao); ?>

                                </div>

                            </div>


                            <div class="home-clima-informacoes">

                                <div class="home-clima-info">

                                    <span class="home-clima-info-icone">
                                        📍
                                    </span>

                                    <div>

                                        <strong>
                                            Localização
                                        </strong>

                                        <p>
                                            Joinville - SC
                                        </p>

                                    </div>

                                </div>


                                <div class="home-clima-info">

                                    <span class="home-clima-info-icone">
                                        💧
                                    </span>

                                    <div>

                                        <strong>
                                            Umidade
                                        </strong>

                                        <p>
                                            <?php echo htmlspecialchars($umidade); ?>%
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="home-clima-rodape">

                            Dados obtidos através da API Open-Meteo

                        </div>

                    <?php else: ?>

                        <div class="home-clima-erro">

                            Não foi possível carregar os dados do clima.

                            <br>

                            Tente novamente mais tarde.

                        </div>

                    <?php endif; ?>

                </div>

            </div>


            <!-- ========================= -->
            <!-- MOSAICO -->
            <!-- ========================= -->

            <div class="home-mosaico-container">

                <div class="mosaico">

                    <div class="mosaico-coluna">

                        <div class="mosaico-bloco cor-clara altura-p"></div>

                        <div class="mosaico-bloco cor-escura altura-p"></div>

                        <div class="mosaico-bloco cor-clara altura-g"></div>

                    </div>


                    <div class="mosaico-coluna">

                        <div class="mosaico-bloco cor-clara altura-m"></div>

                        <div class="mosaico-bloco cor-escura altura-p mosaico-letra">
                            H
                        </div>

                        <div class="mosaico-bloco cor-clara altura-m"></div>

                    </div>


                    <div class="mosaico-coluna">

                        <div class="mosaico-bloco cor-clara altura-g"></div>

                        <div class="mosaico-bloco cor-escura altura-p mosaico-letra">
                            L
                        </div>

                        <div class="mosaico-bloco cor-clara altura-p"></div>

                    </div>


                    <div class="mosaico-coluna">

                        <div class="mosaico-bloco cor-clara altura-gg"></div>

                        <div class="mosaico-bloco cor-escura altura-p mosaico-letra">
                            G
                        </div>

                        <div class="mosaico-bloco cor-clara altura-pp"></div>

                    </div>


                    <div class="mosaico-coluna">

                        <div class="mosaico-bloco cor-clara altura-g"></div>

                        <div class="mosaico-bloco cor-escura altura-p mosaico-letra">
                            L
                        </div>

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