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
			'customize_selective_refresh' => true, // this allows us to see changes in real time when editing the widget in customizer
			'description' => __( 'An "About Us" widget incorporating a selectable logo and description, useful for the footer', 'zendroidPress' )
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

		// Set widget defaults
	$defaults = array(
		'title'    => '',
		'description'     => '',
		'checkbox' => ''
	);

	// Parse current settings with defaults
	extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

	<?php // Widget Title ?>
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

	<?php // Description Field ?>
	<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>">
			<?php esc_attr_e( 'Description', 'zendroidPress' ); ?>
			</label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"	name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" value="<?php echo esc_textarea( $description ); ?>" cols="5" rows="20"><?php echo esc_textarea( $description ); ?></textarea>
	</p>

	<?php // Checkbox ?>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>"><?php esc_attr_e( 'Include logo?', 'zendroidPress' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'checkbox' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?> />
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
	$instance['description'] = isset( $new_instance['description'] ) ? wp_kses_post( $new_instance['description'] ) : '';
	$instance['checkbox'] = isset( $new_instance['checkbox'] ) ? 1 : false;
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

	extract( $args );

	// Check the widget options
	$title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
	$description = isset( $instance['description'] ) ?$instance['description'] : '';
	$checkbox = ! empty( $instance['checkbox'] ) ? $instance['checkbox'] : false;

	// WordPress core before_widget hook (always include )
	echo $before_widget;

		// Display widget title if defined
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		// Display something if checkbox is true
		if ( $checkbox ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php if (get_theme_mod( 'zendroidPress-footer-logo' )) : echo get_theme_mod( 'zendroidPress-footer-logo'); endif; ?>" alt="" class="" id="footer-logo"></a>
		<?php }

		// Display textarea field
		if ( $description ) {
			echo '<div class="about-us-widget-description">' . $description . '</div>';
		}

		?>

		<?php if (get_theme_mod('zendroidPress-secondary-logo')) {
			// If one has been set, this will output a <figure> containing an <img> with the secondary logo uploaded via the customizer (Site Identity)
			echo '<figure class="secondary-logo">' . do_shortcode('[secondary-logo]') . ' </figure>';
		}
		?>

		<?php

	echo $args['after_widget'];
} // end public function widget()

}

// register widget
add_action( 'widgets_init', function() {
	register_widget( 'zendroidthemes_about_us' );
} );


?>