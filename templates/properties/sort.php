<div class="properties-sort">
	<form method="get" action="?" id="sort-form">
		<?php $skip = array(
			'filter-sort-by',
		'filter-sort-order',
		); ?>

		<?php foreach ( $_GET as $key => $value ) : ?>
			<?php if ( ! in_array( $key, $skip ) ) : ?>
				<input type="hidden" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_html( $value ); ?>">
			<?php endif; ?>
		<?php endforeach; ?>

		<div class="properties-sort-inner">


			<div class="properties-filter-sort-by-wrapper">
				<select class="form-control" name="filter-sort-by">
					<option value=""><?php echo esc_html__( 'Sort by', 'preston' ); ?></option>
					<option value="price" <?php if ( ! empty( $_GET['filter-sort-by'] ) && 'price' == $_GET['filter-sort-by'] ) :   ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'Price', 'preston' ); ?></option>
					<option value="title" <?php if ( ! empty( $_GET['filter-sort-by'] ) && 'title' == $_GET['filter-sort-by'] ) :   ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'Title', 'preston' ); ?></option>
				</select>
			</div><!-- /.filter-sort-by-wrapper -->

			<div class="properties-filter-sort-order-wrapper">
				<select class="form-control" name="filter-sort-order">
					<option value=""><?php echo esc_html__( 'Order', 'preston' ); ?></option>
					<option value="asc" <?php if ( ! empty( $_GET['filter-sort-order'] ) && 'asc' == $_GET['filter-sort-order'] ) :   ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'ASC', 'preston' ); ?></option>
					<option value="desc" <?php if ( ! empty( $_GET['filter-sort-order'] ) && 'desc' == $_GET['filter-sort-order'] ) :   ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'DESC', 'preston' ); ?></option>
				</select>
			</div><!-- /.filter-sort-order-wrapper-->
		</div><!-- /.properties-sort-inner -->
	</form>
</div><!-- /.properties-sort -->
