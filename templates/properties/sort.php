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
                <select class="form-control" name="filter-contract">
                    <option value=""><?php echo esc_html__( 'Contract', 'preston' ); ?></option>
                    <option value="TO LET" <?php if ( ! empty( $_GET['filter-contract'] ) && 'TO LET' == $_GET['filter-contract'] ) :   ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'To Let', 'preston' ); ?></option>
                    <option value="LET BY" <?php if ( ! empty( $_GET['filter-contract'] ) && 'LET BY' == $_GET['filter-contract'] ) :   ?>selected="selected"<?php endif; ?>><?php echo esc_html__( 'Let By', 'preston' ); ?></option>

                </select>
            </div><!-- /.filter-sort-by-wrapper -->

		</div><!-- /.properties-sort-inner -->
	</form>
</div><!-- /.properties-sort -->
