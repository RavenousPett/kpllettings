<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $property = isset( $property ) ? $property : get_post(); ?>

<?php $is_sticky = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>

<div class="property-box property-box-style">
    <div class="property-box-image <?php if ( ! has_post_thumbnail( $property ) ) { echo 'without-image'; } ?>">
        <a href="<?php the_permalink(); ?>" class="property-box-image-inner <?php if ( ! empty( $agent ) ) : ?>has-agent<?php endif; ?>">
			<?php
	        /**
	         * realia_before_property_box_image
	         */
	        do_action( 'realia_before_property_box_image', $property->ID );
	        ?>

            <?php if ( has_post_thumbnail( $property ) ) : ?>
				<?php echo get_the_post_thumbnail( $property, 'property-box-thumbnail' ); ?>
            <?php endif; ?>

			<?php
	        /**
	         * realia_after_property_box_image
	         */
	        do_action( 'realia_after_property_box_image', $property->ID );
	        ?>
        </a>
    </div><!-- /.property-image -->
    <div class="property-box-content">
        <div class="property-box-title-wrap">
            <?php $type = Realia_Query::get_property_type_name(); ?>
            <?php if ( ! empty( $type ) ) : ?>
                <div class="type-property"><?php echo esc_attr( $type ); ?></div>
            <?php endif; ?>
	        <h3 class="property-box-title"><a href="<?php the_permalink( $property ); ?>"><?php echo get_the_title( $property ) ?></a></h3>
            <?php $price = Realia_Price::get_property_price( $property->ID ); ?>
	        <?php if ( ! empty( $price ) ) : ?>
	            <div class="property-box-price">
	                <?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?>
	            </div><!-- /.property-box-price -->
	        <?php endif; ?>

        </div><!-- /.property-box-title -->
    </div><!-- /.property-box-content -->
</div>
