<?php

class Wp_Is_Mobile_Text_Widget_Construct_Test extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->wp_is_mobile_text_widget = new WP_Is_Mobile_Text_Widget();
	}

	/**
	 * @test
	 * @group construct
	 */
	public function construct_case() {
		$this->assertEquals( 'wp_is_mobile_text', $this->wp_is_mobile_text_widget->id_base );
		$this->assertEquals( 'WP Is Mobile Text', $this->wp_is_mobile_text_widget->name );

		$this->assertArrayHasKey( 'classname', $this->wp_is_mobile_text_widget->widget_options );
		$this->assertContains( 'widget_is_mobile_text', $this->wp_is_mobile_text_widget->widget_options['classname'] );
		$this->assertArrayHasKey( 'description', $this->wp_is_mobile_text_widget->widget_options );
		$this->assertContains( 'Arbitrary text or HTML.', $this->wp_is_mobile_text_widget->widget_options['description'] );

		$this->assertArrayHasKey( 'id_base', $this->wp_is_mobile_text_widget->control_options );
		$this->assertEquals( 'wp_is_mobile_text', $this->wp_is_mobile_text_widget->control_options['id_base'] );

		$this->assertEquals( 'widget_wp_is_mobile_text', $this->wp_is_mobile_text_widget->option_name );
	}

}
