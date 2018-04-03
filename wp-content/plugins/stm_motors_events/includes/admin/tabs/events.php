<?php
function register_events_metabox($manager, $stmDomain)
{
    /*Register sections*/
    $manager->register_section(
        'stm_event_details',
        array(
            'label' => esc_html__('Event details', $stmDomain),
            'icon' => 'fa fa-bookmark'
        )
    );

    /*Register controls*/
    $fields = array(
        'sticky_event' => array(
            'label' => esc_html__('Stick this post to the front page', $stmDomain),
            'type' => 'checkbox',
            'values' => 'how_sticky'
        ),
		'desc' => array(
			'label' => esc_html__('Short description', $stmDomain),
			'validate' => 'stm_motors_events_no_validate'
		),
		'link' => array(
			'label' => esc_html__('Custom link', $stmDomain),
			'validate' => 'stm_motors_events_no_validate'
		),
		'link_text' => array(
			'label' => esc_html__('Custom link text', $stmDomain),
			'validate' => 'stm_motors_events_no_validate'
		),
        'participants_num' => array(
            'label' => esc_html__('Max Participants', $stmDomain),
			'validate' => 'stm_motors_events_no_validate'
        ),
        'cur_participants' => array(
            'label' => esc_html__('Signed up participants', $stmDomain),
			'validate' => 'stm_motors_events_no_validate'
        ),
        'terms_conditions_link' => array(
            'label' => esc_html__('Terms and Conditions Link', $stmDomain),
			'validate' => 'stm_motors_events_no_validate'
        ),
        'map_title' => array(
            'label' => esc_html__('Map title', $stmDomain),
			'validate' => 'stm_motors_events_no_validate'
        ),
        'address' => array(
            'label' => esc_html__('Event address', $stmDomain),
			'validate' => 'stm_motors_events_no_validate'
        ),
        'latitude' => array(
            'label' => esc_html__('Latitude', $stmDomain),
			'validate' => 'stm_motors_events_no_validate'
        ),
        'longitude' => array(
            'label' => esc_html__('Longitude', $stmDomain),
			'validate' => 'stm_motors_events_no_validate'
        ),
        'numbers' => array(
            'label' => esc_html__('Phone numbers (add phone numbers separated by commas)', $stmDomain),
			'validate' => 'stm_motors_events_no_validate'
        ),
        'date_start' => array(
            'type' => 'event-datepicker',
            'label' => esc_html__('Event date start', $stmDomain),
            'validate' => 'stm_motors_events_date',
        ),
        'date_start_time' => array(
            'type' => 'timepicker',
            'label' => esc_html__('Event date start time', $stmDomain),
			'validate' => 'stm_event_start_timestamp'
        ),
        'date_end' => array(
            'type' => 'event-datepicker',
            'label' => esc_html__('Event date end', $stmDomain),
            'validate' => 'stm_motors_events_date'
        ),
        'date_end_time' => array(
            'type' => 'timepicker',
            'label' => esc_html__('Event date end time', $stmDomain),
			'validate' => 'stm_event_start_timestamp'
        ),
    );

    $fields = apply_filters('stm_projects_fields', $fields);

    foreach($fields as $field => $field_info) {
        /*Register control*/
        $type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
        $validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';
        $manager->register_control(
            $field,
            array(
                'type' => $type,
                'section' => 'stm_event_details',
                'label' => $field_info['label'],
                'attr' => array(
                    'class' => 'widefat',
                )
            )
        );

        /*Register setting*/
        $manager->register_setting(
            $field,
            array(
                'sanitize_callback' => $validate,
            )
        );
    }

}