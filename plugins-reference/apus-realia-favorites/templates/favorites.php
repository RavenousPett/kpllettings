<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <?php echo Realia_Template_Loader::load( 'properties/row' ); ?>
    <?php endwhile; ?>

    <?php the_posts_pagination( array(
        'prev_text' => esc_html__( 'Previous', 'apus-realia-favorites' ),
        'next_text' => esc_html__( 'Next', 'apus-realia-favorites' ),
        'mid_size'  => 2,
    ) ); ?>
<?php else : ?>
    <div class="alert alert-warning">
        <?php if ( is_user_logged_in() ): ?>
            <?php echo esc_html__( "You don't have any favorite properties, yet. Start by adding some.", 'apus-realia-favorites' ); ?>
        <?php else: ?>
            <?php echo esc_html__( 'You need to log in at first.', 'apus-realia-favorites' ); ?>
        <?php endif; ?>
    </div>
<?php endif; ?>