<?php
/**
 * 'About Me' Widget to display profile photo, signature, short bio and social media links
 *
 * @package 	zendroidthemes
 * @since 		1.0
 * @author     	Jason Devine
 * @license    	http://www.gnu.org/licenses/gpl-2.0.html
 *
 */
?>

<?php

class zendroidthemes_about_me extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {

		$widget_options = array(
			'classname' => 'zendroidthemes_about_me',
			'description' => __( 'An "About Me" widget to display profile photo, signature, short bio and social media links', 'zendroidPress' )
		);

		$control_options = array();

		parent::__construct( 'zendroidthemes_about_me', 'Zendroid Themes About Me', $widget_options );

	}


		/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Title', 'zendroidPress' );
			$textarea = ! empty( $instance['textarea'] ) ? $instance['textarea'] : esc_html__( 'What would you like to say about yourself?', 'zendroidPress' );
	?>
	<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
	<?php esc_attr_e( 'Title:', 'zendroidPress' ); ?>
	</label>

	<input
		class="widefat"
		id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
		name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
		type="text"
		value="<?php echo esc_attr( $title ); ?>">
	</p>

	<p>

	<label for="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>">
	<?php esc_attr_e( 'What would you like to say about yourself?', 'zendroidPress' ); ?>
	</label>

	<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>"	name="<?php echo esc_attr( $this->get_field_name( 'textarea' ) ); ?>" value="<?php echo esc_textarea( $textarea ); ?>" cols="5" rows="20"><?php echo esc_textarea( $textarea ); ?></textarea>

	</p>

	<?php
}




	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
public function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'], "<strong><em><i>" ) : '';
	$instance['textarea'] = ( ! empty( $new_instance['textarea'] ) ) ? strip_tags( $new_instance['textarea'], "<strong><em><i>" ) : '';
	return $instance;
}

/**
	 * Front-end display of widget
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	echo $args['before_widget'];
	if ( ! empty( $instance['title'] ) ) {
		echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
	}

		?>
		<div id="about-me">
		<div  id="profile-widget-picture"></div>
		<?php if (get_theme_mod( 'zendroidPress-custom-signature')) { ?>

		<?php
		if ( ! empty( $instance['textarea'] ) ) { ?>
		<div class="about-me-bio">
		<?php
		echo ($instance['textarea']);
		?>
		</div>
		<img id="profile-widget-signature" src="<?php echo get_theme_mod( 'zendroidPress-custom-signature'); ?>">
		<?php
		}
		?>

		<div class="blog-social-container">
			<a class="fab fa-facebook-f" target="blank" href="https://www.facebook.com/<?php echo get_theme_mod('zendroidPress-social-facebook') ?>" title="Follow on Facebook"></a>
			<a class="fab fa-google " target="blank" href="https://plus.google.com/<?php echo get_theme_mod('zendroidPress-social-googleplus') ?>"
			title="Follow on GooglePlus"></a>
			<a class="fab fa-tumblr " target="blank" href="https://www.tumblr.com/<?php echo get_theme_mod('zendroidPress-social-tumblr') ?>"
			title="Follow on Tumblr"></a>
			<a class="fab fa-pinterest " target="blank" href="https://www.pinterest.com/<?php echo get_theme_mod('zendroidcore-social-pinterest') ?>"
			title="Follow on Pinterest"></a>
			<a class="fab fa-twitter " target="blank" href="https://twitter.com/intent/follow?screen_name=<?php echo get_theme_mod('zendroidPress-social-twitter') ?>"
			title="Follow on Twitter"></a>
		</div>

		</div>
		<?php
		}

	echo $args['after_widget'];
}
}

// register widget
add_action( 'widgets_init', function() {
	register_widget( 'zendroidthemes_about_me' );
} );


?>