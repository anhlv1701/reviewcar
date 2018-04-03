<?php
/**
 * Created by PhpStorm.
 * User: NDA
 * Date: 26.12.2017
 * Time: 14:43
 */

$post_id = get_the_ID();

$show_title_box = 'hide';

$title_style = '';

$title = get_the_title( $post_id );

$alignment                           = get_post_meta($post_id, 'alignment', true);
$title_style_h1                      = array();
$title_style_subtitle                = array();
$title_box_bg_color                  = get_post_meta( $post_id, 'title_box_bg_color', true );
$title_box_font_color                = get_post_meta( $post_id, 'title_box_font_color', true );
$title_box_line_color                = get_post_meta( $post_id, 'title_box_line_color', true );
$title_box_custom_bg_image           = get_post_meta( $post_id, 'title_box_custom_bg_image', true );
$sub_title                           = get_post_meta( $post_id, 'sub_title', true );
$breadcrumbs                         = get_post_meta( $post_id, 'breadcrumbs', true );
$breadcrumbs_font_color              = get_post_meta( $post_id, 'breadcrumbs_font_color', true );
$title_box_subtitle_font_color       = get_post_meta( $post_id, 'title_box_subtitle_font_color', true );
$sub_title_instead                   = get_post_meta($post_id, 'sub_title_instead', true);

/*Event data*/
$address = get_post_meta($post_id, 'address', true);
$numbers = get_post_meta($post_id, 'numbers', true);
$eventStartDate = get_post_meta($post_id, 'date_start', true);
$eventEndDate = get_post_meta($post_id, 'date_end', true);
$eventStartTime = get_post_meta($post_id, 'date_start_time', true);
$eventEndTime = get_post_meta($post_id, 'date_end_time', true);

	if( empty($alignment) || is_post_type_archive(stm_listings_post_type()) ) {
		$alignment = 'left';
	}


    if ( $title_box_bg_color ) {
		$title_style .= 'background-color: ' . $title_box_bg_color . ';';
	}

    if ( $title_box_font_color ) {
		$title_style_h1['font_color'] = 'color: ' . $title_box_font_color . ';';
	}

    if ( $title_box_subtitle_font_color ) {
		$title_style_subtitle['font_color'] = 'color: ' . $title_box_subtitle_font_color . ';';
	}

    if ( $title_box_custom_bg_image = wp_get_attachment_image_src( $title_box_custom_bg_image, 'full' ) ) {
		$title_style  .= "background-image: url('" . $title_box_custom_bg_image[0] . "');";
	}

	$show_title_box = get_post_meta( $post_id, 'title', true );
	if($show_title_box == 'hide') {
		$show_title_box = false;
	}else {
		$show_title_box = true;
	}

	$additional_classes = '';

	if(empty($sub_title) and empty($title_box_line_color)) {
		$additional_classes = ' small_title_box';
	}
	if( ($is_shop || $is_product || $is_product_category) && $breadcrumbs == 'show' ) {
		$additional_classes .= ' no_woo_padding';
	}


if ( $show_title_box ) {
	$disable_overlay = '';
?>
	<div class="stm-motors-event-header entry-header <?php echo esc_attr($alignment.$additional_classes.$disable_overlay); ?>" style="<?php echo $title_style; ?>">
		<div class="container">
			<div class="left">
				<div class="event-title">
					<h2 style="<?php echo implode( ' ', $title_style_h1 ); ?>">
						<span class="stm-event-blue"><?php echo esc_html__("Event: ", "stm_motors_events"); ?></span>
						<?php echo (!empty($sub_title_instead) and stm_is_motorcycle()) ? balanceTags( $sub_title_instead, true ) :  balanceTags( $title, true ); ?>
					</h2>
					<?php if($title_box_line_color): ?>
						<div class="colored-separator">
							<div class="first-long" <?php if(!empty($title_box_line_color)): ?> style="background-color: <?php echo esc_attr($title_box_line_color); ?>" <?php endif; ?>></div>
							<div class="last-short" <?php if(!empty($title_box_line_color)): ?> style="background-color: <?php echo esc_attr($title_box_line_color); ?>" <?php endif; ?>></div>
						</div>
					<?php endif; ?>
					<?php if( $sub_title && ! is_search() ){ ?>
						<div class="sub-title h5" style="<?php echo implode( ' ', $title_style_subtitle ); ?>"><?php echo balanceTags( $sub_title, true ); ?></div>
					<?php } ?>
				</div>
				<div class="event-data-header">
					<div class="event-date-wrap">
						<i class="me-ico_event_calendar"></i>
						<div class="event-date">
							<?php echo $eventStartDate; ?>
							<?php echo $eventEndDate; ?>
							<?php echo $eventStartTime; ?>
							<?php echo $eventEndTime; ?>
						</div>
					</div>
					<div class="event-location-wrap">
						<i class="me-ico_event_pin"></i>
						<div class="event-location">
							<?php echo $address; ?>
						</div>
					</div>
					<div class="event-phones-wrap">
						<i class="me-ico_event_phone"></i>
						<div class="event-phone">
							<?php echo $numbers; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="right">
				<div class="actions-block">
					<?php stm_motors_events_load_template('content/stm_events/single/_actions'); ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
	<!-- Breads -->
<?php
if ( $breadcrumbs != 'hide' ):
	if ( function_exists( 'bcn_display' ) ) { ?>
		<div class="stm_breadcrumbs_unit heading-font <?php echo esc_attr($blog_margin); ?>">
			<div class="container">
				<div class="navxtBreads">
					<?php bcn_display(); ?>
				</div>
			</div>
		</div>
	<?php }
endif;