
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