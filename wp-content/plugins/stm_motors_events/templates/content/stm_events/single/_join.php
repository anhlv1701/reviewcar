<?php
$id = get_the_ID();
$participants = get_post_meta($id, 'cur_participants', true);
$max_participants = get_post_meta($id, 'participants_num', true);

if(empty($participants)) $participants = 0;

if($participants < $max_participants): ?>
<div class="event-join-btn-wrap">
    <a href="#stm_event_<?php echo intval($id); ?>"
       class="btn event-btn-bg event-head">
        <?php esc_html_e('Book your stand', 'stm_motors_events'); ?>
    </a>
	<span class="stm_single_event_part-label event-btn-font">
		<?php echo esc_attr($participants); ?>
	</span>
</div>
<?php endif;