<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

require_once STM_EVENTS_PATH . '/includes/admin/butterbean_helpers.php';

require_once 'tabs/events.php';
require_once 'tabs/speaker.php';
require_once 'tabs/participant.php';

add_action('butterbean_event_register', 'stm_magazine_register_manager_order', 10, 2);

function stm_magazine_register_manager_order($butterbean, $post_type) {

	if($post_type == 'stm_events') {
		$butterbean->register_manager(
			'stm_event_details',
			array(
				'label' => esc_html__('STM View settings', 'motors_events'),
				'post_type' => 'stm_events',
				'context' => 'normal',
				'priority' => 'high'
			)
		);

		$manager = $butterbean->get_manager('stm_event_details');
		register_events_metabox($manager, 'stm_motors_events');
	}
}