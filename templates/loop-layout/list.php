<div class="properties-list">
	<?php $i = 0; while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<div class="item">
			<?php echo Realia_Template_Loader::load( 'properties/box-list' ); ?>
		</div>
	<?php $i++; endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>