
<div class="header-info clearfix">
	<div class="header-left pull-left">
		<!-- breadscrumb -->
		<?php the_title( '<h1 class="entry-title property-title">', '</h1>' ); ?>


		<?php $location = Realia_Query::get_property_location_name( null, "," ); ?>
        <?php if ( ! empty ( $location ) ) : ?>
        	<div class="address">
        		<i class="fa fa-map-marker" aria-hidden="true"></i><?php echo wp_kses( $location, wp_kses_allowed_html( 'post' ) ); ?>
            </div>
        <?php endif; ?>

        <span class="meta-top property-meta-tags">
            <?php
            /**
             * realia_after_property_box_image
             */
            do_action( 'realia_after_property_box_image', get_the_ID() );
            ?>

            <?php $contract = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'contract', true ); ?>
            <?php if ($contract): ?>
                <span class="property-badge property-badge-contract"><?php echo trim($contract); ?></span>
            <?php endif; ?>

            <?php $is_featured = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'featured', true ); ?>
            <?php $is_reduced = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'reduced', true ); ?>

            <?php if ( $is_featured && $is_reduced ) : ?>
                <span class="property-badge"><?php echo esc_html__( 'Featured', 'preston' ); ?> / <?php echo esc_html__( 'Reduced', 'preston' ); ?></span>
            <?php elseif ( $is_featured ) : ?>
                <span class="property-badge"><?php echo esc_html__( 'Featured', 'preston' ); ?></span>
            <?php elseif ( $is_reduced ) : ?>
                <span class="property-badge"><?php echo esc_html__( 'Reduced', 'preston' ); ?></span>
            <?php endif; ?>

            <?php if ( $is_sticky ) : ?>
                <span class="property-badge property-badge-sticky"><?php echo esc_html__( 'TOP', 'preston' ); ?></span>
            <?php endif; ?>
        </span>

	</div>
	<div class="header-right pull-right">
		<div class="price">
			<?php $price = Realia_Price::get_property_price(); ?>
			<?php if ( ! empty( $price ) ) : ?>
				<?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?>
			<?php endif; ?>
		</div>

	</div>
</div>
