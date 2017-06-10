<?php $floor = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'epc', true ); ?>
<?php if ( ! empty( $floor ) ) : ?>
	<div class="property-floor-index">
		<h3><?php echo esc_html__('EPC', 'preston'); ?></h3>
		<div class="owl-carousel" data-smallmedium="4" data-extrasmall="4" data-items="4" data-carousel="owl" data-pagination="false" data-nav="true">
			<?php foreach ( $floor as $id => $src ) : ?>
				<a rel="<?php echo esc_url( $src ); ?>" href="<?php echo esc_url( $src ); ?>" class="image-popup">
					<?php echo wp_get_attachment_image( $id, 'property-thumbnail' ); ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div><!-- /.property-gallery-list -->
<?php endif; ?>
