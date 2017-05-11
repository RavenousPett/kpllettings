<?php
//convert hex to rgb
if ( !function_exists ('apustheme_getbowtied_hex2rgb') ) {
	function apustheme_getbowtied_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	}
}
if ( !function_exists ('apustheme_custom_styles') ) {
	function apustheme_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		
		<!-- ******************************************************************** -->
		<!-- * Theme Options Styles ********************************************* -->
		<!-- ******************************************************************** -->
			
		<style>

			/* check main color */ 
			<?php if ( apustheme_get_config('main_color') != "" ) : ?>

			/* seting border color main */

				/* seting background main */
				.apus-breadscrumb .breadcrumb,
				.btn-outline.btn-theme:hover,
				.fillter-vertical .tabs-navigation > li.active,
				.property-box-image-inner .meta-top > span.feature,
				.property-box-style1 .property-price,
				#back-to-top,
				.btn-theme
				{
					background: <?php echo esc_html( apustheme_get_config('main_color') ) ?>;
				}
				/* setting color*/
				.agent-row-content.style-grid:hover .view-more,
				.comment-list .comment-reply-link,
				.mod-property .list-change li:hover > a, .mod-property .list-change li.active > a,
				.pagination .nav-links a:hover, .apus-pagination a:hover,
				.pagination .nav-links span.current, .pagination .nav-links a.current, .apus-pagination span.current, .apus-pagination a.current,
				.fillter-vertical .tabs-navigation > li a,
				.text-theme
				{
					color: <?php echo esc_html( apustheme_get_config('main_color') ) ?>;
				}
				/* setting border color*/
				.btn-outline.btn-theme:hover,
				.btn-outline.btn-theme,
				.mod-property .list-change li:hover > a, .mod-property .list-change li.active > a,
				.pagination .nav-links a:hover, .apus-pagination a:hover,
				.pagination .nav-links span.current, .pagination .nav-links a.current, .apus-pagination span.current, .apus-pagination a.current,
				.fillter-vertical .tabs-navigation > li,
				.fillter-vertical .tabs-navigation > li.active,
				.btn-theme{
					border-color: <?php echo esc_html( apustheme_get_config('main_color') ) ?>;
				}
				/* setting important*/
				.text-theme{
					color: <?php echo esc_html( apustheme_get_config('main_color') ) ?> !important;
				}
			<?php endif; ?>

			<?php if ( apustheme_get_config('second_color') != "" ) : ?>

			/* seting border color second */

				/* seting background main */
				.cmb-form .button-primary, .cmb-form .button, form#property_front .button-primary, form#property_front .button,
				.property-table button[type="submit"]:hover, .property-table button[type="submit"]:active,
				.change-password-form .button, .change-profile-form .button, .property-create,
				.fill-map li.active > a, .fill-map li:hover > a,
				.property-box-image-inner .meta-top > span.property-badge-sticky,
				.owl-controls .owl-dots .owl-dot.active,
				.btn-theme-second
				{
					background: <?php echo esc_html( apustheme_get_config('second_color') ) ?>;
				}
				/* setting color*/
				.property-table .property-table-action,
				.property-table button[type="submit"],
				.property-table .property-table-info-content-price,
				.property-small .property-small-price,
				.view-more:hover,.view-more:active,
				.agent-row-content .agencies,
				.property-box-wrapper .property-box-title-wrap .property-box-price,
				.text-theme-second
				{
					color: <?php echo esc_html( apustheme_get_config('second_color') ) ?>;
				}
				/* setting border color*/
				.cmb-form .button-primary, .cmb-form .button, form#property_front .button-primary, form#property_front .button,
				.property-table button[type="submit"],
				.sidebar-detail .widget_agents_assigned_widget .widget-title,
				.apus-footer .widget-title, .apus-footer .widgettitle, .apus-footer .widget-heading,
				.btn-theme-second{
					border-color: <?php echo esc_html( apustheme_get_config('second_color') ) ?>;
				}
				/* setting important*/
				.text-theme-second{
					color: <?php echo esc_html( apustheme_get_config('second_color') ) ?> !important;
				}
			<?php endif; ?>

			
			/* Custom CSS */
			<?php if ( apustheme_get_config('custom_css') != "" ) : ?>
				<?php echo apustheme_get_config('custom_css') ?>
			<?php endif; ?>

		</style>

	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}
		
		echo implode($new_lines);
	}
}

?>
<?php add_action( 'wp_head', 'apustheme_custom_styles', 99 ); ?>