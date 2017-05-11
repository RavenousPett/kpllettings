<?php
/**
 * preston functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Preston
 * @since Preston 1.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since preston 1.0
 */
define( 'APUSTHEME_THEME_VERSION', '1.1' );
define( 'APUSTHEME_DEMO_MODE', false );
define( 'APUSTHEME_DEV_MODE', true );

if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

if ( ! function_exists( 'apustheme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Preston 1.0
 */
function apustheme_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on preston, use a find and replace
	 * to change 'preston' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'preston', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'preston' ),
		'anonymous'  => esc_html__( 'Anonymous user', 'preston' ),
		'authenticated'  => esc_html__( 'Authenticated user', 'preston' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	add_theme_support( 'realia-custom-styles' );
	
	add_image_size( 'property-thumbnail', 370, 260, true );
	add_image_size( 'property-special1-thumbnail', 770, 550, true );
	add_image_size( 'property-special2-thumbnail', 770, 260, true );
	add_image_size( 'property-special3-thumbnail', 370, 550, true );
	add_image_size( 'property-slider-thumbnail', 1920, 760, true );
	/*
	 * Enable support for Post Formats.250
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = apustheme_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'apustheme_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	apustheme_get_load_plugins();
}
endif; // apustheme_setup
add_action( 'after_setup_theme', 'apustheme_setup' );

/**
 * Load Google Front
 */

function apustheme_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Montserrat, translate this to 'off'. Do not translate
    * into your own language.
    */
    $raleway = _x( 'on', 'Raleway font: on or off', 'preston' );
    $lato    = _x( 'on', 'Lato font: on or off', 'preston' );
    $crimson    = _x( 'on', 'Crimson font: on or off', 'preston' );
 
    if ( 'off' !== $raleway || 'off' !== $lato || 'off' !== $crimson ) {
        $font_families = array();
 
        if ( 'off' !== $raleway ) {
            $font_families[] = 'Raleway:400,500,600,700,800';
        }
        if ( 'off' !== $lato ) {
            $font_families[] = 'Lato:300,400,600,700,900';
        }
        if ( 'off' !== $crimson ) {
            $font_families[] = 'Crimson+Text:400,600';
        }

        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

function apustheme_full_fonts_url() {  
	$protocol = is_ssl() ? 'https:' : 'http:';
	wp_enqueue_style( 'apustheme-theme-fonts', apustheme_fonts_url(), array(), null );
}
add_action('wp_enqueue_scripts', 'apustheme_full_fonts_url');

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Preston 1.1
 */
function apustheme_javascript_detection() {
	wp_add_inline_script( 'apustheme-typekit', "(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);" );
}
add_action( 'wp_enqueue_scripts', 'apustheme_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Preston 1.0
 */
function apustheme_scripts() {
	// Load our main stylesheet.
	$css_folder = apustheme_get_css_folder();
	$js_folder = apustheme_get_js_folder();
	$min = apustheme_get_asset_min();
	// load bootstrap style
	if( is_rtl() ){
		wp_enqueue_style( 'bootstrap', $css_folder . '/bootstrap-rtl'.$min.'.css', array(), '3.2.0' );
	}else{
		wp_enqueue_style( 'bootstrap', $css_folder . '/bootstrap'.$min.'.css', array(), '3.2.0' );
	}
	$css_path = $css_folder . '/template'.$min.'.css';
	wp_enqueue_style( 'apustheme-template', $css_path, array(), '3.2' );
	wp_enqueue_style( 'apustheme-style', get_template_directory_uri() . '/style.css', array(), '3.2' );
	//load font awesome
	wp_enqueue_style( 'font-awesome', $css_folder . '/font-awesome'.$min.'.css', array(), '4.5.0' );

	//load font monia
	wp_enqueue_style( 'font-monia', $css_folder . '/font-monia'.$min.'.css', array(), '1.8.0' );

	// load animate version 3.5.0
	wp_enqueue_style( 'animate', $css_folder . '/animate'.$min.'.css', array(), '3.5.0' );


	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'bootstrap', $js_folder . '/bootstrap'.$min.'.js', array( 'jquery' ), '20150330', true );
	wp_enqueue_script( 'owl-carousel', $js_folder . '/owl.carousel'.$min.'.js', array( 'jquery' ), '2.0.0', true );

	// colorbox
	wp_enqueue_script( 'jquery-colorbox', $js_folder . '/colorbox/jquery.colorbox'.$min.'.js', array( 'jquery' ), '1.1.0', true );
	wp_enqueue_style( 'colorbox', $js_folder . '/colorbox/colorbox'.$min.'.css', array(), '1.1.0' );
	// lazyload image
	wp_enqueue_script( 'jquery-unveil', $js_folder . '/jquery.unveil'.$min.'.js', array( 'jquery' ), '20150330', true );

	// google map
	wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?libraries=places&language='.get_locale().'&key=AIzaSyAgLtmIukM56mTfet5MEoPsng51Ws06Syc', array('jquery'), '1.0', false);
	wp_enqueue_script('infobox', $js_folder . '/maps/infobox.js', array('google-maps'), '1.1.13', false);
	wp_enqueue_script('markerclusterer', $js_folder . '/maps/markerclusterer.js', array('google-maps'), '2.1.1', false);
	wp_enqueue_script('apustheme-map-script', $js_folder . '/maps/script.js', array('jquery', 'google-maps', 'markerclusterer', 'infobox', 'mapescape', 'jquery-google-map'), '1.0', false);
	
	// main script
	wp_register_script( 'apustheme-functions', $js_folder . '/functions'.$min.'.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'apustheme-functions', 'apustheme_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	wp_enqueue_script( 'apustheme-functions' );

	if ( apustheme_get_config('header_js') != "" ) {
		wp_add_inline_script( 'apustheme-header', apustheme_get_config('header_js') );
	}
}
add_action( 'wp_enqueue_scripts', 'apustheme_scripts', 100 );

function apustheme_footer_scripts() {
	if ( apustheme_get_config('footer_js') != "" ) {
		wp_add_inline_script( 'apustheme-footer', apustheme_get_config('footer_js') );
	}
}
add_action('wp_footer', 'apustheme_footer_scripts');
/**
 * Display descriptions in main navigation.
 *
 * @since Preston 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function apustheme_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'apustheme_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Preston 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function apustheme_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'apustheme_search_form_modify' );

/**
 * Function get opt_name
 *
 */
function apustheme_get_opt_name() {
	return 'apustheme_theme_options';
}
add_filter( 'apus_themer_get_opt_name', 'apustheme_get_opt_name' );

function apustheme_register_demo_mode() {
	if ( defined('APUSTHEME_DEMO_MODE') && APUSTHEME_DEMO_MODE ) {
		return true;
	}
	return false;
}
add_filter( 'apus_themer_register_demo_mode', 'apustheme_register_demo_mode' );

function apustheme_get_demo_preset() {
	$preset = '';
    if ( defined('APUSTHEME_DEMO_MODE') && APUSTHEME_DEMO_MODE ) {
        if ( isset($_GET['_preset']) && $_GET['_preset'] ) {
            $presets = get_option( 'apus_themer_presets' );
            if ( is_array($presets) && isset($presets[$_GET['_preset']]) ) {
                $preset = $_GET['_preset'];
            }
        } else {
            $preset = get_option( 'apus_themer_preset_default' );
        }
    }
    return $preset;
}

function apustheme_exporter_settings_option_keys($options) {
	return array_merge( $options, array( 'theme_mods_preston' ) );
}
add_filter( 'apus_exporter_settings_option_keys', 'apustheme_exporter_settings_option_keys' );


function apustheme_get_config($name, $default = '') {
	global $apustheme_options;
    if ( isset($apustheme_options[$name]) ) {
        return $apustheme_options[$name];
    }
    return $default;
}

function apustheme_get_image_lazy_loading() {
	return apustheme_get_config('image_lazy_loading');
}
add_filter( 'apus_themer_get_image_lazy_loading', 'apustheme_get_image_lazy_loading');

function apustheme_load_posttypes_setup($posttypes) {
	return array_merge($posttypes, array('block-content'));
}
add_filter( 'apus_themer_load_posttypes_setup', 'apustheme_load_posttypes_setup' );

function apustheme_register_sidebar() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'preston' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'preston' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Contact Topbar', 'preston' ),
		'id'            => 'contact-topbar',
		'description'   => esc_html__( 'Add widgets here to appear in your Top Bar.', 'preston' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Social Topbar', 'preston' ),
		'id'            => 'social-topbar',
		'description'   => esc_html__( 'Add widgets here to appear in your Top Bar.', 'preston' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Property Sidebar', 'preston' ),
		'id'            => 'property',
		'description'   => esc_html__( 'Add widgets here to appear in your Top Bar.', 'preston' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Property Filler Rent Sale', 'preston' ),
		'id'            => 'property-fillter',
		'description'   => esc_html__( 'Add widgets here to appear in your header site.', 'preston' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Property Filler Rent Sale Vertical', 'preston' ),
		'id'            => 'property-fillter-vertical',
		'description'   => esc_html__( 'Add widgets here to appear in your header site.', 'preston' ),
		'before_widget' => '<aside id="%1$s" class="fillter-vertical widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog left sidebar', 'preston' ),
		'id'            => 'blog-left-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'preston' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog right sidebar', 'preston' ),
		'id'            => 'blog-right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'preston' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Single Property Sidebar', 'preston' ),
		'id'            => 'single-property-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'preston' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
}
add_action( 'widgets_init', 'apustheme_register_sidebar' );

function apustheme_get_load_plugins() {
	// framework
	$plugins[] =(array(
		'name'                     => esc_html__( 'Apus Themer For Themes', 'preston' ),
        'slug'                     => 'apus-themer',
        'required'                 => true,
        'source'				   => esc_url( 'http://apusthemes.com/themeplugins/apus-themer.zip' )
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Cmb2', 'preston' ),
	    'slug'                     => 'cmb2',
	    'required'                 => true,
	));
	
	$plugins[] =(array(
		'name'                     => esc_html__('King Composer - Page Builder', 'preston'),
	    'slug'                     => 'kingcomposer',
	    'required'                 => true,
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Revolution Slider', 'preston' ),
        'slug'                     => 'revslider',
        'required'                 => true,
        'source'				   => esc_url( 'http://apusthemes.com/themeplugins/revslider.zip' )
	));

	// for Property
	$plugins[] =(array(
		'name'                     => esc_html__( 'Realia', 'preston' ),
	    'slug'                     => 'realia',
	    'required'                 => true,
	));

	$plugins[] =(array(
		'name'      => esc_html__( 'WP REST API (WP API)', 'preston' ),
		'slug'      => 'json-rest-api',
		'required'  => false,
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Apus Realia Favorites', 'preston' ),
        'slug'                     => 'apus-realia-favorites',
        'required'                 => true,
        'source'				   => esc_url( 'http://apusthemes.com/themeplugins/apus-realia-favorites.zip' )
	));
	
	// for other plugins
	$plugins[] =(array(
		'name'                     => esc_html__( 'MailChimp for WordPress', 'preston' ),
	    'slug'                     => 'mailchimp-for-wp',
	    'required'                 =>  true
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Contact Form 7', 'preston' ),
	    'slug'                     => 'contact-form-7',
	    'required'                 => true,
	));

	tgmpa( $plugins );
}

require get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/functions-helper.php';
require get_template_directory() . '/inc/functions-frontend.php';

/**
 * Implement the Custom Header feature.
 *
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/classes/megamenu.php';
require get_template_directory() . '/inc/classes/mobilemenu.php';

/**
 * Custom template tags for this theme.
 *
 */
require get_template_directory() . '/inc/template-tags.php';


if ( defined( 'APUS_THEMER_REDUX_ACTIVED' ) ) {
	require get_template_directory() . '/inc/vendors/redux-framework/redux-config.php';
	define( 'APUSTHEME_REDUX_THEMER_ACTIVED', true );
}
if( in_array( 'cmb2/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/cmb2/page.php';
	require get_template_directory() . '/inc/vendors/cmb2/footer.php';
	define( 'APUSTHEME_CMB2_ACTIVED', true );
}
if( in_array( 'kingcomposer/kingcomposer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/kingcomposer/functions.php';
	require get_template_directory() . '/inc/vendors/kingcomposer/maps.php';
	define( 'APUSTHEME_KINGCOMPOSER_ACTIVED', true );
}
if( in_array( 'realia/realia.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/realia/functions.php';
	define( 'APUSTHEME_REALIA_ACTIVED', true );
}

function apustheme_register_widgets($widgets) {
	return array_merge($widgets, array('socials'));
}
add_filter( 'apus_themer_register_widgets', 'apustheme_register_widgets' );
/**
 * Customizer additions.
 *
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Styles
 *
 */
require get_template_directory() . '/inc/custom-styles.php';