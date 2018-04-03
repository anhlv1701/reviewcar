<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$show_on_dealer = true;
$show_on_listing = false;

$positions = array(
    'none' => esc_html__('None', 'stm_motors_events'),
    'left' => esc_html__('Left', 'stm_motors_events'),
    'right' => esc_html__('Right', 'stm_motors_events'),
);

$archive_page = array(
    'list' => esc_html__('List', 'stm_motors_events'),
    'grid' => esc_html__('Grid', 'stm_motors_events'),
);

$events_pagination = array(
    'pagination' => esc_html__('Pagination', 'stm_motors_events'),
    'load_more' => esc_html__('Load More Button', 'stm_motors_events'),
);

STM_Customizer_Events::setPanels(array(
    'events' => array(
        'title' => esc_html__('Events', 'stm_motors_events'),
        'priority' => 40
    ),
));

$events_features = array(
    'events_archive' => array(
        'label' => esc_html__('Events archive', 'stm_motors_events'),
		'type' => 'stm-select',
		'choices' => $archive_page,
		'default' => 'list',
        'description' => esc_html__('Choose Events Page View', 'stm_motors_events'),
    ),
    'events_archive_sidebar_position' => array(
        'label' => esc_html__('Events page sidebar position', 'stm_motors_events'),
		'type' => 'stm-select',
		'choices' => $positions,
		'default' => 'right',
    ),
	'events_block_title_bg' => array(
		'label' => esc_html__('Title background', 'stm_motors_events'),
		'type' => 'image'
	),
	'events_subtitle' => array(
		'label' => esc_html__('Subtitle', 'stm_motors_events'),
		'type' => 'text',
		'default' => esc_html__('Find interesting trade shows & conferences to attend', 'stm_motors_events'),
	),
	'events_archive_paginatin_style' => array(
        'label' => esc_html__('Events pagination type', 'stm_motors_events'),
		'type' => 'stm-select',
		'choices' => $events_pagination,
		'default' => 'pagination',
    ),
    'events_per_page' => array(
        'label' => esc_html__('Events per page', 'stm_motors_events'),
        'type' => 'text',
        'default' => 6
    )
);

STM_Customizer_Events::setSection('events_features', array(
	'title' => esc_html__('Events settings', 'stm_motors_events'),
	'panel' => 'events',
	'fields' => $events_features
));