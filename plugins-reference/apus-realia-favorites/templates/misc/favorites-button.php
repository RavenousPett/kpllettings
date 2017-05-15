<?php if ( ApusRealiaFavorites_Favorites::is_my_favorite( $property_id ) ) : ?>
    <a href="#" class="apus-realia-favorites-btn-toggle heart marked" data-property-id="<?php echo esc_attr($property_id); ?>" data-ajax-url="<?php echo admin_url( 'admin-ajax.php' ); ?>">
        <i class="fa fa-heart-o"></i> <span data-toggle="<?php echo esc_html__( 'Add to favorites', 'apus-realia-favorites' ); ?>"><?php echo esc_html__( 'I Love It', 'apus-realia-favorites' ); ?></span>
    </a><!-- /.apus-realia-favorites-btn-toggle -->
<?php else: ?>
    <a href="#" class="apus-realia-favorites-btn-toggle heart" data-property-id="<?php echo esc_attr($property_id); ?>" data-ajax-url="<?php echo admin_url( 'admin-ajax.php' ); ?>">
        <i class="fa fa-heart-o"></i> <span data-toggle="<?php echo esc_html__( 'I Love It', 'apus-realia-favorites' ); ?>"><?php echo esc_html__( 'Add to favorites', 'apus-realia-favorites' ); ?></span>
    </a><!-- /.apus-realia-favorites-btn-toggle -->
<?php endif ; ?>