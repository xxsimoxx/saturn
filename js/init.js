document.addEventListener('DOMContentLoaded', () => {
    /**
     * Supernova Snackbar feature
     */
    if (document.getElementById('snackbar')) {
        let last_known_scroll_position = 0,
            ticking = false;

        function doSomething(scroll_pos) {
            let scroll_position = parseInt(document.getElementById('snackbar').dataset.scroll, 10);

            if ((scroll_pos) >= scroll_position && (window.innerHeight + window.scrollY) < document.body.offsetHeight) {
                document.getElementById('snackbar').classList.add('snackbar--on');
            } else {
                document.getElementById('snackbar').classList.remove('snackbar--on');
            }
        }

        window.addEventListener('scroll', (e) => {
            last_known_scroll_position = window.scrollY;

            if (!ticking) {
                window.requestAnimationFrame(() => {
                    doSomething(last_known_scroll_position);
                    ticking = false;
                });

                ticking = true;
            }
        });
    }



    document.querySelector('*').addEventListener('click', function (event) {
        var sidebar = document.querySelector('#side-menu'),
            overlay = document.querySelector('#overlay');

        if (event.target.classList.contains('side-menu-close')) {
            event.preventDefault();
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            overlay.onclick = function () {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }
        }
    });



    /**
     * Details/summary HTML element
     * Only open one element at a time
     */
    if (document.querySelector('details')) {
        // Fetch all the details elements
        const details = document.querySelectorAll('details');

        // Add onclick listeners
        details.forEach((targetDetail) => {
            targetDetail.addEventListener('click', () => {
                // Close all details that are not targetDetail
                details.forEach((detail) => {
                    if (detail !== targetDetail) {
                        detail.removeAttribute('open');
                    }
                });
            });
        });
    }
}, false);
