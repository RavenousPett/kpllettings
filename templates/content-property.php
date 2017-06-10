<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="property-detail-actions">
		<?php do_action( 'property_actions', get_the_ID() ); ?>
	</div><!-- /.property-detail-actions -->

	<?php
	$version = apustheme_get_config('property_single_layout_type', 'default');
	if (empty($version)) {
		$version = 'default';
	}
	?>
	<div class="property-layout-<?php echo esc_attr($version); ?>">
		<?php echo Realia_Template_Loader::load('single-layout/'.$version); ?>
	</div>

</article><!-- #post-## -->
