<?php
$archivePageView = get_theme_mod('events_archive', 'list');
$eventsPagination = get_theme_mod('events_archive_paginatin_style', 'pagination');
$eventsPerPage = get_theme_mod('events_per_page', 6);
$eventsSidebarMode = get_theme_mod('events_archive_sidebar_position', 'none');

if(isset($_GET['view_type'])) {
	$view = $_GET['view_type'];
} else {
	$view = $archivePageView;
}

add_filter('body_class', 'stm_events_body_class_' . $view);

$sidebarMode = event_sidebar_mode($eventsSidebarMode);

$paged = (get_query_var('page')) ? get_query_var('page') : 1;

$tax = get_term_by('id', get_queried_object()->term_id, 'event_category');
if($tax) {
	$taxQuery = array(
		'taxonomy' => $tax->taxonomy,
		'field'    => 'slug',
		'terms'    => $tax->slug,
	);
} else {
	$tax = get_term_by('id', get_queried_object()->term_id, 'event_tag');
	$taxQuery = array(
		'taxonomy' => $tax->taxonomy,
		'field'    => 'slug',
		'terms'    => $tax->slug,
	);
}

$args = array(
	'post_type'      => 'stm_events',
	'posts_per_page' => $eventsPerPage,
	'paged'          => $paged,
	'post_status'    => array('publish', 'future'),
	'orderby'        => 'meta_value_num',
	'meta_key'       => 'date_start',
	'order'          => 'ASC',
	'tax_query' => array(
		$taxQuery
	),
);

$classes = ($view == 'list') ? array('stm_events_list') : array('stm_events_grid');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = ($view == 'list') ? 'stm_events_list_style_1' : 'stm_events_grid_style_1';

$q = new WP_Query($args);

if($view == 'list') {
	$uniq = uniqid('stm_events_list');
	$titleBoxTpl = 'header/title_box_archive_list';
} else {
	$uniq = uniqid('stm_events_grid');
}

$tpl = 'content/stm_events/loop/' . $view;

get_header();

if($view === 'grid') {
	stm_motors_events_load_template('header/title_box_archive_grid');
}
stm_motors_events_load_template('header/breadcrumbs');

?>
	<div class="container <?php echo esc_attr($uniq); ?>">
		<div class="row">
			<?php
			echo $sidebarMode['content_before'];

			if($view === 'list') {
				stm_motors_events_load_template('header/title_box_archive_list');
			}

			if ($q->have_posts()): ?>
				<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
					<?php while ($q->have_posts()): $q->the_post(); ?>
						<?php stm_motors_events_load_template($tpl); ?>
					<?php endwhile; ?>
					<div class="stm-events-load-block"></div>
				</div>

				<?php
				if ($q->found_posts > $eventsPerPage):
					if ($eventsPagination === 'pagination') {
						echo events_pagination(
							array(
								'type'    => 'list',
								'format'  => '?page=%#%',
								'current' => $paged,
								'total'   => $q->max_num_pages,
							)
						);
					} else {
						?>

						<div class="container event-load-more-btn-wrap">
							<a href="#"
							   data-page="1"
							   data-per_page="<?php echo esc_js($eventsPerPage); ?>"
							   data-style="<?php echo esc_js($view); ?>"
							   data-view="<?php echo esc_js($view); ?>"
							   data-post_type="stm_events"
							   class="btn event-btn-bg btn_loading stm_load_posts">
								<span><?php esc_html_e('Load more events', 'stm_motors_events'); ?></span>
								<span class="preloader"></span>
							</a>
						</div>
						<?php
					}
				endif;
				wp_reset_postdata();
			endif;

			echo $sidebarMode['content_after'];

			if(isset($sidebarMode['sidebar_before']) && $sidebarMode['sidebar_before'] != "") {
				echo $sidebarMode['sidebar_before'];

				dynamic_sidebar('events_sidebar');

				echo $sidebarMode['sidebar_after'];
			}
			?>
		</div>
	</div>
<?php
get_footer();
?>