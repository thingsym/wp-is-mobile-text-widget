<?php

class Test_Wp_Is_Mobile_Text_Widget_Form extends WP_UnitTestCase {
	public $wp_is_mobile_text_widget;

	public function setUp(): void {
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

		ob_start();
		$this->wp_is_mobile_text_widget->form( $instance );
		$form = ob_get_clean();

		$this->assertRegExp( '#value="aaaaa"#', $form );
		$this->assertRegExp( '#<textarea.*?>bbbbb</textarea>#', $form );
		$this->assertRegExp( '#<textarea.*?>ccccc</textarea>#', $form );
		$this->assertRegExp( '#type="checkbox" />#', $form );
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

		ob_start();
		$this->wp_is_mobile_text_widget->form( $instance );
		$form = ob_get_clean();

		$this->assertRegExp( '#type="checkbox" checked=\'checked\' />#', $form );
	}

}
