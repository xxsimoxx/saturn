<?php
add_action('init', 'supernova_slider_block_main');

function supernova_plugin_block_categories($categories, $post) {
    return array_merge(
        $categories, [
            [
                'slug' => 'supernova',
                'title' => 'Supernova',
                'icon' => 'star-filled',
            ]
        ]
    );
}
add_filter('block_categories_all', 'supernova_plugin_block_categories', 10, 2);

function supernova_block_enqueue_block_editor_assets() {
    wp_enqueue_script(
        'supernova-slider-block-script',
        get_stylesheet_directory_uri() . '/blocks/slider/supernova-slider-block.js',
        ['wp-blocks', 'wp-element', 'wp-i18n', 'wp-editor', 'wp-components']
    );
}

add_action('enqueue_block_editor_assets', 'supernova_block_enqueue_block_editor_assets');

function supernova_slider_block_main() {
    function addShortcodeParam($key, $value) {
        if (trim($value) == '') {
            return '';
        }
        $asc = $key . '="' . $value . '" ';

        return $asc;
    }

    function supernova_slider_render($attributes, $content) {
		$out = '';

        // Slide ID(s)
		$ids = trim($attributes['ids']);

        // Mobile Slide ID(s)
		$mobile = trim($attributes['mobile']);

        // Controls
		$controls = (1 !== (int) trim($attributes['controls'])) ? 'no' : 'yes';

        // Full Height
		$fullheight = (1 !== (int) trim($attributes['fullheight'])) ? 'no' : 'yes';

        // Full Width
		$fullwidth = (1 !== (int) trim($attributes['fullwidth'])) ? 'no' : 'yes';

        // Full Size
		$fullsize = (1 !== (int) trim($attributes['fullsize'])) ? 'no' : 'yes';

        // Zoom
		$zoom = (1 !== (int) trim($attributes['zoom'])) ? 'no' : 'yes';

        // Interval
		$interval = (int) trim($attributes['interval']);

        // Height
		$height = (int) trim($attributes['height']);
        $height = ($height > 0) ? $height : 600;

		$shortcodeData = '[slider ';
		$shortcodeData .= addShortcodeParam('controls', $controls);
		$shortcodeData .= addShortcodeParam('fullheight', $fullheight);
		$shortcodeData .= addShortcodeParam('fullwidth', $fullwidth);
		$shortcodeData .= addShortcodeParam('fullsize', $fullsize);
		$shortcodeData .= addShortcodeParam('zoom', $zoom);
		$shortcodeData .= addShortcodeParam('interval', $interval);
		$shortcodeData .= addShortcodeParam('mobile', $mobile);
		$shortcodeData .= addShortcodeParam('height', $height);
		$shortcodeData .= 'ids="' . $ids . '"]';

		$out .= $shortcodeData;

		return $out;
	}

    register_block_type('supernova/supernova-slider', [
        'render_callback' => 'supernova_slider_render',
        'attributes' => [
            'ids' => [
                'type' => 'string',
                'default' => '1, 2, 3',
            ],
            'mobile' => [
                'type' => 'string',
                'default' => '',
            ],
			'controls'=> [
				'type' => 'boolean',
				'default' => false,
			],
			'fullheight'=> [
				'type' => 'boolean',
				'default' => false,
			],
			'fullwidth'=> [
				'type' => 'boolean',
				'default' => true,
			],
			'fullsize'=> [
				'type' => 'boolean',
				'default' => false,
			],
			'zoom'=> [
				'type' => 'boolean',
				'default' => false,
			],
            'interval' => [
                'type' => 'number',
                'default' => 5000,
            ],
            'height' => [
                'type' => 'number',
                'default' => 600,
            ],
        ],
    ]);
}
