<?php

if( in_array( 'realia/realia.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    add_action('init', 'apustheme_realia_kingcomposer_map', 99 );

    function apustheme_realia_kingcomposer_map() {
        global $kc;
        $contracts = array(
            '' => esc_html__( 'All', 'preston' ),
            'rent' => esc_html__( 'Rent', 'preston' ),
            'sale' => esc_html__( 'Sale', 'preston' ),
        );
        $types = array(
            'featured' => esc_html__( 'Featured', 'preston' ),
            'latest' => esc_html__( 'Latest', 'preston' ),
            'sticky' => esc_html__( 'Sticky', 'preston' ),
            'reduced' => esc_html__( 'Reduced', 'preston' ),
        );
        $kc->add_map( array('realia_properties' => array(
            'name' => 'Apus Properties',
            'description' => esc_html__('Display properties in frontend', 'preston'),
            'icon' => 'sl-paper-plane',
            'category' => 'Apus Realia',
            'params' => array(
                'general' => array(
                    array(
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'preston' ),
                        'type' => 'text'
                    ),
                    array(
                        'name' => 'contract',
                        'label' => esc_html__( 'Contract', 'preston' ),
                        'type' => 'select',
                        'admin_label' => true,
                        'options' => $contracts
                    ),
                    array(
                        'name' => 'type',
                        'label' => esc_html__( 'Property Type', 'preston' ),
                        'type' => 'select',
                        'admin_label' => true,
                        'options' => $types
                    ),
                    array(
                        'name' => 'number',
                        'label' => esc_html__( 'Number property', 'preston' ),
                        'type' => 'number_slider',
                        'options' => array(
                            'min' => 1,
                            'max' => 24,
                            'unit' => '',
                            'show_input' => true
                        ),
                        'value' => 3,
                    ),
                    array(
                        'name' => 'layout_type',
                        'label' => esc_html__( 'Layout Type' ,'preston' ),
                        'type' => 'select',
                        'admin_label' => true,
                        'options' => array(
                            'grid' => esc_html__( 'Grid' ,'preston' ),
                            'list' => esc_html__( 'List' ,'preston' ),
                            'carousel' => esc_html__( 'Carousel' ,'preston' ),
                            'special1' => esc_html__( 'Special 1' ,'preston' ),
                            'special2' => esc_html__( 'Special 2' ,'preston' ),
                        )
                    ),
                    array(
                        'name' => 'columns',
                        'label' => esc_html__( 'Columns' ,'preston' ),
                        'type' => 'number_slider',
                        'options' => array(
                            'min' => 1,
                            'max' => 6,
                            'unit' => '',
                            'show_input' => true
                        ),
                        'value' => 3,
                        'relation'      => array(
                            'parent'    => 'layout_type',
                            'show_when' => array('grid', 'carousel')
                        )
                    )
                ),
                'animate' => array(
                    array(
                        'name'    => 'animate',
                        'type'    => 'animate'
                    )
                ),
            )
            
        )));

        // agents
        $kc->add_map( array('realia_agents' => array(
            'name' => 'Apus Agents',
            'description' => esc_html__('Display agents in frontend', 'preston'),
            'icon' => 'sl-paper-plane',
            'category' => 'Apus Realia',
            'params' => array(
                'general' => array(
                    
                    array(
                        'name' => 'number',
                        'label' => esc_html__( 'Number agent', 'preston' ),
                        'type' => 'number_slider',
                        'options' => array(
                            'min' => 1,
                            'max' => 24,
                            'unit' => '',
                            'show_input' => true
                        ),
                        'value' => 3,
                    ),
                    array(
                        'name' => 'layout_type',
                        'label' => esc_html__( 'Layout Type' ,'preston' ),
                        'type' => 'select',
                        'admin_label' => true,
                        'options' => array(
                            'grid' => esc_html__( 'Grid' ,'preston' ),
                            'carousel' => esc_html__( 'Carousel' ,'preston' ),
                        )
                    ),
                    array(
                        'name' => 'columns',
                        'label' => esc_html__( 'Columns' ,'preston' ),
                        'type' => 'number_slider',
                        'options' => array(
                            'min' => 1,
                            'max' => 6,
                            'unit' => '',
                            'show_input' => true
                        ),
                        'value' => 3
                    ),
                    array(
                        'name' => 'item_style',
                        'label' => esc_html__( 'Item Style' ,'preston' ),
                        'type' => 'select',
                        'admin_label' => true,
                        'options' => array(
                            'style1' => esc_html__( 'Style 1' , 'preston' ),
                            'style2' => esc_html__( 'Style 2' , 'preston' ),
                        )
                    ),
                ),
                'animate' => array(
                    array(
                        'name'    => 'animate',
                        'type'    => 'animate'
                    )
                ),
            )
            
        )));

        // Slider Properties
        $kc->add_map( array('realia_slider_properties' => array(
            'name' => 'Apus Slider Properties',
            'description' => esc_html__('Display Slider Properties in frontend', 'preston'),
            'icon' => 'sl-paper-plane',
            'category' => 'Apus Realia',
            'params' => array(
                'general' => array(
                    array(
                        'type'          => 'autocomplete',
                        'label'         => esc_html__('Autocomplete', 'preston'),
                        'name'          => 'ids',
                        'options'       => array(
                            'multiple'      => true,
                            'post_type'     => 'property', // default is "any"
                        )
                    ),
                    array(
                        'name' => 'show_arrows',
                        'label' => esc_html__('Show arrows', 'preston'),
                        'type' => 'toggle',
                    ),
                    array(
                        'name' => 'show_dots',
                        'label' => esc_html__('Show dots', 'preston'),
                        'type' => 'toggle',
                    ),
                    array(
                        'name' => 'autoplay',
                        'label' => esc_html__('Autoplay', 'preston'),
                        'type' => 'toggle',
                    ),
                    array(
                        'name' => 'autoplay_timeout ',
                        'label' => esc_html__( 'Autoplay timeout', 'preston' ),
                        'type' => 'text',
                        'value' => 10000,
                    ),
                ),
                'animate' => array(
                    array(
                        'name'    => 'animate',
                        'type'    => 'animate'
                    )
                ),
            )
            
        )));
    }
}

