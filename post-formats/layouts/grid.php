<?php
	$columns = apustheme_get_config('blog_columns', 1);
	$bcol = floor( 12 / $columns );
?>
<div class="style-grid">
    <div class="row">
        <?php $count=1; while ( have_posts() ) : the_post(); ?>
            <div class="col-md-<?php echo esc_attr($bcol); ?> <?php echo ($count%$columns == 1) ? ' md-clearfix':''; ?> <?php echo ($columns > 1 && $count%2 == 1) ? ' sm-clearfix' : ''; ?>">
                <?php get_template_part( 'post-formats/content', get_post_format() ); ?>
            </div>
        <?php $count++; endwhile; ?>
    </div>
</div>
