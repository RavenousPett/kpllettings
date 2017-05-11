<header id="apus-header" class="site-header header-v2 hidden-sm hidden-xs <?php echo (apustheme_get_config('keep_header') ? 'main-sticky-header ' : ' '); ?>" role="banner">
    <div id="apus-topbar" class="apus-topbar">
        <div class="container">
            <?php if(is_active_sidebar('contact-topbar')){ ?>
                <div class="pull-left">
                    <?php dynamic_sidebar('contact-topbar'); ?>
                </div>
            <?php } ?>
             <?php if(is_active_sidebar('social-topbar')){ ?>
                <div class="pull-right">
                    <?php dynamic_sidebar('social-topbar'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="header-main clearfix">
        <div class="container">
            <div class="p-relative">
                <div class="header-inner clearfix p-relative">
                    <!-- LOGO -->
                        <div class="logo-in-theme pull-left">
                            <?php get_template_part( 'page-templates/parts/logo' ); ?>
                        </div>
                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <div class="pull-right p-static wrapper-menu">
                                <button class="action-menu"><i class="mn-icon-103" aria-hidden="true"></i></button>
                            </div>
                        <?php endif; ?>
                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <div class="main-menu pull-right">
                                <nav data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar" role="navigation">
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
                        <div class="user-login pull-right active">
                            
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
    </div>
</header>