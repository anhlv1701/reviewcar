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

<a href="<?php the_permalink(); ?>"
   title="<?php the_title(); ?>"
	<?php echo esc_attr(post_class('stm_event_single_grid no_deco')); ?>>
	<div class="events-grid-img">
		<?php the_post_thumbnail('m-e-1110-580');?>
	</div>
	<div class="stm-event-loop-data">
		<div class="left">
			<?php if(isset($category[0])): ?>
			<div class="event-category heading-font">
				<?php echo $category[0];?>
			</div>
			<?php endif; ?>
			<h3 class="ttc"><?php the_title(); ?></h3>
			<?php if(!empty($date)): ?>
				<div class="event-loop-Date">
					<i class="me-ico_event_calendar"></i>
					<div><?php echo esc_attr($date); ?></div>
				</div>
			<?php endif; ?>
			<div class="event-loop-Address">
				<i class="me-ico_event_pin"></i>
				<?php echo sanitize_text_field($address); ?>
			</div>
		</div>
		<div class="right">
			<div class="event-loop-Participants">
				<i class="me-ico_event_participants"></i>
				<span class="stm_single_event_part-label event-btn-font">
					<?php echo esc_attr($participants); ?>
				</span>
			</div>
		</div>
	</div>
</a>