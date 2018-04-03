<?php
/**
 * Created by PhpStorm.
 * User: NDA
 * Date: 26.12.2017
 * Time: 10:27
 */


add_action('init', 'stm_motors_events_include_customizer');

function stm_motors_events_include_customizer()
{
	require_once __DIR__ . '/customizer/customizer.class.php';
}

function motors_events_wp_head()
{
	?>
	<script type="text/javascript">
        var stm_ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
	</script>
	<?php
}

add_action('wp_head', 'motors_events_wp_head');

function motors_get_VC_img($img_id, $img_size, $url = false)
{
	$image = '';
	if (!empty($img_id) and !empty($img_size)) {
		$img = wpb_getImageBySize(array(
			'attach_id'  => $img_id,
			'thumb_size' => $img_size,
		));

		if (!empty($img['thumbnail'])) {
			$image = $img['thumbnail'];

			if ($url) {
				$datas = array();
				preg_match( '/src="([^"]*)"/i', $image, $datas );
				if(!empty($datas[1])) {
					$image = $datas[1];
				} else {
					$image = '';
				}
			}
		}
	}

	return apply_filters('motors_get_VC_img', $image);
}

function motors_vc_post_type($post_type)
{
	$choices = array(
		esc_html__('Select', 'motors') => 0
	);
	if (is_admin()) {
		$posts = get_posts(array('post_type' => $post_type, 'posts_per_page' => -1));
		if ($posts) {
			foreach ($posts as $val) {
				$choices[get_the_title($val)] = $val->ID;
			}
		}
	}

	return apply_filters('motors_vc_post_type', $choices);
}

function events_pagination($pagination = array(), $defaults = array())
{
	$pagination['prev_text'] = '<i class="fa fa-chevron-left"></i>';
	$pagination['next_text'] = '<i class="fa fa-chevron-right"></i>';

	$pagination['type'] = 'array';

	$pagination = wp_parse_args($pagination, $defaults);

	$pagination = paginate_links($pagination);
	if (!empty($pagination)):
		$has_prev = '';
		$has_next = '';
		foreach ($pagination as $page) {
			if (strpos($page, 'prev page-numbers') !== false) $has_prev = 'stm_has_prev';
			if (strpos($page, 'next page-numbers') !== false) $has_next = 'stm_has_next';
		}


		ob_start();

		?>
		<ul class="page-numbers clearfix <?php echo esc_attr($has_prev . ' ' . $has_next) ?>">
			<?php foreach ($pagination as $key => $page):
				$class = 'stm_page_num';
				if (strpos($page, 'prev') !== false) $class = 'stm_prev';
				if (strpos($page, 'next') !== false) $class = 'stm_next';
				?>
				<li class="<?php echo esc_attr($class); ?>">
					<?php echo wp_kses_post($page); ?>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php $pagination = ob_get_clean();
	endif;

	return $pagination;
}

function event_get_terms_array($id, $taxonomy, $filter, $link = false, $args = '')
{
	$terms = wp_get_post_terms($id, $taxonomy);
	if (!is_wp_error($terms) and !empty($terms)) {
		if ($link) {
			$links = array();
			if (!empty($args)) $args = motors_array_as_string($args);
			foreach ($terms as $term) {
				$url = get_term_link($term);
				$links[] = "<a {$args} href='{$url}' title='{$term->name}'>{$term->name}</a>";
			}
			$terms = $links;
		} else {
			$terms = wp_list_pluck($terms, $filter);
		}
	} else {
		$terms = array();
	}

	return apply_filters('event_get_terms_array', $terms);
}

function event_sidebar_mode ($sidebarPosition) {
	$content_before = $content_after = $sidebar_before = $sidebar_after = '';

	if ($sidebarPosition == 'none') {
		$content_before .= '<div class="col-md-12">';

		$content_after .= '</div>';
	} else {
		if ($sidebarPosition == 'right') {
			$content_before .= '<div class="col-md-9 col-sm-12 col-xs-12"><div class="sidebar-margin-top clearfix"></div>';
			$sidebar_before .= '<div class="col-md-3 hidden-sm hidden-xs motors-sidebar">';

			$sidebar_after .= '</div>';
			$content_after .= '</div>';
		} elseif ($sidebarPosition == 'left') {
			$content_before .= '<div class="col-md-9 col-md-push-3 col-sm-12"><div class="sidebar-margin-top clearfix"></div>';
			$sidebar_before .= '<div class="col-md-3 col-md-pull-9 hidden-sm hidden-xs motors-sidebar">';

			$sidebar_after .= '</div>';
			$content_after .= '</div>';
		}
	}

	$return = array();
	$return['content_before'] = $content_before;
	$return['content_after'] = $content_after;
	$return['sidebar_before'] = $sidebar_before;
	$return['sidebar_after'] = $sidebar_after;

	return $return;
}

function stm_events_body_class_list($classes) {

	$eventsSidebarMode = get_theme_mod('events_archive_sidebar_position', 'none');
	$archivePageView = get_theme_mod('events_archive', 'list');
	if(isset($_GET['view_type'])) {
		$view = $_GET['view_type'];
	} else {
		$view = $archivePageView;
	}

	$classes[] = 'stm_motors_events_list no_margin sidebar_' . $eventsSidebarMode . ' event_' . $view;

	return $classes;
}

function stm_events_body_class_grid($classes) {
	$eventsSidebarMode = get_theme_mod('events_archive_sidebar_position', 'none');
	$archivePageView = get_theme_mod('events_archive', 'list');
	if(isset($_GET['view_type'])) {
		$view = $_GET['view_type'];
	} else {
		$view = $archivePageView;
	}

	$classes[] = 'stm_motors_events_grid sidebar_' . $eventsSidebarMode . ' event_' . $view;

	return $classes;
}

function stmJSVars() {
    ?>
    <script type="text/javascript">
        var countdownDay = '<?php echo esc_html__("Day", "stm_motors_events"); ?>';
        var countdownHrs = '<?php echo esc_html__("Hrs", "stm_motors_events"); ?>';
        var countdownMin = '<?php echo esc_html__("Min", "stm_motors_events"); ?>';
        var countdownSec = '<?php echo esc_html__("Sec", "stm_motors_events"); ?>';
    </script>
    <?php
}

add_action('wp_footer', 'stmJSVars');