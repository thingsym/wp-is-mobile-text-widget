<?php
class Wp_Is_Mobile_Text_Widget_Widget_Pc_Test extends WP_UnitTestCase {
	protected $backupGlobalsBlacklist = array( 'wpdb', 'wp_query', 'post' );

	public function setUp() {
			parent::setUp();
			$this->wp_is_mobile_text_widget = new WP_Is_Mobile_Text_Widget();
	}

	/**
	 * @test
	 * @group widget
	 * @group pc
	 * @backupGlobals enabled
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

		$this->expectOutputRegex( '#<h3 class="widget-title">aaaaa</h3>#' );
		$this->expectOutputRegex( '#<div class="textwidget wp-is-mobile-text-widget">bbbbb</div>#' );

		$this->wp_is_mobile_text_widget->widget( $args, $instance );
	}

	/**
	 * @test
	 * @group widget
	 * @group pc
	 * @backupGlobals enabled
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

		$this->expectOutputRegex( '#<h3 class="widget-title">aaaaa</h3>#' );
		$this->expectOutputRegex( '#<div class="textwidget wp-is-mobile-text-widget">bbb<br>bb</div>#' );

		$this->wp_is_mobile_text_widget->widget( $args, $instance );
	}

	/**
	 * @test
	 * @group widget
	 * @group pc
	 * @backupGlobals enabled
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
			'text'           => 'bbb<br>bb

sss<br>ss',
			'is_mobile_text' => 'ccc<br>cc

sss<br>ss',
			'filter'         => true,
		);

		$this->expectOutputRegex( '#<h3 class="widget-title">aaaaa</h3>#' );
		$this->expectOutputRegex( '#<div class="textwidget wp-is-mobile-text-widget"><p>bbb<br />bb</p>
<p>sss<br />ss</p>
</div>#' );

		$this->wp_is_mobile_text_widget->widget( $args, $instance );
	}

	/**
	 * @test
	 * @group widget
	 * @group pc
	 * @backupGlobals enabled
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

		$this->expectOutputRegex( '#<h3 class="widget-title">via filter</h3>#' );
		$this->expectOutputRegex( '#<div class="textwidget wp-is-mobile-text-widget">via filter</div>#' );

		$this->wp_is_mobile_text_widget->widget( $args, $instance );
	}

	/**
	 * @test
	 * @group widget
	 * @group pc
	 * @backupGlobals enabled
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

		$this->expectOutputRegex( '#<div class="textwidget wp-is-mobile-text-widget">via filter</div>#' );

		$this->wp_is_mobile_text_widget->widget( $args, $instance );
	}

	public function _filter_test() {
		return "via filter";
	}

}
