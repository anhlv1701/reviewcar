<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

wp_enqueue_script('events-schedule');

$content = str_replace('[stm_schedule_item', '[stm_schedule_item stm_date_format="' . $stm_event_lesson_date_format . '" stm_time_format="' . $stm_event_lesson_time_format . '"', $content);

?>

<div class="stm_schedule stm_schedule_style_1">
    <div class="events_lessons_box">
        <?php echo wpb_js_remove_wpautop($content); ?>
    </div>
</div>