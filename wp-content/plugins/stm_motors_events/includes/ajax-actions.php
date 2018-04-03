<?php
/**
 * Created by PhpStorm.
 * User: NDA
 * Date: 03.01.2018
 * Time: 17:50
 */

function events_load_more_posts()
{
	$page = intval($_GET['page']);
	$per_page = intval($_GET['per_page']);
	$offset = $per_page * $page;

	$r = array(
		'content' => '',
		'page'    => $page + 1
	);

	$upcoming = $past = false;

	if (!empty($_GET['upcoming']) and events_check_string($_GET['upcoming'])) {
		$upcoming = true;
	}

	if (!empty($_GET['past']) and events_check_string($_GET['past'])) {
		$past = true;
	}

	$style = sanitize_text_field($_GET['style']);
	$post_type = sanitize_text_field($_GET['post_type']);

	$args = array(
		'post_type'      => $post_type,
		'posts_per_page' => $per_page,
		'offset'         => $offset,
		'orderby'        => 'meta_value_num',
		'meta_key'       => 'date_start',
		'order'          => 'ASC',
		'meta_query'     => array(
			'relation' => 'OR',
		),
	);

	if ($past) {
		$args['meta_query'][] = array(
			'key'     => 'date_start',
			'value'   => time(),
			'compare' => '<=',
		);
	}

	if ($upcoming) {
		$args['meta_query'][] = array(
			'key'     => 'date_start',
			'value'   => time(),
			'compare' => '>=',
		);
	}

	$q = new WP_Query($args);

	$total = $q->found_posts;
	if ($q->have_posts()) {
		$tpl = 'content/stm_events/loop/' . $style;
		ob_start();
		while ($q->have_posts()) {
			$q->the_post();
			stm_motors_events_load_template($tpl);
		}
		$r['content'] = ob_get_clean();
	}

	if ($total <= ($offset + $per_page)) {
		$r['page'] = null;
	}

	wp_reset_postdata();

	wp_send_json($r);
	exit;
}


add_action('wp_ajax_events_load_more_posts', 'events_load_more_posts');
add_action('wp_ajax_nopriv_events_load_more_posts', 'events_load_more_posts');