<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пример анимации логотипа</title>
    <style>
        :root {
            --bg-dark: #121212;
            --logo-color: #264653; /* Исходный цвет вашего лого */
            --size: 150px; /* Размер контейнера лого */
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--bg-dark);
            font-family: sans-serif;
            color: #eee;
            flex-wrap: wrap; /* Для удобного размещения нескольких примеров */
            gap: 50px;
        }

        .demo-block {
            text-align: center;
            border: 1px solid #333;
            padding: 20px;
            border-radius: 8px;
            background: #1a1a1a;
        }

        /* --- Базовая структура логотипа на CSS --- */
        .ermakov-logo {
            width: var(--size);
            height: var(--size);
            position: relative;
            transform-style: preserve-3d; /* Для 3D-анимаций */
        }

        /* Общие стили для всех линий/кругов */
        .ermakov-logo div {
            position: absolute;
            background-color: var(--logo-color);
            border-radius: 10px; /* Гладкие края */
        }

        /* 1. Внешние круги */
        .ermakov-logo .outer-rings {
            width: 100%;
            height: 100%;
            border: 6px solid var(--logo-color);
            border-radius: 50%;
            background: transparent;
            /* Превращаем сплошной круг в прерывистый (как в оригинале) */
            border-left-color: transparent;
            border-right-color: transparent;
            top: -6px;
            left: -6px;
        }

        .ermakov-logo .outer-rings::after {
            content: '';
            position: absolute;
            width: 105%; height: 105%;
            top: -8px; left: -8px;
            border: 6px solid var(--logo-color);
            border-radius: 50%;
            border-top-color: transparent;
            border-bottom-color: transparent;
        }

        /* 2. Центральный крест */
        .ermakov-logo .line-v {
            width: 6px;
            height: 130px;
            top: 2px;
            left: calc(50% - 3px);
        }
        .ermakov-logo .line-v-alt {
            width: 5px;
            height: 130px;
            top: 2px;
            left: calc(50% + 2px);
        }

        .ermakov-logo .line-h {
            width: 65px;
            height: 6px;
            top: 90px;
            left: 35px;
        }
        .ermakov-logo .line-h-alt {
            width: 65px;
            height: 5px;
            top: 95px;
            left: 35px;
        }

        /* Правая часть креста */
        .ermakov-logo .line-h-right {
            width: 40px;
            height: 6px;
            top: 90px;
            left: 120px;
        }
        .ermakov-logo .line-h-right-alt {
            width: 40px;
            height: 5px;
            top: 95px;
            left: 120px;
        }

        /* Длинные вертикальные линии */
        .ermakov-logo .line-v-long {
            width: 6px;
            height: 196px;
            top: 2px;
            left: calc(50% + 12px);
        }
        .ermakov-logo .line-v-long-alt {
            width: 5px;
            height: 196px;
            top: 2px;
            left: calc(50% + 17px);
        }

        /* ========================================= */
        /* ВАРИАНТ 1: Плавное появление (Эффект Фокуса) */
        /* ========================================= */
        .ermakov-logo.anim-focus {
            opacity: 0;
            filter: blur(10px);
            transform: scale(0.8);
            animation: focusReveal 1.5s ease forwards;
        }

        @keyframes focusReveal {
            100% {
                opacity: 1;
                filter: blur(0px);
                transform: scale(1);
            }
        }

        /* ========================================= */
        /* ВАРИАНТ 2: Последовательная отрисовка */
        /* ========================================= */
        .ermakov-logo.anim-draw div {
            opacity: 0;
        }

        /* Задержки для разных элементов */
        .ermakov-logo.anim-draw .outer-rings {
            animation: drawElement 0.5s ease-out forwards 0.2s;
        }
        .ermakov-logo.anim-draw .line-v, .ermakov-logo.anim-draw .line-v-alt {
            animation: drawElement 0.4s ease-out forwards 0.6s;
        }
        .ermakov-logo.anim-draw .line-h, .ermakov-logo.anim-draw .line-h-alt,
        .ermakov-logo.anim-draw .line-h-right, .ermakov-logo.anim-draw .line-h-right-alt {
            animation: drawElement 0.4s ease-out forwards 1.0s;
        }
        .ermakov-logo.anim-draw .line-v-long, .ermakov-logo.anim-draw .line-v-long-alt {
            animation: drawElement 0.4s ease-out forwards 1.4s;
        }

        @keyframes drawElement {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========================================= */
        /* ВАРИАНТ 3: Пульсация и Сдвиг (Глич-эффект) */
        /* ========================================= */
        .ermakov-logo.anim-glitch {
            animation: glitchPulse 3s ease-in-out infinite;
        }

        .ermakov-logo.anim-glitch div {
            transform-origin: center;
        }

        /* Делаем линии чуть тоньше, чтобы они "играли" */
        .ermakov-logo.anim-glitch .line-v-alt,
        .ermakov-logo.anim-glitch .line-h-alt,
        .ermakov-logo.anim-glitch .line-h-right-alt,
        .ermakov-logo.anim-glitch .line-v-long-alt {
            opacity: 0.4;
            animation: innerPulse 1s ease-in-out infinite alternate;
        }

        @keyframes glitchPulse {
            0%, 100% { transform: scale(1); opacity: 1; filter: blur(0); }
            5% { transform: scale(1.03); opacity: 0.8; filter: blur(1px); }
            10% { transform: scale(1); opacity: 1; filter: blur(0); }
            95% { transform: scale(1); opacity: 1; filter: blur(0); }
        }

        @keyframes innerPulse {
            to { opacity: 0.1; }
        }

        /* ========================================= */
        /* ВАРИАНТ 4: Вертикальное вращение при появлении */
        /* ========================================= */
        .ermakov-logo.anim-spin {
            opacity: 0;
            transform: rotateY(-90deg) scale(0.5); /* Начало: повернуто ребром */
            transform-origin: center center;
            animation: spinReveal 1.2s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        }

        @keyframes spinReveal {
            100% {
                opacity: 1;
                transform: rotateY(0deg) scale(1);
            }
        }

    </style>
</head>
<body>

    <div class="demo-block">
        <p>1. Плавный фокус</p>
        <div class="ermakov-logo anim-focus">
            <div class="outer-rings"></div>
            <div class="line-v"></div>
            <div class="line-v-alt"></div>
            <div class="line-h"></div>
            <div class="line-h-alt"></div>
            <div class="line-h-right"></div>
            <div class="line-h-right-alt"></div>
            <div class="line-v-long"></div>
            <div class="line-v-long-alt"></div>
        </div>
    </div>

    <div class="demo-block">
        <p>2. Последовательная отрисовка</p>
        <div class="ermakov-logo anim-draw">
            <div class="outer-rings"></div>
            <div class="line-v"></div>
            <div class="line-v-alt"></div>
            <div class="line-h"></div>
            <div class="line-h-alt"></div>
            <div class="line-h-right"></div>
            <div class="line-h-right-alt"></div>
            <div class="line-v-long"></div>
            <div class="line-v-long-alt"></div>
        </div>
    </div>

    <div class="demo-block">
        <p>3. Глич-пульсация (бесконечно)</p>
        <div class="ermakov-logo anim-glitch">
            <div class="outer-rings"></div>
            <div class="line-v"></div>
            <div class="line-v-alt"></div>
            <div class="line-h"></div>
            <div class="line-h-alt"></div>
            <div class="line-h-right"></div>
            <div class="line-h-right-alt"></div>
            <div class="line-v-long"></div>
            <div class="line-v-long-alt"></div>
        </div>
    </div>

    <div class="demo-block">
        <p>4. Вертикальное вращение (при появлении)</p>
        <div class="ermakov-logo anim-spin">
            <div class="outer-rings"></div>
            <div class="line-v"></div>
            <div class="line-v-alt"></div>
            <div class="line-h"></div>
            <div class="line-h-alt"></div>
            <div class="line-h-right"></div>
            <div class="line-h-right-alt"></div>
            <div class="line-v-long"></div>
            <div class="line-v-long-alt"></div>
        </div>
    </div>

</body>
</html>