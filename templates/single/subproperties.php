<?php
$show_subproperties = apustheme_get_config('show_property_sub', true);
if (!$show_subproperties) {
	return;
}
$post = get_post();
$author_id = $post->post_author;
$subproperties = Realia_Post_Type_Property::get_properties( $author_id, "publish", get_the_ID() );

?>

<?php if ( is_array( $subproperties ) && ! empty( $subproperties ) ) : ?>
	<div class="property-subproperties">
		<h3><?php echo esc_html__( 'Subproperties', 'preston' ); ?></h3>
		<div class="clearfix">
			<?php foreach ( $subproperties as $subproperty ): ?>
				<?php echo Realia_Template_Loader::load( 'properties/row', array( 'property' => $subproperty ) ); ?>
			<?php endforeach; ?>
		</div><!-- /.row -->
	</div><!-- /.subproperties -->
<?php endif?>