<?php

class wp_is_mobile_text_widget_Update_Test extends WP_UnitTestCase {

    public function setUp() {
        parent::setUp();
        $this->WP_Is_Mobile_Text_Widget = new WP_Is_Mobile_Text_Widget();
    }

    /**
     * @test
     * @group update
     */
    public function update_case_none_input() {
        $new_instance = array(
            'title' => '',
            'text' => '',
            'is_mobile_text' => '',
            // 'filter' => 0,
        );
        $old_instance = array();

        $validate = $this->WP_Is_Mobile_Text_Widget->update( $new_instance, $old_instance );

        $this->assertEquals( $validate['title'], '' );
        $this->assertEquals( $validate['text'], '' );
        $this->assertEquals( $validate['is_mobile_text'], '' );
        $this->assertEquals( $validate['filter'], 0 );
    }

    /**
     * @test
     * @group update
     */
    public function update_case_filter() {
        $new_instance = array(
            'title' => '',
            'text' => '',
            'is_mobile_text' => '',
            'filter' => 1,
        );
        $old_instance = array();

        $validate = $this->WP_Is_Mobile_Text_Widget->update( $new_instance, $old_instance );

        $this->assertEquals( $validate['filter'], 1 );

        $new_instance = array(
            'title' => '',
            'text' => '',
            'is_mobile_text' => '',
            // 'filter' => 0,
        );
        $old_instance = array();

        $validate = $this->WP_Is_Mobile_Text_Widget->update( $new_instance, $old_instance );

        $this->assertEquals( $validate['filter'], 0 );
    }

    /**
     * @test
     * @group update
     */
    public function update_case_title() {
        $new_instance = array(
            'title' => 'asdf',
            'text' => '',
            'is_mobile_text' => '',
        );
        $old_instance = array();

        $validate = $this->WP_Is_Mobile_Text_Widget->update( $new_instance, $old_instance );

        $this->assertEquals( $validate['title'], 'asdf' );

        $new_instance = array(
            'title' => 'as<br>df',
            'text' => '',
            'is_mobile_text' => '',
        );
        $old_instance = array();

        $validate = $this->WP_Is_Mobile_Text_Widget->update( $new_instance, $old_instance );

        $this->assertEquals( $validate['title'], 'asdf' );
    }

    /**
     * @test
     * @group update
     */
    public function update_case_text() {
        $new_instance = array(
            'title' => '',
            'text' => 'asdf',
            'is_mobile_text' => '',
        );
        $old_instance = array();

        $validate = $this->WP_Is_Mobile_Text_Widget->update( $new_instance, $old_instance );

        $this->assertEquals( $validate['text'], 'asdf' );

        $new_instance = array(
            'title' => '',
            'text' => 'as<br>df',
            'is_mobile_text' => '',
        );
        $old_instance = array();

        $validate = $this->WP_Is_Mobile_Text_Widget->update( $new_instance, $old_instance );

        $this->assertEquals( $validate['text'], 'as<br>df' );

        $new_instance = array(
            'title' => '',
            'text' => "as'df",
            'is_mobile_text' => '',
        );
        $old_instance = array();

        $validate = $this->WP_Is_Mobile_Text_Widget->update( $new_instance, $old_instance );

        $this->assertEquals( $validate['text'], "as'df" );
    }

    /**
     * @test
     * @group update
     */
    public function update_case_is_mobile_text() {
        $new_instance = array(
            'title' => '',
            'text' => '',
            'is_mobile_text' => 'asdf',
        );
        $old_instance = array();

        $validate = $this->WP_Is_Mobile_Text_Widget->update( $new_instance, $old_instance );

        $this->assertEquals( $validate['is_mobile_text'], 'asdf' );

        $new_instance = array(
            'title' => '',
            'text' => '',
            'is_mobile_text' => 'as<br>df',
        );
        $old_instance = array();

        $validate = $this->WP_Is_Mobile_Text_Widget->update( $new_instance, $old_instance );

        $this->assertEquals( $validate['is_mobile_text'], 'as<br>df' );

        $new_instance = array(
            'title' => '',
            'text' => '',
            'is_mobile_text' => "as'df",
        );
        $old_instance = array();

        $validate = $this->WP_Is_Mobile_Text_Widget->update( $new_instance, $old_instance );

        $this->assertEquals( $validate['is_mobile_text'], "as'df" );
    }
}
