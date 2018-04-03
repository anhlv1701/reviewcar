<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
if ( ! class_exists( 'STM_Customizer_Events_Post_Type_Control' ) ) {

	class STM_Customizer_Events_Post_Type_Control extends WP_Customize_Control {

		public $type = 'stm-post-type';
		public $post_type = '';

		public function render_content() {

			if ( empty( $this->post_type ) ) {
				$this->post_type = 'post';
			}

			$post_types[] = __( '--- Default ---', 'stm_vehicles_listing' );
			$query        = get_posts( array( 'post_type' => $this->post_type, 'posts_per_page' => - 1 ) );
			if ( $query ) {
				foreach ( $query as $post ) {
					$post_types[ $post->ID ] = get_the_title( $post->ID );
				}
			}

			$input_args = array(
				'type'    => 'select',
				'label'   => $this->label,
				'name'    => '',
				'id'      => $this->id,
				'value'   => $this->value(),
				'link'    => $this->get_link(),
				'options' => $post_types
			);

			?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'stm-', '', $this->type ) ); ?>">

				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<div class="stm-form-item">
					<div class="stm-post-type-wrapper stm-form-item">
						<?php stm_input( $input_args ); ?>
					</div>
				</div>

				<?php if ( '' != $this->description ) : ?>
					<div class="description customize-control-description">
						<?php echo esc_html( $this->description ); ?>
					</div>
				<?php endif; ?>

			</div>
			<?php
		}
	}
}