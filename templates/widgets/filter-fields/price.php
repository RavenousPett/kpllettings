<?php if ( empty( $instance['hide_price'] ) ) : ?>
	<div class="row">

		<div class="form-group col-sm-12">

				<label for="filter-price-range-id">Price range</label>

                <select class="form-control" name="filter-price-range-id" id="filter-price-range-id">
                    <option value="1">Any</option>
                    <option value="2">£0 - £1100 pcm</option>
                    <option value="3">£1100 - £2000 pcm</option>
                    <option value="4">> £2000 pcm</option>
                </select>


		</div><!-- /.form-group -->

	</div>
<?php endif; ?>
