<?php
class Test_Wp_Is_Mobile_Text_Widget_Widget_Pc extends WP_UnitTestCase {
	public $wp_is_mobile_text_widget;

	public function setUp(): void {
			parent::setUp();
			$this->wp_is_mobile_text_widget = new WP_Is_Mobile_Text_Widget();
	}

	/**
	 * @test
	 * @group widget
	 * @group pc
	 */
	public function widget_case_pc_1() {
		$args = array(
			'before_widget' => '<aside id="wp_is_mobile_text-1" class="widget widget_is_mobile_text">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		);
		$instance = array(
			'title'          => 'aaaaa',
			'text'           => 'bbbbb',
			'is_mobile_text' => 'ccccc',
			'filter'         => false,
		);

		ob_start();
		$this->wp_is_mobile_text_widget->widget( $args, $instance );
		$widget = ob_get_clean();

		$this->assertRegExp( '#<aside id="wp_is_mobile_text-1" class="widget_text widget widget_is_mobile_text">#', $widget );
		$this->assertRegExp( '#<h3 class="widget-title">aaaaa</h3>#', $widget );
		$this->assertRegExp( '#<div class="textwidget wp-is-mobile-text-widget">bbbbb</div>#', $widget );
	}

	/**
	 * @test
	 * @group widget
	 * @group pc
	 */
	public function widget_case_pc_2() {
		$args = array(
			'before_widget' => '<aside id="wp_is_mobile_text-1" class="widget widget_is_mobile_text">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		);
		$instance = array(
			'title'          => 'aaaaa',
			'text'           => 'bbb<br>bb',
			'is_mobile_text' => 'ccc<br>cc',
			'filter'         => false,
		);

		ob_start();
		$this->wp_is_mobile_text_widget->widget( $args, $instance );
		$widget = ob_get_clean();

		$this->assertRegExp( '#<h3 class="widget-title">aaaaa</h3>#', $widget );
		$this->assertRegExp( '#<div class="textwidget wp-is-mobile-text-widget">bbb<br>bb</div>#', $widget );
	}

	/**
	 * @test
	 * @group widget
	 * @group pc
	 */
	public function widget_case_pc_filter() {
		$args = array(
			'before_widget' => '<aside id="wp_is_mobile_text-1" class="widget widget_is_mobile_text">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		);
		$instance = array(
			'title'          => 'aaaaa',
			'text'           => "bbb<br>bb\n\nsss<br>ss",
			'is_mobile_text' => "ccc<br>\n\nsss<br>ss",
			'filter'         => true,
		);
		$expected = array(
			'text'           => wpautop( "bbb<br>bb\n\nsss<br>ss" ),
			'is_mobile_text' => wpautop( "ccc<br>\n\nsss<br>ss" ),
		);

		ob_start();
		$this->wp_is_mobile_text_widget->widget( $args, $instance );
		$widget = ob_get_clean();

		$this->assertRegExp( '#<h3 class="widget-title">aaaaa</h3>#', $widget );
		$this->assertRegExp( '#<div class="textwidget wp-is-mobile-text-widget">' . $expected['text'] . '</div>#', $widget );
	}

	/**
	 * @test
	 * @group widget
	 * @group pc
	 */
	public function widget_case_pc_filters() {
		$args = array(
			'before_widget' => '<aside id="wp_is_mobile_text-1" class="widget widget_is_mobile_text">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		);
		$instance = array(
			'title'          => 'aaaaa',
			'text'           => 'bbbbb',
			'is_mobile_text' => 'ccccc',
			'filter'         => false,
		);

		add_filter( 'widget_title', array( $this, '_filter_test' ) );
		add_filter( 'widget_text', array( $this, '_filter_test' ) );

		ob_start();
		$this->wp_is_mobile_text_widget->widget( $args, $instance );
		$widget = ob_get_clean();

		$this->assertRegExp( '#<h3 class="widget-title">via filter</h3>#', $widget );
		$this->assertRegExp( '#<div class="textwidget wp-is-mobile-text-widget">via filter</div>#', $widget );
	}

	/**
	 * @test
	 * @group widget
	 * @group pc
	 */
	public function widget_case_pc_filters_wp_is_mobile_text_widget_text() {
		$args = array(
			'before_widget' => '<aside id="wp_is_mobile_text-1" class="widget widget_is_mobile_text">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		);
		$instance = array(
			'title'          => 'aaaaa',
			'text'           => 'bbbbb',
			'is_mobile_text' => 'ccccc',
			'filter'         => false,
		);

		add_filter( 'wp_is_mobile_text_widget_text', array( $this, '_filter_test' ) );

		ob_start();
		$this->wp_is_mobile_text_widget->widget( $args, $instance );
		$widget = ob_get_clean();

		$this->assertRegExp( '#<div class="textwidget wp-is-mobile-text-widget">via filter</div>#', $widget );
	}

	public function _filter_test() {
		return 'via filter';
	}

}
