<?php

include "../infra/conn.php";

$paginaAtual = "monitoramento";
$submenuAtual = "monitoramento";

include("../includes/navbar.php");

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Monitoramento | SA-Ferrorama</title>

    <style>

        /* ============================================================
           HLGL — MONITORAMENTO V4
           CSS exclusivo desta página.
           Todas as classes usam o prefixo: hlgl-mon4-
           Só usa <div> e <span> para não herdar estilos globais
           (header, main, h1, p...) vindos do navbar ou de outras páginas.
        ============================================================ */

        .hlgl-mon4-page {

            /* >>> ALTURA DO NAVBAR (ajuste aqui se necessário) <<< */
            --hlgl-nav-h: 46px;

            position: fixed;
            top: var(--hlgl-nav-h);
            left: 0;
            right: 0;
            bottom: 0;

            z-index: 1;

            display: flex;
            flex-direction: column;

            overflow-x: hidden;
            overflow-y: auto;

            padding: 18px 24px;

            background:
                radial-gradient(circle at 8% 15%, rgba(58,107,176,.14), transparent 28%),
                radial-gradient(circle at 92% 85%, rgba(35,77,133,.13), transparent 30%),
                linear-gradient(135deg, #edf3f9 0%, #f8fafc 50%, #edf2f8 100%);

            font-family: Arial, Helvetica, sans-serif;
            color: #1b2e4d;

            box-sizing: border-box;
        }

        .hlgl-mon4-page *,
        .hlgl-mon4-page *::before,
        .hlgl-mon4-page *::after {
            box-sizing: border-box;
        }


        /* ---------- PAINEL ---------- */

        .hlgl-mon4-panel {

            position: relative;

            flex: 1 0 auto;

            width: min(1100px, 100%);

            align-self: center;

            overflow: hidden;

            border-radius: 26px;

            background: linear-gradient(135deg, rgba(255,255,255,.99), rgba(248,251,254,.99));

            border: 1px solid rgba(27,46,77,.09);

            box-shadow:
                0 25px 60px rgba(27,46,77,.12),
                0 4px 16px rgba(27,46,77,.06);
        }

        .hlgl-mon4-panel::before {

            content: "";
            position: absolute;
            z-index: 10;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;

            background: linear-gradient(90deg, #162c49, #234d85, #4d83c2, #234d85, #162c49);
        }

        .hlgl-mon4-grid {

            position: absolute;
            inset: 0;
            pointer-events: none;

            background-image:
                linear-gradient(rgba(35,77,133,.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(35,77,133,.035) 1px, transparent 1px);

            background-size: 30px 30px;
        }

        .hlgl-mon4-dot {

            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #4f82bc;
            opacity: .3;
            box-shadow: 0 0 0 5px rgba(79,130,188,.07);
        }

        .hlgl-mon4-dot-1 { top: 70px;    left: 60px; }
        .hlgl-mon4-dot-2 { top: 130px;   right: 65px; }
        .hlgl-mon4-dot-3 { bottom: 75px; left: 90px; }
        .hlgl-mon4-dot-4 { bottom: 105px; right: 95px; }


        /* ---------- CONTEÚDO ---------- */

        .hlgl-mon4-content {

            position: relative;
            z-index: 5;

            min-height: 100%;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            gap: 14px;

            padding: 30px 28px 26px;
        }


        /* ---------- TÍTULO ---------- */

        .hlgl-mon4-head {

            width: 100%;
            text-align: center;
        }

        .hlgl-mon4-label {

            display: block;
            margin: 0 0 8px;

            font-size: 10px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #3a6bb0;
        }

        .hlgl-mon4-title {

            display: block;
            margin: 0;

            font-size: clamp(30px, 3.4vw, 42px);
            line-height: 1.05;
            font-weight: 800;
            letter-spacing: -1px;
            color: #182f50;
        }

        .hlgl-mon4-subtitle {

            display: block;
            margin: 8px 0 0;

            font-size: 13px;
            line-height: 1.4;
            color: #718096;
        }


        /* ---------- FERROVIA (SVG) ---------- */

        .hlgl-mon4-rail {

            position: relative;

            width: 100%;
            max-width: 680px;

            margin: 0 auto;
        }

        .hlgl-mon4-rail-glow {

            position: absolute;
            left: 50%;
            top: 50%;

            width: 80%;
            height: 70%;

            transform: translate(-50%, -50%);

            border-radius: 50%;

            background: radial-gradient(ellipse, rgba(48,91,145,.16), transparent 70%);

            filter: blur(14px);

            pointer-events: none;
        }

        .hlgl-mon4-svg {

            position: relative;

            display: block;

            width: 100%;
            height: auto;

            max-height: 40vh;

            overflow: visible;
        }


        /* ---------- STATUS ---------- */

        .hlgl-mon4-status {

            display: inline-flex;
            align-items: center;
            gap: 9px;

            padding: 8px 18px;

            border-radius: 50px;

            background: linear-gradient(135deg, #f0f7ff, #e7f0fa);
            border: 1px solid #d3e3f3;

            color: #234d85;

            font-size: 12px;
            font-weight: 700;

            box-shadow: 0 5px 14px rgba(35,77,133,.08);
        }

        .hlgl-mon4-status-dot {

            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;

            background: #4a83c4;
            box-shadow: 0 0 0 4px rgba(74,131,196,.12);

            animation: hlglMon4Pulse 1.7s ease-in-out infinite;
        }

        @keyframes hlglMon4Pulse {

            0%, 100% { opacity: 1;   transform: scale(1); }
            50%      { opacity: .35; transform: scale(.72); }
        }

        .hlgl-mon4-description {

            display: block;

            width: min(580px, 100%);
            margin: 0;

            text-align: center;

            font-size: 12.5px;
            line-height: 1.5;
            color: #77869a;
        }


        /* ---------- CARDS FUTUROS ---------- */

        .hlgl-mon4-cards {

            width: min(820px, 100%);

            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;

            margin-top: 6px;
        }

        .hlgl-mon4-card {

            position: relative;

            padding: 16px 18px;

            border-radius: 16px;

            background: rgba(255,255,255,.85);
            border: 1px solid rgba(27,46,77,.08);

            box-shadow: 0 8px 20px rgba(27,46,77,.06);

            overflow: hidden;
        }

        .hlgl-mon4-card::before {

            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;

            background: linear-gradient(180deg, #4d83c2, #234d85);
        }

        .hlgl-mon4-card-label {

            display: block;

            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            color: #6c7f99;
        }

        .hlgl-mon4-card-value {

            display: block;

            margin: 6px 0 2px;

            font-size: 26px;
            font-weight: 800;
            line-height: 1;
            color: #234d85;
        }

        .hlgl-mon4-card-note {

            display: block;

            font-size: 11px;
            color: #94a1b3;
        }


        /* ---------- RESPONSIVO ---------- */

        @media (max-height: 760px) {

            .hlgl-mon4-content { gap: 10px; padding: 18px 22px 16px; }
            .hlgl-mon4-svg     { max-height: 34vh; }
            .hlgl-mon4-cards   { display: none; }
        }

        @media (max-width: 700px) {

            .hlgl-mon4-page    { padding: 10px; }
            .hlgl-mon4-panel   { border-radius: 18px; }
            .hlgl-mon4-content { padding: 20px 12px 18px; }
            .hlgl-mon4-cards   { grid-template-columns: 1fr; }
            .hlgl-mon4-subtitle,
            .hlgl-mon4-description { font-size: 11.5px; }
        }

        @media (prefers-reduced-motion: reduce) {

            .hlgl-mon4-status-dot { animation: none; }
        }

    </style>

</head>

<body>

<div class="hlgl-mon4-page">

    <div class="hlgl-mon4-panel">

        <div class="hlgl-mon4-grid"></div>

        <span class="hlgl-mon4-dot hlgl-mon4-dot-1"></span>
        <span class="hlgl-mon4-dot hlgl-mon4-dot-2"></span>
        <span class="hlgl-mon4-dot hlgl-mon4-dot-3"></span>
        <span class="hlgl-mon4-dot hlgl-mon4-dot-4"></span>

        <div class="hlgl-mon4-content">

            <!-- TÍTULO -->
            <div class="hlgl-mon4-head">
                <span class="hlgl-mon4-label">SA-Ferrorama • Sistema HLGL</span>
                <span class="hlgl-mon4-title">Monitoramento</span>
                <span class="hlgl-mon4-subtitle">Acompanhe futuramente as informações dos trens em operação.</span>
            </div>

            <!-- FERROVIA -->
            <div class="hlgl-mon4-rail">

                <div class="hlgl-mon4-rail-glow"></div>

                <svg class="hlgl-mon4-svg" viewBox="0 0 640 270" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">

                    <defs>

                        <linearGradient id="hlglMon4Body" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0"   stop-color="#6197cf"/>
                            <stop offset=".5"  stop-color="#2e6099"/>
                            <stop offset="1"   stop-color="#172d4a"/>
                        </linearGradient>

                        <linearGradient id="hlglMon4Wagon" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0"   stop-color="#7fa9d6"/>
                            <stop offset=".5"  stop-color="#3d72ab"/>
                            <stop offset="1"   stop-color="#234d85"/>
                        </linearGradient>

                        <linearGradient id="hlglMon4Window" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0" stop-color="#f8fcff"/>
                            <stop offset="1" stop-color="#99bad8"/>
                        </linearGradient>

                        <radialGradient id="hlglMon4Light">
                            <stop offset="0"   stop-color="#fff" stop-opacity=".95"/>
                            <stop offset=".4"  stop-color="#bfe0ff" stop-opacity=".5"/>
                            <stop offset="1"   stop-color="#4d83c2" stop-opacity="0"/>
                        </radialGradient>

                        <filter id="hlglMon4Shadow" x="-30%" y="-30%" width="160%" height="180%">
                            <feDropShadow dx="0" dy="4" stdDeviation="3" flood-color="#142a45" flood-opacity=".35"/>
                        </filter>

                    </defs>

                    <!-- base de brita -->
                    <ellipse cx="320" cy="135" rx="241" ry="87" fill="none" stroke="rgba(27,46,77,.07)" stroke-width="52"/>
                    <ellipse cx="320" cy="135" rx="241" ry="87" fill="none" stroke="#e4dccf" stroke-width="40" opacity=".75"/>

                    <!-- caminho de referência (centro) -->
                    <path id="hlglMon4Path" d="M 561 135 A 241 87 0 1 1 79 135 A 241 87 0 1 1 561 135" fill="none" stroke="none"/>

                    <!-- dormentes (gerados pelo JS) -->
                    <g id="hlglMon4Sleepers"></g>

                    <!-- trilhos -->
                    <ellipse cx="320" cy="135" rx="250" ry="96" fill="none" stroke="#5e6d80" stroke-width="4.5"/>
                    <ellipse cx="320" cy="135" rx="232" ry="78" fill="none" stroke="#5e6d80" stroke-width="4.5"/>
                    <ellipse cx="320" cy="134" rx="250" ry="96" fill="none" stroke="rgba(255,255,255,.7)" stroke-width="1"/>
                    <ellipse cx="320" cy="134" rx="232" ry="78" fill="none" stroke="rgba(255,255,255,.7)" stroke-width="1"/>

                    <!-- trem (montado pelo JS) -->
                    <g id="hlglMon4Train"></g>

                </svg>

            </div>

            <!-- STATUS -->
            <div class="hlgl-mon4-status">
                <span class="hlgl-mon4-status-dot"></span>
                Página em construção
            </div>

            <span class="hlgl-mon4-description">
                O módulo de monitoramento está sendo desenvolvido.
                Em breve, será possível acompanhar informações dos
                trens diretamente nesta página.
            </span>

            <!-- CARDS FUTUROS -->
            <div class="hlgl-mon4-cards">

                <div class="hlgl-mon4-card">
                    <span class="hlgl-mon4-card-label">Trens em operação</span>
                    <span class="hlgl-mon4-card-value">--</span>
                    <span class="hlgl-mon4-card-note">Disponível em breve</span>
                </div>

                <div class="hlgl-mon4-card">
                    <span class="hlgl-mon4-card-label">Estações</span>
                    <span class="hlgl-mon4-card-value">--</span>
                    <span class="hlgl-mon4-card-note">Disponível em breve</span>
                </div>

                <div class="hlgl-mon4-card">
                    <span class="hlgl-mon4-card-label">Alertas</span>
                    <span class="hlgl-mon4-card-value">--</span>
                    <span class="hlgl-mon4-card-note">Disponível em breve</span>
                </div>

            </div>

        </div>

    </div>

</div>


<script>

(function () {

    "use strict";

    var NS = "http://www.w3.org/2000/svg";

    var path       = document.getElementById("hlglMon4Path");
    var sleepersG  = document.getElementById("hlglMon4Sleepers");
    var trainG     = document.getElementById("hlglMon4Train");

    if (!path || !sleepersG || !trainG) { return; }

    var total = path.getTotalLength();


    function el(name, attrs, parent) {

        var node = document.createElementNS(NS, name);

        for (var k in attrs) {
            node.setAttribute(k, attrs[k]);
        }

        if (parent) { parent.appendChild(node); }

        return node;
    }


    /* ponto + ângulo (graus) em uma distância do caminho */
    function pointAt(dist) {

        var d  = ((dist % total) + total) % total;
        var p1 = path.getPointAtLength(d);
        var p2 = path.getPointAtLength((d + 1) % total);

        return {
            x: p1.x,
            y: p1.y,
            a: Math.atan2(p2.y - p1.y, p2.x - p1.x) * 180 / Math.PI
        };
    }


    /* ---------- DORMENTES ---------- */

    var sleeperCount = 44;

    for (var i = 0; i < sleeperCount; i++) {

        var p = pointAt((total / sleeperCount) * i);

        var g = el("g", {
            transform: "translate(" + p.x + " " + p.y + ") rotate(" + p.a + ")"
        }, sleepersG);

        el("rect", {
            x: -3.5, y: -17, width: 7, height: 34, rx: 1.5,
            fill: "#a97b4f", stroke: "rgba(78,50,30,.45)", "stroke-width": .8
        }, g);

        el("rect", {
            x: -3.5, y: -17, width: 2.2, height: 34, rx: 1,
            fill: "rgba(255,255,255,.22)"
        }, g);
    }


    /* ---------- TREM ---------- */

    /* locomotiva (x = frente para a direita) */
    function buildLoco() {

        var g = el("g", { filter: "url(#hlglMon4Shadow)" });

        el("rect", { x: -26, y: -12, width: 52, height: 24, rx: 8, fill: "url(#hlglMon4Body)", stroke: "#142a45", "stroke-width": 1.6 }, g);
        el("rect", { x: -20, y: -9,  width: 30, height: 4,  rx: 2, fill: "rgba(255,255,255,.35)" }, g);

        el("rect", { x: -17, y: -4, width: 13, height: 8, rx: 2, fill: "url(#hlglMon4Window)", stroke: "#172d4a", "stroke-width": 1.2 }, g);
        el("rect", { x: 0,   y: -4, width: 13, height: 8, rx: 2, fill: "url(#hlglMon4Window)", stroke: "#172d4a", "stroke-width": 1.2 }, g);

        el("rect", { x: 17, y: -9, width: 7, height: 18, rx: 3, fill: "#183452", stroke: "#142a45", "stroke-width": 1 }, g);

        el("circle", { cx: 29, cy: 0, r: 13, fill: "url(#hlglMon4Light)" }, g);
        el("circle", { cx: 25, cy: -6, r: 2.2, fill: "#fff" }, g);
        el("circle", { cx: 25, cy: 6,  r: 2.2, fill: "#fff" }, g);

        return g;
    }

    function buildWagon() {

        var g = el("g", { filter: "url(#hlglMon4Shadow)" });

        el("rect", { x: -22, y: -11, width: 44, height: 22, rx: 6, fill: "url(#hlglMon4Wagon)", stroke: "#142a45", "stroke-width": 1.5 }, g);
        el("rect", { x: -17, y: -8,  width: 34, height: 3.5, rx: 1.7, fill: "rgba(255,255,255,.35)" }, g);

        el("rect", { x: -17, y: -3, width: 10, height: 7, rx: 2, fill: "url(#hlglMon4Window)", stroke: "#172d4a", "stroke-width": 1 }, g);
        el("rect", { x: -4,  y: -3, width: 10, height: 7, rx: 2, fill: "url(#hlglMon4Window)", stroke: "#172d4a", "stroke-width": 1 }, g);
        el("rect", { x: 9,   y: -3, width: 8,  height: 7, rx: 2, fill: "url(#hlglMon4Window)", stroke: "#172d4a", "stroke-width": 1 }, g);

        return g;
    }

    /* [elemento, distância atrás da frente] */
    var cars = [
        { node: buildLoco(),  offset: 0   },
        { node: buildWagon(), offset: 52  },
        { node: buildWagon(), offset: 100 }
    ];

    cars.forEach(function (c) { trainG.appendChild(c.node); });


    /* ---------- ANIMAÇÃO ---------- */

    var speed    = 62;      /* px por segundo (unidades do SVG) */
    var position = total * .25;
    var last     = null;

    var reduce = window.matchMedia &&
                 window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    function render() {

        cars.forEach(function (c) {

            var p = pointAt(position - c.offset);

            c.node.setAttribute(
                "transform",
                "translate(" + p.x + " " + p.y + ") rotate(" + p.a + ")"
            );
        });
    }

    function frame(time) {

        if (last === null) { last = time; }

        var dt = Math.min((time - last) / 1000, .05);

        last = time;

        position = (position + speed * dt) % total;

        render();

        requestAnimationFrame(frame);
    }

    render();

    if (!reduce) {
        requestAnimationFrame(frame);
    }

})();

</script>

</body>

</html>