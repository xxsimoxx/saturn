<?php
add_action('admin_menu', 'saturn_settings_menu');

function saturn_settings_menu() {
    add_menu_page('Saturn', 'Saturn', 'manage_options', 'saturn-settings', 'saturn_settings', 'dashicons-star-filled', 4);

    add_menu_page('Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22);
}

function saturn_settings() {
    ?>
    <div class="wrap">
        <h1>Saturn</h1>

        <?php
        $tab = (filter_has_var(INPUT_GET, 'tab')) ? filter_input(INPUT_GET, 'tab') : 'welcome';
        $section = 'admin.php?page=saturn-settings&amp;tab=';
        ?>
        <h2 class="nav-tab-wrapper">
            <a href="<?php echo $section; ?>welcome" class="nav-tab <?php echo $tab === 'welcome' ? 'nav-tab-active' : ''; ?>">Welcome</a>
            <a href="<?php echo $section; ?>design" class="nav-tab <?php echo $tab === 'design' ? 'nav-tab-active' : ''; ?>">Design</a>
            <a href="<?php echo $section; ?>css" class="nav-tab <?php echo $tab === 'css' ? 'nav-tab-active' : ''; ?>">Custom CSS</a>
            <a href="<?php echo $section; ?>html" class="nav-tab <?php echo $tab === 'html' ? 'nav-tab-active' : ''; ?>">Custom HTML/JS</a>
            <a href="<?php echo $section; ?>modules" class="nav-tab <?php echo $tab === 'modules' ? 'nav-tab-active' : ''; ?>">Modules</a>
            <a href="<?php echo $section; ?>tools" class="nav-tab <?php echo $tab === 'tools' ? 'nav-tab-active' : ''; ?>">Integrations</a>
            <a href="<?php echo $section; ?>gdpr" class="nav-tab <?php echo $tab === 'gdpr' ? 'nav-tab-active' : ''; ?>">GDPR</a>
        </h2>

        <?php if ($tab === 'welcome') { ?>
            <h2 class="saturn-welcome">Welcome to Saturn</h2>

            <p style="font-size: 18px;">Thank you for choosing Saturn theme for WordPress! You are now to build your block-powered website!</p>
            <p style="font-size: 18px;">Saturn is our flagship theme, enhanced for <b>speed</b>, <b>security</b>, <b>performance</b>, improved <b>search engine experience</b> and <b>high conversion ratio</b>.</p>
            <p style="font-size: 18px;">The underlying Saturn code is lightning fast, secure and SEO-friendly with full block editor support and 100% compatibility with Yoast SEO, Jetpack, SendGrid, Cloudflare and more.</p>

            <p>Use this GitHub.com Access Token for your Git Updater plugin:</p>
            <p><code>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</code></p>

            <p><small>Saturn v<?php echo wp_get_theme()->get('Version'); ?></small></p>
        <?php } else if ($tab === 'tools') {
            if (isset($_POST['supernova_save'])) {
                update_option('tracking_ga', sanitize_text_field($_POST['tracking_ga']));
                update_option('tracking_gtm', sanitize_text_field($_POST['tracking_gtm']));
                update_option('google_fonts_api', sanitize_text_field($_POST['google_fonts_api']));

                delete_option('wppd_google_places_api');
                delete_option('wppd_google_place_id');

                echo '<div class="updated notice is-dismissible"><p>Settings updated successfully!</p></div>';
            }
            ?>
            <h3>Saturn Tools &amp; Integrations</h3>

            <form method="post" action="">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label>Google Analytics</label></th>
                            <td>
                                <p>
                                    <input type="text" id="tracking_ga" name="tracking_ga" class="regular-text" value="<?php echo get_option('tracking_ga'); ?>">
                                    <br><small>Use your Google Analytics <code>UA-XXXXXX-YY</code> code here.</small>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Google Tag Manager</label></th>
                            <td>
                                <p>
                                    <input type="text" id="tracking_gtm" name="tracking_gtm" class="regular-text" value="<?php echo get_option('tracking_gtm'); ?>">
                                    <br><small>Use your Google Tag Manager <code>GTM-XXXXXXX</code> code here.</small>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Google Fonts API</label></th>
                            <td>
                                <p>
                                    <input type="text" id="google_fonts_api" name="google_fonts_api" class="regular-text" value="<?php echo get_option('google_fonts_api'); ?>">
                                    <br><small>Use your Google Fonts API key here. <a href="https://developers.google.com/fonts/docs/developer_api">Get a key</a>.</small>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>

                <p><input type="submit" name="supernova_save" value="Save Changes" class="button-primary"></p>
            </form>
        <?php } else if ($tab === 'design') {
            if (isset($_POST['supernova_save'])) {
                update_option('content_width', (int) $_POST['content_width']);

                update_option('reusable_block_footer_id', (int) $_POST['reusable_block_footer_id']);
                update_option('reusable_block_post_sidebar_id', (int) $_POST['reusable_block_post_sidebar_id']);
                update_option('reusable_block_mobile_id', (int) $_POST['reusable_block_mobile_id']);

                // Navigation bar
                update_option('boxed_nav', (int) $_POST['boxed_nav']);
                update_option('rounded_nav', (int) $_POST['rounded_nav']);
                update_option('padded_nav', (int) $_POST['padded_nav']);
                update_option('transparent_nav', (int) $_POST['transparent_nav']);
                update_option('noshadow_nav', (int) $_POST['noshadow_nav']);

                update_option('header_type', (int) $_POST['header_type']);
                update_option('navicon_type', (int) $_POST['navicon_type']);

                // Colours
                update_option('primary_colour', sanitize_text_field($_POST['primary_colour']));
                update_option('body_background_colour', sanitize_text_field($_POST['body_background_colour']));
                update_option('body_text_colour', sanitize_text_field($_POST['body_text_colour']));
                update_option('header_background_colour', sanitize_text_field($_POST['header_background_colour']));
                update_option('header_menu_text_colour', sanitize_text_field($_POST['header_menu_text_colour']));
                update_option('header_menu_hover_colour', sanitize_text_field($_POST['header_menu_hover_colour']));
                update_option('footer_background_colour', sanitize_text_field($_POST['footer_background_colour']));
                //

                update_option('supernova_external_css', $_POST['supernova_external_css']);

                update_option('use_native_fonts', (int) $_POST['use_native_fonts']);
                update_option('use_icofont', (int) $_POST['use_icofont']);
                delete_option('use_cascadia_code_fonts');

                update_option('heading_font', (string) $_POST['heading_font']);
                update_option('body_font', (string) $_POST['body_font']);

                // Flickity options
                update_option('flickity_wrapAround', (int) $_POST['flickity_wrapAround']);
                update_option('flickity_groupCells', (int) $_POST['flickity_groupCells']);
                update_option('flickity_groupCellsValue', (int) $_POST['flickity_groupCellsValue']);
                update_option('flickity_autoPlay', (int) $_POST['flickity_autoPlay']);
                //

                echo '<div class="updated notice is-dismissible"><p>Settings updated successfully!</p></div>';
            }
            ?>
            <form method="post" action="">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row" colspan="2"><h2>Structure Settings</h2></th>
                        </tr>
                        <tr>
                            <th scope="row"><label>Content Width</label></th>
                            <td>
                                <p>
                                    <select name="content_width">
                                        <option value="0">Select a content width...</option>
                                        <option value="960" <?php if ((int) get_option('content_width') === 960) echo 'selected'; ?>>Narrow (960px)</option>
                                        <option value="1024" <?php if ((int) get_option('content_width') === 1024) echo 'selected'; ?>>Classic (1024px)</option>
                                        <option value="1170" <?php if ((int) get_option('content_width') === 1170) echo 'selected'; ?>>Bootstrapped (1170px, recommended)</option>
                                        <option value="1280" <?php if ((int) get_option('content_width') === 1280) echo 'selected'; ?>>Large (1280px)</option>
                                    </select>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="reusable_block_footer_id">Footer Reusable Block</label></th>
                            <td>
                                <?php
                                $reusableBlockFooterId = get_option('reusable_block_footer_id');

                                $args = [
                                    'post_type' => 'wp_block',
                                    'posts_per_page' => -1,
                                    'order' => 'ASC',
                                    'orderby' => 'title'
                                ];
                                $wpBlockQuery = new WP_Query($args);

                                $out = '<select name="reusable_block_footer_id" id="reusable_block_footer_id">';
                                    $out .= '<option value="">Select a reusable block...</option>';

                                    if ($wpBlockQuery->have_posts()) {
                                        while ($wpBlockQuery->have_posts()) {
                                            $wpBlockQuery->the_post();

                                            $selected = ((int) $reusableBlockFooterId === (int) get_the_ID()) ? 'selected' : '';
                                            $out .= '<option value="' . get_the_ID() . '" ' . $selected . '>' . get_the_title() . '</option>';
                                        }
                                    }
                                $out .= '</select>
                                <br><small><a href="' . admin_url('edit.php?post_type=wp_block') . '">Select your footer reusable block or create one now</a>.</small>';

                                echo $out;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="reusable_block_post_sidebar_id">Post Sidebar Reusable Block</label></th>
                            <td>
                                <?php
                                $reusableBlockPostSidebarId = get_option('reusable_block_post_sidebar_id');

                                $args = [
                                    'post_type' => 'wp_block',
                                    'posts_per_page' => -1,
                                    'order' => 'ASC',
                                    'orderby' => 'title'
                                ];
                                $wpBlockQuery = new WP_Query($args);

                                $out = '<select name="reusable_block_post_sidebar_id" id="reusable_block_post_sidebar_id">';
                                    $out .= '<option value="">Select a reusable block...</option>';

                                    if ($wpBlockQuery->have_posts()) {
                                        while ($wpBlockQuery->have_posts()) {
                                            $wpBlockQuery->the_post();

                                            $selected = ((int) $reusableBlockPostSidebarId === (int) get_the_ID()) ? 'selected' : '';
                                            $out .= '<option value="' . get_the_ID() . '" ' . $selected . '>' . get_the_title() . '</option>';
                                        }
                                    }
                                $out .= '</select>
                                <br><small><a href="' . admin_url('edit.php?post_type=wp_block') . '">Select your post sidebar reusable block or create one now</a>. Use this sidebar for blog posts.</small>';

                                echo $out;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="reusable_block_mobile_id">Mobile Menu Reusable Block<br><small>Below menu</small></label></th>
                            <td>
                                <?php
                                $reusableBlockMobileId = get_option('reusable_block_mobile_id');

                                $args = [
                                    'post_type' => 'wp_block',
                                    'posts_per_page' => -1,
                                    'order' => 'ASC',
                                    'orderby' => 'title'
                                ];
                                $wpBlockQuery = new WP_Query($args);

                                $out = '<select name="reusable_block_mobile_id" id="reusable_block_mobile_id">';
                                    $out .= '<option value="">Select a reusable block...</option>';

                                    if ($wpBlockQuery->have_posts()) {
                                        while ($wpBlockQuery->have_posts()) {
                                            $wpBlockQuery->the_post();

                                            $selected = ((int) $reusableBlockMobileId === (int) get_the_ID()) ? 'selected' : '';
                                            $out .= '<option value="' . get_the_ID() . '" ' . $selected . '>' . get_the_title() . '</option>';
                                        }
                                    }
                                $out .= '</select>
                                <br><small><a href="' . admin_url('edit.php?post_type=wp_block') . '">Select your mobile reusable block or create one now</a>. Use this block to show additional details under the mobile menu (e.g. social icons, location or even a map).</small>';

                                echo $out;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2"><h2>Navigation Settings</h2></th>
                        </tr>
                        <tr>
                            <th scope="row"><label>Header/Navigation Type</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" id="boxed_nav" name="boxed_nav" value="1" <?php echo ((int) get_option('boxed_nav') === 1) ? 'checked' : ''; ?>>
                                    <label for="boxed_nav">Boxed</label>
                                    <input type="checkbox" id="rounded_nav" name="rounded_nav" value="1" <?php echo ((int) get_option('rounded_nav') === 1) ? 'checked' : ''; ?>>
                                    <label for="rounded_nav">Rounded</label>
                                    <input type="checkbox" id="padded_nav" name="padded_nav" value="1" <?php echo ((int) get_option('padded_nav') === 1) ? 'checked' : ''; ?>>
                                    <label for="padded_nav">Padded</label>
                                    <input type="checkbox" id="transparent_nav" name="transparent_nav" value="1" <?php echo ((int) get_option('transparent_nav') === 1) ? 'checked' : ''; ?>>
                                    <label for="transparent_nav">Transparent</label>
                                    <input type="checkbox" id="noshadow_nav" name="noshadow_nav" value="1" <?php echo ((int) get_option('noshadow_nav') === 1) ? 'checked' : ''; ?>>
                                    <label for="noshadow_nav">No Shadow</label>
                                </p>
                                <p>
                                    <select name="header_type" id="header-type">
                                        <option value="0">Select a navigation bar type...</option>
                                        <option value="1" <?php if ((int) get_option('header_type') === 1) echo 'selected'; ?>>Top navigation bar</option>
                                        <option value="2" <?php if ((int) get_option('header_type') === 2) echo 'selected'; ?>>Sticky (overlaid, modern) navigation bar</option>
                                    </select>
                                    <label> with </label>
                                    <select name="navicon_type" id="navicon_type">
                                        <option value="0">Select a navigation icon colour...</option>
                                        <option value="1" <?php if ((int) get_option('navicon_type') === 1) echo 'selected'; ?>>Black mobile navicon</option>
                                        <option value="2" <?php if ((int) get_option('navicon_type') === 2) echo 'selected'; ?>>White mobile navicon</option>
                                    </select>
                                    <br><small>Note that the transparent, forced white navigation bar only applies to landing pages.</small>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2"><h2>Colour Settings</h2></th>
                        </tr>
                        <tr>
                            <th scope="row"><label>Primary Colour</label></th>
                            <td>
                                <input class="color-well" name="primary_colour" type="text" value="<?php echo get_option('primary_colour'); ?>">
                                <small>This is the main colour, used for accents, overlays and tints.</small>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Body Colours</label></th>
                            <td>
                                <p>
                                    <input class="color-well" name="body_background_colour" type="text" value="<?php echo get_option('body_background_colour'); ?>">
                                    <small>Body background colour</small>
                                </p>
                                <p>
                                    <input class="color-well" name="body_text_colour" type="text" value="<?php echo get_option('body_text_colour'); ?>">
                                    <small>Body text colour</small>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Header Colours</label></th>
                            <td>
                                <p>
                                    <input class="color-well" name="header_background_colour" type="text" value="<?php echo get_option('header_background_colour'); ?>">
                                    <small>Header background colour</small>
                                </p>
                                <p>
                                    <input class="color-well" name="header_menu_text_colour" type="text" value="<?php echo get_option('header_menu_text_colour'); ?>">
                                    <small>Header menu text colour</small>
                                </p>
                                <p>
                                    <input class="color-well" name="header_menu_hover_colour" type="text" value="<?php echo get_option('header_menu_hover_colour'); ?>">
                                    <small>Header menu hover colour</small>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Footer Colours</label></th>
                            <td>
                                <p>
                                    <input class="color-well" name="footer_background_colour" type="text" value="<?php echo get_option('footer_background_colour'); ?>">
                                    <small>Footer background colour</small>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2"><h2>Typography Settings</h2></th>
                        </tr>
                        <tr>
                            <th scope="row"><label>External Stylesheets</label></th>
                            <td>
                                <p>Any URL's added here will be added as <code>&lt;link&gt;s</code> in order, and before the CSS in the editor.</p>

                                <label class="thin-ui-popover">
                                    <button name="popover" class="button button-secondary">&#129300; See Examples</button>
                                    <div class="thin-ui-popover-body">
                                        <h3>Example resource URL:</h3>
                                        <p>
                                            1. <code>https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&amp;display=swap</code><br>
                                            2. <code>https://cdn.example.com/fonts/brandon-grotesque.css</code>
                                        </p>
                                    </div>
                                </label>

                                <div id="repeater-fields">
                                    <?php
                                    $supernovaExternalResources = get_option('supernova_external_css');

                                    if (count(array_filter((array) get_option('supernova_external_css'))) > 0) {
                                        $supernovaExternalResources = array_filter($supernovaExternalResources);

                                        foreach ($supernovaExternalResources as $resource) { ?>
                                            <p>
                                                <input type="url" class="large-text" placeholder="https://" name="supernova_external_css[]" value="<?php echo $resource; ?>">
                                            </p>
                                        <?php }
                                    }
                                    ?>
                                </div>

                                <p>
                                    <a href="#" class="button button-secondary" id="repeater-add">Add another resource</a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Icon Fonts</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" id="use_icofont" name="use_icofont" value="1" <?php echo ((int) get_option('use_icofont') === 1) ? 'checked' : ''; ?>> <label for="use_icofont">Use Icofont</label>
                                    <br><small><a href="https://icofont.com/">https://icofont.com/</a></small>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Fonts</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" id="use_native_fonts" name="use_native_fonts" value="1" <?php echo ((int) get_option('use_native_fonts') === 1) ? 'checked' : ''; ?>> <label for="use_native_fonts">Use native OS fonts</label>
                                </p>
                                <hr>
                                <p>
                                    <small>Note that the following weights will be automatically loaded: 300, 400, 500 and 700. Also note that if no heading font is selected, all fonts will be inherited from body.</small>
                                </p>

                                <?php if ((string) get_option('google_fonts_api') !== '') { ?>
                                <script>
                                fetch('https://www.googleapis.com/webfonts/v1/webfonts?key=<?php echo (string) get_option('google_fonts_api'); ?>')
                                    .then(response => {
                                        return response.json();
                                    })
                                    .then(data => {
                                        const fontArray = Object.keys(data).map((key) => [key, data[key]]);

                                        fontArray[1][1].forEach(function (fontFamily) {
                                            var headingFontSelector = document.getElementById('heading-font'),
                                                bodyFontSelector = document.getElementById('body-font'),
                                                fontOption1 = document.createElement('option'),
                                                fontOption2 = document.createElement('option'),
                                                currentHeadingFontOption = '<?php echo (string) get_option('heading_font'); ?>',
                                                currentBodyFontOption = '<?php echo (string) get_option('body_font'); ?>';

                                            fontOption1.value = fontFamily.family;
                                            fontOption1.text = fontFamily.family + ' (' + fontFamily.category + ')';
                                            fontOption2.value = fontFamily.family;
                                            fontOption2.text = fontFamily.family + ' (' + fontFamily.category + ')';

                                            headingFontSelector.add(fontOption1);
                                            bodyFontSelector.add(fontOption2);

                                            if (currentHeadingFontOption === fontFamily.family) {
                                                headingFontSelector.value = fontFamily.family;
                                                headingFontSelector.text = fontFamily.family + ' (' + fontFamily.category + ')';
                                            }

                                            if (currentBodyFontOption === fontFamily.family) {
                                                bodyFontSelector.value = fontFamily.family;
                                                bodyFontSelector.text = fontFamily.family + ' (' + fontFamily.category + ')';
                                            }
                                        });
                                    })
                                    .catch(err => {
                                        // error
                                    });
                                </script>
                                <?php } else { ?>
                                    <p>You need a Google Fonts API key to view Google Fonts. <a href="<?php echo admin_url('admin.php?page=saturn-settings&tab=tools'); ?>">Add one here</a>.</p>
                                <?php } ?>

                                <p>
                                    <select name="heading_font" id="heading-font">
                                        <option value="0">Select a heading font...</option>
                                    </select> Heading (titles, headings, sections) font
                                </p>
                                <p>
                                    <select name="body_font" id="body-font">
                                        <option value="0">Select a body font...</option>
                                    </select> Body (content, copy) font
                                </p>
                            </td>
                        </tr>


                        <tr>
                            <th scope="row"><label>Slider Settings</label></th>
                            <td>
                                <p>
                                    <b>Flickity Options</b>
                                </p>
                                <p>
                                    <input type="checkbox" id="flickity_wrapAround" name="flickity_wrapAround" value="1" <?php echo ((int) get_option('flickity_wrapAround') === 1) ? 'checked' : ''; ?>>
                                    <label for="flickity_wrapAround"><code class="codor"><a href="https://flickity.metafizzy.co/options.html#wraparound">wrapAround</a></code> (bool)</label>
                                    <br>
                                    <input type="checkbox" id="flickity_groupCells" name="flickity_groupCells" value="1" <?php echo ((int) get_option('flickity_groupCells') === 1) ? 'checked' : ''; ?>>
                                    <label for="flickity_groupCells"><code class="codor"><a href="https://flickity.metafizzy.co/options.html#groupcells">groupCells</a></code> (bool)</label>
                                    <br>
                                    <input type="number" id="flickity_groupCellsValue" name="flickity_groupCellsValue" placeholder="1" value="<?php echo (int) get_option('flickity_groupCellsValue'); ?>">
                                    <label for="flickity_groupCellsValue"><code class="codor"><a href="https://flickity.metafizzy.co/options.html#groupcells">groupCells</a></code> (int)</label>
                                    <br>
                                    <input type="number" id="flickity_autoPlay" name="flickity_autoPlay" placeholder="3000" value="<?php echo (int) get_option('flickity_autoPlay'); ?>">
                                    <label for="flickity_autoPlay">
                                        <code class="codor"><a href="https://flickity.metafizzy.co/options.html#autoplay">autoPlay</a></code> (int, milliseconds)
                                        <br><small>Uses <code class="codor">pauseAutoPlayOnHover: true</code></small>
                                    </label>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>

                <p><input type="submit" name="supernova_save" value="Save Changes" class="button-primary"></p>
            </form>
        <?php } else if ($tab === 'css') {
            if (isset($_POST['supernova_save'])) {
                update_option('supernova_custom_css', $_POST['supernova_custom_css']);

                echo '<div class="updated notice is-dismissible"><p>Settings updated successfully!</p></div>';
            }
            ?>
            <h3><?php esc_html_e('Custom CSS', 'saturn'); ?></h3>
            <p>Add your own CSS code here to customise the appearance and layout of your site or use the <a href="<?php echo admin_url('customize.php'); ?>">WordPress Customizer</a> to add custom CSS rules.</p>

            <form method="post" action="">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label>Custom CSS Rules</label></th>
                            <td>
                                <p>
                                    <textarea name="supernova_custom_css" id="supernova_custom_css" class="large-text code saturn-code" rows="32"><?php echo stripslashes(get_option('supernova_custom_css')); ?></textarea>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <p><input type="submit" name="supernova_save" value="Save Changes" class="button-primary"></p>
            </form>
        <?php } else if ($tab === 'html') {
            if (isset($_POST['supernova_save'])) {
                update_option('supernova_custom_html', htmlentities(stripslashes($_POST['supernova_custom_html'])));
                update_option('supernova_custom_html_footer', htmlentities(stripslashes($_POST['supernova_custom_html_footer'])));

                echo '<div class="updated notice is-dismissible"><p>Settings updated successfully!</p></div>';
            }
            ?>
            <h3><?php esc_html_e('Custom HTML/JS', 'saturn'); ?></h3>
            <p>Add your own HTML or JavaSscript code snippets or tracking snippets here to customize the appearance and layout of your site.</p>

            <form method="post" action="">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label>Custom HTML/JS (<code>&lt;head&gt;</code>)</label></th>
                            <td>
                                <p>
                                    <textarea name="supernova_custom_html" id="supernova_custom_html" class="large-text code saturn-code" rows="24"><?php echo html_entity_decode(get_option('supernova_custom_html')); ?></textarea>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Custom HTML/JS (footer)</label></th>
                            <td>
                                <p>
                                    <textarea name="supernova_custom_html_footer" id="supernova_custom_html_footer" class="large-text code saturn-code" rows="24"><?php echo html_entity_decode(get_option('supernova_custom_html_footer')); ?></textarea>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <p><input type="submit" name="supernova_save" value="Save Changes" class="button-primary"></p>
            </form>
        <?php } else if ($tab === 'modules') {
            if (isset($_POST['supernova_save'])) {
                delete_option('use_side_drawer');
                delete_option('side_drawer_handle_title');
                delete_option('supernova_drawer_block_id');

                delete_option('supernova_snackbar');
                delete_option('supernova_snackbar_block_id');
                delete_option('supernova_snackbar_scroll_value');

                update_option('use_side_panel', (int) $_POST['use_side_panel']);
                update_option('supernova_side_panel_modal', (int) $_POST['supernova_side_panel_modal']);
                update_option('supernova_side_panel_block_id', (int) $_POST['supernova_side_panel_block_id']);

                update_option('use_leaflet', (int) $_POST['use_leaflet']);
                update_option('use_flickity', (int) $_POST['use_flickity']);
                update_option('use_cursor', (int) $_POST['use_cursor']);
                update_option('use_butter', (int) $_POST['use_butter']);
                update_option('use_dark_mode', (int) $_POST['use_dark_mode']);

                update_option('use_organic_underline', (int) $_POST['use_organic_underline']);
                update_option('use_back_to_top', (int) $_POST['use_back_to_top']);

                // JavaScript Libraries
                update_option('use_splitting_js', (int) $_POST['use_splitting_js']);
                update_option('use_magnetmouse_js', (int) $_POST['use_magnetmouse_js']);

                echo '<div class="updated notice is-dismissible"><p>Settings updated successfully!</p></div>';
            }
            ?>
            <h3>Modules</h3>
            <p>Select all the modules you need for your current theme setup.</p>

            <form method="post" action="">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label>Side Panel</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" id="use_side_panel" name="use_side_panel" value="1" <?php echo ((int) get_option('use_side_panel') === 1) ? 'checked' : ''; ?>>
                                    <label for="use_side_panel">Enable side panel</label>
                                    <br>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 377 377" class="saturn-icon saturn-icon-padded saturn-icon-12"><path d="m275 216-22 21 45 45H52V0H22v312h276l-44 44 21 21 80-80z"/></svg> <input type="checkbox" id="supernova_side_panel_modal" name="supernova_side_panel_modal" value="1" <?php echo ((int) get_option('supernova_side_panel_modal') === 1) ? 'checked' : ''; ?>>
                                    <label for="supernova_side_panel_modal">Enable modal popup mode</label>
                                    <br><small>A configurable right side off-canvas panel.</small>
                                    <br><small>Use the <code>toggle-nav</code> class to create a panel trigger.</small>
                                </p>
                                <p>
                                    <?php
                                    $supernovaSidePanelBlockID = get_option('supernova_side_panel_block_id');

                                    $args = [
                                        'post_type' => 'wp_block',
                                        'posts_per_page' => -1,
                                        'order' => 'ASC',
                                        'orderby' => 'title'
                                    ];
                                    $wpBlockQuery = new WP_Query($args);

                                    echo '<select name="supernova_side_panel_block_id" id="supernova_side_panel_block_id">
                                        <option value="">Select a reusable block...</option>';

                                        if ($wpBlockQuery->have_posts()) {
                                            while ($wpBlockQuery->have_posts()) {
                                                $wpBlockQuery->the_post();

                                                $selected = ((int) $supernovaSidePanelBlockID === (int) get_the_ID()) ? 'selected' : '';
                                                echo '<option value="' . get_the_ID() . '" ' . $selected . '>' . get_the_title() . '</option>';
                                            }
                                        }
                                    echo '</select>
                                    <br><small><a href="' . admin_url('edit.php?post_type=wp_block') . '">Select your side panel reusable block or create one now</a>.</small>';
                                    ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>LeafletJS</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" id="use_leaflet" name="use_leaflet" value="1" <?php echo ((int) get_option('use_leaflet') === 1) ? 'checked' : ''; ?>>
                                    <label for="use_leaflet">Use LeafletJS</label>
                                    <br><small>Use LeafletJS library for OpenStreetMap maps.</small>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Flickity Slider/Carousel</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" id="use_flickity" name="use_flickity" value="1" <?php echo ((int) get_option('use_flickity') === 1) ? 'checked' : ''; ?>>
                                    <label for="use_flickity">Use Flickity Slider/Carousel</label>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Dynamic Cursor</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" id="use_cursor" name="use_cursor" value="1" <?php echo ((int) get_option('use_cursor') === 1) ? 'checked' : ''; ?>>
                                    <label for="use_cursor">Use Dynamic Cursor</label>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Smooth Scroll</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" id="use_butter" name="use_butter" value="1" <?php echo ((int) get_option('use_butter') === 1) ? 'checked' : ''; ?>>
                                    <label for="use_butter">Use Smooth Scroll</label>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Dark Mode</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" id="use_dark_mode" name="use_dark_mode" value="1" <?php echo ((int) get_option('use_dark_mode') === 1) ? 'checked' : ''; ?>>
                                    <label for="use_dark_mode">Use Dark Mode</label>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Design Modules</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" id="use_organic_underline" name="use_organic_underline" value="1" <?php echo ((int) get_option('use_organic_underline') === 1) ? 'checked' : ''; ?>>
                                    <label for="use_organic_underline">Use <em>Organic</em> underline for primary navigation items (requires Icofont)</label>
                                </p>
                                <p>
                                    <input type="checkbox" id="use_back_to_top" name="use_back_to_top" value="1" <?php echo ((int) get_option('use_back_to_top') === 1) ? 'checked' : ''; ?>>
                                    <label for="use_back_to_top">Use a bottom-right <em>back-to-top</em> arrow (requires Icofont)</label>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>JavaScript Libraries</label></th>
                            <td>
                                <p>
                                    <input class="wppd-ui-toggle" type="checkbox" id="use_splitting_js" name="use_splitting_js" value="1" <?php echo ((int) get_option('use_splitting_js') === 1) ? 'checked' : ''; ?>>
                                    <label for="use_splitting_js">Enable <code>splitting.js</code> (<a href="https://github.com/shshaw/splitting">https://github.com/shshaw/splitting</a>)</label>
                                </p>
                                <p>
                                    <input class="wppd-ui-toggle" type="checkbox" id="use_magnetmouse_js" name="use_magnetmouse_js" value="1" <?php echo ((int) get_option('use_magnetmouse_js') === 1) ? 'checked' : ''; ?>>
                                    <label for="use_magnetmouse_js">Enable <code>Magnet Mouse</code></label>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <p><input type="submit" name="supernova_save" value="Save Changes" class="button-primary"></p>
            </form>
        <?php } else if ($tab === 'gdpr') {
            if (isset($_POST['supernova_save'])) {
                update_option('gdpr_privacy_policy_page', (int) $_POST['gdpr_privacy_policy_page']);

                echo '<div class="updated notice is-dismissible"><p>Settings updated successfully!</p></div>';
            }
            ?>
            <h3>GDPR/Privacy Policy Settings</h3>

            <form method="post" action="">
                <p>Let the user know about your <b>GDPR/Privacy Policy</b> with a floating bottom right element.</p>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label>GDPR/Privacy Policy</label></th>
                            <td>
                                <p>
                                    <?php
                                    if (!get_option('gdpr_privacy_policy_page')) {
                                        $privacy_policy_page_id = (int) get_option('wp_page_for_privacy_policy');
                                    } else {
                                        $privacy_policy_page_id = (int) get_option('gdpr_privacy_policy_page');
                                    }

                                    wp_dropdown_pages([
                                        'name' => 'gdpr_privacy_policy_page',
                                        'selected' => $privacy_policy_page_id
                                    ]);
                                    ?>
                                    <br><small>This is the GDPR/Privacy Policy page.</small>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <p><input type="submit" name="supernova_save" value="Save Changes" class="button-primary"></p>
            </form>
        <?php }
    echo '</div>';
}
