(function(editor, components, i18n, element) {
    var el = element.createElement;
    var registerBlockType = wp.blocks.registerBlockType;

    var InspectorControls = wp.editor.InspectorControls;
    var TextControl = wp.components.TextControl;
    var TextareaControl = wp.components.TextareaControl;
    var RangeControl = wp.components.RangeControl;
    var ServerSideRender = wp.components.ServerSideRender;
    var RadioControl = wp.components.RadioControl;
    var MenuItemsChoice  = wp.components.MenuItemsChoice;
    var ToggleControl = wp.components.ToggleControl;

    registerBlockType('supernova/supernova-slider', {
        title: 'Supernova Slider',
        description: 'A full-featured slider block.',
        icon: 'slides',
        category: 'supernova',
        attributes: {
            ids: {
                type: 'string',
                default: '1, 2, 3',
            },
            mobile: {
                type: 'string',
                default: '',
            },
            controls: {
                type: 'boolean',
                default: false,
            },
            fullheight: {
                type: 'boolean',
                default: false,
            },
            fullwidth: {
                type: 'boolean',
                default: true,
            },
            fullsize: {
                type: 'boolean',
                default: false,
            },
            zoom: {
                type: 'boolean',
                default: false,
            },
            interval: {
				type: 'number',
				default: 5000,
			},
            height: {
				type: 'number',
				default: 600,
			},
        },

        edit: function (props) {
            var attributes = props.attributes;

            var ids = attributes.ids;
            var mobile = attributes.mobile;
            var controls = attributes.controls;
            var fullheight = attributes.fullheight;
            var fullwidth = attributes.fullwidth;
            var fullsize = attributes.fullsize;
            var zoom = attributes.zoom;
			var interval = attributes.interval;
			var height = attributes.height;

            return [
                el(InspectorControls, { key: 'inspector' },
                    el(
                        components.PanelBody, {
                            title: 'Slider Settings',
                            className: 'supernova_block',
                            initialOpen: true,
                        },

                        el(ToggleControl, {
                            type: 'boolean',
                            label: 'Slider Controls',
                            help: 'Whether to show the slider controls.',
                            checked: !!controls,
                            onChange: function (new_controls) {
                                props.setAttributes({ controls: new_controls });
                            },
                        }),
                        el(ToggleControl, {
                            type: 'boolean',
                            label: 'Full Height',
                            help: 'Whether to show a fullheight (100vh) slider.',
                            checked: !!fullheight,
                            onChange: function (new_fullheight) {
                                props.setAttributes({ fullheight: new_fullheight });
                            },
                        }),
                        el(ToggleControl, {
                            type: 'boolean',
                            label: 'Full Width',
                            help: 'Whether to show a fullwidth (100vw) slider.',
                            checked: !!fullwidth,
                            onChange: function (new_fullwidth) {
                                props.setAttributes({ fullwidth: new_fullwidth });
                            },
                        }),
                        el(ToggleControl, {
                            type: 'boolean',
                            label: 'Full Size Hero Image',
                            help: 'Whether to show the full (original) featured image.',
                            checked: !!fullsize,
                            onChange: function (new_fullsize) {
                                props.setAttributes({ fullsize: new_fullsize });
                            },
                        }),
                        el(ToggleControl, {
                            type: 'boolean',
                            label: 'Zoom',
                            help: 'Whether to apply a Ken Burns zoom effect.',
                            checked: !!zoom,
                            onChange: function (new_zoom) {
                                props.setAttributes({ zoom: new_zoom });
                            },
                        }),
                        el(TextControl, {
                            type: 'string',
                            label: 'Slide ID(s)',
                            placeholder:  i18n.__('1, 2, 3'),
                            help: i18n.__('Whether to show a specific post ID (or more, comma-separated).'),
                            value: ids,
                            onChange: function (new_ids) {
                                props.setAttributes({ ids: new_ids });
                            },
                        }),
                    ),

                    el(
                        components.PanelBody, {
                            title: 'Advanced Slider Options',
                            className: 'supernova_block',
                            initialOpen: false,
                        },

                        el(TextControl, {
                            type: 'number',
                            min: 1000,
                            step: 1000,
                            label: 'Interval between slides, in milliseconds',
                            placeholder: '5000',
                            value: interval,
                            onChange: function (new_interval) {
                                props.setAttributes({ interval: new_interval });
                            },
                        }),
                        el(TextControl, {
                            type: 'number',
                            min: 200,
                            step: 20,
                            label: 'Slider height, in pixels (default is 600)',
                            placeholder: '600',
                            value: height,
                            onChange: function (new_height) {
                                props.setAttributes({ height: new_height });
                            },
                        }),
                        el(TextControl, {
                            type: 'string',
                            label: 'Mobile Slide ID(s)',
                            placeholder:  i18n.__('1, 2, 3'),
                            help: i18n.__('Whether to show a specific post ID (or more, comma-separated) on mobile devices.'),
                            value: mobile,
                            onChange: function (new_mobile) {
                                props.setAttributes({ mobile: new_mobile });
                            },
                        }),
                    ),
                ),
                el(ServerSideRender, {
                    block: 'supernova/supernova-slider',
                    attributes: props.attributes
                })
            ];
        },

        save: function () {
            return null;
        },
    });
})(
    window.wp.editor,
    window.wp.components,
    window.wp.i18n,
    window.wp.element,
);
