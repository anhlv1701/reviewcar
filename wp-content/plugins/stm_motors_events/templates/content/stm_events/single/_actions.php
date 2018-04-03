<?php
wp_enqueue_script('motors_events_addtocalendar');
$id = get_the_ID();
$address = get_post_meta($id, 'address', true);

$date_start = get_post_meta($id, 'date_start', true);
$date_start_time = get_post_meta($id, 'date_start_time', true);
$date_end = get_post_meta($id, 'date_end', true);
$date_end_time = get_post_meta($id, 'date_end_time', true);

$timezone = (get_option('timezone_string')) ? get_option('timezone_string') : esc_html__('Europe/London', 'stm_motors_events');
?>

<div class="stm_mgb_50 stm_single_event__actions">
    <?php if (!empty($date_start) and !empty($date_start_time) and !empty($date_end) and !empty($date_end_time)): ?>
    <div class="stm_single_event__calendar stm_mgr_15">
        <a href="#"
           data-toggle="false"
           data-element=".stm_single_event__calendar"
           class="btn event-btn-outline event-head js_trigger__click">
            <?php esc_html_e('Save to calendar', 'stm_motors_events'); ?>
        </a>

        <span class="addtocalendar atc-style-blue">
            <var class="atc_event hidden">
                <var class="atc_date_start"><?php echo motors_get_formatted_date($date_start, 'Y-m-d'); ?><?php echo sanitize_text_field($date_start_time); ?></var>
                <var class="atc_date_end"><?php echo motors_get_formatted_date($date_end, 'Y-m-d'); ?><?php echo sanitize_text_field($date_end_time); ?></var>
                <var class="atc_timezone"><?php echo sanitize_text_field($timezone); ?></var>
                <var class="atc_title"><?php the_title(); ?></var>
                <var class="atc_location"><?php echo sanitize_text_field($address); ?></var>
            </var>
        </span>
    </div>
    <?php endif; ?>

    <?php stm_motors_events_load_template('content/stm_events/single/_join'); ?>
</div>
