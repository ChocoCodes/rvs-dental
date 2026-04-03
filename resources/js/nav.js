document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (!menuToggle || !mobileMenu) return;

    const line1 = document.getElementById('menu-line-1');
    const line2 = document.getElementById('menu-line-2');
    const line3 = document.getElementById('menu-line-3');
    let isOpen = false;

    menuToggle.addEventListener('click', function() {
        isOpen = !isOpen;

        if (isOpen) {
            mobileMenu.classList.remove('hidden');
            mobileMenu.classList.add('flex')
            // Transform hamburger to X
            line1.classList.add('rotate-45', 'translate-y-2');
            line2.classList.add('opacity-0');
            line3.classList.add('-rotate-45', '-translate-y-2');
        } else {
            mobileMenu.classList.add('hidden');
            // Transform X back to hamburger
            line1.classList.remove('rotate-45', 'translate-y-2');
            line2.classList.remove('opacity-0');
            line3.classList.remove('-rotate-45', '-translate-y-2');
        }
    });
});
