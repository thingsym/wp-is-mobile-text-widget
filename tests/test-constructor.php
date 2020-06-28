<?php

class Test_Wp_Is_Mobile_Text_Widget_Constructor extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->wp_is_mobile_text_widget = new WP_Is_Mobile_Text_Widget();
	}

	/**
	 * @test
	 * @group constructor
	 */
	public function constructor_case() {
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

}
