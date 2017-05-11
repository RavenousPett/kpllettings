<?php $gallery = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'gallery', true ); ?>

<?php if ( ! empty( $gallery ) ) : ?>
	<div class="property-gallery-list">
		<h3><?php echo esc_html__('Gallery', 'preston'); ?></h3>
		<div class="row">
			<?php foreach ( $gallery as $id => $src ) : ?>
				<div class="col-md-2 col-sm-3 col-xs-4">
					<a rel="gallery" href="<?php echo esc_url( $src ); ?>" class="image-popup">
						<?php echo wp_get_attachment_image( $id, 'property-thumbnail' ); ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div><!-- /.property-gallery-list -->
<?php endif; ?>