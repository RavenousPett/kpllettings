<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="infobox">
	<a class="infobox-image" href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail( 'property-thumbnail' ); ?>

		<?php $price = Realia_Price::get_property_price(); ?>
		<?php if ( ! empty( $price ) ) : ?>
			<div class="infobox-content-price"><?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?></div>
		<?php endif; ?>
	</a>

	<div class="infobox-content">
		<div class="infobox-content-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>

		<div class="infobox-content-body">
			<div class="infobox-content-body-location">
				<?php echo Realia_Query::get_property_location_name(); ?>
			</div>

			<?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'lot_area', true ); ?>
			<?php if ( ! empty( $area ) ) : ?>
				<?php $area = Realia_Utilities::format_number( $area ); ?>
				<div class="infobox-content-body-area">
					<span><?php echo esc_html__( 'Area', 'preston' ); ?>: </span>
					<strong><?php echo esc_attr( $area ); ?> <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?></strong>
				</div>
			<?php endif; ?>

			<?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
			<?php if ( ! empty( $beds ) ) : ?>
				<div class="infobox-content-body-beds">
					<span><?php echo esc_html__( 'Beds', 'preston' ); ?>: </span>
					<strong><?php echo esc_attr( $beds ); ?></strong>
				</div>
			<?php endif; ?>

			<?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
			<?php if ( ! empty( $baths ) ) : ?>
				<div class="infobox-content-body-baths">
					<span><?php echo esc_html__( 'Baths', 'preston' ); ?>: </span>
					<strong><?php echo esc_attr( $baths ); ?></strong>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
