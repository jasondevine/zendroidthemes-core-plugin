<?php
/**
 * Widget to display logo in the theme footer area, along with a description
 *
 * @package 	zendroidthemes
 * @since 		1.0
 * @author     	Jason Devine
 * @license    	http://www.gnu.org/licenses/gpl-2.0.html
 *
 */
?>


<?php

class zendroidthemes_about_us extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {

		$widget_options = array(
			'classname' => 'zendroidthemes_about_us',
			'description' => __( 'An "About Us" widgetygidget incorporating a selectable logo and description, useful for the footer', 'zendroidPress' )
		);

		$control_options = array();

		parent::__construct( 'zendroidthemes_about_us', 'Zendroid Themes About Us', $widget_options );

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
			$textarea = ! empty( $instance['textarea'] ) ? $instance['textarea'] : esc_html__( 'Description', 'zendroidPress' );

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
	<?php esc_attr_e( 'Description', 'zendroidPress' ); ?>
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
	} ?>

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php if (get_theme_mod( 'zendroidPress-footer-logo' )) : echo get_theme_mod( 'zendroidPress-footer-logo'); endif; ?>" alt="" class="" id="footer-logo"></a>

	<?php

		if ( ! empty( $instance['textarea'] ) ) { ?>
		<div class="about-us-widget-description">
		<?php
		echo ($instance['textarea']);
		?>
		</div>

		<?php if (get_theme_mod('zendroidPress-secondary-logo')) {
			// If one has been set, this will output a <figure> containing an <img> with the secondary logo uploaded via the customizer (Site Identity)
			echo '<figure class="secondary-logo">' . do_shortcode('[secondary-logo]') . ' </figure>';
		}
		?>

		<?php
		}
	echo $args['after_widget'];
}












}

// register widget
add_action( 'widgets_init', function() {
	register_widget( 'zendroidthemes_about_us' );
} );


?>