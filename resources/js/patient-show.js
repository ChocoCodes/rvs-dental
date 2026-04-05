document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');

    if (!tabButtons.length || !tabPanels.length) return;

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.dataset.tab;

            tabButtons.forEach(btn => {
                btn.classList.remove('active');
                const bg = btn.querySelector('.tab-bg');
                if (bg) {
                    bg.setAttribute('fill', 'transparent');
                }
                const icon = btn.querySelector('.tab-icon');
                if (icon) {
                    icon.setAttribute('fill', '#006A6A');
                }
            });

            this.classList.add('active');
            const activeBg = this.querySelector('.tab-bg');
            if (activeBg) {
                activeBg.setAttribute('fill', '#006A6A');
            }
            const activeIcon = this.querySelector('.tab-icon');
            if (activeIcon) {
                activeIcon.setAttribute('fill', 'white');
            }

            tabPanels.forEach(panel => {
                panel.classList.add('hidden');
            });

            const targetPanel = document.getElementById(`tab-${targetTab}`);
            if (targetPanel) {
                targetPanel.classList.remove('hidden');
            }
        });
    });
});
