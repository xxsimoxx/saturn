/**
 * Resize navigation bar and reposition it based on scroll value
 */
function navResize() {
    if (window.pageYOffset == 0) {
        document.querySelector('header').classList.remove('header--nav-scrolled');
        document.querySelector('header nav').classList.remove('nav-scrolled');
    } else {
        document.querySelector('header').classList.add('header--nav-scrolled');
        document.querySelector('header nav').classList.add('nav-scrolled');
    }
}



document.addEventListener('DOMContentLoaded', () => {
    navResize();

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
            sidebar.classList.toggle( "active" );
            overlay.classList.toggle( "active" );
            overlay.onclick = function () {
                sidebar.classList.toggle( "active" );
                overlay.classList.toggle( "active" );
            }
        }
    });



    // Only Use the IntersectionObserver if it is supported
    if (IntersectionObserver && document.querySelector('img')) {
        // When the element is visible on the viewport, 
        // add the animated class so it creates the animation.
        let callback = (entries) => {
            entries.forEach(entry => {
                // If the element is visible, add the animated class
                if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                    entry.target.classList.add('animated');
                }
            });
        }

        // Create the observer
        let observer = new IntersectionObserver(callback, {
            root: null,
            threshold: 0.3
        });

        // Get and observe all the items with the item class
        let items = document.querySelectorAll('img');
        items.forEach((item) => {
            item.classList.add('animation');
            observer.observe(item);
        });
    }
}, false);



window.addEventListener('scroll', () => {
    navResize();
});






/**
 *
 */
var show = function (elem) {
    elem.style.display = 'block';
};
var hide = function (elem) {
    elem.style.display = 'none';
};
var toggle = function (elem) {
    // If the element is visible, hide it
    if (window.getComputedStyle(elem).display === 'block') {
        hide(elem);
        return;
    }

    // Otherwise, show it
    show(elem);
};
