<?php

$atts  = array_merge( array(
	'columns'	=> 3,
	'layout_type' => 'grid',
	'contract' => '',
	'item_style' => 'style1',
	'number' => 3,
), $atts);
extract( $atts );

$bcol = 12/$columns;
if ($columns == 5) {
	$bcol = 'cus-5';
}
$style = 'row';
if ($item_style == 'style2') {
	$style = 'row-style2';
}
$args = array(
	'post_type' => 'agent',
	'posts_per_page' => isset($number) && $number ? $number : 3
);
$loop = new WP_Query($args);

if ($loop->have_posts()): ?>
	<div class="widget widget-agents <?php echo esc_attr($item_style); ?>">
		<?php if ($layout_type == 'carousel'): ?>
			<div class="owl-carousel" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-smallmedium="2" data-extrasmall="1" data-pagination="false" data-nav="true">
				<?php while ( $loop->have_posts() ): $loop->the_post(); ?>
			        <?php echo Realia_Template_Loader::load( 'agents/'.$style ); ?>
			    <?php endwhile; ?>
			</div>
		<?php else: ?>
			<div class="row">
				<?php $count = 1; while ( $loop->have_posts() ): $loop->the_post(); ?>
					<div class="col-md-<?php echo esc_attr($bcol); ?> col-sm-6 col-xs-12 <?php echo ($count%$columns) ==1?' col-md-clear':''; ?> <?php echo ($count%2) == 1?' col-sm-clear':''; ?>">
			        	<?php echo Realia_Template_Loader::load( 'agents/'.$style ); ?>
			        </div>
			    <?php $count++; endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>