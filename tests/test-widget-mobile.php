<?php
class Test_Wp_Is_Mobile_Text_Widget_Widget_Mobile extends WP_UnitTestCase {
	protected $backupGlobalsBlacklist = array( 'wpdb', 'wp_query', 'post' );

	public function setUp() {
		parent::setUp();
		$this->wp_is_mobile_text_widget = new WP_Is_Mobile_Text_Widget();
	}

	/**
	 * @test
	 * @group widget
	 * @group mobile
	 * @backupGlobals enabled
	 */
	public function widget_case_mobile_1() {
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

		$_SERVER['HTTP_USER_AGENT'] = 'Mobile';

		ob_start();
		$this->wp_is_mobile_text_widget->widget( $args, $instance );
		$widget = ob_get_clean();

		$this->assertRegExp( '#<aside id="wp_is_mobile_text-1" class="widget_text widget widget_is_mobile_text">#', $widget );
		$this->assertRegExp( '#<h3 class="widget-title">aaaaa</h3>#', $widget );
		$this->assertRegExp( '#<div class="textwidget wp-is-mobile-text-widget">ccccc</div>#', $widget );
	}

	/**
	 * @test
	 * @group widget
	 * @group mobile
	 * @backupGlobals enabled
	 */
	public function widget_case_mobile_2() {
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

		$_SERVER['HTTP_USER_AGENT'] = 'Mobile';

		ob_start();
		$this->wp_is_mobile_text_widget->widget( $args, $instance );
		$widget = ob_get_clean();

		$this->assertRegExp( '#<h3 class="widget-title">aaaaa</h3>#', $widget );
		$this->assertRegExp( '#<div class="textwidget wp-is-mobile-text-widget">ccc<br>cc</div>#', $widget );
	}

	/**
	 * @test
	 * @group widget
	 * @group mobile
	 * @backupGlobals enabled
	 */
	public function widget_case_mobile_filter() {
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

		$_SERVER['HTTP_USER_AGENT'] = 'Mobile';

		ob_start();
		$this->wp_is_mobile_text_widget->widget( $args, $instance );
		$widget = ob_get_clean();

		$this->assertRegExp( '#<h3 class="widget-title">aaaaa</h3>#', $widget );
		$this->assertRegExp( '#<div class="textwidget wp-is-mobile-text-widget">' . $expected['is_mobile_text'] . '</div>#', $widget );
	}

	/**
	 * @test
	 * @group widget
	 * @group mobile
	 * @backupGlobals enabled
	 */
	public function widget_case_mobile_filters() {
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

		$_SERVER['HTTP_USER_AGENT'] = 'Mobile';

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
	 * @group mobile
	 * @backupGlobals enabled
	 */
	public function widget_case_mobile_filters_wp_is_mobile_text_widget_is_mobile_true() {
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

		$_SERVER['HTTP_USER_AGENT'] = 'Mobile';

		add_filter( 'wp_is_mobile_text_widget_is_mobile_true', array( $this, '_filter_test' ) );

		ob_start();
		$this->wp_is_mobile_text_widget->widget( $args, $instance );
		$widget = ob_get_clean();

		$this->assertRegExp( '#<div class="textwidget wp-is-mobile-text-widget">via filter</div>#', $widget );
	}

	public function _filter_test() {
		return 'via filter';
	}

}
