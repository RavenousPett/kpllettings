<header class="topbar-mobile">
    <div class="apus-topbar hidden-lg hidden-md">
        <div class="container">
            <div class="topbar-inner clearfix">
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
    </div>
</header>
<div id="apus-header-mobile" class="header-mobile hidden-lg hidden-md clearfix <?php echo (apustheme_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
    <div class="container">
    <div class="row">
        <div class="col-xs-4">
            <div class="topbar-inner-left clearfix">
                <div class="active-mobile pull-left">
                    <button data-toggle="offcanvas" class="btn btn-sm btn-danger btn-offcanvas btn-toggle-canvas offcanvas" type="button">
                       <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="setting-popup pull-left">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-primary btn-outline dropdown-toggle" type="button" data-toggle="dropdown"><span class="fa fa-user"></span></button>
                        <div class="dropdown-menu">

                            <?php if (is_user_logged_in()) : ?>

                                <?php if ( has_nav_menu( 'authenticated' ) ) : ?>
                                    <div class="user-menu menu-topbar">
                                        <nav data-duration="400" class="slide animate navbar" role="navigation">
                                        <?php   $args = array(
                                                'theme_location' => 'authenticated',
                                                'container_class' => 'navbar-collapse',
                                                'menu_class' => 'nav navbar-nav menu',
                                                'fallback_cb' => '',
                                                'menu_id' => 'authenticated-menu-mobile',
                                                'walker' => new Apustheme_Nav_Menu()
                                            );
                                            wp_nav_menu($args);
                                        ?>
                                        </nav>
                                    </div>
                                <?php endif; ?>

                            <?php else : ?>

                                <?php if ( has_nav_menu( 'anonymous' ) ) : ?>
                                    <div class="user-menu menu-topbar">
                                        <nav data-duration="400" class="slide animate navbar" role="navigation">
                                        <?php   $args = array(
                                                'theme_location' => 'anonymous',
                                                'container_class' => 'navbar-collapse',
                                                'menu_class' => 'nav navbar-nav menu',
                                                'fallback_cb' => '',
                                                'menu_id' => 'anonymous-menu-mobile',
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
        <div class="col-xs-4">
            <?php
                $logo = apustheme_get_config('media-mobile-logo');
            ?>

            <?php if( isset($logo['url']) && !empty($logo['url']) ): ?>
                <div class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                        <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                    </a>
                </div>
            <?php else: ?>
                <div class="logo logo-theme">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                        <img src="<?php echo esc_url_raw( get_template_directory_uri().'/images/logo.jpg'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-xs-4">
            <div class="topbar-inner-right clearfix">
                <div class="search-popup  pull-right">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-primary btn-outline dropdown-toggle" type="button" data-toggle="dropdown"><span class="fa fa-search"></span></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <?php get_template_part( 'page-templates/parts/productsearchform' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>