<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<!-- block-top-content -->

<!-- end -->

<section id="main-container" class="main-content inner half-map-content">
    <div class="row no-margin">
        <div class="col-sm-12 col-lg-5 no-padding">
            <div id="property-half-map" class="property-half-map"></div>
        </div>
        <div id="main-content" class="col-sm-12 col-lg-7 no-padding">
            <main id="main" class="site-main content" role="main">
                <?php if ( have_posts() ) : ?>
                        
                    <?php
                    /**
                     * realia_before_property_archive
                     */
                    do_action( 'realia_before_property_archive' );

                    $display_mod = apustheme_woocommerce_get_display_mode();
                    $columns = apustheme_get_config( 'property_columns', 3 );
                    $bcol = 12/$columns;
                    if ($columns == 5) {
                        $bcol = 'cus-5';
                    }
                    $class = 'col-md-'.esc_attr($bcol).($columns > 1 ? ' col-sm-6' : '');
                    ?>
                    <div class="main-content-top clearfix">
                        <header class="page-header">
                            <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
                        </header><!-- .page-header -->
                        <div class="mod-property">
                            <div class="property-display-mod">
                                <ul class="nav list-change">
                                    <li>
                                        <?php esc_html_e('View','preston'); ?>
                                    </li>
                                    <li class="<?php echo ($display_mod == 'grid' ? 'active' : ''); ?>">
                                        <a href="#tab-properties-grid" data-toggle="tab" data-type="grid">
                                            <i class="fa fa-th" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li class="<?php echo ($display_mod == 'list' ? 'active' : ''); ?>">
                                        <a href="#tab-properties-list" data-toggle="tab" data-type="list">
                                            <i class="fa fa-list-ul" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
                    <div class="mod-property clearfix">
                        <div class="actions">
                            <div class="actions-link">
                                <?php
                                    $current_contract = isset($_GET['filter-contract']) ? $_GET['filter-contract'] : '';
                                    $current_url = apustheme_property_page_link();
                                    $url = remove_query_arg( 'filter-contract', $current_url );
                                    $url_rent = add_query_arg( 'filter-contract', 'RENT', remove_query_arg( 'filter-contract', $current_url ) );
                                    $url_sale = add_query_arg( 'filter-contract', 'SALE', remove_query_arg( 'filter-contract', $current_url ) );
                                ?>

                                <a <?php echo trim($current_contract == '' ? 'class="active"' : ''); ?> href="<?php echo esc_url($url); ?>" title="<?php echo esc_html__('All', 'preston'); ?>"><?php echo esc_html__('All', 'preston'); ?></a>
                                <a <?php echo trim($current_contract == 'RENT' ? 'class="active"' : ''); ?> href="<?php echo esc_url($url_rent); ?>" title="<?php echo esc_html__('For Rent', 'preston'); ?>"><?php echo esc_html__('For Rent', 'preston'); ?></a>
                                <a <?php echo trim($current_contract == 'SALE' ? 'class="active"' : ''); ?> href="<?php echo esc_url($url_sale); ?>" title="<?php echo esc_html__('For Sale', 'preston'); ?>"><?php echo esc_html__('For Sale', 'preston'); ?></a>
                            </div>
                            <?php echo Realia_Template_Loader::load('properties/sort'); ?>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="tab-properties-grid" class="tab-pane <?php echo ($display_mod == 'grid' ? 'active' : ''); ?>">
                            <div class="property-box-archive type-box">
                                <div class="row">
                                    <?php $index = 0; ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <div class="<?php echo esc_attr($class); ?><?php echo ($index%$columns == 0) ? ' col-md-clear':''; ?> <?php echo ($columns > 1 && $index%2 == 0) ? ' col-sm-clear' : ''; ?>">
                                            <?php echo Realia_Template_Loader::load( 'properties/box' ); ?>
                                        </div>
                                        <?php $index++; ?>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                        <div id="tab-properties-list" class="tab-pane <?php echo ($display_mod == 'list' ? 'active' : ''); ?>">
                            <div class="property-box-archive type-row">
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <?php echo Realia_Template_Loader::load( 'properties/row' ); ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                    /**
                     * realia_after_property_archive
                     */
                    do_action( 'realia_after_property_archive' );
                    ?>

                    <?php the_posts_pagination( array(
                        'prev_text'          => esc_html__( 'Previous page', 'preston' ),
                        'next_text'          => esc_html__( 'Next page', 'preston' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'preston' ) . ' </span>',
                    ) ); ?>
                <?php else : ?>
                    <?php get_template_part( 'content', 'none' ); ?>
                <?php endif; ?>

            </main><!-- .site-main -->
        </div>
    </div>
</section><!-- .content-area -->