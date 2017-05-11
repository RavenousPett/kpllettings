<?php
$title = '';
$atts  = array_merge( array(
	'ids'	=> '',
	'show_arrows' => '',
	'show_dots' => '',
	'autoplay' => '',
	'autoplay_timeout' => 10000,
), $atts);
extract( $atts );

if ( function_exists('apus_themer_autocomplete_options_helper') ) {
	$ids = apustheme_autocomplete_options_helper($ids);
	if (!empty($ids)) {
		$args = array(
			'post_type'         => 'property',
			'post_status'       => 'publish',
			'posts_per_page'    => -1,
			'post__in'          => $ids,
			'orderby'           => 'post__in'
		);
		$loop = new WP_Query($args);
		if ( $loop->have_posts() ):
		?>
			<div style="clear:both;"></div>
			<div class="owl-carousel" data-smallmedium="1" data-extrasmall="1" data-items="1" data-carousel="owl" data-pagination="<?php echo ($show_dots ? 'true' : 'false'); ?>" data-nav="<?php echo ($show_arrows ? 'true' : 'false'); ?>" data-autoplay="<?php echo ($autoplay ? 'true' : 'false'); ?>" data-autoplay_timeout="<?php echo trim($autoplay_timeout); ?>">
			<?php
			while ( $loop->have_posts() ) : $loop->the_post();
				$image_id = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'slider_image', true );
				$image_thumbnail_src = wp_get_attachment_image_src( $image_id, 'property-slider-thumbnail'  );
				$image = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'slider_image', true );

				?>
				<div class="property-slider-item">
					<div class="property-slider-item-image"><img src="<?php echo esc_url( $image ); ?>" alt=""></div>
					<div class="property-wrapper">
						<div class="container">
							<div class="item">
								<?php echo Realia_Template_Loader::load( 'properties/box' ); ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			endwhile;
			?>
			</div>
			<?php
		endif;

		wp_reset_query();
	}
}