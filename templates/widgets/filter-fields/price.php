<?php if ( empty( $instance['hide_price'] ) ) : ?>
	<div class="row">
        <?php
        // Would need to strip these fields out and hard code to be one drop down select box with the two and from value. Name would be something like filter-price-range-id. The value could be the id of an array key which contains the to and from values 
		<div class="form-group col-sm-6 col-xs-12">
			<?php if ( 'labels' == $input_titles ) : ?>
				<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_price_from"><?php echo esc_html__( 'Price from', 'preston' ); ?></label>
			<?php endif; ?>

			<input type="number" min="0" name="filter-price-from"
					<?php if ( 'placeholders' == $input_titles ) : ?>placeholder="<?php echo esc_html__( 'Price from', 'preston' ); ?>"<?php endif; ?>
			       class="form-control" value="<?php echo ! empty( $_GET['filter-price-from'] ) ? esc_attr( $_GET['filter-price-from'] ) : ''; ?>"
			       id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_price_from">
		</div><!-- /.form-group -->

		<div class="form-group col-sm-6 col-xs-12">
			<?php if ( 'labels' == $input_titles ) : ?>
				<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_price_to"><?php echo esc_html__( 'Price to', 'preston' ); ?></label>
			<?php endif; ?>

			<input type="number" min="0" name="filter-price-to"
					<?php if ( 'placeholders' == $input_titles ) : ?>placeholder="<?php echo esc_html__( 'Price to', 'preston' ); ?>"<?php endif; ?>
			       class="form-control" value="<?php echo ! empty( $_GET['filter-price-to'] ) ? esc_attr( $_GET['filter-price-to'] ) : ''; ?>"
			       id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_price_to">
		</div><!-- /.form-group -->
	</div>
<?php endif; ?>
