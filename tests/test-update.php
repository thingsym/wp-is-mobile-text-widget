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
		$expected = array(
			'title'          => '',
			'text'           => '',
			'is_mobile_text' => '',
			'filter'         => false,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertEquals( $validate, $expected );
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
		$expected = array(
			'title'          => '',
			'text'           => '',
			'is_mobile_text' => '',
			'filter'         => true,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertEquals( $validate, $expected );
		$this->assertTrue( $validate['filter'] );

		$new_instance = array(
			'title'          => '',
			'text'           => '',
			'is_mobile_text' => '',
			'filter'         => false,
		);
		$expected = array(
			'title'          => '',
			'text'           => '',
			'is_mobile_text' => '',
			'filter'         => false,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertEquals( $validate, $expected );
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
		$expected = array(
			'title'          => 'asdf',
			'text'           => '',
			'is_mobile_text' => '',
			'filter'         => false,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertEquals( $validate, $expected );
		$this->assertEquals( $validate['title'], 'asdf' );

		$new_instance = array(
			'title'          => "as\n<br>df",
			'text'           => '',
			'is_mobile_text' => '',
			'filter'         => false,
		);
		$expected = array(
			'title'          => sanitize_text_field( "as\n<br>df" ),
			'text'           => '',
			'is_mobile_text' => '',
			'filter'         => false,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertEquals( $validate, $expected );
		$this->assertEquals( $validate['title'], $expected[ 'title' ] );
	}

	/**
	 * @test
	 * @group update
	 */
	public function update_case_text() {
		$new_instance = array(
			'title'          => '',
			'text'           => 'asdf',
			'is_mobile_text' => 'asdf',
			'filter'         => false,
		);
		$expected = array(
			'title'          => '',
			'text'           => 'asdf',
			'is_mobile_text' => 'asdf',
			'filter'         => false,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertEquals( $validate, $expected );
		$this->assertEquals( $validate['text'], 'asdf' );
		$this->assertEquals( $validate['is_mobile_text'], 'asdf' );

		$new_instance = array(
			'title'          => '',
			'text'           => 'as<br>df',
			'is_mobile_text' => 'as<br>df',
			'filter'         => false,
		);
		$expected = array(
			'title'          => '',
			'text'           => 'as<br>df',
			'is_mobile_text' => 'as<br>df',
			'filter'         => false,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertEquals( $validate, $expected );
		$this->assertEquals( $validate['text'], 'as<br>df' );
		$this->assertEquals( $validate['is_mobile_text'], 'as<br>df' );

		$new_instance = array(
			'title'          => '',
			'text'           => "as'df",
			'is_mobile_text' => "as'df",
			'filter'         => false,
		);
		$expected = array(
			'title'          => '',
			'text'           => "as'df",
			'is_mobile_text' => "as'df",
			'filter'         => false,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertEquals( $validate, $expected );
		$this->assertEquals( $validate['text'], "as'df" );
		$this->assertEquals( $validate['is_mobile_text'], "as'df" );
	}

	/**
	 * @test
	 * @group update
	 * @group singlesite
	 */
	public function update_case_unfiltered_html() {
		if ( is_multisite() ) {
			$this->markTestSkipped(
				'multisite skip tests'
			);
		}

		wp_set_current_user(
			$this->factory->user->create( array(
				'role' => 'administrator',
			) )
		);

		$new_instance = array(
			'title'          => '',
			'text'           => '<style></style>',
			'is_mobile_text' => '<style></style>',
			'filter'         => false,
		);
		$expected = array(
			'title'          => '',
			'text'           => '<style></style>',
			'is_mobile_text' => '<style></style>',
			'filter'         => false,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertTrue( current_user_can( 'unfiltered_html' ) );
		$this->assertEquals( $validate, $expected );
		$this->assertEquals( $validate['text'], '<style></style>' );
		$this->assertEquals( $validate['is_mobile_text'], '<style></style>' );


		wp_set_current_user(
			$this->factory->user->create( array(
				'role' => 'editor',
			) )
		);

		$new_instance = array(
			'title'          => '',
			'text'           => '<style></style>',
			'is_mobile_text' => '<style></style>',
			'filter'         => false,
		);
		$expected = array(
			'title'          => '',
			'text'           => '<style></style>',
			'is_mobile_text' => '<style></style>',
			'filter'         => false,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertTrue( current_user_can( 'unfiltered_html' ) );
		$this->assertEquals( $validate, $expected );
		$this->assertEquals( $validate['text'], '<style></style>' );
		$this->assertEquals( $validate['is_mobile_text'], '<style></style>' );


		wp_set_current_user(
			$this->factory->user->create( array(
				'role' => 'author',
			) )
		);

		$new_instance = array(
			'title'          => '',
			'text'           => '<style></style>',
			'is_mobile_text' => '<style></style>',
			'filter'         => false,
		);
		$expected = array(
			'title'          => '',
			'text'           => wp_kses_post( '<style></style>' ),
			'is_mobile_text' => wp_kses_post( '<style></style>' ),
			'filter'         => false,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertFalse( current_user_can( 'unfiltered_html' ) );
		$this->assertEquals( $validate, $expected );
		$this->assertEquals( $validate['text'], '' );
		$this->assertEquals( $validate['is_mobile_text'], '' );
	}

	/**
	 * @test
	 * @group update
	 * @group multisite
	 */
	public function update_case_unfiltered_html_multisite() {
		if ( ! is_multisite() ) {
			$this->markTestSkipped(
				'singlesite skip tests'
			);
		}

		wp_set_current_user(
			$this->factory->user->create( array(
				'role' => 'administrator',
			) )
		);

		$new_instance = array(
			'title'          => '',
			'text'           => '<style></style>',
			'is_mobile_text' => '<style></style>',
			'filter'         => false,
		);
		$expected = array(
			'title'          => '',
			'text'           => wp_kses_post( '<style></style>' ),
			'is_mobile_text' => wp_kses_post( '<style></style>' ),
			'filter'         => false,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertFalse( current_user_can( 'unfiltered_html' ) );
		$this->assertEquals( $validate, $expected );
		$this->assertEquals( $validate['text'], '' );
		$this->assertEquals( $validate['is_mobile_text'], '' );


		wp_set_current_user(
			$this->factory->user->create( array(
				'role' => 'editor',
			) )
		);

		$new_instance = array(
			'title'          => '',
			'text'           => '<style></style>',
			'is_mobile_text' => '<style></style>',
			'filter'         => false,
		);
		$expected = array(
			'title'          => '',
			'text'           => wp_kses_post( '<style></style>' ),
			'is_mobile_text' => wp_kses_post( '<style></style>' ),
			'filter'         => false,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertFalse( current_user_can( 'unfiltered_html' ) );
		$this->assertEquals( $validate, $expected );
		$this->assertEquals( $validate['text'], '' );
		$this->assertEquals( $validate['is_mobile_text'], '' );

		wp_set_current_user(
			$this->factory->user->create( array(
				'role' => 'author',
			) )
		);

		$new_instance = array(
			'title'          => '',
			'text'           => '<style></style>',
			'is_mobile_text' => '<style></style>',
			'filter'         => false,
		);
		$expected = array(
			'title'          => '',
			'text'           => wp_kses_post( '<style></style>' ),
			'is_mobile_text' => wp_kses_post( '<style></style>' ),
			'filter'         => false,
		);

		$validate = $this->wp_is_mobile_text_widget->update( $new_instance, array() );

		$this->assertFalse( current_user_can( 'unfiltered_html' ) );
		$this->assertEquals( $validate, $expected );
		$this->assertEquals( $validate['text'], '' );
		$this->assertEquals( $validate['is_mobile_text'], '' );
	}

}