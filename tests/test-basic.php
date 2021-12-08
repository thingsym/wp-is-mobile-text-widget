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
		$this->assertEquals( $expected, $this->wp_is_mobile_text_widget->default_instance );
	}

	/**
	 * @test
	 * @group basic
	 */
	public function constructor_case() {
		$this->assertEquals( 10, has_action( 'init', array( $this->wp_is_mobile_text_widget, 'load_textdomain' ) ) );
		$this->assertEquals( 10, has_filter( 'plugin_row_meta', array( $this->wp_is_mobile_text_widget, 'plugin_metadata_links' ) ) );

		$this->assertEquals( 'wp_is_mobile_text', $this->wp_is_mobile_text_widget->id_base );
		$this->assertEquals( 'WP Is Mobile Text', $this->wp_is_mobile_text_widget->name );

		$this->assertArrayHasKey( 'classname', $this->wp_is_mobile_text_widget->widget_options );
		$this->assertEquals( 'widget_is_mobile_text', $this->wp_is_mobile_text_widget->widget_options['classname'] );
		$this->assertArrayHasKey( 'description', $this->wp_is_mobile_text_widget->widget_options );
		$this->assertContains( 'Arbitrary text or HTML.', $this->wp_is_mobile_text_widget->widget_options['description'] );

		$this->assertArrayHasKey( 'id_base', $this->wp_is_mobile_text_widget->control_options );
		$this->assertEquals( 'wp_is_mobile_text', $this->wp_is_mobile_text_widget->control_options['id_base'] );
		$this->assertEquals( '400', $this->wp_is_mobile_text_widget->control_options['width'] );
		$this->assertEquals( '350', $this->wp_is_mobile_text_widget->control_options['height'] );

		$this->assertEquals( 'widget_wp_is_mobile_text', $this->wp_is_mobile_text_widget->option_name );
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
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
