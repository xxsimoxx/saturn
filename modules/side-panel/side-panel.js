document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.toggle-nav')) {
        let navLinks = document.querySelectorAll('.toggle-nav');

        navLinks.forEach((link, index) => {
            link.addEventListener('click', (e) => {
                e.preventDefault();

                if (document.getElementById('site-menu').classList.contains('show-nav')) {
                    document.getElementById('site-menu').classList.remove('show-nav');
                    document.body.classList.remove('no-scroll');
                } else {
                    document.getElementById('site-menu').classList.add('show-nav');
                    document.body.classList.add('no-scroll');
                }
            });
        });
    }
});
