<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function stm_motors_events_admin_enqueue($hook)
{
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');

    wp_enqueue_style('stm-listings-datetimepicker', STM_EVENTS_URL . '/assets/css/jquery.stmdatetimepicker.css', null, null, 'all');
    wp_enqueue_script('stm-listings-datetimepicker', STM_EVENTS_URL . '/assets/js/jquery.stmdatetimepicker.js', array('jquery'), null, true);

	wp_enqueue_script('jquery-ui-datepicker');

    wp_enqueue_style('stm-listings-timepicker', STM_EVENTS_URL . '/includes/admin/butterbean/css/jquery.timepicker.css', null, null, 'all');
    wp_enqueue_script('stm-listings-timepicker', STM_EVENTS_URL . '/includes/admin/butterbean/js/jquery.timepicker.js', array('jquery'), null, true);

    wp_enqueue_media();

	wp_enqueue_script('stm-motors-events-js', STM_EVENTS_URL . '/assets/js/motors-events.js', array('jquery','jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-sortable'));

	wp_enqueue_style('stm_motors-events_awesome_font', STM_EVENTS_URL . '/assets/css/font-awesome.min.css');

	/*Google places*/
	$google_api_key = get_theme_mod('google_api_key', '');
	$google_api_map = 'https://maps.googleapis.com/maps/api/js?key=' . $google_api_key . '&libraries=places';

	wp_register_script('stm_gmap', $google_api_map, array('jquery'), null, true);

	//wp_enqueue_script('stm_gmap');
	wp_enqueue_script('stm-google-places', STM_EVENTS_URL . '/assets/js/stm-google-places.js', 'stm_gmap', null, true);

	wp_enqueue_style('stm_motors_events_css', STM_EVENTS_URL . '/assets/css/style.css');
}

add_action('admin_enqueue_scripts', 'stm_motors_events_admin_enqueue');