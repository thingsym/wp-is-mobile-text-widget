<?php

class Test_Wp_Is_Mobile_Text_Widget_Basic extends WP_UnitTestCase {
	public $wp_is_mobile_text_widget;

	public function setUp(): void {
		parent::setUp();
		$this->wp_is_mobile_text_widget = new WP_Is_Mobile_Text_Widget();
	}

	/**
	 * @test
	 * @group basic
	 */
	function public_variable() {

		$expected = array(
			'title'          => '',
			'text'           => '',
			'is_mobile_text' => '',
			'filter'         => false,
		);
		$this->assertSame( $expected, $this->wp_is_mobile_text_widget->default_instance );
	}

	/**
	 * @test
	 * @group basic
	 */
	public function constructor_case() {
		$this->assertSame( 'wp_is_mobile_text', $this->wp_is_mobile_text_widget->id_base );
		$this->assertSame( 'WP Is Mobile Text', $this->wp_is_mobile_text_widget->name );

		$this->assertArrayHasKey( 'classname', $this->wp_is_mobile_text_widget->widget_options );
		$this->assertSame( 'widget_is_mobile_text', $this->wp_is_mobile_text_widget->widget_options['classname'] );
		$this->assertArrayHasKey( 'description', $this->wp_is_mobile_text_widget->widget_options );
		$this->assertContains( 'Arbitrary text or HTML.', $this->wp_is_mobile_text_widget->widget_options['description'] );

		$this->assertArrayHasKey( 'id_base', $this->wp_is_mobile_text_widget->control_options );
		$this->assertSame( 'wp_is_mobile_text', $this->wp_is_mobile_text_widget->control_options['id_base'] );
		$this->assertSame( 400, $this->wp_is_mobile_text_widget->control_options['width'] );
		$this->assertSame( 350, $this->wp_is_mobile_text_widget->control_options['height'] );

		$this->assertSame( 'widget_wp_is_mobile_text', $this->wp_is_mobile_text_widget->option_name );

		$this->assertSame( 10, has_filter( 'plugin_row_meta', array( $this->wp_is_mobile_text_widget, 'plugin_metadata_links' ) ) );
	}

	/**
	 * @test
	 * @group basic
	 */
	public function load_textdomain() {
		$loaded = $this->wp_is_mobile_text_widget->load_textdomain();
		$this->assertFalse( $loaded );

		unload_textdomain( 'wp-is-mobile-text-widget' );

		add_filter( 'locale', [ $this, '_change_locale' ] );
		add_filter( 'load_textdomain_mofile', [ $this, '_change_textdomain_mofile' ], 10, 2 );

		$loaded = $this->wp_is_mobile_text_widget->load_textdomain();
		$this->assertTrue( $loaded );

		remove_filter( 'load_textdomain_mofile', [ $this, '_change_textdomain_mofile' ] );
		remove_filter( 'locale', [ $this, '_change_locale' ] );

		unload_textdomain( 'wp-is-mobile-text-widget' );
	}

	/**
	 * hook for load_textdomain
	 */
	function _change_locale( $locale ) {
		return 'ja';
	}

	function _change_textdomain_mofile( $mofile, $domain ) {
		if ( $domain === 'wp-is-mobile-text-widget' ) {
			$locale = determine_locale();
			$mofile = plugin_dir_path( __WP_IS_MOBILE_TEXT_WIDGET__ ) . 'languages/wp-is-mobile-text-widget-' . $locale . '.mo';

			$this->assertSame( $locale, get_locale() );
			$this->assertFileExists( $mofile );
		}

		return $mofile;
	}

	/**
	 * @test
	 * @group basic
	 */
	public function plugin_metadata_links() {
		$links = $this->wp_is_mobile_text_widget->plugin_metadata_links( array(), plugin_basename( __WP_IS_MOBILE_TEXT_WIDGET__ ) );
		$this->assertContains( '<a href="https://github.com/sponsors/thingsym">Become a sponsor</a>', $links );
	}

}
