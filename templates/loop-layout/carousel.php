<?php

$columns = isset($columns) ? $columns : 3;
?>
<div class="owl-carousel" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-smallmedium="2" data-extrasmall="1" data-pagination="false" data-nav="true">
    <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
        <?php echo Realia_Template_Loader::load( 'properties/box' ); ?>
    <?php endwhile; ?>
</div> 
<?php wp_reset_postdata(); ?>