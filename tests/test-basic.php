<?php

class Test_Wp_Is_Mobile_Text_Widget_Basic extends WP_UnitTestCase {

	public function setUp() {
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
		$this->assertSame( 10, has_action( 'plugins_loaded', array( $this->wp_is_mobile_text_widget, 'load_textdomain' ) ) );
		$this->assertSame( 10, has_filter( 'plugin_row_meta', array( $this->wp_is_mobile_text_widget, 'plugin_metadata_links' ) ) );

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
	}

	/**
	 * @test
	 * @group basic
	 */
	public function load_textdomain() {
		$result = $this->wp_is_mobile_text_widget->load_textdomain();
		$this->assertNull( $result );
	}

	/**
	 * @test
	 * @group basic
	 */
	public function plugin_metadata_links() {
		$links = $this->wp_is_mobile_text_widget->plugin_metadata_links( array(), plugin_basename( __WP_Is_Mobile_Text_Widget__ ) );
		$this->assertContains( '<a href="https://github.com/sponsors/thingsym">Become a sponsor</a>', $links );
	}

}
