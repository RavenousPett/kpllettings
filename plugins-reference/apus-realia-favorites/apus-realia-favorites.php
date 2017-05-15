<?php
/**
 * Plugin Name: Apus Realia Favorites
 * Plugin URI: http://apusthemes.com/apus-realia-favorites/
 * Description: Apus Realia Favorites is a plugin for Louisiana directory listing theme
 * Version: 1.0.0
 * Author: ApusTheme
 * Author URI: http://apusthemes.com
 * Requires at least: 3.8
 * Tested up to: 4.1
 *
 * Text Domain: apus-realia-favorites
 * Domain Path: /languages/
 *
 * @package apus-realia-favorites
 * @category Plugins
 * @author ApusTheme
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists("ApusRealiaFavorites") ){
	
	final class ApusRealiaFavorites{

		private static $instance;

		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ApusRealiaFavorites ) ) {
				self::$instance = new ApusRealiaFavorites;
				self::$instance->setup_constants();
				
				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
				
				self::$instance->includes();
			}

			return self::$instance;
		}

		/**
		 *
		 */
		public function setup_constants(){
			// Plugin version
			if ( ! defined( 'APUSREALIAFAVORITES_VERSION' ) ) {
				define( 'APUSREALIAFAVORITES_VERSION', '1.0.0' );
			}

			// Plugin Folder Path
			if ( ! defined( 'APUSREALIAFAVORITES_PLUGIN_DIR' ) ) {
				define( 'APUSREALIAFAVORITES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'APUSREALIAFAVORITES_PLUGIN_URL' ) ) {
				define( 'APUSREALIAFAVORITES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'APUSREALIAFAVORITES_PLUGIN_FILE' ) ) {
				define( 'APUSREALIAFAVORITES_PLUGIN_FILE', __FILE__ );
			}
		}

		public function includes() {
			require_once APUSREALIAFAVORITES_PLUGIN_DIR . 'inc/class-favorites.php';
		}
		/**
		 *
		 */
		public function load_textdomain() {
			// Set filter for ApusRealiaFavorites's languages directory
			$lang_dir = dirname( plugin_basename( APUSREALIAFAVORITES_PLUGIN_FILE ) ) . '/languages/';
			$lang_dir = apply_filters( 'apusrealiafavorites_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'apus-realia-favorites' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'apus-realia-favorites', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/apus-realia-favorites/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/apus-realia-favorites folder
				load_textdomain( 'apus-realia-favorites', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/apus-realia-favorites/languages/ folder
				load_textdomain( 'apus-realia-favorites', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'apus-realia-favorites', false, $lang_dir );
			}
		}
	}
}

function ApusRealiaFavorites() {
	return ApusRealiaFavorites::getInstance();
}

ApusRealiaFavorites();
