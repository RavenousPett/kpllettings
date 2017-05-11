<?php

function apustheme_realia_add_fields( $metaboxes ) {
	$metaboxes[REALIA_PROPERTY_PREFIX . 'general']['fields'][] = array(
		'name'              => esc_html__( 'Floor Plans', 'preston' ),
		'id'                => REALIA_PROPERTY_PREFIX . 'plans',
		'type'              => 'file_list',
	);
	
	$metaboxes[REALIA_PROPERTY_PREFIX . 'general']['fields'][] = array(
		'name' => esc_html__( 'Video link', 'preston' ),
		'id' => REALIA_PROPERTY_PREFIX . 'video',
		'type' => 'text'
	);

	$metaboxes[REALIA_PROPERTY_PREFIX . 'general']['fields'][] = array(
		'name'              => esc_html__( 'Image for slider', 'preston' ),
		'id'                => REALIA_PROPERTY_PREFIX . 'slider_image',
		'description'       => esc_html__( 'Use large images which has at least 1920px width and 760px height.', 'preston' ),
		'type'              => 'file',
	);

	return $metaboxes;
}
add_action( 'cmb2_meta_boxes', 'apustheme_realia_add_fields', 9999 );

function apustheme_get_properties($contract, $type, $number = 4) {
	$args = array(
		'post_type' => 'property',
		'posts_per_page' => $number,
	);

	switch ($type) {
		case 'featured':
			$args['meta_query'][] = array(
				'key'       => REALIA_PROPERTY_PREFIX . 'featured',
				'value'     => 'on',
				'compare'   => '==',
			);
			break;
		case 'reduced':
			$args['meta_query'][] = array(
				'key'       => REALIA_PROPERTY_PREFIX . 'reduced',
				'value'     => 'on',
				'compare'   => '==',
			);
			break;
		case 'sticky':
			$args['meta_query'][] = array(
				'key'       => REALIA_PROPERTY_PREFIX . 'sticky',
				'value'     => 'on',
				'compare'   => '==',
			);
			break;
		default:

			break;
	}

	if ($contract) {
		$args['meta_query'][] = array(
			'key'       => REALIA_PROPERTY_PREFIX . 'contract',
			'value'     => $contract,
			'compare'   => '==',
		);
	}
	
	return new WP_Query($args);
}


if ( !function_exists('apustheme_agency_content_class') ) {
	function apustheme_agency_content_class( $class ) {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		if ( apustheme_get_config('agency_'.$page.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'apustheme_agency_content_class', 'apustheme_agency_content_class', 1 , 1  );

if ( !function_exists('apustheme_get_agency_layout_configs') ) {
	function apustheme_get_agency_layout_configs() {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		$left = apustheme_get_config('agency_'.$page.'_left_sidebar');
		$right = apustheme_get_config('agency_'.$page.'_right_sidebar');

		switch ( apustheme_get_config('agency_'.$page.'_layout') ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-12 col-xs-12'  );
		 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12 pull-right' );
		 		break;
		 	case 'main-right':
		 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-12 col-xs-12 pull-right' ); 
		 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
	 			break;
 			case 'left-main-right':
 				$configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3 col-sm-12 col-xs-12'  );
		 		$configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
		 		$configs['main'] = array( 'class' => 'col-md-6 col-sm-12 col-xs-12' );
 				break;
		 	default:
		 		$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
		 		break;
		}

		return $configs; 
	}
}


if ( !function_exists('apustheme_agent_content_class') ) {
	function apustheme_agent_content_class( $class ) {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		if ( apustheme_get_config('agent_'.$page.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'apustheme_agent_content_class', 'apustheme_agent_content_class', 1 , 1  );

if ( !function_exists('apustheme_get_agent_layout_configs') ) {
	function apustheme_get_agent_layout_configs() {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		$left = apustheme_get_config('agent_'.$page.'_left_sidebar');
		$right = apustheme_get_config('agent_'.$page.'_right_sidebar');

		switch ( apustheme_get_config('agent_'.$page.'_layout') ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-12 col-xs-12'  );
		 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12 pull-right' );
		 		break;
		 	case 'main-right':
		 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-12 col-xs-12 pull-right' ); 
		 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
	 			break;
 			case 'left-main-right':
 				$configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3 col-sm-12 col-xs-12'  );
		 		$configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
		 		$configs['main'] = array( 'class' => 'col-md-6 col-sm-12 col-xs-12' );
 				break;
		 	default:
		 		$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
		 		break;
		}

		return $configs; 
	}
}


if ( !function_exists('apustheme_property_content_class') ) {
	function apustheme_property_content_class( $class ) {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		if ( apustheme_get_config('property_'.$page.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'apustheme_property_content_class', 'apustheme_property_content_class', 1 , 1  );


if ( !function_exists('apustheme_get_property_layout_configs') ) {
	function apustheme_get_property_layout_configs() {
		$page = 'archive';
		if ( is_singular( 'property' ) ) {
            $page = 'single';
        }
		$left = apustheme_get_config('property_'.$page.'_left_sidebar');
		$right = apustheme_get_config('property_'.$page.'_right_sidebar');

		switch ( apustheme_get_config('property_'.$page.'_layout') ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-4 col-sm-12 col-xs-12'  );
		 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12 pull-right' );
		 		break;
		 	case 'main-right':
		 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-4 col-sm-12 col-xs-12 pull-right' ); 
		 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
	 			break;
 			case 'left-main-right':
 				$configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3 col-sm-12 col-xs-12'  );
		 		$configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
		 		$configs['main'] = array( 'class' => 'col-md-6 col-sm-12 col-xs-12' );
 				break;
		 	default:
		 		$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
		 		break;
		}

		return $configs; 
	}
}

function apustheme_property_page_link($keep_query = false ) {
    if ( is_post_type_archive( 'property' ) ) {
        $link = get_post_type_archive_link( 'property' );
    } else {
        $link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
    }

    if( $keep_query ) {
        // Keep query string vars intact
        foreach ( $_GET as $key => $val ) {
            if ( 'orderby' === $key || 'submit' === $key ) {
                continue;
            }
            $link = add_query_arg( $key, $val, $link );
        }
    }
    return $link;
}

remove_action( 'realia_before_property_archive', array( 'Realia_Filter', 'sort_template' ) );


if ( !function_exists('apustheme_woocommerce_get_display_mode') ) {
    function apustheme_woocommerce_get_display_mode() {
        $woo_mode = get_theme_mod( 'realia_general_show_property_archive_as_grid', null );
        if ($woo_mode == '1') {
        	$woo_mode = 'grid';
        } else {
        	$woo_mode = 'list';
        }
        if ( isset($_COOKIE['apustheme_woo_mode']) && ($_COOKIE['apustheme_woo_mode'] == 'list' || $_COOKIE['apustheme_woo_mode'] == 'grid') ) {
            $woo_mode = $_COOKIE['apustheme_woo_mode'];
        }
        return $woo_mode;
    }
}