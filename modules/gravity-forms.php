<?php
/**
 * Move currency symbol from the right to the left for Gravity Forms to comply
 * with Euro (EUR) notation
 */
add_filter(
    'gform_currencies',
    function( $currencies ) {
        $currencies['EUR']['symbol_left']  = '€';
        $currencies['EUR']['symbol_right'] = '';

        $currencies['EUR']['thousand_separator'] = ',';
        $currencies['EUR']['decimal_separator']  = '.';

        return $currencies;
    }
);



/**
 * Remove Gravity Forms nag
 */
function saturn_gravity_forms_remove_nag() {
    if ( is_admin() ) {
        update_option( 'rg_gforms_message', '' );

        remove_action( 'after_plugin_row_gravityforms/gravityforms.php', [ 'GFForms', 'plugin_row' ] );
    }
}

add_action( 'admin_init', 'saturn_gravity_forms_remove_nag', 99 );



/**
 * Allow the display of a carbon copy field when creating a notification.
 *
 * @url https://docs.gravityforms.com/gform_notification_enable_cc/
 */
function saturn_gravity_forms_enable_cc( $enable, $notification, $form ) {
    return true;
}

add_filter( 'gform_notification_enable_cc', 'saturn_gravity_forms_enable_cc', 10, 3 );
