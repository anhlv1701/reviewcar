<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function stm_motors_events_enqueue_scripts_styles()
{
    wp_enqueue_style('font-awesome', STM_EVENTS_URL . '/assets/css/font-awesome.min.css', array());
    wp_enqueue_style('stm-motors-event-font-style', STM_EVENTS_URL . '/assets/css/motors-events-font.css', array());
    wp_enqueue_style('stm-motors-event-style', STM_EVENTS_URL . '/assets/css/style.css', array());

    wp_enqueue_script('jquery_cookie', STM_EVENTS_URL . '/assets/js/frontend/jquery.cookie.js', array('jquery'), null, true);
    wp_enqueue_script('motors_event_map', STM_EVENTS_URL . '/assets/js/frontend/event_map.js', array('jquery'), null, true);
    wp_enqueue_script('motors_events', STM_EVENTS_URL . '/assets/js/motors-events.js', array('jquery'), null, false);
	wp_register_script( 'events-schedule', STM_EVENTS_URL . '/assets/js/frontend/schedule.js', array( 'jquery' ), null, true );
	wp_register_script( 'motors_events_addtocalendar', STM_EVENTS_URL . '/assets/js/frontend/addtocalendar.js', array( 'jquery' ), null, true );
	wp_register_script( 'motors_events_join_form', STM_EVENTS_URL . '/assets/js/frontend/join_form.js', array( 'jquery' ), null, true );
}

add_action('wp_enqueue_scripts', 'stm_motors_events_enqueue_scripts_styles');