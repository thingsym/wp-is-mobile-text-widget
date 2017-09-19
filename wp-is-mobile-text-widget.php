<?php
/**
 * Plugin Name: WP Is Mobile Text Widget
 * Plugin URI: https://github.com/thingsym/wp-is-mobile-text-widget
 * Description: This WordPress plugin adds text widget that switched display text using wp_is_mobile() function whether the device is mobile or not.
 * Version: 1.0.3
 * Author: thingsym
 * Author URI: https://www.thingslabo.com/
 * License: GPLv2 or later
 * Text Domain: wp-is-mobile-text-widget
 * Domain Path: /languages
 *
 * @package WP_Is_Mobile_Text_Widget
 */

/**
 *     Copyright 2015 thingsym (http://www.thingslabo.com/)
 *
 *     This program is free software; you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation; either version 2 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *     GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with this program; if not, write to the Free Software
 *     Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110, USA
 */

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

/**
 * WP Is Mobile Text Widget class
 *
 * @since 1.0.0
 */
class WP_Is_Mobile_Text_Widget extends WP_Widget {
	/**
	 * Default instance.
	 *
	 * @since 1.0.3
	 *
	 * @access protected
	 *
	 * @var array $default_instance {
	 *     @type string title
	 *     @type string text
	 *     @type string is_mobile_text
	 *     @type string filter
	 * }
	 */
	protected $default_instance = array(
		'title'          => '',
		'text'           => '',
		'is_mobile_text' => '',
		'filter'         => false,
	);

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		load_plugin_textdomain( 'wp-is-mobile-text-widget', false, basename( dirname( __FILE__ ) ) . '/languages' );

		$widget_options = array(
			'classname'   => 'widget_is_mobile_text',
			'description' => __( 'Arbitrary text or HTML.', 'wp-is-mobile-text-widget' ),
			'customize_selective_refresh' => true,
		);
		$control_options = array(
			'width'  => 400,
			'height' => 350,
		);

		parent::__construct( 'wp_is_mobile_text', __( 'WP Is Mobile Text', 'wp-is-mobile-text-widget' ), $widget_options, $control_options );
	}

	/**
	 * Outputs the content for the current Text widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Text widget instance.
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {
		$instance = array_merge( $this->default_instance, $instance );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-text.php */
		$text = apply_filters( 'widget_text', $instance['text'], $instance, $this );
		$is_mobile_text = apply_filters( 'widget_text', $instance['is_mobile_text'], $instance, $this );

		/**
		 * Filters the content of the Text widget when wp_is_mobile is false.
		 *
		 * @since 1.0.3
		 *
		 * @param string                   $text     The widget content.
		 * @param array                    $instance Array of settings for the current widget.
		 * @param WP_Is_Mobile_Text_Widget $this     Current Text widget instance.
		 */
		$text = apply_filters( 'wp_is_mobile_text_widget_text', $text, $instance, $this );

		/**
		 * Filters the content of the Text widget when wp_is_mobile is true.
		 *
		 * @since 1.0.3
		 *
		 * @param string                   $text     The widget content.
		 * @param array                    $instance Array of settings for the current widget.
		 * @param WP_Is_Mobile_Text_Widget $this     Current Text widget instance.
		 */
		$is_mobile_text = apply_filters( 'wp_is_mobile_text_widget_is_mobile_true', $is_mobile_text, $instance, $this );

		if ( function_exists( 'wp_is_mobile' ) && wp_is_mobile() ) {
			if ( empty( $is_mobile_text ) ) {
				return;
			}
			$text = empty( $instance['filter'] ) ? $is_mobile_text : wpautop( $is_mobile_text );
		}
		else {
			if ( empty( $text ) ) {
				return;
			}
			$text = empty( $instance['filter'] ) ? $text : wpautop( $text );
		}

		// Inject the Text widget's container class name alongside this widget's class name for theme styling compatibility.
		$args['before_widget'] = preg_replace( '/(?<=\sclass=["\'])/', 'widget_text ', $args['before_widget'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		echo '<div class="textwidget wp-is-mobile-text-widget">';
		echo $text;
		echo '</div>';
		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Text widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @param array $new_instance  New settings for this instance as input by the user via  WP_Widget::form().
	 * @param array $old_instance  Old settings for this instance.
	 *
	 * @return array $instance      Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array_merge( $this->default_instance, $old_instance );

		$instance['title'] = empty( $new_instance['title'] ) ? '' : sanitize_text_field( $new_instance['title'] );

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = empty( $new_instance['text'] ) ? '' : $new_instance['text'];
			$instance['is_mobile_text'] = empty( $new_instance['is_mobile_text'] ) ? '' : $new_instance['is_mobile_text'];
		}
		else {
			$instance['text'] = empty( $new_instance['text'] ) ? '' : wp_kses_post( $new_instance['text'] );
			$instance['is_mobile_text'] = empty( $new_instance['is_mobile_text'] ) ? '' : wp_kses_post( $new_instance['is_mobile_text'] );
		}

		$instance['filter'] = empty( $new_instance['filter'] ) ? false : true;

		return $instance;
	}

	/**
	 * Outputs the Text widget settings form.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @param array $instance Current settings.
	 *
	 * @return void
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->default_instance );
?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wp-is-mobile-text-widget' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Text:', 'wp-is-mobile-text-widget' ); ?></label>
		<textarea class="widefat" rows="10" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>

		<?php if ( ! current_user_can( 'unfiltered_html' ) ) : ?>
			<?php
			$probably_unsafe_html = array( 'script', 'iframe', 'form', 'input', 'style' );
			$allowed_html = wp_kses_allowed_html( 'post' );
			$disallowed_html = array_diff( $probably_unsafe_html, array_keys( $allowed_html ) );
			?>
			<?php if ( ! empty( $disallowed_html ) ) : ?>
				<p>
					<?php esc_html_e( 'Some HTML tags are not permitted, including:', 'wp-is-mobile-text-widget' ); ?>
					<code><?php echo join( '</code>, <code>', $disallowed_html ); ?></code>
				</p>
			<?php endif; ?>
		<?php endif; ?>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'is_mobile_text' ) ); ?>"><?php esc_html_e( 'Text on mobile:', 'wp-is-mobile-text-widget' ); ?></label>
		<textarea class="widefat" rows="10" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'is_mobile_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'is_mobile_text' ) ); ?>"><?php echo esc_textarea( $instance['is_mobile_text'] ); ?></textarea></p>

		<?php if ( ! current_user_can( 'unfiltered_html' ) ) : ?>
			<?php
			$probably_unsafe_html = array( 'script', 'iframe', 'form', 'input', 'style' );
			$allowed_html = wp_kses_allowed_html( 'post' );
			$disallowed_html = array_diff( $probably_unsafe_html, array_keys( $allowed_html ) );
			?>
			<?php if ( ! empty( $disallowed_html ) ) : ?>
				<p>
					<?php esc_html_e( 'Some HTML tags are not permitted, including:', 'wp-is-mobile-text-widget' ); ?>
					<code><?php echo join( '</code>, <code>', $disallowed_html ); ?></code>
				</p>
			<?php endif; ?>
		<?php endif; ?>

		<p><input id="<?php echo esc_attr( $this->get_field_id( 'filter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'filter' ) ); ?>" type="checkbox"<?php checked( isset( $instance['filter'] ) ? $instance['filter'] : 0 ); ?> /> <label for="<?php echo esc_attr( $this->get_field_id( 'filter' ) ); ?>"><?php esc_html_e( 'Automatically add paragraphs', 'wp-is-mobile-text-widget' ); ?></label></p>

<?php
	}
}
