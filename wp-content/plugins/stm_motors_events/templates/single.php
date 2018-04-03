<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header();?>
<?php stm_motors_events_load_template('header/title_box'); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="stm-single-post">
			<div class="container">
				<?php if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						stm_motors_events_load_template('content/stm_events/single/main');
					endwhile;
				endif; ?>
			</div>
		</div>
	</div>
<?php get_footer();?>