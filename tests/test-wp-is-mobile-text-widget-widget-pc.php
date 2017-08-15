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
		public function widget_case_pc() {
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

				$this->assertContains( '<h3 class="widget-title">aaaaa</h3>', $widget );
				$this->assertContains( '<div class="textwidget">bbbbb</div>', $widget );
		}

}
