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
     * Observe and animate all elements having a class of .supernova-anim-in
     * 
     * @url https://alligator.io/js/intersection-observer/
     */
    if (document.querySelector('.supernova-anim-in')) {
        const options = {
            root: null, // use the document's viewport as the container
            rootMargin: '0px', // % or px - offsets added to each side of the intersection 
            threshold: 0.5 // percentage of the target element which is visible
        }

        let callback = (entries) => {
            entries.forEach(entry => {
                // If entry (box) is visible - according with the params set in `options`
                // then adds `isVisible` class to box
                // otherwise removes `isVisible` class
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-changed');
                    observer.unobserve(entry.target);
                } else {
                    //entry.target.classList.remove('is-changed');
                }
            });
        }

        // Create the intersection observer instance by calling its constructor and passing it a
        // callback function to be run whenever a threshold is crossed in one direction or the other:
        let observer = new IntersectionObserver(callback, options);

        // Get all the `.box` from DOM and attach the observer to these
        document.querySelectorAll('.supernova-anim-in').forEach(box => { observer.observe(box) });
    }
}, false);
