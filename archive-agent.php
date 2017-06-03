<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
$sidebar_configs = apustheme_get_agent_layout_configs();

apustheme_render_breadcrumbs();

?>
<section id="main-container" class="agent-container main-content <?php echo apply_filters('apustheme_agent_content_class', 'container');?> inner">
    <div class="row">
        <?php if ( isset($sidebar_configs['left']) ) : ?>
            <div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
                <aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
                    <?php if ( is_active_sidebar( $sidebar_configs['left']['sidebar'] ) ): ?>
                        <?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
                    <?php endif; ?>
                </aside>
            </div>
        <?php endif; ?>
        <div id="main-content" class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
            <main id="main" class="site-main content" role="main">
                <div class="row">
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <div class="col-md-4">
                                <?php echo Realia_Template_Loader::load( 'agents/row' ); ?>
                            </div>
                        <?php endwhile; ?>
                        <?php the_posts_pagination( array(
                            'prev_text'          => '<i class="fa fa-chevron-left"></i>',
                            'next_text'          => '<i class="fa fa-chevron-right"></i>',
                            'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'preston' ) . ' </span>',
                        ) ); ?>
                    <?php else : ?>
                        <?php get_template_part( 'content', 'none' ); ?>
                    <?php endif; ?>
                </div>
            </main><!-- .site-main -->
        </div>
        <?php if ( isset($sidebar_configs['right']) ) : ?>
            <div class="<?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
                <aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
                    <?php if ( is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ): ?>
                        <?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
                    <?php endif; ?>
                </aside>
            </div>
        <?php endif; ?>

    </div><!-- /.row -->
</section>
<?php get_footer(); ?>
