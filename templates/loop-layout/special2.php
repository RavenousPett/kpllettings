<div class="properties-special2">
	<div class="row">
		<?php $i = 0; while ( $loop->have_posts() ) : $loop->the_post(); ?>

			<?php if ($i%4 <= 2): ?>
				<?php if ($i%4 == 0): ?>
					<div class="col-md-8">
						<div class="row">
				<?php endif; ?>

					<?php if ($i%4 <= 1): ?>
						<div class="col-md-6 col-sm-6">
							<?php echo Realia_Template_Loader::load( 'properties/box-style2' ); ?>
						</div>
					<?php else: ?>
						<div class="col-md-12">
							<?php echo Realia_Template_Loader::load( 'properties/box-style2', array('image_thumb_size' => 'property-special2-thumbnail') ); ?>
						</div>
					<?php endif; ?>

				<?php if ($i%4 == 2 || $i == ($loop->post_count - 1) ): ?>
						</div>
					</div>
				<?php endif; ?>
			<?php else: ?>
				<div class="col-md-4">
					<?php echo Realia_Template_Loader::load( 'properties/box-style2', array('image_thumb_size' => 'property-special3-thumbnail') ); ?>
				</div>
			<?php endif; ?>

		<?php $i++; endwhile; ?>
	</div>
</div>
<?php wp_reset_postdata(); ?>