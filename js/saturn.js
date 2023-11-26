function saturnGetContrast(hexcolor) {
    hexcolor = hexcolor.replace('#', '');

    return (parseInt(hexcolor, 16) > 0xffffff / 2) ? 'black' : 'white';
}
function saturnResetColorWell() {
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
            colorWell.style.color = saturnGetContrast(colorWell.value);

            colorWell.addEventListener('input', saturnResetColorWell, false);
            colorWell.addEventListener('click', saturnResetColorWell, false);
            colorWell.addEventListener('touch', saturnResetColorWell, false);

            colorWell.addEventListener('blur', function () {
                this.style.backgroundColor = this.value;
                this.style.color = saturnGetContrast(this.value);
            });
        });
    }
});
