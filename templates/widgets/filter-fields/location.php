<?php if ( empty( $instance['hide_location'] ) ) : ?>
	<?php if ( 'single-select' == get_theme_mod( 'realia_filter_location_field_type', 'single-select' ) ) : ?>
		<div class="form-group">
			<div class="over-width">
			<?php if ( 'labels' == $input_titles ) : ?>
				<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_location"><?php echo esc_html__( 'Location', 'preston' ); ?></label>
			<?php endif; ?>

			<select class="form-control" name="filter-location" id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_location">
				<option value="">
					<?php if ( 'placeholders' == $input_titles ) : ?>
						<?php echo esc_html__( 'Location', 'preston' ); ?>
					<?php else : ?>
						<?php echo esc_html__( 'All locations', 'preston' ); ?>
					<?php endif; ?>
				</option>

				<?php $locations = get_terms( 'locations', array(
					'hide_empty' 	=> false,
					'parent'		=> 0,
				) ); ?>

				<?php if ( is_array( $locations ) ) : ?>
					<?php foreach ( $locations as $location ) : ?>
						<option value="<?php echo esc_attr( $location->term_id ); ?>" <?php if ( ! empty( $_GET['filter-location'] ) && $_GET['filter-location'] == $location->term_id ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( $location->name ); ?></option>

						<?php $sublocations = get_terms( 'locations', array(
							'hide_empty'    => false,
							'parent'        => $location->term_id,
						) ); ?>

						<?php if ( is_array( $sublocations ) ) : ?>
							<?php foreach ( $sublocations as $sublocation ) : ?>
								<option value="<?php echo esc_attr( $sublocation->term_id ); ?>" <?php if ( ! empty( $_GET['filter-location'] ) && $_GET['filter-location'] == $sublocation->term_id ) : ?>selected="selected"<?php endif; ?>>
									&raquo;&nbsp; <?php echo esc_html( $sublocation->name ); ?>
								</option>

								<?php $subsublocations = get_terms( 'locations', array(
									'hide_empty' 	=> false,
									'parent' 		=> $sublocation->term_id,
								) ); ?>

								<?php if ( is_array( $subsublocations ) ) : ?>
									<?php foreach ( $subsublocations as $subsublocation ) : ?>
										<option value="<?php echo esc_attr( $subsublocation->term_id ); ?>" <?php if ( ! empty( $_GET['filter-location'] ) && $_GET['filter-location'] == $subsublocation->term_id ) : ?>selected="selected"<?php endif; ?>>
											&nbsp;&nbsp;&nbsp;&raquo;&nbsp; <?php echo esc_html( $subsublocation->name ); ?>
										</option>
									<?php endforeach; ?>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
			</div>
		</div><!-- /.form-group -->
	<?php else: ?>
		<?php $ajax_url = admin_url( 'admin-ajax.php' ); ?>

		<div class="form-group">
			<div class="over-width">
			<?php if ( 'labels' == $input_titles ) : ?>
				<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_location"><?php echo esc_html__( 'Location', 'preston' ); ?></label>
			<?php endif; ?>

			<select class="form-control" name="filter-location" id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_location">
				<option value="">
					<?php if ( 'placeholders' == $input_titles ) : ?>
						<?php echo esc_html__( 'Location', 'preston' ); ?>
					<?php else : ?>
						<?php echo esc_html__( 'All locations', 'preston' ); ?>
					<?php endif; ?>
				</option>

				<?php $locations = get_terms( 'locations', array(
					'hide_empty' 	=> false,
					'parent'		=> 0,
				) ); ?>

				<?php if ( is_array( $locations ) ) : ?>
					<?php foreach ( $locations as $location ) : ?>
						<option value="<?php echo esc_attr( $location->term_id ); ?>" <?php if ( ! empty( $_GET['filter-location'] ) && $_GET['filter-location'] == $location->term_id ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( $location->name ); ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
			</div>
		</div><!-- /.form-group -->

		<div class="form-group">
			<div class="over-width">
			<?php if ( 'labels' == $input_titles ) : ?>
				<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_location"><?php echo esc_html__( 'Sublocation', 'preston' ); ?></label>
			<?php endif; ?>

			<select class="form-control"
					name="filter-sublocation"
					data-ajax-url="<?php echo trim($ajax_url); ?>"
					data-ajax-action="realia_select_chain_location_options"
					data-selected="<?php echo empty( $_GET['filter-sublocation'] ) ? '' : esc_attr( $_GET['filter-sublocation'] ); ?>"
					id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_sublocation">
				<option value="">
					<?php if ( 'placeholders' == $input_titles ) : ?>
						<?php echo esc_html__( 'Sublocation', 'preston' ); ?>
					<?php else : ?>
						<?php echo esc_html__( 'All sublocations', 'preston' ); ?>
					<?php endif; ?>
				</option>
			</select>
			</div>
		</div><!-- /.form-group -->

		<div class="form-group">
			<div class="over-width">
			<?php if ( 'labels' == $input_titles ) : ?>
				<label for="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_location"><?php echo esc_html__( 'Subsublocation', 'preston' ); ?></label>
			<?php endif; ?>

			<select class="form-control"
					name="filter-subsublocation"
					data-ajax-url="<?php echo trim($ajax_url); ?>"
					data-ajax-action="realia_select_chain_location_options"
					data-selected="<?php echo empty( $_GET['filter-subsublocation'] ) ? '' : esc_attr( $_GET['filter-subsublocation'] ); ?>"
					id="<?php echo ! empty( $field_id_prefix ) ? $field_id_prefix : ''; ?><?php echo esc_attr( $args['widget_id'] ); ?>_subsublocation">
				<option value="">
					<?php if ( 'placeholders' == $input_titles ) : ?>
						<?php echo esc_html__( 'Subsublocation', 'preston' ); ?>
					<?php else : ?>
						<?php echo esc_html__( 'All subsublocations', 'preston' ); ?>
					<?php endif; ?>
				</option>
			</select>
			</div>
		</div><!-- /.form-group -->
	<?php endif; ?>
<?php endif; ?>
