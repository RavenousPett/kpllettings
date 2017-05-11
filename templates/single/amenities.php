<?php $amenities = get_categories( array(
	'taxonomy' 		=> 'amenities',
	'hide_empty' 	=> false,
) ); ?>

<?php $hide = get_theme_mod( 'realia_general_hide_unassigned_amenities', false ); ?>
<?php if ( ! empty( $amenities ) ) : ?>
    <div class="property-section property-amenities">
        <h3><?php echo esc_html__('Amenities', 'preston'); ?></h3>
        <ul class="columns-gap list-check">
            <?php foreach ( $amenities as $amenity ) : ?>
                <?php $has_term = has_term( $amenity->term_id, 'amenities' ); ?>

                <?php if ( ! $hide || ( $hide  && $has_term ) ) : ?>
                    <li <?php if ( $has_term ) : ?>class="yes"<?php else : ?>class="no"<?php endif; ?>><?php echo esc_html( $amenity->name ); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div><!-- /.property-amenities -->
<?php endif; ?>