<?php
$title = '';
$atts  = array_merge( array(
	'columns'	=> 3,
	'layout_type' => 'grid',
	'contract' => '',
	'type' => 'featured',
	'number' => 3,
), $atts);
extract( $atts );

$loop = apustheme_get_properties($contract, $type, $number);
$layout_type = isset($layout_type) && $layout_type ? $layout_type : 'grid';

?>
<div class="widget property-widget">
<?php if(!empty($title)): ?>
	<h3 class="widget-title">
		<?php echo trim($title); ?>
	</h3>
<?php endif; ?>
<?php  if ( $loop->have_posts() ):
	?>
	<div class="property-content">
		<?php echo Realia_Template_Loader::load( 'loop-layout/'.$layout_type, array( 'loop' => $loop, 'columns' => $columns ) ); ?>
	</div>
	<?php
endif; ?>
</div>