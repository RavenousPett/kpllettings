<?php
$show_similar = apustheme_get_config('show_property_similar', true);
if (!$show_similar) {
    return;
}
Realia_Query::loop_properties_similar();

?>

<?php if ( have_posts() ) : ?>
    <div class="property-similar-properties">
        <h3><?php echo esc_html__( 'Similar properties', 'preston' ); ?></h3>

            <?php while ( have_posts() ) : the_post(); ?>
                <?php echo Realia_Template_Loader::load( 'properties/row' ); ?>
            <?php endwhile; ?>
    </div><!-- /.similar-properties -->
<?php endif?>

<?php wp_reset_query(); ?>