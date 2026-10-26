<?php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HLGL Ferrovia | Monitoramento ferroviário inteligente</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wdth,wght@125,900&family=Oswald:wght@600&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<div class="hlgl-home">

  <header class="hlgl-topbar">
    <a href="#hlgl-inicio" class="hlgl-logo">HLGL</a>
    <nav class="hlgl-nav">
      <a href="#hlgl-inicio" class="hlgl-ativo">Início</a>
      <a href="#hlgl-sobre">Sobre</a>
      <a href="#hlgl-funcionalidades">Funcionalidades</a>
      <a href="#hlgl-beneficios">Benefícios</a>
    </nav>
    <a href="public/login.php" class="hlgl-login">Acesse o Sistema</a>
  </header>

  <section class="hlgl-hero" id="hlgl-inicio">
    <div class="hlgl-hero-texto">
      <span class="hlgl-tag">Ferrovia</span>
      <h1 class="hlgl-h1">HLGL</h1>
      <h2 class="hlgl-h2">Monitoramento ferroviário <span>inteligente</span> para transformar dados em informação.</h2>
      <p>O HLGL é uma solução tecnológica que centraliza informações sobre trens, clima e muito mais, oferecendo segurança, eficiência e controle para todos os envolvidos.</p>
      <a href="#hlgl-sobre" class="hlgl-btn">Conheça o Projeto <i class="bi bi-arrow-right"></i></a>
    </div>

    <div class="hlgl-blocos" aria-hidden="true">
      <div class="hlgl-col"><span style="flex:2"></span><span class="hlgl-escuro" style="flex:2"></span><span style="flex:4"></span></div>
      <div class="hlgl-col"><span style="flex:4"></span><span class="hlgl-escuro" style="flex:3"></span><span style="flex:4"></span></div>
      <div class="hlgl-col"><span style="flex:5"></span><span class="hlgl-escuro" style="flex:2.5"></span><span style="flex:2"></span></div>
      <div class="hlgl-col"><span style="flex:6"></span><span class="hlgl-escuro" style="flex:2"></span><span style="flex:1"></span></div>
      <div class="hlgl-col"><span style="flex:5"></span><span class="hlgl-escuro" style="flex:2.5"></span><span style="flex:2"></span></div>
      <div class="hlgl-col"><span style="flex:4"></span><span class="hlgl-escuro" style="flex:3"></span><span style="flex:4"></span></div>
    </div>
  </section>

  <section class="hlgl-secao hlgl-claro" id="hlgl-sobre">
    <div class="hlgl-container hlgl-problema">
      <div class="hlgl-img-bloco"><i class="bi bi-train-front"></i></div>
      <div>
        <small>O problema</small>
        <h3>A falta de informações pode gerar riscos.</h3>
        <p>A passagem dos trens faz parte da rotina da cidade, mas a falta de informações sobre a operação pode dificultar o planejamento de quem precisa se deslocar e aumentar os riscos de incidentes.</p>
      </div>
      <div class="hlgl-divisor">
        <small>A solução</small>
        <h3>Tudo o que você precisa, em um só lugar.</h3>
        <p>O HLGL reúne informações da operação ferroviária em um único sistema, facilitando o acompanhamento e a visualização dos dados em tempo real.</p>
      </div>
    </div>
  </section>

  <section class="hlgl-secao hlgl-escura" id="hlgl-funcionalidades">
    <div class="hlgl-container">
      <small>Funcionalidades</small>
      <h3>Monitoramento completo da operação ferroviária</h3>
      <p class="hlgl-sub">Acompanhe trens, sensores, rotas e eventos em tempo real, com uma interface intuitiva e fácil de usar.</p>

      <div class="hlgl-cards5">
        <article><i class="bi bi-train-front"></i><h4>Monitoramento de trens</h4><p>Acompanhe a localização e o status da operação.</p></article>
        <article><i class="bi bi-wifi"></i><h4>Sensores</h4><p>Dados em tempo real sobre velocidade, temperatura, falhas e muito mais.</p></article>
        <article><i class="bi bi-geo-alt"></i><h4>Rotas</h4><p>Visualize e gerencie as rotas ferroviárias cadastradas.</p></article>
        <article><i class="bi bi-file-text"></i><h4>Relatórios</h4><p>Acesse relatórios e histórico da operação.</p></article>
        <article><i class="bi bi-bell"></i><h4>Eventos</h4><p>Receba alertas e notificações sobre ocorrências e anomalias.</p></article>
      </div>
    </div>
  </section>

  <section class="hlgl-secao hlgl-claro">
    <div class="hlgl-container hlgl-como">
      <div>
        <small>Como funciona</small>
        <h3>Da coleta de dados à informação</h3>
        <p>O HLGL integra sensores, sistemas e dados externos para transformar informações brutas em insights valiosos para a operação ferroviária.</p>
      </div>
      <div class="hlgl-passos">
        <div class="hlgl-passo"><i class="bi bi-wifi"></i><h4>Sensores</h4><p>Coletam dados da ferrovia</p></div>
        <i class="bi bi-arrow-right hlgl-seta"></i>
        <div class="hlgl-passo"><i class="bi bi-database"></i><h4>Coleta de dados</h4><p>Envia para o sistema</p></div>
        <i class="bi bi-arrow-right hlgl-seta"></i>
        <div class="hlgl-passo"><i class="bi bi-gear"></i><h4>Processamento</h4><p>Organiza e analisa as informações</p></div>
        <i class="bi bi-arrow-right hlgl-seta"></i>
        <div class="hlgl-passo"><i class="bi bi-graph-up"></i><h4>HLGL</h4><p>Apresenta os dados de forma clara e visual</p></div>
      </div>
    </div>
  </section>

  <section class="hlgl-secao hlgl-cinza" id="hlgl-beneficios">
    <div class="hlgl-container hlgl-beneficios">
      <div>
        <small>Benefícios</small>
        <h3>Mais segurança, eficiência e controle nas operações</h3>
      </div>
      <div class="hlgl-cards3">
        <article><i class="bi bi-shield-check"></i><h4>Segurança</h4><p>Melhor visualização das informações ferroviárias e resposta mais rápida a incidentes.</p></article>
        <article><i class="bi bi-lightning-charge"></i><h4>Eficiência</h4><p>Informações organizadas para auxiliar na operação e no planejamento.</p></article>
        <article><i class="bi bi-eye"></i><h4>Acompanhamento</h4><p>Visualização das condições da ferrovia, eventos e histórico da operação.</p></article>
      </div>
    </div>
  </section>

  <section class="hlgl-cta" id="hlgl-contato">
    <div class="hlgl-container">
      <h3>Pronto para transformar a gestão da sua ferrovia?</h3>
      <p>Conheça o HLGL e descubra como nossa solução pode fazer a diferença na sua operação.</p>
      <a href="public/login.php" class="hlgl-btn">Acessar sistema <i class="bi bi-arrow-right"></i></a>
    </div>
  </section>

  <footer class="hlgl-footer">
    <a href="#hlgl-inicio" class="hlgl-logo">HLGL</a>
    <p>Tecnologia a favor de uma ferrovia mais segura e eficiente.</p>
    
  </footer>

</div>

<script src="scripts/landing-page.js"></script>
</body>
</html>