add_filter( 'apus_themer_kingcomposer_map_element_newsletter', 'apustheme_kingcomposer_map_newsletter');
function apustheme_kingcomposer_map_newsletter($args) {
    if ( isset($args['params'][0]['options']) ) {
        $args['params'][0]['options'] = array(
                'style1' => esc_html__( 'Style 1', 'preston' ),
                'style2' => esc_html__( 'Style 2', 'preston' ),
                'style3' => esc_html__( 'Style 3', 'preston' )
            );
    }
    return $args;
}


add_action('init', 'apustheme_kingcomposer_maps', 99 );
function apustheme_kingcomposer_maps() {
    global $kc;
    $layouts = array(
        'grid' => esc_html__( 'Grid', 'preston' ),
        'carousel' => esc_html__( 'Carousel', 'preston' ),
        'list' => esc_html__( 'List', 'preston' )
    );
    // element heading title
    $kc->add_map( array('element_heading_title' => array(
        'name' => 'Apus Heading Title',
        'description' => esc_html__('Display Heading Title in frontend', 'preston'),
        'icon' => 'sl-paper-plane',
        'category' => 'Elements',
        'params' => array(
            array(
                'name' => 'title',
                'label' => esc_html__( 'Title', 'preston' ),
                'type' => 'text'
            ),
            array(
                "type" => "textarea",
                "class" => "",
                "label" => esc_html__('Description', 'preston'),
                "name" => "description",
            ),
            array(
                'name' => 'style',
                'label' => esc_html__( 'Style' ,'preston' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => array(
                    '' => esc_html__( 'Default' , 'preston' ),
                    'style_white' => esc_html__( 'White' , 'preston' ),
                    'style_left' => esc_html__( 'Text Left' , 'preston' ),
                )
            ),
        )
    )));

    $kc->add_map( array('element_contact_info' => array(
        'name' => esc_html__( 'Apus Contact Info', 'preston' ),
        'title' => esc_html__( 'Apus Contact Info Settings', 'preston' ),
        'icon' => 'fa fa-newspaper-o',
        'category' => 'Elements',
        'wrapper_class' => 'clearfix',
        'description' => esc_html__( 'Display Contact Info.', 'preston' ),
        'params' => array(
            array(
                'name' => 'title',
                'label' => esc_html__( 'Title', 'preston' ),
                'type' => 'text'
            ),
            array(
                "type" => "textarea",
                "class" => "",
                "label" => esc_html__('Description', 'preston'),
                "name" => "description",
            ),
            array(
                'type' => 'group',
                'label' => esc_html__('Items', 'preston'),
                'name' => 'items',
                'params' => array(
                    array(
                        "type" => "icon_picker",
                        "label" => esc_html__("Icon Font", 'preston'),
                        "name" => "icon"
                    ),
                    array(
                        "type" => "attach_image",
                        "description" => esc_html__("If you upload an image, icon will not show.", 'preston'),
                        "name" => "image",
                        'label' => esc_html__('Icon Image', 'preston' )
                    ),
                    array(
                        "type" => "textarea",
                        "class" => "",
                        "label" => esc_html__('Description', 'preston'),
                        "name" => "description",
                    ),
                ),
            ),
            array(
                'name' => 'style',
                'label' => esc_html__( 'Item Style' ,'preston' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => array(
                    '' => esc_html__( 'Default' , 'preston' ),
                    'no_border' => esc_html__( 'No Border' , 'preston' ),
                )
            ),
        )
    )));

    $kc->add_map( array('element_testimonials' => array(
        'name' => esc_html__( 'Apus Testimonials', 'preston' ),
        'title' => esc_html__( 'Apus Testimonials Settings', 'preston' ),
        'icon' => 'fa fa-newspaper-o',
        'category' => 'Elements',
        'wrapper_class' => 'clearfix',
        'description' => esc_html__( 'List of testimonials with more layouts.', 'preston' ),
        'params' => array(
            array(
                'type'            => 'group',
                'label'            => esc_html__('Testimonial Items', 'preston'),
                'name'            => 'testimonials',
                'params' => array(
                    array(
                        "type" => "attach_image",
                        "label" => esc_html__('Photo', 'preston'),
                        "name" => 'image',
                        "value" => '',
                    ),
                    array(
                        'type' => 'text',
                        'label' => esc_html__( 'Name', 'preston' ),
                        'name' => 'name',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'text',
                        'label' => esc_html__( 'Job', 'preston' ),
                        'name' => 'job',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => esc_html__( 'Content', 'preston' ),
                        'name' => 'content',
                        'admin_label' => true,
                    ),
                ),
            ),
            array(
                'name' => 'columns',
                'label' => esc_html__( 'Grid Column' ,'preston' ),
                'type' => 'number_slider',
                'options' => array(
                    'min' => 1,
                    'max' => 6,
                    'unit' => '',
                    'show_input' => true
                ),
                "admin_label" => true
            ),
            array(
                'name' => 'layout_type',
                'label' => esc_html__( 'Layout Type' ,'preston' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => $layouts
            ),
            array(
                'name' => 'style',
                'label' => esc_html__( 'Item Style' ,'preston' ),
                'type' => 'select',
                'admin_label' => true,
                'options' => array(
                    '' => esc_html__( 'Default' , 'preston' ),
                    'style_border' => esc_html__( 'Style Border' , 'preston' ),
                )
            ),
        )
    )));
}