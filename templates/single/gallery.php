<?php $gallery = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'gallery', true ); ?>

<?php if ( ! empty( $gallery ) ) : ?>
	<div class="property-gallery">
		<div class="property-gallery-preview property-box-image-inner">
			<?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>
            <?php if ( $is_sticky ) : ?>
            	<span class="meta-top">
                	<span class="property-badge property-badge-sticky"><?php echo esc_html__( 'TOP', 'preston' ); ?></span>
                </span>
            <?php endif; ?>

			<div class="owl-carousel property-gallery-preview-owl" data-smallmedium="1" data-extrasmall="1" data-items="1" data-carousel="owl" data-pagination="false" data-nav="true">
				<?php foreach ( $gallery as $id => $src ) : ?>
					<?php echo wp_get_attachment_image( $id , 'full' );?>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="owl-carousel property-gallery-index" data-smallmedium="5" data-extrasmall="3" data-items="6" data-carousel="owl" data-pagination="false" data-nav="true">
			<?php $index = 0; ?>
			<?php foreach ( $gallery as $id => $src ) : ?>
				<div <?php echo ( 0 == $index ) ? 'class="active thumb-link"' : 'class="thumb-link"'; ?>>
					<a rel="<?php echo esc_url( $src ); ?>" href="<?php echo esc_url( $src ); ?>">
						<?php echo wp_get_attachment_image( $id, 'thumbnail' ); ?>
					</a>
					<?php $index++; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div><!-- /.property-gallery -->
<?php endif; ?>