<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Входной экран с SVG анимацией</title>
    <style>
        :root {
            --bg-dark: #121212;
            --md-sys-color-primary: #264653; /* Акцентный цвет логотипа */
            --text-primary: #ffffff;

            /* Переменные для контроля толщины обводки */
            --logo-stroke-start: 2px;
            --logo-stroke-end: 8px;
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--bg-dark);
            font-family: 'Roboto', sans-serif;
            color: var(--text-primary);
        }

        /* Контейнер для центрирования и выравнивания */
        .hero-entrance {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 24px;
        }

        /* --- Настройки SVG Логотипа --- */
        .ae-logo-animated {
            width: 180px;
            height: 180px;
            overflow: visible;

            /* Анимация вращения всего контейнера по оси Y */
            opacity: 0;
            transform: rotateY(-90deg);
            transform-origin: center;
            animation: spinEntrance 1.2s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }

        .ae-line {
            fill: none;
            stroke: var(--md-sys-color-primary);
            stroke-linecap: butt;

            /* Задаем начальную толщину */
            stroke-width: var(--logo-stroke-start);

            /* Подготовка к анимации отрисовки */
            stroke-dasharray: 400;
            stroke-dashoffset: 400;

            /* Запуск отрисовки контуров */
            animation: drawAndThicken 1.5s ease-out forwards 0.3s;
        }

        /* --- Типографика и выравнивание --- */
        .md-headline-small {
            margin: 0;
            font-size: 2.25rem;
            font-weight: 400;
            letter-spacing: 0px;
            line-height: 2.75rem;

            /* Легкий Fade Up для заголовка */
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.8s ease forwards 1s;
        }

        /* --- Ключевые кадры (Keyframes) --- */

        /* 1. Появление с вращением (для контейнера) */
        @keyframes spinEntrance {
            100% {
                opacity: 1;
                transform: rotateY(0deg);
            }
        }

        /* 2. Прорисовка линий и динамическое изменение stroke-width */
        @keyframes drawAndThicken {
            50% {
                /* Линии остаются тонкими до середины анимации */
                stroke-width: var(--logo-stroke-start);
            }
            100% {
                /* В конце линии полностью отрисованы и набирают нужную толщину */
                stroke-dashoffset: 0;
                stroke-width: var(--logo-stroke-end);
            }
        }

        /* 3. Появление текста */
        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <div class="hero-entrance">
        <svg class="ae-logo-animated" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path class="ae-line" d="M 110 20 A 80 80 0 0 1 110 180" />
            <line class="ae-line" x1="110" y1="20" x2="110" y2="180" />
            <line class="ae-line" x1="110" y1="100" x2="180" y2="100" />

            <path class="ae-line" d="M 90 20 A 80 80 0 0 0 45 160" />
            <line class="ae-line" x1="90" y1="20" x2="90" y2="130" />
            <line class="ae-line" x1="20" y1="100" x2="90" y2="100" />
        </svg>

        <h1 class="md-headline-small">Блог Александра Ермакова</h1>
    </div>

</body>
</html>