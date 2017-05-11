<?php

add_action('init', 'apustheme_kingcomposer_init');
function apustheme_kingcomposer_init() {
    if ( function_exists( 'kc_add_icon' ) ) {
    	$css_folder = apustheme_get_css_folder();
		$min = apustheme_get_asset_min();
        kc_add_icon( $css_folder . '/font-monia'.$min.'.css' );
    }
}

function apustheme_autocomplete_options_helper( $options ){
	$output = array();
   	$options = array_map('trim', explode(',', $options));
	foreach( $options as $option ){
		$tmp = explode( ":", $option );
		$output[] = $tmp[0];
	}
	return $output; 
}