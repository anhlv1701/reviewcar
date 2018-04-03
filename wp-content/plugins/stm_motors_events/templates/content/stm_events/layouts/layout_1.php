<?php
$tpl = 'content/stm_events/single/';
$show_title_box = get_post_meta( $post_id, 'title', true );
?>

<?php if($show_title_box): ?>
	<h2 class="stm_single_event__title text-transform"><?php the_title(); ?></h2>
<?php endif; ?>

<?php stm_motors_events_load_template($tpl . '_top_content'); ?>

<?php stm_motors_events_load_template($tpl . '_map'); ?>

<div class="stm_single_event__content"><?php the_content(); ?></div>

<?php stm_motors_events_load_template($tpl . '_join_form'); ?>