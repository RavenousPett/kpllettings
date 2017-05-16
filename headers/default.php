<header id="apus-header" class="site-header header-v3 hidden-sm hidden-xs <?php echo (apustheme_get_config('keep_header') ? 'main-sticky-header ' : ' '); ?>" role="banner">
    <div id="apus-topbar" class="apus-topbar">
        <div class="container">
            <div class="topbar-inner clearfix">
                <?php if(is_active_sidebar('contact-topbar')){ ?>
                    <div class="pull-left">
                        <?php dynamic_sidebar('contact-topbar'); ?>
                    </div>
                <?php } ?>

                <div class="user-login pull-right">
                    <?php if (is_user_logged_in()) : ?>

                        <?php if ( has_nav_menu( 'authenticated' ) ) : ?>
                            <div class="user-menu">
                                <nav data-duration="400" class="hidden-xs hidden-sm slide animate navbar" role="navigation">
                                <?php   $args = array(
                                        'theme_location' => 'authenticated',
                                        'container_class' => 'collapse navbar-collapse',
                                        'menu_class' => 'nav navbar-nav menu',
                                        'fallback_cb' => '',
                                        'menu_id' => 'authenticated-menu',
                                        'walker' => new Apustheme_Nav_Menu()
                                    );
                                    wp_nav_menu($args);
                                ?>
                                </nav>
                            </div>
                        <?php endif; ?>

                    <?php else : ?>

                        <?php if ( has_nav_menu( 'anonymous' ) ) : ?>
                            <div class="user-menu">
                                <nav data-duration="400" class="hidden-xs hidden-sm slide animate navbar" role="navigation">
                                <?php   $args = array(
                                        'theme_location' => 'anonymous',
                                        'container_class' => 'collapse navbar-collapse',
                                        'menu_class' => 'nav navbar-nav menu',
                                        'fallback_cb' => '',
                                        'menu_id' => 'anonymous-menu',
                                        'walker' => new Apustheme_Nav_Menu()
                                    );
                                    wp_nav_menu($args);
                                ?>
                                </nav>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <div class="header-main clearfix">
        <div class="header-main-top">
            <div class="container">
                <div class="header-center-inner clearfix p-relative">
                    <div class="row">
                        <!-- LOGO -->
                        <div class="col-md-2">
                            <div class="logo-in-theme">
                                <?php get_template_part( 'page-templates/parts/logo' ); ?>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                <div class="main-menu  pull-right">
                                    <nav
                                     data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar" role="navigation">
                                    <?php   $args = array(
                                            'theme_location' => 'primary',
                                            'container_class' => 'collapse navbar-collapse',
                                            'menu_class' => 'nav navbar-nav megamenu',
                                            'fallback_cb' => '',
                                            'menu_id' => 'primary-menu',
                                            'walker' => new Apustheme_Nav_Menu()
                                        );
                                        wp_nav_menu($args);
                                    ?>
                                    </nav>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>
