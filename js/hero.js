document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById('wave-bg');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let width, height, cols, rows, centerX, centerY;
    const spacing = 560;
    let time = 0;

    function resize() {
        width = canvas.width = canvas.offsetWidth;
        height = canvas.height = canvas.offsetHeight;

        // Находим точный центр экрана
        centerX = width / 2;
        centerY = height / 2;

        // Увеличиваем запас колонок, чтобы при расширении не было "дыр" по краям
        cols = Math.ceil(width / spacing) + 4;
        rows = Math.ceil(height / spacing) + 4;
    }

    window.addEventListener('resize', resize);
    resize();

    // МАГИЯ ЗДЕСЬ: Функция для расчета радиального смещения каждой точки
    function getPoint(x_base, y_base, time) {
        // 1. Направление смещения по-прежнему от центра
        // (сохраняем эффект, где углы квадрата разъезжаются в разные стороны)
        const dx = x_base - centerX;
        const dy = y_base - centerY;
        const angle = Math.atan2(dy, dx);

        // 2. Фаза волны (тайминг) теперь зависит от X, а не от расстояния от центра!
        // Умножение на 0.003 делает волну широкой и плавной.
        // Прибавление time заставляет волну "бежать" в отрицательную сторону оси X (справа налево).
        // Добавлен легкий модификатор по оси Y (y_base * 0.001), чтобы волна шла под едва заметным углом
        // и не выглядела слишком искусственно ровной, как сканер.
        const wave = Math.sin(x_base * 0.003 + y_base * 0.001 + time) * 35;

        // 3. Применяем смещение
        return {
            x: x_base + (Math.cos(angle) * wave),
            y: y_base + (Math.sin(angle) * wave)
        };
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);

        const lineColor = 'rgba(38, 70, 83, 0.25)';
        const fillColor = 'rgba(38, 70, 83, 0.05)';

        ctx.lineWidth = 1;
        ctx.strokeStyle = lineColor;
        ctx.fillStyle = fillColor;

        // Центрируем сетку: сдвигаем начало координат так, чтобы ровно в (centerX, centerY)
        // находился геометрический центр одного из квадратов
        const startX = centerX - Math.floor(cols / 2) * spacing - (spacing / 2);
        const startY = centerY - Math.floor(rows / 2) * spacing - (spacing / 2);

        for (let i = 0; i < cols; i++) {
            for (let j = 0; j < rows; j++) {

                // Базовые координаты 4-х вершин текущей ячейки
                let x1_base = startX + i * spacing;
                let y1_base = startY + j * spacing;

                let x2_base = startX + (i + 1) * spacing;
                let y2_base = startY + j * spacing;

                let x3_base = startX + i * spacing;
                let y3_base = startY + (j + 1) * spacing;

                let x4_base = startX + (i + 1) * spacing;
                let y4_base = startY + (j + 1) * spacing;

                // Получаем итоговые координаты с учетом радиальной волны
                let p1 = getPoint(x1_base, y1_base, time);
                let p2 = getPoint(x2_base, y2_base, time);
                let p3 = getPoint(x3_base, y3_base, time);
                let p4 = getPoint(x4_base, y4_base, time);

                // Отрисовка первого треугольника
                ctx.beginPath();
                ctx.moveTo(p1.x, p1.y);
                ctx.lineTo(p2.x, p2.y);
                ctx.lineTo(p3.x, p3.y);
                ctx.closePath();
                ctx.fill();
                ctx.stroke();

                // Отрисовка второго треугольника
                ctx.beginPath();
                ctx.moveTo(p2.x, p2.y);
                ctx.lineTo(p4.x, p4.y);
                ctx.lineTo(p3.x, p3.y);
                ctx.closePath();
                ctx.fill();
                ctx.stroke();
            }
        }

        // Скорость анимации
        time += 0.009;
        requestAnimationFrame(animate);
    }

    animate();
});