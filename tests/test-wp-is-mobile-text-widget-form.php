<?php

class Wp_Is_Mobile_Text_Widget_Form_Test extends WP_UnitTestCase {

		public function setUp() {
				parent::setUp();
				$this->WP_Is_Mobile_Text_Widget = new WP_Is_Mobile_Text_Widget();
		}

		/**
		 * @test
		 * @group form
		 */
		public function form_case_1() {
				$instance = array(
						'title' => 'aaaaa',
						'text' => 'bbbbb',
						'is_mobile_text' => 'ccccc',
						'filter' => false,
				);

				ob_start();
				$this->WP_Is_Mobile_Text_Widget->form( $instance );
				$form = ob_get_clean();

				$this->assertContains( 'value="aaaaa"', $form );
				$this->assertRegExp( '/<textarea.*?>bbbbb<\/textarea>/', $form );
				$this->assertRegExp( '/<textarea.*?>ccccc<\/textarea>/', $form );
				$this->assertEquals( 0, preg_match( '/type="checkbox"	checked=\'checked\'/', $form ) );
		}

		/**
		 * @test
		 * @group form
		 */
		public function form_case_2() {
				$instance = array(
						'title' => 'aaaaa',
						'text' => 'bbbbb',
						'is_mobile_text' => 'ccccc',
						'filter' => true,
				);

				ob_start();
				$this->WP_Is_Mobile_Text_Widget->form( $instance );
				$form = ob_get_clean();

				$this->assertContains( 'type="checkbox"	checked=\'checked\'', $form );
		}

}
