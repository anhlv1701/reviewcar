<?php
/**
 * Created by PhpStorm.
 * User: NDA
 * Date: 28.12.2017
 * Time: 16:57
 */

add_action('init', 'motors_events_update_existing_shortcodes');

function motors_events_update_existing_shortcodes()
{

	if (function_exists('vc_add_params')) {

		vc_map( array(
			'html_template' => STM_EVENTS_PATH . '/vc_templates/stm_schedule.php',
			'name' => esc_html__( 'Motors Schedule Tabs', 'motors' ),
			'base' => 'stm_schedule',
			'category' => esc_html__( 'Content', 'motors' ),
			"as_parent" => array( 'only' => 'stm_schedule_item' ),
			"is_container" => true,
			"content_element" => true,
			"show_settings_on_create" => true,
			'description' => esc_html__('Events schedule', 'motors'),
			'category' =>array(
				esc_html__('Content', 'motors'),
				esc_html__('Motors', 'motors')
			),
			'params' => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Date Format', 'motors' ),
					'param_name' => 'stm_event_lesson_date_format',
					'value' => array(
						date_i18n('D, F j, Y')  => 'D, F j, Y',
						date_i18n('F j, Y')  => 'F j, Y',
						date_i18n('Y-m-d')  => 'Y-m-d',
						date_i18n('m/d/Y')  => 'm/d/Y',
						date_i18n('d/m/Y')  => 'd/m/Y',
					)
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Time Format', 'motors' ),
					'param_name' => 'stm_event_lesson_time_format',
					'value' => array(
						date_i18n('g:i A')  => 'g:i A',
						date_i18n('g:i a')  => 'g:i a',
						date_i18n('H:i')  => 'H:i',
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'motors' ),
					'param_name' => 'css',
					'group'       => esc_html__( 'Design Options', 'motors' ),
				)
			),
			"js_view" => 'VcColumnView'
		) );

		$speakers = motors_vc_post_type('stm_speakers');
		$speakers_data = array();
		foreach($speakers as $speaker_name => $speaker_id) {
			$speakers_data[] = array( 'label' => $speaker_name, 'value' => $speaker_id);
		}

		vc_map( array(
			'html_template' => STM_EVENTS_PATH . '/vc_templates/stm_schedule_item.php',
			"name" => esc_html__('Schedule Item', 'motors'),
			"base" => "stm_schedule_item",
			"content_element" => true,
			"as_child" => array('only' => 'stm_schedule'),
			"params" => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'motors' ),
					'param_name' => 'stm_event_lesson_title',
					'holder'        => 'div'
				),
				array(
					'type'        => 'stm_datepicker_vc',
					'heading'     => esc_html__( 'Date', 'motors' ),
					'param_name'  => 'datepicker',
					'holder'        => 'div'
				),
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Lessons Info', 'motors' ),
					'param_name' => 'heading',
					'value'      => urlencode(json_encode(array(
						array(
							'label'       => esc_html__('Title', 'motors'),
							'admin_label' => true
						),
					))),
					'params' => array(
						array(
							'type'        => 'stm_timepicker_vc',
							'heading'     => esc_html__( 'Time start', 'motors' ),
							'param_name'  => 'timepicker_start',
						),
						array(
							'type'        => 'stm_timepicker_vc',
							'heading'     => esc_html__( 'Time end', 'motors' ),
							'param_name'  => 'timepicker_end',
						),
						array(
							'type'         => 'textfield',
							'heading'      => esc_html__( 'Location', 'motors' ),
							'param_name'   => 'location'
						),
						array(
							'type'         => 'textfield',
							'heading'      => esc_html__( 'Title', 'motors' ),
							'param_name'   => 'title',
							'admin_label' => true,
						),
						array(
							'type'       => 'textarea',
							'heading'    => esc_html__( 'Description', 'motors' ),
							'param_name' => 'description'
						),
						array(
							'type' => 'autocomplete',
							'heading' => esc_html__( 'Select speakers', 'motors' ),
							'param_name' => 'lesson_speakers',
							'settings' => array(
								'multiple' => true,
								'sortable' => true,
								'min_length' => 1,
								'no_hide' => true,
								'unique_values' => true,
								'display_inline' => true,
								'values' => $speakers_data
							)
						),
					)
				)
			)
		) );

        vc_map( array(
            'html_template' => STM_EVENTS_PATH . '/vc_templates/stm_events.php',
            "name" => esc_html__('Stm Events', 'motors'),
            "base" => "stm_events",
            "content_element" => true,
            'category' => __('STM Magazine', 'motors'),
            "params" => array(
                array(
                    'type' => 'textfield',
                    'heading' => __('Title', 'motors'),
                    'param_name' => 'events_title',
                ),
            )
        ) );
	}
}

if (class_exists('WPBakeryShortCodesContainer')) {

	class WPBakeryShortCode_Stm_Schedule extends WPBakeryShortCodesContainer {
	}
}

if (class_exists('WPBakeryShortCode')) {

	class WPBakeryShortCode_Stm_Schedule_Item extends WPBakeryShortCode {
	}

    class WPBakeryShortCode_STM_Events extends WPBakeryShortCode
    {
    }

}

if(class_exists('WpbakeryShortcodeParams')) vc_add_shortcode_param('stm_datepicker_vc', 'stm_datepicker_vc_st', get_template_directory_uri() . '/inc/vc_extend/datepicker.js');
function stm_datepicker_vc_st($settings, $value)
{
	return '<div class="stm_datepicker_vc_field">'
		. '<input type="text" name="' . esc_attr($settings['param_name']) . '" class="stm_datepicker_vc wpb_vc_param_value wpb-textinput ' .
		esc_attr($settings['param_name']) . ' ' .
		esc_attr($settings['type']) . '_field" type="text" value="' . esc_attr($value) . '" />' .
		'</div>';
}

if(class_exists('WpbakeryShortcodeParams')) vc_add_shortcode_param('stm_timepicker_vc', 'stm_timepicker_vc_st', get_template_directory_uri() . '/inc/vc_extend/timepicker.js');
function stm_timepicker_vc_st($settings, $value)
{
	return '<div class="stm_timepicker_vc_field">'
		. '<input type="text" name="' . esc_attr($settings['param_name']) . '" class="stm_timepicker_vc wpb_vc_param_value wpb-textinput ' .
		esc_attr($settings['param_name']) . ' ' .
		esc_attr($settings['type']) . '_field" type="text" value="' . esc_attr($value) . '" />' .
		'</div>';
}