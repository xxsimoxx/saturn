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
    if (document.querySelector('button[name="popover"]')) {
        [].forEach.call(document.querySelectorAll('button[name="popover"]'), (popover) => {
            popover.addEventListener('click', (event) => {
                event.preventDefault();
            });
        });
    }
});
