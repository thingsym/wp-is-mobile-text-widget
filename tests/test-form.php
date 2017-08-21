<?php

class Wp_Is_Mobile_Text_Widget_Form_Test extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->wp_is_mobile_text_widget = new WP_Is_Mobile_Text_Widget();
	}

	/**
	 * @test
	 * @group form
	 */
	public function form_case_1() {
		$instance = array(
			'title'          => 'aaaaa',
			'text'           => 'bbbbb',
			'is_mobile_text' => 'ccccc',
			'filter'         => false,
		);

		$this->expectOutputRegex( '#value="aaaaa"#' );
		$this->expectOutputRegex( '#<textarea.*?>bbbbb</textarea>#' );
		$this->expectOutputRegex( '#<textarea.*?>ccccc</textarea>#' );
		$this->expectOutputRegex( '#type="checkbox" />#' );

		$this->wp_is_mobile_text_widget->form( $instance );
	}

	/**
	 * @test
	 * @group form
	 */
	public function form_case_2() {
		$instance = array(
			'title'          => 'aaaaa',
			'text'           => 'bbbbb',
			'is_mobile_text' => 'ccccc',
			'filter'         => true,
		);

		$this->expectOutputRegex( '#type="checkbox" checked=\'checked\' />#' );

		$this->wp_is_mobile_text_widget->form( $instance );
	}

}
