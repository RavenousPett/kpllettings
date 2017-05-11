<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $property = isset( $property ) ? $property : get_post(); ?>

<?php
    $is_sticky = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'sticky', true );

    $latitude = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'map_location_latitude', true );
    $longitude = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'map_location_longitude', true );

    $content = str_replace( array( "\r\n", "\n", "\t" ), '', Realia_Template_Loader::load( 'misc/google-map-infowindow' ) );
    $marker_content = str_replace( array( "\r\n", "\n", "\t" ), '', Realia_Template_Loader::load( 'misc/google-map-marker' ) );
?>

<div class="property-box property-box-style1" data-latitude="<?php echo esc_attr($latitude); ?>" data-longitude="<?php echo esc_attr($longitude); ?>">
    <div class="property-map-content-wrapper hidden">
        <div class="property-map-content">
            <?php echo trim($content); ?>
        </div>
        <div class="property-map-marker">
            <?php echo trim($marker_content); ?>
        </div>
    </div>
    <div class="property-box-image <?php if ( ! has_post_thumbnail( $property ) ) { echo 'without-image'; } ?>">
        <a href="<?php the_permalink(); ?>" class="property-box-image-inner <?php if ( ! empty( $agent ) ) : ?>has-agent<?php endif; ?>">
			<?php
	        /**
	         * realia_before_property_box_image
	         */
	        do_action( 'realia_before_property_box_image', $property->ID );
	        ?>

            <?php if ( has_post_thumbnail( $property ) ) : ?>
				<?php echo get_the_post_thumbnail( $property, 'property-special1-thumbnail' ); ?>
            <?php endif; ?>
            <span class="meta-top">
    			<?php
    	        /**
    	         * realia_after_property_box_image
    	         */
    	        do_action( 'realia_after_property_box_image', $property->ID );
    	        ?>

    	        <?php $contract = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'contract', true ); ?>
    	        <?php if ($contract): ?>
    	        	<span class="property-badge property-badge-contract"><?php echo trim($contract); ?></span>
    	        <?php endif; ?>

                <?php $is_featured = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'featured', true ); ?>
                <?php $is_reduced = get_post_meta( $property->ID, REALIA_PROPERTY_PREFIX . 'reduced', true ); ?>

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
        </a>
        <div class="property-box-absolute">
            <div class="property-box-content clearfix">
    	        <div class="property-box-title">
    		        
    	            <h3 class="entry-title"><a href="<?php the_permalink( $property ); ?>"><?php echo get_the_title( $property ) ?></a></h3>

                    <?php $location = Realia_Query::get_property_location_name( null, ',' ); ?>
                    <?php if ( ! empty( $location ) ) : ?>
                        <div class="property-row-location">
                            <i class="fa fa-map-marker" aria-hidden="true"></i><?php echo wp_kses( $location, wp_kses_allowed_html( 'post' ) ); ?>
                        </div>
                    <?php endif; ?>
    	        </div><!-- /.property-box-title -->

    	        <?php $price = Realia_Price::get_property_price( $property->ID ); ?>
    	        <?php if ( ! empty( $price ) ) : ?>
    	            <div class="property-box-price">
                        <div class="property-price">
    	                   <?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?>
                        </div>
    	            </div><!-- /.property-box-price -->
    	        <?php endif; ?>

    	    </div><!-- /.property-box-content -->

    	    <div class="property-box-meta clearfix">
                <?php $home_area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
                <?php if ( ! empty( $home_area ) ) : ?>
                    <div class="field-item" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__( 'Area', 'preston' ); ?>">
                        <i class="fa fa-arrows"></i>
                        <?php echo esc_attr( $home_area ); ?> <?php echo get_theme_mod( 'realia_measurement_area_unit', null ); ?>
                    </div>
                <?php endif; ?>

                <?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
                <?php if ( ! empty( $beds ) ) : ?>
                    <div class="field-item" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__( 'Beds', 'preston' ); ?>">
                        <i class="fa fa-bed"></i>
                        <?php echo esc_attr( $beds ); ?> <?php echo esc_html__( 'Beds', 'preston' ); ?>
                    </div>
                <?php endif; ?>

                <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
                <?php if ( ! empty( $baths ) ) : ?>
                    <div class="field-item" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__( 'Baths', 'preston' ); ?>">
                        <i class="fa fa-bath"></i>
                        <?php echo esc_attr( $baths ); ?> <?php echo esc_html__( 'Baths', 'preston' ); ?>
                    </div>
                <?php endif; ?>

                <?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'garages', true ); ?>
                <?php if ( ! empty( $garages ) ) : ?>
                    <div class="field-item last-childen" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__( 'Garages', 'preston' ); ?>">
                        <i class="fa fa-car"></i>
                        <?php echo esc_attr( $garages ); ?> <?php echo esc_html__( 'Garages', 'preston' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div><!-- /.property-image -->
</div>