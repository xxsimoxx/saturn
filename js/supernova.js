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

});
