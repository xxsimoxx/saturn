document.addEventListener('DOMContentLoaded', () => {
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



    /**
     * Dynamic cursor
     */
    if (document.querySelector('.has-cursor')) {
        const cursorSettings = {
            'class': 'dynamicCursor',
            'size': '18',
            'expandedSize': '40',
            'expandSpeed': 0.4,
            'background': 'rgba(161, 142, 218, 0.25)',
            'opacity': '1',
            'transitionTime': '1.4s',
            'transitionEase': 'cubic-bezier(0.075, 0.820, 0.165, 1.000)',
            'borderWidth': '0',
            'borderColor': 'black',
            'iconSize': '11px',
            'iconColor': 'black',
            'triggerElements': {
                'trigger': {
                    'className': 'trigger',
                    'icon': '+'
                }
            }
        }


        function dynamicCursor(options) {
            cursor = document.createElement('div');
            let cursorIcon = document.createElement('div');

            cursorIcon.classList.add('cursorIcon');
            cursorIcon.style.position = 'absolute';
            cursorIcon.style.fontFamily = 'monospace';
            cursorIcon.style.textAlign = 'center'
            cursorIcon.style.top = '50%';
            cursorIcon.style.width = '100%';
            cursorIcon.style.transform = 'translateY(-50%)';
            cursorIcon.style.color = options.iconColor;
            cursorIcon.style.fontSize = options.iconSize;
            cursorIcon.style.opacity = 0;
            cursorIcon.style.transition = `opacity ${options.expandSpeed}s`;

            cursor.classList.add(options.class);
            cursor.style.boxSizing = 'border-box';
            cursor.style.width = `${options.size}px`;
            cursor.style.height = `${options.size}px`;
            cursor.style.borderRadius = `${options.expandedSize}px`;
            cursor.style.opacity = 0;

            cursor.style.pointerEvents = 'none';
            cursor.style.zIndex = 999;
            cursor.style.transition = `transform ${options.transitionTime} ${options.transitionEase}, width ${options.expandSpeed}s .2s, height ${options.expandSpeed}s .2s, opacity 1s .2s`;
            cursor.style.border = `${options.borderWidth}px solid ${options.borderColor}`;
            cursor.style.position = 'fixed';
            cursor.style.background = options.background;

            cursor.appendChild(cursorIcon);
            document.body.appendChild(cursor);

            setTimeout(function () {
                cursor.style.opacity = options.opacity;
            }, 500)

            var idle;

            document.onmousemove = e => {
                x = e.clientX;
                y = e.clientY;

                cursor.style.opacity = options.opacity;
                clearInterval(idle)

                idle = setTimeout(function () {
                    cursor.style.opacity = 0;
                }, 4000)

                cursor.style.top = '0';
                cursor.style.left = '0';
                cursor.style.transform = `translateX(calc(${x}px - 50%)) translateY(calc(${y}px - 50%))`;
            }

            if (document.querySelector(`a`)) {
                let icon = options.triggerElements.trigger.icon;

                [].forEach.call(document.querySelectorAll(`a`), trigger => {
                    trigger.addEventListener('mouseover', () => {
                        cursor.style.width = `${options.expandedSize}px`;
                        cursor.style.height = `${options.expandedSize}px`;
                        cursorIcon.innerHTML = icon;
                        cursorIcon.style.opacity = 1;
                    });

                    trigger.addEventListener('mouseout', () => {
                        cursor.style.width = `${options.size}px`;
                        cursor.style.height = `${options.size}px`;
                        cursorIcon.style.opacity = 0;
                    });
                });
            }
        }

        dynamicCursor(cursorSettings);
    }

    /**
     * Butter.js
     */
    if (document.querySelector('.has-butter')) {
        const options = {
            wrapperId: 'saturn-scroll',
            wrapperDamper: 0.10,
            cancelOnTouch: true
        };
        butter.init(options);
    }


    if (document.getElementById('switch')) {
        let theme = localStorage.getItem('data-theme');

        const checkboxes = document.querySelectorAll('input[name="theme"]');
        const changeThemeToDark = () => {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('data-theme', 'dark');
        }

        const changeThemeToLight = () => {
            document.documentElement.setAttribute('data-theme', 'light');
            localStorage.setItem('data-theme', 'light');
        }

        if (theme === 'dark') {
            changeThemeToDark();

            [].forEach.call(document.querySelectorAll('input[name="theme"]'), checkboxEach => {
                checkboxEach.checked = true;
            });
        }

        [].forEach.call(checkboxes, checkbox => {
            checkbox.addEventListener('change', () => {
                let theme = localStorage.getItem('data-theme');

                if (theme === 'dark') {
                    changeThemeToLight();

                    [].forEach.call(document.querySelectorAll('input[name="theme"]'), checkboxEach => {
                        checkboxEach.checked = false;
                    });
                } else {
                    changeThemeToDark();

                    [].forEach.call(document.querySelectorAll('input[name="theme"]'), checkboxEach => {
                        checkboxEach.checked = true;
                    });
                }
            });
        });
    }

    if (parseInt(saturn_ajax_var.use_magnetmouse_js, 10) === 1) {
        if (document.querySelector('.magnet')) {
            (function () {
                const links = document.querySelectorAll('.magnet');

                const animateMe = function (e) {
                    const span = this.querySelector('a');
                    const { offsetX: x, offsetY: y } = e,
                        { offsetWidth: width, offsetHeight: height } = this;

                    move = 32;
                    xMove = x / width * (move * 2) - move;
                    yMove = y / height * (move * 2) - move;

                    span.style.transform = `translate(${xMove}px, ${yMove}px)`;

                    if (e.type === 'mouseleave') span.style.transform = '';
                };

                links.forEach(link => link.addEventListener('mousemove', animateMe));
                links.forEach(link => link.addEventListener('mouseleave', animateMe));
            })();
        }
    }
}, false);
