<?php

$id = get_the_ID();
$lat = get_post_meta($id, 'latitude', true);
$lng = get_post_meta($id, 'longitude', true);
$mapTitle = get_post_meta($id, 'map_title', true);

$pin_color = array(
	2 => 'main_color',
	3 => 'secondary_color'
);

$pin_color = "#ff0000";

$include_map = '';
if (!empty($lat) and !empty($lng)) $include_map = 'included'; ?>

<?php if (!empty($include_map)):
	wp_enqueue_script('stm_gmap');
	$motors_event_map = array(
		'lat' => $lat,
		'lng' => $lng,
	);
	wp_localize_script('motors_event_map','motors_event_map', $motors_event_map);
	wp_enqueue_script('motors_event_map', 'motors_events', STM_THEME_VERSION, false);
	?>
	<h4 class="map-title"><?php echo esc_html($mapTitle); ?></h4>
    <div id="gmap"></div>

<?php endif; ?>
