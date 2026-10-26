(function () {
    'use strict';

    var raiz = document.querySelector('.hlgl-home');
    if (!raiz) return;

    var links = raiz.querySelectorAll('.hlgl-nav a');

    var secoes = Array.prototype.map.call(links, function (a) {
        return document.querySelector(a.getAttribute('href'));
    });

    function atualizarMenu() {
        var scrollAtual = window.scrollY + 180;
        var atual = 0;

        secoes.forEach(function (secao, i) {
            if (secao && secao.getBoundingClientRect().top + window.scrollY <= scrollAtual) {
                atual = i;
            }
        });

        links.forEach(function (link, i) {
            link.classList.toggle('hlgl-ativo', i === atual);
        });
    }

    raiz.querySelectorAll('a[href^="#hlgl-"]').forEach(function (a) {

        a.addEventListener('click', function (e) {

            var alvo = document.querySelector(a.getAttribute('href'));

            if (!alvo) return;

            e.preventDefault();

            links.forEach(function (link) {
                link.classList.remove('hlgl-ativo');
            });

            a.classList.add('hlgl-ativo');

            // Rola suavemente até a seção
            alvo.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });

    });

    window.addEventListener('scroll', atualizarMenu, {
        passive: true
    });

    window.addEventListener('load', atualizarMenu);

    atualizarMenu();

})();