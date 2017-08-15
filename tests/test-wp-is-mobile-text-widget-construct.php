<?php

class Wp_Is_Mobile_Text_Widget_Construct_Test extends WP_UnitTestCase {

		public function setUp() {
				parent::setUp();
				$this->WP_Is_Mobile_Text_Widget = new WP_Is_Mobile_Text_Widget();
		}

		/**
		 * @test
		 * @group construct
		 */
		public function construct_case() {
				$this->assertEquals( 'wp_is_mobile_text', $this->WP_Is_Mobile_Text_Widget->id_base );
				$this->assertEquals( 'WP Is Mobile Text', $this->WP_Is_Mobile_Text_Widget->name );

				$this->assertArrayHasKey( 'classname', $this->WP_Is_Mobile_Text_Widget->widget_options );
				$this->assertContains( 'widget_is_mobile_text', $this->WP_Is_Mobile_Text_Widget->widget_options['classname'] );
				$this->assertArrayHasKey( 'description', $this->WP_Is_Mobile_Text_Widget->widget_options );
				$this->assertContains( 'Arbitrary text or HTML.', $this->WP_Is_Mobile_Text_Widget->widget_options['description'] );

				$this->assertArrayHasKey( 'id_base', $this->WP_Is_Mobile_Text_Widget->control_options );
				$this->assertEquals( 'wp_is_mobile_text', $this->WP_Is_Mobile_Text_Widget->control_options['id_base'] );

				$this->assertEquals( 'widget_wp_is_mobile_text', $this->WP_Is_Mobile_Text_Widget->option_name );
		}

}
