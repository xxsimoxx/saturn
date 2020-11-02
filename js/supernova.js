function supernovaGetContrast(hexcolor) {
    hexcolor = hexcolor.replace('#', '');

    return (parseInt(hexcolor, 16) > 0xffffff/2) ? 'black' : 'white';
}
function supernovaResetColorWell() {
    this.style.backgroundColor = 'white';
    this.style.color = 'black';
}



document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('repeater-add')) {
        /**
         * Add new repeater field
         */
        function addRepeaterField() {
            let newRepeater = document.createElement('div');

            newRepeater.innerHTML = '<p><input type="url" class="large-text" placeholder="https://" name="supernova_external_css[]"></p>';
            document.getElementById('repeater-fields').appendChild(newRepeater);
        }

        document.getElementById('repeater-add').addEventListener('click', (e) => {
            e.preventDefault();

            addRepeaterField('dynamicInput');
        });
    }



    if (document.getElementById('supernova_custom_css')) {
        wp.codeEditor.initialize(document.getElementById('supernova_custom_css'), {
            'codemirror': {
                'mode': 'css',
                'indentUnit': 4,
                'indentWithTabs': true,
                'lineNumbers': true,
            }
        });
    }

    if (document.getElementById('supernova_custom_html')) {
        wp.codeEditor.initialize(document.getElementById('supernova_custom_html'), {
            'codemirror': {
                'mode': 'htmlmixed',
                'indentUnit': 4,
                'indentWithTabs': true,
                'lineNumbers': true,
            }
        });
    }

    if (document.getElementById('supernova_custom_html_footer')) {
        wp.codeEditor.initialize(document.getElementById('supernova_custom_html_footer'), {
            'codemirror': {
                'mode': 'htmlmixed',
                'indentUnit': 4,
                'indentWithTabs': true,
                'lineNumbers': true,
            }
        });
    }



    /**
     * Color Well Vanilla JS
     */
    if (document.querySelector('.color-well')) {
        [].forEach.call(document.querySelectorAll('.color-well'), function (colorWell) {
            colorWell.style.backgroundColor = colorWell.value;
            colorWell.style.color = supernovaGetContrast(colorWell.value);

            colorWell.addEventListener('input', supernovaResetColorWell, false);
            colorWell.addEventListener('click', supernovaResetColorWell, false);
            colorWell.addEventListener('touch', supernovaResetColorWell, false);

            colorWell.addEventListener('blur', function () {
                this.style.backgroundColor = this.value;
                this.style.color = supernovaGetContrast(this.value);
            });
        });
    }



    /**
     * Thin UI Popovers
     */
    if (document.querySelector('[data-popover-target]')) {
        // Create an array of all popover toggle buttons on the page
        let popoverButtonsArray = [].slice.call(document.querySelectorAll('[data-popover-target]'));

        // Assign toggle buttons to corosponding popover
        popoverButtonsArray.forEach((currentValue, currentIndex, listObj) => {
            let targetIdName = popoverButtonsArray[currentIndex].dataset.popoverTarget; // get the id from dataset
            let targetPopover = document.getElementById(targetIdName); // get the element based on id
            let targetCloseButton = targetPopover.querySelector('.thin-ui-popover-close-button'); // popover close icon

            // Assign all the buttons to open and close their popovers
            popoverButtonsArray[currentIndex].addEventListener('click', () => {
                // Hide other popovers
                let popoverTriggers = document.querySelectorAll('.thin-ui-popover');
                [].forEach.call(popoverTriggers, function (el) {
                    el.classList.add('hide');
                });

                targetPopover.classList.toggle('hide');
            });

            // Make the close icon close the popover
            targetCloseButton.addEventListener('click', (event) => {
                event.preventDefault();

                targetPopover.classList.toggle('hide');
            });
        });
    }
});
