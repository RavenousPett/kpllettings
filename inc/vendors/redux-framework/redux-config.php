<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Apustheme_Redux_Framework_Config')) {

    class Apustheme_Redux_Framework_Config
    {
        public $args = array();
        public $sections = array();
        public $ReduxFramework;

        public function __construct()
        {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            add_action('init', array($this, 'initSettings'), 10);
        }

        public function initSettings()
        {
            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        public function setSections()
        {
            global $wp_registered_sidebars;
            $sidebars = array();

            if ( !empty($wp_registered_sidebars) ) {
                foreach ($wp_registered_sidebars as $sidebar) {
                    $sidebars[$sidebar['id']] = $sidebar['name'];
                }
            }
            $columns = array( '1' => esc_html__('1 Column', 'preston'),
                '2' => esc_html__('2 Columns', 'preston'),
                '3' => esc_html__('3 Columns', 'preston'),
                '4' => esc_html__('4 Columns', 'preston'),
                '5' => esc_html__('5 Columns', 'preston'),
                '6' => esc_html__('6 Columns', 'preston')
            );
            
            $general_fields = array();
            if ( !function_exists( 'wp_site_icon' ) ) {
                $general_fields[] = array(
                    'id' => 'media-favicon',
                    'type' => 'media',
                    'title' => esc_html__('Favicon Upload', 'preston'),
                    'desc' => esc_html__('', 'preston'),
                    'subtitle' => esc_html__('Upload a 16px x 16px .png or .gif image that will be your favicon.', 'preston'),
                );
            }
            $general_fields[] = array(
                'id' => 'preload',
                'type' => 'switch',
                'title' => esc_html__('Preload Website', 'preston'),
                'default' => true,
            );
            $general_fields[] = array(
                'id' => 'image_lazy_loading',
                'type' => 'switch',
                'title' => esc_html__('Image Lazy Loading', 'preston'),
                'default' => true,
            );
            // General Settings Tab
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => esc_html__('General', 'preston'),
                'fields' => $general_fields
            );
            // Header
            $this->sections[] = array(
                'icon' => 'el el-website',
                'title' => esc_html__('Header', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'media-logo',
                        'type' => 'media',
                        'title' => esc_html__('Logo Upload', 'preston'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your logo.', 'preston'),
                    ),
                    array(
                        'id' => 'media-mobile-logo',
                        'type' => 'media',
                        'title' => esc_html__('Mobile Logo Upload', 'preston'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your logo.', 'preston'),
                    ),
                    array(
                        'id' => 'header_type',
                        'type' => 'select',
                        'title' => esc_html__('Header Layout Type', 'preston'),
                        'subtitle' => esc_html__('Choose a header for your website.', 'preston'),
                        'options' => apustheme_get_header_layouts()
                    ),
                    array(
                        'id' => 'keep_header',
                        'type' => 'switch',
                        'title' => esc_html__('Keep Header When Scroll Mouse', 'preston'),
                        'default' => false
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Search Form', 'preston'),
                'fields' => array(
                    array(
                        'id'=>'show_searchform',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search Form', 'preston'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'preston'),
                        'off' => esc_html__('No', 'preston'),
                    ),
                    array(
                        'id'=>'search_type',
                        'type' => 'button_set',
                        'title' => esc_html__('Search Content Type', 'preston'),
                        'required' => array('show_searchform','equals',true),
                        'options' => array('all' => esc_html__('All', 'preston'), 'post' => esc_html__('Post', 'preston'), 'product' => esc_html__('Product', 'preston')),
                        'default' => 'all'
                    ),
                    array(
                        'id'=>'search_category',
                        'type' => 'switch',
                        'title' => esc_html__('Show Categories', 'preston'),
                        'required' => array('search_type', 'equals', array('post', 'product')),
                        'default' => false,
                        'on' => esc_html__('Yes', 'preston'),
                        'off' => esc_html__('No', 'preston'),
                    ),
                    array(
                        'id' => 'autocomplete_search',
                        'type' => 'switch',
                        'title' => esc_html__('Autocomplete search?', 'preston'),
                        'required' => array('show_searchform','equals',true),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_search_product_image',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search Result Image', 'preston'),
                        'required' => array('autocomplete_search', '=', '1'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_search_product_price',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search Result Price', 'preston'),
                        'required' => array(array('autocomplete_search', '=', '1'), array('search_type', '=', 'product')),
                        'default' => 1
                    ),
                )
            );
            // Footer
            $this->sections[] = array(
                'icon' => 'el el-website',
                'title' => esc_html__('Footer', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'footer_type',
                        'type' => 'select',
                        'title' => esc_html__('Footer Layout Type', 'preston'),
                        'subtitle' => esc_html__('Choose a footer for your website.', 'preston'),
                        'options' => apustheme_get_footer_layouts()
                    ),
                    array(
                        'id' => 'back_to_top',
                        'type' => 'switch',
                        'title' => esc_html__('Back To Top Button', 'preston'),
                        'subtitle' => esc_html__('Toggle whether or not to enable a back to top button on your pages.', 'preston'),
                        'default' => true,
                    ),
                )
            );

            // Blog settings
            $this->sections[] = array(
                'icon' => 'el el-pencil',
                'title' => esc_html__('Blog', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'show_blog_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'preston'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'preston'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'preston').'</em>',
                        'id' => 'blog_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'blog_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'preston'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'preston'),
                    ),
                )
            );
            // Archive Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog & Post Archives', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'blog_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'preston'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'preston'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'preston'),
                                'alt' => esc_html__('Main Only', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'preston'),
                                'alt' => esc_html__('Left - Main Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Main - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'blog_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'preston'),
                        'default' => false
                    ),
                    array(
                        'id' => 'blog_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'preston'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'blog_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'preston'),
                        'options' => $sidebars
                        
                    ),
                    array(
                        'id' => 'blog_display_mode',
                        'type' => 'select',
                        'title' => esc_html__('Display Mode', 'preston'),
                        'options' => array(
                            'grid' => esc_html__('Grid Layout', 'preston'),
                            'mansory' => esc_html__('Mansory Layout', 'preston'),
                            'list' => esc_html__('List Layout', 'preston'),
                            'chess' => esc_html__('Chess Layout', 'preston'),
                            'timeline' => esc_html__('Timeline Layout', 'preston'),
                        ),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Blog Columns', 'preston'),
                        'options' => $columns,
                        'default' => 4
                    ),
                    array(
                        'id' => 'blog_item_style',
                        'type' => 'select',
                        'title' => esc_html__('Blog Item Style', 'preston'),
                        'options' => array(
                            'grid' => esc_html__('Grid', 'preston'),
                            'list' => esc_html__('List', 'preston')
                        ),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'blog_item_thumbsize',
                        'type' => 'text',
                        'title' => esc_html__('Thumbnail Size', 'preston'),
                        'desc' => esc_html__('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme.', 'preston'),
                    ),

                )
            );
            // Single Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog', 'preston'),
                'fields' => array(
                    
                    array(
                        'id' => 'blog_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'preston'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'preston'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'preston'),
                                'alt' => esc_html__('Main Only', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'preston'),
                                'alt' => esc_html__('Left - Main Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Main - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'blog_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'preston'),
                        'default' => false
                    ),
                    array(
                        'id' => 'blog_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Left Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'preston'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'blog_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Right Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'preston'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'show_blog_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'preston'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_blog_releated',
                        'type' => 'switch',
                        'title' => esc_html__('Show Releated Posts', 'preston'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_blog_releated',
                        'type' => 'text',
                        'title' => esc_html__('Number of related posts to show', 'preston'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'default' => 4,
                        'min' => '1',
                        'step' => '1',
                        'max' => '20',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'releated_blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Releated Blogs Columns', 'preston'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'options' => $columns,
                        'default' => 4
                    ),

                )
            );
            // Agency
            $this->sections[] = array(
                'icon' => 'el el-shopping-cart',
                'title' => esc_html__('Agency', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'show_agency_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'preston'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'preston'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'preston').'</em>',
                        'id' => 'agency_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'agency_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'preston'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'preston'),
                    )
                )
            );
            // Archive settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Agency Archives', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'agency_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'preston'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your archive agency page.', 'preston'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Content', 'preston'),
                                'alt' => esc_html__('Main Content', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left Sidebar - Main Content', 'preston'),
                                'alt' => esc_html__('Left Sidebar - Main Content', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main Content - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Main Content - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'agency_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'preston'),
                        'default' => false
                    ),
                    array(
                        'id' => 'agency_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'preston'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'agency_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'preston'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'number_agency_per_page',
                        'type' => 'text',
                        'title' => esc_html__('Number of Products Per Page', 'preston'),
                        'default' => 12,
                        'min' => '1',
                        'step' => '1',
                        'max' => '100',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'agency_columns',
                        'type' => 'select',
                        'title' => esc_html__('Agency Columns', 'preston'),
                        'options' => $columns,
                        'default' => 4
                    ),
                    array(
                        'id' => 'show_agency_agents',
                        'type' => 'switch',
                        'title' => esc_html__('Show Agency Agents', 'preston'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_agency_agents',
                        'title' => esc_html__('Number agents', 'preston'),
                        'default' => 4,
                        'min' => '1',
                        'step' => '1',
                        'max' => '20',
                        'type' => 'slider',
                        'required' => array('show_agency_agents','equals',true),
                    ),
                    array(
                        'id' => 'agent_agency_columns',
                        'type' => 'select',
                        'title' => esc_html__('Columns', 'preston'),
                        'options' => $columns,
                        'default' => 4,
                        'required' => array('show_agency_agents','equals',true),
                    ),
                )
            );
            // Agency Page
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Single Agency', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'agency_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'preston'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your Single Product Page.', 'preston'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'preston'),
                                'alt' => esc_html__('Main Only', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'preston'),
                                'alt' => esc_html__('Left - Main Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Main - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'agency_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'preston'),
                        'default' => false
                    ),
                    array(
                        'id' => 'agency_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Left Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'preston'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'agency_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Right Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'preston'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'show_agency_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'preston'),
                        'default' => 1
                    )

                )
            );
            // Agent
            $this->sections[] = array(
                'icon' => 'el el-shopping-cart',
                'title' => esc_html__('Agent', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'show_agent_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'preston'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'preston'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'preston').'</em>',
                        'id' => 'agent_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'agent_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'preston'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'preston'),
                    )
                )
            );
            // Archive settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Agent Archives', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'agent_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'preston'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your archive agent page.', 'preston'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Content', 'preston'),
                                'alt' => esc_html__('Main Content', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left Sidebar - Main Content', 'preston'),
                                'alt' => esc_html__('Left Sidebar - Main Content', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main Content - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Main Content - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'agent_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'preston'),
                        'default' => false
                    ),
                    array(
                        'id' => 'agent_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'preston'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'agent_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'preston'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'number_agent_per_page',
                        'type' => 'text',
                        'title' => esc_html__('Number of Products Per Page', 'preston'),
                        'default' => 12,
                        'min' => '1',
                        'step' => '1',
                        'max' => '100',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'agent_columns',
                        'type' => 'select',
                        'title' => esc_html__('Agent Columns', 'preston'),
                        'options' => $columns,
                        'default' => 4
                    ),
                )
            );
            // Agent Page
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Single Agent', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'agent_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'preston'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your Single Product Page.', 'preston'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'preston'),
                                'alt' => esc_html__('Main Only', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'preston'),
                                'alt' => esc_html__('Left - Main Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Main - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'agent_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'preston'),
                        'default' => false
                    ),
                    array(
                        'id' => 'agent_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Left Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'preston'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'agent_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Right Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'preston'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'show_agent_properties',
                        'type' => 'switch',
                        'title' => esc_html__('Show Agent Properties', 'preston'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_agent_properties',
                        'title' => esc_html__('Number properties', 'preston'),
                        'default' => 4,
                        'min' => '1',
                        'step' => '1',
                        'max' => '20',
                        'type' => 'slider',
                        'required' => array('show_agent_properties','equals',true),
                    ),
                    array(
                        'id' => 'property_agent_columns',
                        'type' => 'select',
                        'title' => esc_html__('Columns', 'preston'),
                        'options' => $columns,
                        'default' => 4,
                        'required' => array('show_agent_properties','equals',true),
                    ),
                    array(
                        'id' => 'show_agent_contact_form',
                        'type' => 'switch',
                        'title' => esc_html__('Show Agent Contact Form', 'preston'),
                        'default' => 1
                    ),
                )
            );
            // Property Archive settings
            $block_contents = array();
            if (is_admin()) {
                $block_contents = apustheme_get_block_content_profiles();
            }
            $this->sections[] = array(
                'title' => esc_html__('Property Archives Page', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'property_archive_layout_version',
                        'type' => 'select',
                        'title' => esc_html__('Archive Layout', 'preston'),
                        'subtitle' => esc_html__('Choose a layout for archvie, taxonomy page.', 'preston'),
                        'options' => array(
                            'default' => esc_html__('Default', 'preston'),
                            'half-map' => esc_html__('Half Map', 'preston'),
                        ),
                        'default' => true
                    ),
                    array(
                        'id' => 'property_archive_show_top_content',
                        'type' => 'switch',
                        'title' => esc_html__('Show Archive Top Content', 'preston'),
                        'required' => array('property_archive_layout_version', 'equals', 'default'),
                        'default' => true
                    ),
                    array(
                        'id' => 'property_archive_top_content',
                        'type' => 'select',
                        'title' => esc_html__('Archive Top Block Content', 'preston'),
                        'required' => array('property_archive_show_top_content', 'equals', true),
                        'options' => $block_contents
                    ),
                    array(
                        'id' => 'property_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'preston'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your archive property page.', 'preston'),
                        'required' => array('property_archive_layout_version', 'equals', 'default'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Content', 'preston'),
                                'alt' => esc_html__('Main Content', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left Sidebar - Main Content', 'preston'),
                                'alt' => esc_html__('Left Sidebar - Main Content', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main Content - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Main Content - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'property_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'preston'),
                        'default' => false,
                        'required' => array('property_archive_layout_version', 'equals', 'default'),
                    ),
                    array(
                        'id' => 'property_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'preston'),
                        'options' => $sidebars,
                        'required' => array('property_archive_layout_version', 'equals', 'default'),
                    ),
                    array(
                        'id' => 'property_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'preston'),
                        'options' => $sidebars,
                        'required' => array('property_archive_layout_version', 'equals', 'default'),
                    ),


                    array(
                        'id' => 'number_property_per_page',
                        'type' => 'text',
                        'title' => esc_html__('Number of Products Per Page', 'preston'),
                        'default' => 12,
                        'min' => '1',
                        'step' => '1',
                        'max' => '100',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'property_columns',
                        'type' => 'select',
                        'title' => esc_html__('Property Columns', 'preston'),
                        'options' => $columns,
                        'default' => 3
                    ),
                )
            );
            // Single Property Page
            $this->sections[] = array(
                'title' => esc_html__('Property Detail page', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'property_single_layout_type',
                        'type' => 'select',
                        'title' => esc_html__('Property Layout Type', 'preston'),
                        'options' => array(
                            'default' => esc_html__('Default', 'preston'),
                            'layout1' => esc_html__('Layout 1', 'preston'),
                            'layout2' => esc_html__('Layout 2', 'preston')
                        ),
                        'default' => 'default',
                    ),
                    array(
                        'id' => 'property_single_content_layout',
                        'type' => 'select',
                        'title' => esc_html__('Property Content Layout', 'preston'),
                        'options' => array(
                            'default' => esc_html__('Default', 'preston'),
                            'tabs' => esc_html__('Tabs', 'preston')
                        ),
                        'default' => 'default',
                    ),
                    array(
                        'id' => 'show_property_social',
                        'type' => 'switch',
                        'title' => esc_html__('Show Property Social', 'preston'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_property_sub',
                        'type' => 'switch',
                        'title' => esc_html__('Show Sub Properties', 'preston'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_property_similar',
                        'type' => 'switch',
                        'title' => esc_html__('Show Properties Similar', 'preston'),
                        'default' => 1
                    ),
                )
            );
            // Page IDX settings
            $this->sections[] = array(
                'icon' => 'el el-pencil',
                'title' => esc_html__('Idx Page', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'show_page_idx_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'preston'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'preston'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'preston').'</em>',
                        'id' => 'page_idx_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'page_idx_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'preston'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'preston'),
                    ),
                    array(
                        'id' => 'page_idx_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'preston'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'preston'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'preston'),
                                'alt' => esc_html__('Main Only', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'preston'),
                                'alt' => esc_html__('Left - Main Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Main - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'preston'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'preston'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'page_idx_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'preston'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'page_idx_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'preston'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'preston'),
                        'options' => $sidebars
                        
                    ),
                )
            );
            // Style
            $this->sections[] = array(
                'icon' => 'el el-icon-css',
                'title' => esc_html__('Style', 'preston'),
                'fields' => array(
                    array (
                        'id' => 'main_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Content', 'preston').'</h3>',
                    ),
                    array (
                        'title' => esc_html__('Main Theme Color', 'preston'),
                        'subtitle' => esc_html__('The main color of the site.', 'preston'),
                        'id' => 'main_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '#EC7A5C',
                    ),
                    array (
                        'title' => esc_html__('Second Theme Color', 'preston'),
                        'subtitle' => esc_html__('The main color of the site.', 'preston'),
                        'id' => 'second_color',
                        'type' => 'color',
                        'transparent' => false,
                        'default' => '#EC7A5C',
                    ),
                    array (
                        'id' => 'site_background',
                        'type' => 'background',
                        'title' => esc_html__('Site Background', 'preston'),
                        'output' => 'body'
                    ),
                    array (
                        'id' => 'container_bg',
                        'type' => 'color_rgba',
                        'title' => esc_html__('Container Background Color', 'preston'),
                        'output' => array(
                            'background-color' =>'#apus-main-content'
                        )
                    ),
                    array (
                        'id' => 'forms_inputs_bg',
                        'type' => 'color_rgba',
                        'title' => esc_html__('Forms inputs Color', 'preston'),
                        'output' => array(
                            'background-color' =>'.form-control, select, .quantity input[type="number"], .emodal, input[type="text"], input[type="email"], input[type="password"], input[type="tel"], textarea, textarea.form-control, .mail-form .input-group .form-control'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Typography', 'preston'),
                'fields' => array(
                    
                    array (
                        'id' => 'main_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Body Font', 'preston').'</h3>',
                    ),
                    // Standard + Google Webfonts
                    array (
                        'title' => esc_html__('Font Face', 'preston'),
                        'subtitle' => '<em>'.esc_html__('Pick the Main Font for your site.', 'preston').'</em>',
                        'id' => 'main_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'default' => array (
                            'font-family' => 'Montserrat',
                            'subsets' => '',
                        ),
                        'output' => array(
                            'body, p'
                        )
                    ),
                    
                    // Header
                    array (
                        'id' => 'secondary_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Heading', 'preston').'</h3>',
                    ),
                    array (
                        'title' => esc_html__('H1 Font', 'preston'),
                        'subtitle' => '<em>'.esc_html__('Pick the H1 Font for your site.', 'preston').'</em>',
                        'id' => 'h1_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h1'
                        )
                    ),
                    array (
                        'title' => esc_html__('H2 Font', 'preston'),
                        'subtitle' => '<em>'.esc_html__('Pick the H2 Font for your site.', 'preston').'</em>',
                        'id' => 'h2_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h2'
                        )
                    ),
                    array (
                        'title' => esc_html__('H3 Font', 'preston'),
                        'subtitle' => '<em>'.esc_html__('Pick the H3 Font for your site.', 'preston').'</em>',
                        'id' => 'h3_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h3'
                        )
                    ),
                    array (
                        'title' => esc_html__('H4 Font', 'preston'),
                        'subtitle' => '<em>'.esc_html__('Pick the H4 Font for your site.', 'preston').'</em>',
                        'id' => 'h4_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h4'
                        )
                    ),
                    array (
                        'title' => esc_html__('H5 Font', 'preston'),
                        'subtitle' => '<em>'.esc_html__('Pick the H5 Font for your site.', 'preston').'</em>',
                        'id' => 'h5_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h5'
                        )
                    ),
                    array (
                        'title' => esc_html__('H6 Font', 'preston'),
                        'subtitle' => '<em>'.esc_html__('Pick the H6 Font for your site.', 'preston').'</em>',
                        'id' => 'h6_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h6'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Top Bar', 'preston'),
                'fields' => array(
                    array(
                        'id'=>'topbar_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'preston'),
                        'output' => '#apus-topbar'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'preston'),
                        'id' => 'topbar_text_color',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'preston'),
                        'id' => 'topbar_link_color',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color When Hover', 'preston'),
                        'id' => 'topbar_link_color_hover',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar a:hover'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Header', 'preston'),
                'fields' => array(
                    array(
                        'id'=>'header_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'preston'),
                        'output' => '#apus-header'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'preston'),
                        'id' => 'header_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'preston'),
                        'id' => 'header_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Active', 'preston'),
                        'id' => 'header_link_color_active',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header .active > a, #apus-header a:active, #apus-header a:hover'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Main Menu', 'preston'),
                'fields' => array(
                    array(
                        'title' => esc_html__('Link Color', 'preston'),
                        'id' => 'main_menu_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'.navbar-nav.megamenu > li > a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Active', 'preston'),
                        'id' => 'main_menu_link_color_active',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'.navbar-nav.megamenu > li.active > a, .navbar-nav.megamenu > li:hover > a, .navbar-nav.megamenu > li:active > a,.navbar-nav.megamenu > li.open > a'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Footer', 'preston'),
                'fields' => array(
                    array(
                        'id'=>'footer_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'preston'),
                        'output' => '.apus-footer'
                    ),
                    array(
                        'title' => esc_html__('Heading Color', 'preston'),
                        'id' => 'footer_heading_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer .widgettile,#apus-footer .widget-title'
                        )
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'preston'),
                        'id' => 'footer_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'preston'),
                        'id' => 'footer_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Hover', 'preston'),
                        'id' => 'footer_link_color_hover',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer a:hover'
                        )
                    ),
                )
            );
            
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Copyright', 'preston'),
                'fields' => array(
                    array(
                        'id'=>'copyright_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'preston'),
                        'output' => '.apus-copyright'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'preston'),
                        'id' => 'copyright_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'preston'),
                        'id' => 'copyright_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright a, .apus-copyright a i'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Hover', 'preston'),
                        'id' => 'copyright_link_color_hover',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright a:hover .apus-copyright a i:hover'
                        )
                    ),
                )
            );

            // Social Media
            $this->sections[] = array(
                'icon' => 'el el-file',
                'title' => esc_html__('Social Media', 'preston'),
                'fields' => array(
                    array(
                        'id' => 'facebook_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Facebook Share', 'preston'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'twitter_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable twitter Share', 'preston'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'linkedin_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable linkedin Share', 'preston'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'tumblr_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable tumblr Share', 'preston'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'google_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable google plus Share', 'preston'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'pinterest_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable pinterest Share', 'preston'),
                        'default' => 1
                    )
                )
            );
            // Custom Code
            $this->sections[] = array(
                'icon' => 'el-icon-css',
                'title' => esc_html__('Custom CSS/JS', 'preston'),
                'fields' => array(
                    array (
                        'title' => esc_html__('Custom CSS', 'preston'),
                        'subtitle' => esc_html__('Paste your custom CSS code here.', 'preston'),
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                    
                    array (
                        'title' => esc_html__('Header JavaScript Code', 'preston'),
                        'subtitle' => esc_html__('Paste your custom JS code here. The code will be added to the header of your site.', 'preston'),
                        'id' => 'header_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                    
                    array (
                        'title' => esc_html__('Footer JavaScript Code', 'preston'),
                        'subtitle' => esc_html__('Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.', 'preston'),
                        'id' => 'footer_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                )
            );
            $this->sections[] = array(
                'title' => esc_html__('Import / Export', 'preston'),
                'desc' => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'preston'),
                'icon' => 'el-icon-refresh',
                'fields' => array(
                    array(
                        'id' => 'opt-import-export',
                        'type' => 'import_export',
                        'title' => esc_html__('Import Export', 'preston'),
                        'subtitle' => esc_html__('Save and restore your Redux options', 'preston'),
                        'full_width' => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments()
        {
            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $preset = apustheme_get_demo_preset();
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'apustheme_theme_options'.$preset,
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'),
                // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'),
                // Version that appears at the top of your panel
                'menu_type' => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true,
                // Show the sections below the admin menu item or not
                'menu_title' => esc_html__('Theme Options', 'preston'),
                'page_title' => esc_html__('Theme Options', 'preston'),

                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography' => true,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar' => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon' => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable' => 'apustheme_options',
                // Set a different name for your global variable other than the opt_name
                'dev_mode' => false,
                // Show the time the page took to load, etc
                'update_notice' => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer' => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority' => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon' => '',
                // Specify a custom URL to an icon
                'last_tab' => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options',
                // Page slug used to denote the panel
                'save_defaults' => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show' => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false,
                // REMOVE
                'use_cdn' => true
            );

            return $this->args;
        }

    }

    global $reduxConfig;
    $reduxConfig = new Apustheme_Redux_Framework_Config();
}
