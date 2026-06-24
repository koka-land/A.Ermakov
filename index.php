<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AE Logo Animations</title>
    <style>
        /* ========================================= */
        /* Базовые стили страницы                    */
        /* ========================================= */
        :root {
            --bg-dark: #121212;
            --logo-color: #264653; /* Фирменный цвет логотипа */
            --card-bg: #1e1e1e;
        }

        body, html {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--bg-dark);
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #ffffff;
            flex-wrap: wrap;
            gap: 40px;
            padding: 40px;
            box-sizing: border-box;
        }

        .demo-card {
            background-color: var(--card-bg);
            border: 1px solid #333;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            width: 260px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .demo-card h3 {
            margin: 0 0 30px 0;
            font-size: 16px;
            font-weight: 400;
            color: #b0bec5;
        }

        /* ========================================= */
        /* Настройки SVG Логотипа                    */
        /* ========================================= */
        .ae-logo {
            width: 160px;
            height: 160px;
            overflow: visible;
        }

        /* Общие стили для всех линий логотипа */
        .ae-path {
            fill: none;
            stroke: var(--logo-color);
            stroke-width: 8;
            stroke-linecap: butt; /* Плоские концы линий как на эталоне */
        }

        /* ========================================= */
        /* ВАРИАНТ 1: Плавный фокус                  */
        /* ========================================= */
        .anim-focus {
            opacity: 0;
            filter: blur(12px);
            transform: scale(0.7);
            animation: focusReveal 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        @keyframes focusReveal {
            100% {
                opacity: 1;
                filter: blur(0px);
                transform: scale(1);
            }
        }

        /* ========================================= */
        /* ВАРИАНТ 2: Последовательная отрисовка     */
        /* ========================================= */
        /* Изначально прячем все линии */
        .anim-draw .ae-path {
            stroke-dasharray: 300;
            stroke-dashoffset: 300;
        }

        /* Задаем очередность и время появления каждой линии */
        .anim-draw .arc-right   { animation: drawLine 0.7s ease-out forwards 0.2s; }
        .anim-draw .vert-right  { animation: drawLine 0.6s ease-out forwards 0.5s; }
        .anim-draw .arc-left    { animation: drawLine 0.7s ease-out forwards 0.9s; }
        .anim-draw .vert-left   { animation: drawLine 0.5s ease-out forwards 1.3s; }
        .anim-draw .horiz-right { animation: drawLine 0.4s ease-out forwards 1.6s; }
        .anim-draw .horiz-left  { animation: drawLine 0.4s ease-out forwards 1.8s; }

        @keyframes drawLine {
            to { stroke-dashoffset: 0; }
        }

        /* ========================================= */
        /* ВАРИАНТ 3: Пульсация (бесконечно)         */
        /* ========================================= */
        .anim-pulse {
            animation: pulseEffect 4s infinite ease-in-out;
            transform-origin: center;
        }

        @keyframes pulseEffect {
            0%, 100% { transform: scale(1); opacity: 1; filter: drop-shadow(0 0 0 transparent); }
            50% { transform: scale(1.05); opacity: 0.8; filter: drop-shadow(0 0 15px rgba(38, 70, 83, 0.5)); }
        }

        /* ========================================= */
        /* ВАРИАНТ 4: Вертикальное вращение          */
        /* ========================================= */
        .anim-spin {
            opacity: 0;
            transform: rotateY(-90deg);
            transform-origin: center;
            animation: spinReveal 1.2s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }

        @keyframes spinReveal {
            100% {
                opacity: 1;
                transform: rotateY(0deg);
            }
        }

    </style>
</head>
<body>

    <template id="logo-template">
        <svg class="ae-logo" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path class="ae-path arc-right" d="M 110 20 A 80 80 0 0 1 110 180" />
            <line class="ae-path vert-right" x1="110" y1="20" x2="110" y2="180" />
            <line class="ae-path horiz-right" x1="110" y1="100" x2="180" y2="100" />

            <path class="ae-path arc-left" d="M 90 20 A 80 80 0 0 0 45 160" />
            <line class="ae-path vert-left" x1="90" y1="20" x2="90" y2="130" />
            <line class="ae-path horiz-left" x1="20" y1="100" x2="90" y2="100" />
        </svg>
    </template>

    <div class="demo-card">
        <h3>1. Плавный фокус</h3>
        <div class="anim-focus" id="wrap-1"></div>
    </div>

    <div class="demo-card">
        <h3>2. Отрисовка линий</h3>
        <div class="anim-draw" id="wrap-2"></div>
    </div>

    <div class="demo-card">
        <h3>3. Пульсация (бесконечно)</h3>
        <div class="anim-pulse" id="wrap-3"></div>
    </div>

    <div class="demo-card">
        <h3>4. Вращение по оси Y</h3>
        <div class="anim-spin" id="wrap-4"></div>
    </div>

    <script>
        const template = document.getElementById('logo-template').innerHTML;
        document.getElementById('wrap-1').innerHTML = template;
        document.getElementById('wrap-2').innerHTML = template;
        document.getElementById('wrap-3').innerHTML = template;
        document.getElementById('wrap-4').innerHTML = template;
    </script>

</body>
</html>