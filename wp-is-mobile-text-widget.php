<?php
/**
 * Plugin Name: WP Is Mobile Text Widget
 * Plugin URI:  https://github.com/thingsym/wp-is-mobile-text-widget
 * Description: This WordPress plugin adds text widget that switched display text using wp_is_mobile() function whether the device is mobile or not.
 * Version:     1.2.0
 * Author:      thingsym
 * Author URI:  https://www.thingslabo.com/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-is-mobile-text-widget
 * Domain Path: /languages
 *
 * @package WP_Is_Mobile_Text_Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( '__WP_IS_MOBILE_TEXT_WIDGET__', __FILE__ );

require_once plugin_dir_path( __FILE__ ) . 'inc/class-wp-is-mobile-text-widget.php';

if ( class_exists( 'WP_Is_Mobile_Text_Widget' ) ) {
	add_action( 'widgets_init', 'wp_is_mobile_text_widget_load_widgets' );
}

/**
 * Register WP_Is_Mobile_Text_Widget.
 *
 * @since 1.0.0
 */
function wp_is_mobile_text_widget_load_widgets() {
	register_widget( 'WP_Is_Mobile_Text_Widget' );
}
