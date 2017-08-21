<?php

class Test_Wp_Is_Mobile_Text_Widget_Update extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->wp_is_mobile_text_widget = new WP_Is_Mobile_Text_Widget();
	}

	/**
	 * @test
	 * @group update
	 */
	public function update_case_none_input() {
		$new_instance = array(
			'title'          => '',
			'text'           => '',
			'is_mobile_text' => '',
			'filter'         => false,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertEquals( $validate['title'], '' );
		$this->assertEquals( $validate['text'], '' );
		$this->assertEquals( $validate['is_mobile_text'], '' );
		$this->assertFalse( $validate['filter'] );
	}

	/**
	 * @test
	 * @group update
	 */
	public function update_case_filter() {
		$new_instance = array(
			'title'          => '',
			'text'           => '',
			'is_mobile_text' => '',
			'filter'         => true,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertTrue( $validate['filter'] );

		$new_instance = array(
			'title'          => '',
			'text'           => '',
			'is_mobile_text' => '',
			'filter'         => false,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertFalse( $validate['filter'] );
	}

	/**
	 * @test
	 * @group update
	 */
	public function update_case_title() {
		$new_instance = array(
			'title'          => 'asdf',
			'text'           => '',
			'is_mobile_text' => '',
			'filter'         => false,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertEquals( $validate['title'], 'asdf' );

		$new_instance = array(
			'title'          => 'as<br>df',
			'text'           => '',
			'is_mobile_text' => '',
			'filter'         => false,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertEquals( $validate['title'], 'asdf' );
	}

	/**
	 * @test
	 * @group update
	 */
	public function update_case_text() {
		$new_instance = array(
			'title'          => '',
			'text'           => 'asdf',
			'is_mobile_text' => '',
			'filter'         => false,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertEquals( $validate['text'], 'asdf' );

		$new_instance = array(
			'title'          => '',
			'text'           => 'as<br>df',
			'is_mobile_text' => '',
			'filter'         => false,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertEquals( $validate['text'], 'as<br>df' );

		$new_instance = array(
			'title'          => '',
			'text'           => "as'df",
			'is_mobile_text' => '',
			'filter'         => false,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertEquals( $validate['text'], "as'df" );
	}

	/**
	 * @test
	 * @group update
	 */
	public function update_case_is_mobile_text() {
		$new_instance = array(
			'title'          => '',
			'text'           => '',
			'is_mobile_text' => 'asdf',
			'filter'         => false,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertEquals( $validate['is_mobile_text'], 'asdf' );

		$new_instance = array(
			'title'          => '',
			'text'           => '',
			'is_mobile_text' => 'as<br>df',
			'filter'         => false,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertEquals( $validate['is_mobile_text'], 'as<br>df' );

		$new_instance = array(
			'title'          => '',
			'text'           => '',
			'is_mobile_text' => "as'df",
			'filter'         => false,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertEquals( $validate['is_mobile_text'], "as'df" );
	}

	/**
	 * @test
	 * @group update
	 */
	public function update_case_unfiltered_html() {
		$user = $this->factory->user->create_and_get( array( 'role' => 'administrator' ) );
		wp_set_current_user( $user->ID );

		$new_instance = array(
			'title'         => '',
			'text'           => '<style></style>',
			'is_mobile_text' => '<style></style>',
			'filter'         => false,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertEquals( $validate['text'], '<style></style>' );
		$this->assertEquals( $validate['is_mobile_text'], '<style></style>' );


		$user = $this->factory->user->create_and_get( array( 'role' => 'editor' ) );
		wp_set_current_user( $user->ID );

		$new_instance = array(
			'title'         => '',
			'text'           => '<style></style>',
			'is_mobile_text' => '<style></style>',
			'filter'         => false,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertEquals( $validate['text'], '<style></style>' );
		$this->assertEquals( $validate['is_mobile_text'], '<style></style>' );


		$user = $this->factory->user->create_and_get( array( 'role' => 'author' ) );
		wp_set_current_user( $user->ID );

		$new_instance = array(
			'title'         => '',
			'text'           => '<style></style>',
			'is_mobile_text' => '<style></style>',
			'filter'         => false,
		);
		$old_instance = array();

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, $old_instance );

		$this->assertEquals( $validate['text'], '' );
		$this->assertEquals( $validate['is_mobile_text'], '' );
	}

}
