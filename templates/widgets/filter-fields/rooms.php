<?php if ( empty( $instance['hide_rooms'] ) ) : ?>
	<?php if ( empty( $instance['hide_rooms'] ) ) : ?>
		<div class="form-group ">
			<div class="over-width">
			<?php if ( 'labels' == $input_titles ) : ?>
				<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_baths"><?php echo esc_html__( 'Rooms', 'preston' ); ?></label>
			<?php endif; ?>

			<select name="filter-rooms"
					id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>-rooms"
					class="form-control">
				<option value="">
					<?php if ( 'placeholders' == $input_titles ) : ?>
						<?php echo esc_html__( 'Rooms: any', 'preston' ); ?>
					<?php else : ?>
						<?php echo esc_html__( 'Any', 'preston' ); ?>
					<?php endif; ?>
				</option>

				<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
					<option value="<?php echo esc_attr( $i ); ?>" <?php if ( ! empty( $_GET['filter-rooms'] ) && $_GET['filter-rooms'] == $i ) : ?>selected="selected"<?php endif; ?>>
						<?php echo esc_attr( $i ); ?>+
					</option>
				<?php endfor; ?>
			</select>
			</div>
		</div><!-- /.form-group -->
	<?php endif; ?>
<?php endif; ?>
