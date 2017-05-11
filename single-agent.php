<?php

get_header();

$sidebar_configs = apustheme_get_agent_layout_configs();

apustheme_render_breadcrumbs();
?>

<section id="main-container" class="main-content <?php echo apply_filters( 'apustheme_agent_content_class', 'container' ); ?> inner">
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
        <div id="main-content" class="col-xs-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
            <div id="primary" class="content-area">
                <div id="content" class="site-content single-post" role="main">
                    <?php
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            echo Realia_Template_Loader::load('content-agent');
                        // End the loop.
                        endwhile;
                    ?>
                </div><!-- #content -->
            </div><!-- #primary -->
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
    </div>  
</section>
<?php get_footer(); ?>