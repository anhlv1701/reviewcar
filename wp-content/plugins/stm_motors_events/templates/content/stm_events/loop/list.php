<?php
/**
 * Created by PhpStorm.
 * User: NDA
 * Date: 03.01.2018
 * Time: 10:38
 */

$id = get_the_ID();
$date_start = get_post_meta($id, 'date_start', true);
$date_start_time = get_post_meta($id, 'date_start_time', true);
$date_end_time = get_post_meta($id, 'date_end_time', true);
$address = get_post_meta($id, 'address', true);
$participants = get_post_meta($id, 'cur_participants', true);
$category = event_get_terms_array($id, 'event_category', 'name', false);
if(empty($participants)) $participants = 0;

$date = $time = '';
$date = (!empty($date_start)) ? motors_get_formatted_date($date_start) : '';

if(!empty($date_start_time)) $time .= $date_start_time;
if(!empty($date_end_time)) $time .= ' - ' . $date_end_time;

?>

<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" <?php echo esc_attr(post_class('stm_event_single_list no_deco')); ?>>
	<div class="events-list-img">
		<?php the_post_thumbnail('m-e-255-160');?>
	</div>
	<div class="stm-event-loop-data">
		<h3 class="top-content"><?php the_title(); ?></h3>
		<div class="middle-content">
			<?php if(isset($category[0])): ?>
				<div class="event-category normal-font">
					<?php echo $category[0];?>
				</div>
			<?php endif; ?>
			<?php if(!empty($date)): ?>
				<div class="event-loop-Date">
					<i class="me-ico_event_calendar"></i>
					<div><?php echo esc_attr($date); ?></div>
				</div>
			<?php endif; ?>
			<div class="event-loop-Address">
				<i class="me-ico_event_pin"></i>
				<div><?php echo sanitize_text_field($address); ?></div>
			</div>
		</div>
		<div class="bottom-content">
			<?php the_excerpt(); ?>
		</div>
	</div>
</a>