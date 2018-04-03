<?php
$id = get_the_ID();
$selectedCar = get_post_meta($id, 'review_car', true);
$thumb = get_the_post_thumbnail_url($selectedCar, 'm-r-255-160');

if(empty($thumb) && get_the_post_thumbnail_url($id, 'full') != null) {
    $thumb = get_the_post_thumbnail_url($id, 'm-r-255-160');
}

$startAt = get_post_meta($id, 'show_title_start_at', true);

$performance = get_post_meta($id, 'performance', true);
$comfort = get_post_meta($id, 'comfort', true);
$interior = get_post_meta($id, 'interior', true);
$exterior = get_post_meta($id, 'exterior', true);

$ratingSumm = (($performance + $comfort + $interior + $exterior) / 4);

$price = stm_listing_price_view(get_post_meta($selectedCar, 'stm_genuine_price', true));
$hwy = get_post_meta($selectedCar, 'highway_mpg', true);
$cwy = get_post_meta($selectedCar, 'sity_mpg', true);

$title = get_the_title();

if(!empty($selectedCar)) {
    $title = '<span>' . get_the_title($selectedCar) . '</span> ' . string_max_charlength($title, 55);
}
?>

<div class="col-md-3 col-sm-6 col-xs-12">
    <div class="review-archive-item">
        <div class="review-loop">
            <h5><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h5>
            <div class="img">
                <img src="<?php echo esc_url($thumb); ?>" />
                <div class="arrow-circle">
                    <i class="arrow"></i>
                </div>
            </div>
            <div class="middle_info <?php if($ratingSumm > 0) echo 'middle-rating'; ?>">
                <div class="car_info">
                    <?php if(!empty($startAt)): ?>
                        <div class="starting-at normal-font">
                            <?php echo esc_html__('Starting at', 'stm_motors_review'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="price heading-font">
                        <?php echo esc_html($price); ?>
                    </div>
                    <?php if(empty($startAt)): ?>
                        <div class="mpg normal-font">
                            <?php echo esc_html($hwy) . esc_html__('Hwy', 'stm_motors_review') . ' / ' . esc_html($cwy) . esc_html__('City', 'stm_motors_review'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if($ratingSumm > 0) :?>
                    <div class="rating">
                        <div class="rating-stars">
                            <i class="rating-empty"></i>
                            <i class="rating-color" style="width: <?php echo $ratingSumm * 20; ?>%;"></i>
                        </div>
                        <div class="rating-text heading-font">
                            <?php echo sprintf(esc_html__('%s out of 5.0', 'stm_motors_review'), round($ratingSumm, 1)); ?>
                        </div>
                        <div class="rating-details-popup">
                            <ul class="rating-params">
                                <li>
                                    <span class="normal-font"><?php echo esc_html__('Performance', 'stm_motors_review')?></span>
                                    <div class="rating-stars">
                                        <i class="rating-empty"></i>
                                        <i class="rating-color" style="width: <?php echo $performance * 20; ?>%;"></i>
                                    </div>
                                </li>
                                <li>
                                    <span class="normal-font"><?php echo esc_html__('Comfort', 'stm_motors_review')?></span>
                                    <div class="rating-stars">
                                        <i class="rating-empty"></i>
                                        <i class="rating-color" style="width: <?php echo $comfort * 20; ?>%;"></i>
                                    </div>
                                </li>
                                <li>
                                    <span class="normal-font"><?php echo esc_html__('Interior', 'stm_motors_review')?></span>
                                    <div class="rating-stars">
                                        <i class="rating-empty"></i>
                                        <i class="rating-color" style="width: <?php echo $interior * 20; ?>%;"></i>
                                    </div>
                                </li>
                                <li>
                                    <span class="normal-font"><?php echo esc_html__('Exterior', 'stm_motors_review')?></span>
                                    <div class="rating-stars">
                                        <i class="rating-empty"></i>
                                        <i class="rating-color" style="width: <?php echo $exterior * 20; ?>%;"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="no-review normal-font">
                        <?php echo esc_html__('No reviews for this Vehicle', 'stm_motors_review'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="excerpt normal-font">
                <?php the_excerpt_max_charlength(115); ?>
            </div>
        </div>
    </div>
</div>