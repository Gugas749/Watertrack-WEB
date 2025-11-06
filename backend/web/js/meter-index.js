document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.querySelector('[data-toggle="right-panel"]');
    const panel = document.getElementById('rightPanel');
    const closeBtn = document.getElementById('closePanel');
    const overlay = document.getElementById('overlay');
    const form = document.getElementById('add-meter-form');

    function openPanel() {
        panel.style.display = 'block';
        overlay.style.display = 'block';
        requestAnimationFrame(() => panel.classList.add('show'));
    }

    function closePanel() {
        panel.classList.remove('show');
        overlay.style.display = 'none';
        setTimeout(() => {
            panel.style.display = 'none';
            // 🧹 Auto-reset form when panel closes
            if (form) form.reset();
        }, 300);
    }

    if (openBtn) openBtn.addEventListener('click', openPanel);
    if (closeBtn) closeBtn.addEventListener('click', closePanel);
    if (overlay) overlay.addEventListener('click', closePanel);
});
