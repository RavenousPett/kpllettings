<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
	
	$layout = apustheme_get_config('property_archive_layout_version', 'default');
	if (empty($layout)) {
		$layout = 'default';
	}
	echo Realia_Template_Loader::load('archive-layout/'.$layout);

get_footer();
?>
