<?php
/**
 * Custom Widget.
 */

namespace Inc\Admin;

use WP_Widget;
        
class PayWidget extends WP_Widget
{
        
	public $widget_ID;

	public $widget_name;

	public $widget_options = array();

	public $control_options = array();

	public function __construct() {

		$this->widget_ID = 'widget_paymart';

		$this->widget_name = 'PayMart Pay';

		$this->widget_options = array(
			'classname' => $this->widget_ID,
			'description' => $this->widget_name,
			'customize_selective_refresh' => true,
		);

		$this->control_options = array(
			'width' => 400,
			'height' => 350,
		);
        }

	/**
         * register default hooks and actions for WordPress
         * @return
         */
	public function register()
	{
		parent::__construct( $this->widget_ID, $this->widget_name, $this->widget_options, $this->control_options );

		add_action( 'widgets_init', array( $this, 'widgetsInit' ) );
	}

	/**
	 * Register this widget
	 */
	public function widgetsInit()
	{
		register_widget( $this );
	}

	/**
	 * Outputs the content of the widget - Front-end
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
			?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Amount to give:', 'paymart' ); ?></label> 
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
						<?php // echo $this->collection_account; ?>
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Phone Number:', 'paymart' ); ?></label> 
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
						<?php // echo $this->collection_account; ?>
					</p>
			<?php 
		}
            echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
                
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'PayMart Pay', 'paymart' );
		$pay_email = ! empty( $instance['pay_email'] ) ? $instance['pay_email'] : '';
		$pay_password = ! empty( $instance['pay_password'] ) ? $instance['pay_password'] : '' ;
		$collection_account = ! empty( $instance['collection_account'] ) ? $instance['collection_account'] : '' ;
	?>
		<p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'paymart' ); ?></label> 
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'pay_email' ) ); ?>"><?php esc_attr_e( 'Account Email:', 'paymart' ); ?></label> 
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pay_email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pay_email' ) ); ?>" type="email" value="<?php echo esc_attr( $pay_email ); ?>">
		</p>
		<p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'pay_password' ) ); ?>"><?php esc_attr_e( 'Account password:', 'paymart' ); ?></label> 
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pay_password' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pay_password' ) ); ?>" type="password" value="<?php echo esc_attr( $pay_password ); ?>">
		</p>
		<p>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'Collection Account Number' ) ); ?>"><?php esc_attr_e( 'collection_account:', 'paymart' ); ?></label> 
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'collection_account' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'collection_account' ) ); ?>" type="text" value="<?php echo esc_attr( $collection_account ); ?>">
		</p>
	<?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['pay_email'] = sanitize_text_field( $new_instance['pay_email'] );
		$instance['pay_password'] = sanitize_text_field( $new_instance['pay_password'] );
		$instance['collection_account'] = sanitize_text_field( $new_instance['collection_account'] );

		return $instance;
        }

}