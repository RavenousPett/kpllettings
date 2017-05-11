<?php
$atts  = array_merge( array(
	'title' => '',
	'description' => '',
	'style' => '',
), $atts);

extract( $atts );
?>
<div class="widget-heading-title <?php echo esc_attr($style); ?>">
	<h3 class="title">
		<?php echo trim($title); ?>
	</h3>
	<div class="desc"><?php echo trim($description); ?></div>
</div>