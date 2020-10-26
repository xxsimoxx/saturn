document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.drawer-handle')) {
        let drawer = document.querySelector('.off-canvas-drawer'),
            drawerHandle = drawer.querySelector('.drawer-handle'),
            drawerClose = drawer.querySelector('.drawer-close');

        drawerHandle.addEventListener('click', () => {
            drawer.classList.toggle('is-open');
            document.body.classList.toggle('no-scroll');
        });
        drawerClose.addEventListener('click', () => {
            drawer.classList.toggle('is-open');
            document.body.classList.toggle('no-scroll');
        });
    }
});
