// --- Анимация фона: Классические диагонали без пустот ---
document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById('wave-bg');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let width, height, cols, rows;
    const spacing = 560; // Твой размер
    let time = 0;

    function resize() {
        width = canvas.width = canvas.offsetWidth;
        height = canvas.height = canvas.offsetHeight;
        // +2 чтобы хватило запаса для отрисовки за краями экрана
        cols = Math.ceil(width / spacing) + 2;
        rows = Math.ceil(height / spacing) + 2;
    }
    window.addEventListener('resize', resize);
    resize();

    function animate() {
        ctx.clearRect(0, 0, width, height);

        const lineColor = 'rgba(38, 70, 83, 0.25)';
        const fillColor = 'rgba(38, 70, 83, 0.05)';

        ctx.lineWidth = 1;
        ctx.strokeStyle = lineColor;
        ctx.fillStyle = fillColor;

        // СОХРАНЯЕМ ТРЮК: начинаем рисовать ЗА границей экрана
        const startX = -spacing;
        const startY = -spacing;

        for (let i = 0; i < cols; i++) {
            for (let j = 0; j < rows; j++) {

                // УБРАЛИ СМЕЩЕНИЕ РЯДОВ: теперь точки идут строго друг под другом
                let x = startX + i * spacing;
                let baseY = startY + j * spacing;

                // Волна
                let offset = Math.sin(x * 0.005 + time) * 35 + Math.cos(baseY * 0.005 + time * 0.8) * 25;
                let y1 = baseY + offset;

                let x2 = startX + (i + 1) * spacing;
                let baseY2 = startY + j * spacing;
                let y2 = baseY2 + Math.sin(x2 * 0.005 + time) * 35 + Math.cos(baseY2 * 0.005 + time * 0.8) * 25;

                let x3 = startX + i * spacing;
                let baseY3 = startY + (j + 1) * spacing;
                let y3 = baseY3 + Math.sin(x3 * 0.005 + time) * 35 + Math.cos(baseY3 * 0.005 + time * 0.8) * 25;

                let x4 = startX + (i + 1) * spacing;
                let baseY4 = startY + (j + 1) * spacing;
                let y4 = baseY4 + Math.sin(x4 * 0.005 + time) * 35 + Math.cos(baseY4 * 0.005 + time * 0.8) * 25;

                // Первый треугольник (диагональ \ )
                ctx.beginPath();
                ctx.moveTo(x, y1);
                ctx.lineTo(x2, y2);
                ctx.lineTo(x3, y3);
                ctx.closePath();
                ctx.fill();
                ctx.stroke();

                // Второй треугольник (диагональ / )
                ctx.beginPath();
                ctx.moveTo(x2, y2);
                ctx.lineTo(x4, y4);
                ctx.lineTo(x3, y3);
                ctx.closePath();
                ctx.fill();
                ctx.stroke();
            }
        }

        time += 0.008; // Твоя медленная скорость
        requestAnimationFrame(animate);
    }

    animate();
});