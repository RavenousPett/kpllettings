
<div class="properties-special1">
	<div class="row">
		<?php $i = 0; while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php if ($i == 0): ?>
				<div class="col-md-8">
					<?php echo Realia_Template_Loader::load( 'properties/box-style1' ); ?>
				</div><div class="second">
			<?php elseif ($i == 1 || $i == 2): ?>
				<div class="col-md-4 col-sm-6">
					<?php echo Realia_Template_Loader::load( 'properties/box-style2' ); ?>
				</div>
				<?php if($i == 2) echo '</div></div><div class="clearfix second"> <div class="owl-carousel" data-smallmedium="2" data-extrasmall="1" data-items="3" data-carousel="owl" data-pagination="false" data-nav="true">'; ?>
			<?php else: ?>
					<?php echo Realia_Template_Loader::load( 'properties/box' ); ?>
			<?php endif; ?>
		<?php $i++; endwhile; ?>
	</div></div>
</div>
<?php wp_reset_postdata(); ?>