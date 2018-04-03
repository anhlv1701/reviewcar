<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$events = new WP_Query(array(
    'post_type' => 'stm_events',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'ignore_sticky_posts' => true
));

if($events->have_posts()) {

    $firstPost = $events->get_posts();
    $firstPost = $firstPost[0];

    $id = $firstPost->ID;

    $date_start = get_post_meta($id, 'date_start', true);
    $date_start_time = get_post_meta($id, 'date_start_time', true);
    $date_end = get_post_meta($id, 'date_end', true);
    $date_end_time = get_post_meta($id, 'date_end_time', true);
    $address = get_post_meta($id, 'address', true);
    $participants = get_post_meta($id, 'cur_participants', true);
    $category = event_get_terms_array($id, 'event_category', 'name', false);

    if(empty($participants)) $participants = 0;

    $date_prev = (!empty($date_start)) ? motors_get_formatted_date($date_start, 'd M Y') : '';

    /*Countdown*/

    $timeFormatCountdown = motors_get_formatted_date(strtotime($date_end_time), 'H:i:s');
    $dateCountdown = motors_get_formatted_date($date_end, 'Y-m-d ') . $timeFormatCountdown;

    /*Countdown*/

    if(!empty($date_start_time)) $time .= $date_start_time;
    if(!empty($date_end_time)) $time .= ' - ' . $date_end_time;
}
?>
<div class="stm-events-wrap">
    <div class="events-top">
        <h2>
            <?php echo $events_title; ?>
        </h2>
    </div>
    <div id="eventsMiddle" class="events-middle">
        <div class="events-list">
            <?php
            if($events->have_posts()){
                while ($events->have_posts()) {
                    $events->the_post();

                    get_template_part("partials/vc_loop/event_loop");
                }
            }
            ?>
        </div>
        <div class="event-content">
            <div class="title">
                <h3><?php echo $firstPost->post_title; ?></h3>
            </div>
            <div class="event-data">
                <div class="address">
                    <i class="me-ico_event_pin"></i>
                    <div><?php echo $address; ?></div>
                </div>
                <div class="date">
                    <i class="stm-icon-ico_mag_calendar"></i>
                    <div><?php echo $date_prev; ?></div>
                </div>
                <div class="time">
                    <i class="me-ico_event_clock"></i>
                    <div><?php echo $time; ?></div>
                </div>
            </div>
            <div class="event-single-wrap">
                <div class="img">
                    <?php echo get_the_post_thumbnail($id, 'stm-img-690-410'); ?>
                </div>
                <div class="timer">
                    <div class="stm-countdown-wrapper">
                        <time class="heading-font" datetime="<?php echo $dateCountdown ?>"  data-countdown="<?php echo str_replace( "-", "/", $dateCountdown ); ?>" ></time>
                    </div>
                </div>
                <div class="timer timerFullHeight">
                    <div class="stm-countdown-wrapper">
                        <time class="heading-font" datetime="<?php echo $dateCountdown ?>"  data-countdown="<?php echo str_replace( "-", "/", $dateCountdown ); ?>" ></time>
                    </div>
                </div>
                <div class="participants">
                    <i class="me-ico_profile"></i>
                    <div class="prticipants_count heading-font">
                        <?php echo $participants; ?>
                    </div>
                </div>
                <div class="event_more_btn">
                    <a href="<?php echo esc_url(get_the_permalink($id)); ?>" class="stm-button"><?php echo esc_html__('More Details', 'stm_motors_events'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_reset_postdata(); ?>
