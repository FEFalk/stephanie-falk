<?php
/**
 * Initialize the custom Theme Options.
 */
add_action( 'init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.0
 */
function custom_theme_options() {

    /* OptionTree is not loaded yet, or this is not an admin request */
    if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
        return false;

    /**
     * Get a copy of the saved settings array.
     */
    $saved_settings = get_option( ot_settings_id(), array() );

    /**
     * Custom settings array that will eventually be
     * passes to the OptionTree Settings API Class.
     */
    $custom_settings = array(
        /*'contextual_help' => array(
            'content'       => array(
                array(
                    'id'        => 'option_types_help',
                    'title'     => __( 'Option Types', 'yoga' ),
                    'content'   => '<p>' . __( 'Help content goes here!', 'yoga' ) . '</p>'
                ),
            ),
            'sidebar'       => '<p>' . __( 'Sidebar content goes here!', 'yoga' ) . '</p>'
        ),*/
        'sections'        => array(

            array(
                'id'          => 'header_option',
                'title'       => __( 'Header', 'yoga' )
            ),
            array(
                'id'          => 'footer_options',
                'title'       => __( 'Footer', 'yoga' )
            ),

            array(
                'id'          => 'typo_option',
                'title'       => __( 'Typography', 'yoga' )
            ),
            array(
                'id'          => 'layout_options',
                'title'       => __( 'Layout', 'yoga' )
            ),
            array(
                'id'          => 'social_links',
                'title'       => __( 'Social', 'yoga' )
            ),
            array(
                'id'          => 'styling_options',
                'title'       => __( 'Color Scheme', 'yoga' )
            ),
            array(
                'id'          => 'advanced_options',
                'title'       => __( 'Advanced', 'yoga' )
            ),
            array(
                'id'          => 'importer_section',
                'title'       => __( 'Import', 'yoga' )
            ),


        ),
        'settings'        => array(


            /* Styling Options */

            array(
                'id'          => 'skin_primary',
                'label'       => __( 'Skin - Primary Color', 'yoga' ),
                'std'         => '#000000',
                'type'        => 'colorpicker',
                'section'     => 'styling_options',
            ),

            array(
                'id'          => 'skin_secondary',
                'label'       => __( 'Skin - Secondary Color', 'yoga' ),
                'std'         => '#ffffff',
                'type'        => 'colorpicker',
                'section'     => 'styling_options',
            ),

            array(
                'id'          => 'custom_skin_switch',
                'label'       => __( 'Customize Skin', 'yoga' ),
                'desc'       => __( 'Custom colors selection may override the Primary and Secondary Skin colors at some places', 'yoga' ),
                'std'         => 'off',
                'type'        => 'on-off',
                'class'       => 'switch_div',
                'section'     => 'styling_options',
            ),


            array(
                'id'          => 'body_bg_tab',
                'label'       => __( 'Body', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'body_bg',
                'label'       => __( 'Background', 'yoga' ),
                'desc'        => __( 'Body background with image, color, etc.', 'yoga' ),
                'std'         => array(
                    'background-color'  => '#ffffff'
                ),
                'type'        => 'background',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'headings_colors',
                'label'       => __( 'Headings Colors', 'yoga' ),
                'std'         => array(
                    'h1'    => '#000000',
                    'h2'    => '#000000',
                    'h3'    => '#000000',
                    'h4'    => '#000000',
                    'h5'    => '#000000',
                    'h6'    => '#000000',
                ),
                'type'        => 'link-color',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'body_link_color',
                'label'       => __( 'Link Color', 'yoga' ),
                'std'         => array(
                    'link'  => '#000000',
                    'active'  => '#000000',
                    'hover'  => '#666666',
                    'visited'  => '#000000',
                ),
                'type'        => 'link-color',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'header_bg_tab',
                'label'       => __( 'Header', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'header_bg',
                'label'       => __( 'Background', 'yoga' ),
                'std'         => array(
                    'background-color'  => '#ffffff',
                ),
                'type'        => 'background',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'logo_color',
                'label'       => __( 'Logo Text Color', 'yoga' ),
                'std'         => array(
                    'link'  => '#000000',
                    'hover'  => '#666666'
                ),
                'type'        => 'link-color',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),


            array(
                'id'          => 'menu_bg_tab',
                'label'       => __( 'Menu', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'menu_link_color',
                'label'       => __( 'Menu Item Color', 'yoga' ),
                'std'         => array(
                    'link'  => '#000000',
                    'hover'  => '#ffffff',
                    'active'  => '#ffffff',
                ),
                'type'        => 'link-color',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),
            array(
                'id'          => 'menu_typo_bg',
                'label'       => __( 'Menu Item Background Color', 'yoga' ),
                'std'         => array(
                    'link'  => '#ffffff',
                    'hover'  => '#000000',
                    'active'  => '#000000',
                ),
                'type'        => 'link-color',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'submenu_link_color',
                'label'       => __( 'Submenu Item Color', 'yoga' ),
                'std'         => array(
                    'link'  => '#ffffff',
                    'hover'  => '#ffffff',
                    'active'  => '#ffffff',
                ),
                'type'        => 'link-color',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'submenu_typo_bg',
                'label'       => __( 'Submenu Item Background Color', 'yoga' ),
                'std'         => array(
                    'link'  => '#000000',
                    'hover'  => '#222222',
                    'active'  => '#000000',
                ),
                'type'        => 'link-color',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'banner_bg_tab',
                'label'       => __( 'Banner', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'hbanner_text_color',
                'label'       => __( 'Homepage Banner - Text Color', 'yoga' ),
                'type'        => 'link-color',
                'std'         => array(
                    'link'  => '#ffffff',
                    'hover'  => '#ffffff',
                    'active'  => '#cccccc',
                ),
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'intbanner_text_color',
                'label'       => __( 'Internal Banner - Text Color', 'yoga' ),
                'std'         => array(
                    'link'  => '#ffffff',
                    'hover'  => '#ffffff',
                    'active'  => '#cccccc',
                ),
                'type'        => 'link-color',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'page_sections_color_tab',
                'label'       => __( 'Page Sections', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'page_section_text_color',
                'label'       => __( 'Text Color', 'yoga' ),
                'std'        => '#000000',
                'type'        => 'colorpicker',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'bg_page_section_text_color',
                'label'       => __( 'Background Section - Text Color', 'yoga' ),
                'std'        => '',
                'type'        => 'colorpicker',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'footer_bg_tab',
                'label'       => __( 'Footer', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'footer_bg',
                'label'       => __( 'Background', 'yoga' ),
                'type'        => 'background',
                'section'     => 'styling_options',
                'std'         => array(
                    'background-color'  => '#000000',
                ),
                'condition'     => 'custom_skin_switch:is(on)',
            ),
            array(
                'id'          => 'footer_tcolor',
                'label'       => __( 'Text Color', 'yoga' ),
                'type'        => 'colorpicker',
                'section'     => 'styling_options',
                'std'         => '#ffffff',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'copyright_bg',
                'label'       => __( 'Copyright Background Color', 'yoga' ),
                'type'        => 'background',
                'section'     => 'styling_options',
                'std'         => array(
                    'background-color' => '#ffffff',
                ),
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'copyright_color',
                'label'       => __( 'Copyright Text Color', 'yoga' ),
                'type'        => 'colorpicker',
                'std'         => '#000000',
                'section'     => 'styling_options',
                'condition'     => 'copyright_switch:is(on)',
            ),

            array(
                'id'          => 'button_bg_tab',
                'label'       => __( 'Buttons', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            /* Banner Buttons */

            array(
                'id'          => 'ban_buttons_text_color',
                'label'       => '<b>'.__( 'Banner Buttons', 'yoga' ).'</b>',
                'type'        => 'link-color',
                'std'        => array(
                    'link'  => '#000000',
                    'hover'  => '#4f4f4f',
                    'active'  => '',
                    'visited'  => '',
                ),
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'ban_buttons_border_sw',
                'label'       => __( 'Banner Buttons - Show Border', 'yoga' ),
                'type'        => 'on-off',
                'std'        => 'off',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'ban_buttons_border',
                'label'       => __( 'Banner Buttons - Border', 'yoga' ),
                'type'        => 'border',
                'section'     => 'styling_options',
                'condition'     => 'ban_buttons_border_sw:is(on)',
            ),

            array(
                'id'          => 'ban_buttons_border_rad',
                'label'       => __( 'Banner Buttons - Border Radius', 'yoga' ),
                'desc'       => 'pixels',
                'type'        => 'numeric-slider',
                'section'     => 'styling_options',
                'condition'     => 'ban_buttons_border_sw:is(on)',
            ),



            /* Content Buttons */

            array(
                'id'          => 'cont_buttons_text_color',
                'label'       => '<b>'.__( 'Content Buttons', 'yoga' ).'</b>',
                'type'        => 'link-color',
                'std'        => array(
                    'link'  => '#000000',
                    'hover'  => '',
                    'active'  => '',
                    'visited'  => '',
                ),
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),
            array(
                'id'          => 'cont_buttons_border_sw',
                'label'       => __( 'Content Buttons - Show Border', 'yoga' ),
                'type'        => 'on-off',
                'std'        => 'off',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'cont_buttons_border',
                'label'       => __( 'Content Buttons - Border', 'yoga' ),
                'type'        => 'border',
                'std'        => array(
                    'width'  => '1',
                    'unit'  => 'px',
                    'style'  => 'solid',
                    'color'  => '#000000',
                ),
                'section'     => 'styling_options',
                'condition'     => 'cont_buttons_border_sw:is(on),custom_skin_switch:is(on)',
            ),
            array(
                'id'          => 'cont_buttons_border_rad',
                'label'       => __( 'Content Buttons - Border Radius', 'yoga' ),
                'desc'       => 'pixels',
                'type'        => 'numeric-slider',
                'std'        => '60',
                'section'     => 'styling_options',
                'condition'     => 'cont_buttons_border_sw:is(on),custom_skin_switch:is(on)',
            ),

            /* Form Buttons */

            array(
                'id'          => 'form_buttons_text_color',
                'label'       => '<b>'.__( 'Form Buttons', 'yoga' ).'</b>',
                'type'        => 'link-color',
                'std'        => array(
                    'link'  => '',
                    'hover'  => '',
                    'active'  => '',
                    'visited'  => '',
                ),
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),
            array(
                'id'          => 'form_buttons_border_sw',
                'label'       => __( 'Form Buttons - Show Border', 'yoga' ),
                'type'        => 'on-off',
                'std'        => 'off',
                'section'     => 'styling_options',
                'condition'     => 'custom_skin_switch:is(on)',
            ),

            array(
                'id'          => 'form_buttons_border',
                'label'       => __( 'Form Buttons - Border', 'yoga' ),
                'type'        => 'border',
                'section'     => 'styling_options',
                'condition'     => 'form_buttons_border_sw:is(on)',
            ),

            array(
                'id'          => 'form_buttons_border_rad',
                'label'       => __( 'Form Buttons - Border Radius', 'yoga' ),
                'desc'       => 'pixels',
                'type'        => 'numeric-slider',
                'section'     => 'styling_options',
                'condition'     => 'form_buttons_border_sw:is(on)',
            ),


            array(
                'id'          => 'social_bg_tab',
                'label'       => __( 'Social Icons', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'styling_options',
                /*'condition'     => 'custom_skin_switch:is(on)',*/
            ),

            array(
                'id'          => 'social_icons_color_invert',
                'label'       => __( 'Social Icon Default Colors', 'yoga' ),
                'desc'       => __( 'If turned On, the native colors of social icons will be used.', 'yoga' ),
                'std'         => 'off',
                'type'        => 'on-off',
                'section'     => 'styling_options',
                'condition'   => 'custom_skin_switch:is(on)',
                'class'     => 'switch_div',
            ),

            array(
                'id'          => 'social_icons_color',
                'label'       => __( 'Social Icons Color', 'yoga' ),
                'type'        => 'link-color',
                'section'     => 'styling_options',
                'condition'     => 'social_icons_color_invert:is(off),custom_skin_switch:is(on)',
                'std'     => array(
                    'link'  => '#ffffff',
                    'hover'  => 'rgba(255,255,255,0.44)',
                ),
            ),

            array(
                'id'          => 'testimonial_bg_tab',
                'label'       => __( 'Testimonials', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'styling_options',
                /*'condition'     => 'custom_skin_switch:is(on)',*/
            ),

            array(
                'id'          => 'testimonial_bg_color',
                'label'       => __( 'Background Color', 'yoga' ),
                'std'         => 'rgba(0,0,0,.5)',
                'type'        => 'colorpicker-opacity',
                'section'     => 'styling_options',
                'condition'   => 'custom_skin_switch:is(on)',
                'class'     => 'switch_div',
            ),

            array(
                'id'          => 'testimonial_text_color',
                'label'       => __( 'Text Color', 'yoga' ),
                'std'         => '#ffffff',
                'type'        => 'colorpicker',
                'section'     => 'styling_options',
                'condition'   => 'custom_skin_switch:is(on)',
                'class'     => 'switch_div',
            ),




            /* Header Options */

            /* Logo */
            array(
                'id'          => 'logo_switch',
                'label'       => __( 'Show Logo', 'yoga' ),
                'std'         => 'on',
                'type'        => 'on-off',
                'section'     => 'header_option',
                'class'     => 'switch_div',
            ),

            array(
                'id'          => 'logo_img',
                'label'       => __( 'Upload Logo', 'yoga' ),
                'desc'         => __('Site title will be displayed if no image uploaded.', 'yoga').'<br>'.__('Site title', 'yoga').' : '.get_bloginfo('blogname'),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'header_option',
                'class'       => 'align_top',
                'condition'   => 'logo_switch:is(on)',
                'operator'    => 'and'
            ),

            array(
                'id'          => 'logo_text_helper',
                'label'       => __( 'Manage Site Title', 'yoga' ),
                'desc'        => '<a href="#section_typo_option" onclick="jQuery(\'#ui-id-3\').trigger(\'click\')">'.__( 'Change the font style for logo', 'yoga' ).'</a>',
                'std'         => '',
                'type'        => 'textblock',
                'section'     => 'header_option',
                'class'       => 'ot-upload-attachment-id',
                'condition'   => 'logo_switch:is(on)',
                'operator'    => 'and'
            ),

            array(
                'id'          => 'header_height',
                'label'       => __( 'Header Height', 'yoga' ),
                'std'         => array('90', 'px'),
                'type'        => 'measurement',
                'section'     => 'header_option',
            ),

            array(
                'id'          => 'header_nav_helper',
                'label'       => __( 'Manage Logo Text', 'yoga' ),
                'desc'        => '<span class="dashicons dashicons-external"></span> '.sprintf('<a href="%s" target="_blank">'.__( 'Manage Header Menu', 'yoga' ).'</a>', admin_url('customize.php?autofocus[panel]=nav_menus')).'<br><br><a href="#section_typo_option" onclick="jQuery(\'#ui-id-3\').trigger(\'click\')">'.__( 'Change the font style for Header Menu', 'yoga' ).'</a>',
                'std'         => '',
                'type'        => 'textblock',
                'section'     => 'header_option',
                'class'       => 'ot-upload-attachment-id',
            ),


            array(
                'id'          => 'favicon_img',
                'desc'       => '<span class="dashicons dashicons-external"></span> '.sprintf('<a href="%s" target="_blank">'.__( 'Upload Favicon', 'yoga' ).'</a>', admin_url('customize.php?autofocus[control]=site_icon')),
                'std'         => '',
                'type'        => 'textblock',
                'section'     => 'header_option',
                'class'       => 'ot-upload-attachment-id',
            ),

            /* #Fonts# */
            array(
                'id'          => 'typo_fonts',
                'label'       => __( 'Font Families', 'yoga' ),
                'desc'        => __( "Add fonts in your website.", "yoga" ).PHP_EOL. __("The newly added font families will appear after saving the options.", "yoga" ),
                'std'         => array(
                    array(
                        'family'    => 'arimo',
                        'variants'  => array( 'regular','700','italic','700italic'),
                        'subsets'   => array( 'latin', 'latin-ext' ),
                    ),
                    array(
                        'family'    => 'oregano',
                        'variants'  => array( 'regular','italic'),
                        'subsets'   => array( 'latin', 'latin-ext' ),
                    ),
                ),
                'type'        => 'google-fonts',
                'section'     => 'typo_option',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'min_max_step'=> '',
                'class'       => 'align_top',
                'condition'   => '',
                'operator'    => 'and'
            ),


            array(
                'id'          => 'font_typos',
                'label'       => __( 'Font Styles', 'yoga' ),
                'desc'        => __( 'Theme\'s default font properties can be changed from the section specific tabs given below.', 'yoga' ),
                'std'         => '',
                'type'        => 'textblock-block',
                'section'     => 'typo_option',
                'class'       => 'no_bottom_border',
                'operator'    => 'and'
            ),


            /* Logo Fonts */
            array(
                'id'          => 'logof_tab',
                'label'       => __( 'Header', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'typo_option',
            ),

            array(
                'id'          => 'logo_typo',
                'label'       => __( 'Logo Font Style', 'yoga' ),
                'desc'        => __( 'This will change the typography of logo text only.', 'yoga' ),
                'std'         => array(
                    'font-family' => 'arimo',
                    'font-color' => '#000000',
                    'font-size' => '28px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' =>'',
                    'line-height' => '34px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),

            array(
                'id'          => 'menu_typo',
                'label'       => __( 'Header Menu Font Style', 'yoga' ),
                'desc'        => __( 'This will change the typography of navigation menu in header.', 'yoga'  ),
                'std'         => array(
                    'font-family' => 'arimo',
                    'font-color' => '#000000',
                    'font-size' => '16px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => 'normal',
                    'letter-spacing' =>'',
                    'line-height' => '20px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),

            /* Body Fonts */

            array(
                'id'          => 'bodyf_tab',
                'label'       => __( 'Body', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'typo_option',
            ),

            array(
                'id'          => 'body_typo',
                'label'       => __( 'Body', 'yoga' ),
                'desc'        => __( 'This will change the typography of content areas only.', 'yoga'  ),
                'std'         => array(
                    'font-family' => 'arimo',
                    'font-color' => '#000000',
                    'font-size' => '18px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' =>'',
                    'line-height' => '32px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),

            array(
                'id'          => 'secondf_typo',
                'label'       => __( 'Secondary Font Family', 'yoga' ),
                'desc'        => __( 'This will change the font familiy of titles of special elements, e.g., widgets.', 'yoga'  ),
                'std'         => array(
                    'font-family' => 'oregano',
                    'font-color' => '#000000',
                    'font-size' => '16px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' =>'',
                    'line-height' => '29px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),

            /* Heading Fonts */


            /* H1 - H6 */
            array(
                'id'          => 'h1_typo',
                'label'       => __( 'H1 Font Style', 'yoga' ),
                /*'desc'        => __( 'Select the font size, font family, color etc', 'yoga'  ),*/
                'std'         => array(
                    'font-family' => 'arimo',
                    'font-color' => '#000000',
                    'font-size' => '38px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' =>'',
                    'line-height' => '51px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),
            array(
                'id'          => 'h2_typo',
                'label'       => __( 'H2 Font Style', 'yoga' ),
                /*'desc'        => __( 'Select the font size, font family, color etc', 'yoga'  ),*/
                'std'         => array(
                    'font-family' => 'arimo',
                    'font-color' => '#000000',
                    'font-size' => '40px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => 'bold',
                    'letter-spacing' =>'',
                    'line-height' => '48px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),
            array(
                'id'          => 'h3_typo',
                'label'       => __( 'H3 Font Style', 'yoga' ),
                /*'desc'        => __( 'Select the font size, font family, color etc', 'yoga'  ),*/
                'std'         => array(
                    'font-family' => 'arimo',
                    'font-color' => '#000000',
                    'font-size' => '30px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' =>'',
                    'line-height' => '40px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),
            array(
                'id'          => 'h4_typo',
                'label'       => __( 'H4 Font Style', 'yoga' ),
                'desc'        => __( 'Select the font size, font family, color etc', 'yoga'  ),
                'std'         => array(
                    'font-family' => 'arimo',
                    'font-color' => '#000000',
                    'font-size' => '26px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' =>'',
                    'line-height' => '35px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),
            array(
                'id'          => 'h5_typo',
                'label'       => __( 'H5 Font Style', 'yoga' ),
                /*'desc'        => __( 'Select the font size, font family, color etc', 'yoga'  ),*/
                'std'         => array(
                    'font-family' => 'oregano',
                    'font-color' => '#000000',
                    'font-size' => '30px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' =>'',
                    'line-height' => '54px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),
            array(
                'id'          => 'h6_typo',
                'label'       => __( 'H6 Font Style', 'yoga' ),
                /*'desc'        => __( 'Select the font size, font family, color etc', 'yoga'  ),*/
                'std'         => array(
                    'font-family' => 'arimo',
                    'font-color' => '#000000',
                    'font-size' => '18px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => '400',
                    'letter-spacing' =>'',
                    'line-height' => '26px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),

            /* Homepage Banner Fonts */
            array(
                'id'          => 'hbannerf_tab',
                'label'       => __( 'Homepage Banner', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'typo_option',
            ),

            array(
                'id'          => 'banner_htypo',
                'label'       => __( 'Banner Heading Font Style', 'yoga' ),
                'desc'        => __( 'This will change the typography of homepage banner only.', 'yoga'  ).'<br><br>'.__( 'To change Banner Height: ', 'yoga' ).'<b>'.__( 'Theme Options > Banners > Homepage Banner Height', 'yoga' ).'</b>'.'<br><br>'.__( 'To change Homepage Banner Content: ', 'yoga' ).'<b>'.__( 'Pages > Home > Banner', 'yoga' ).'</b>',
                'std'         => array(
                    'font-family' => 'arimo',
                    'font-color' => '#ffffff',
                    'font-size' => '80px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => 'normal',
                    'letter-spacing' =>'',
                    'line-height' => '80px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),

            array(
                'id'          => 'banner_stypo',
                'label'       => __( 'Banner Subtext Font Style', 'yoga' ),
                'desc'        => __( 'This will change the typography of homepage banner only.', 'yoga'  ),
                'std'         => array(
                    'font-family' => 'oregano',
                    'font-color' => '#ffffff',
                    'font-size' => '30px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => 'normal',
                    'letter-spacing' =>'',
                    'line-height' => '30px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),

            array(
                'id'          => 'banner_hshadow',
                'label'       => __( 'Text Shadow', 'yoga' ),
                'desc'        =>__('This will add a shadow on the text.', 'yoga'),
                'std'         => '',
                'type'        => 'box-shadow',
                'section'     => 'typo_option',
                'operator'    => 'and'
            ),


            /* Internal Banner Fonts */
            array(
                'id'          => 'Intbannerf_tab',
                'label'       => __( 'Internal Banners', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'typo_option',
            ),

            array(
                'id'          => 'ibanner_typo',
                'label'       => __( 'Internal Banner Font Style', 'yoga' ),
                'desc'        => __( 'This will change the typography of internal page banners only.', 'yoga' ).'<br><br>'.__( 'To change Banner Height: ', 'yoga' ).'<b>'.__( 'Theme Options > Banners > Internal Banner Height', 'yoga' ).'</b>'.'<br><br>'.__( 'To change Homepage Banner Content: ', 'yoga' ).'<b>'.__( 'Pages > Home > Banner', 'yoga' ).'</b>',
                'std'         => array(
                    'font-family' => 'arimo',
                    'font-color' => '#ffffff',
                    'font-size' => '80px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => 'normal',
                    'letter-spacing' =>'',
                    'line-height' => '96px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),

            array(
                'id'          => 'ibanner_hshadow',
                'label'       => __( 'Text Shadow', 'yoga' ),
                'desc'        =>__('This will add a shadow on the banner text', 'yoga'),
                'std'         => '',
                'type'        => 'box-shadow',
                'section'     => 'typo_option',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'min_max_step'=> '',
                'class'       => '',
                'condition'   => '',
                'operator'    => 'and'
            ),


            /* Page Sections */
            array(
                'id'          => 'hsections_tab',
                'label'       => __( 'Page Sections', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'typo_option',
            ),

            array(
                'id'          => 'sectionsh_typo',
                'label'       => __( 'Section Titles Font Style', 'yoga' ),
                'desc'        => __( 'This will change the typography of section titles on pages.', 'yoga'  ),
                'std'         => array(
                    'font-family' => 'arimo',
                    'font-size' => '40px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => 'normal',
                    'letter-spacing' =>'',
                    'line-height' => '42px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),

            /* Footer */
            array(
                'id'          => 'footerf_tab',
                'label'       => __( 'Footer', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'typo_option',
            ),

            array(
                'id'          => 'footerh_typo',
                'label'       => __( 'Footer', 'yoga' ),
                'desc'        => __( 'This will change the typography of the Footer.', 'yoga'  ),
                'std'         => array(
                    'font-family' => 'arimo',
                    'font-color' => '#000000',
                    'font-size' => '18px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => 'normal',
                    'letter-spacing' =>'',
                    'line-height' => '32px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),

            /* Buttons */
            array(
                'id'          => 'buttonsf_tab',
                'label'       => __( 'Buttons', 'yoga' ),
                'type'        => 'tab',
                'section'     => 'typo_option',
            ),

            array(
                'id'          => 'buttonsh_typo',
                'label'       => __( 'Buttons Font Style', 'yoga' ),
                'desc'        => __( 'This will change the typography of the buttons.', 'yoga'  ),
                'std'         => array(
                    'font-family' => 'arimo',
                    'font-color' => '#000000',
                    'font-size' => '18px',
                    'font-style' => 'normal',
                    'font-variant' => 'normal',
                    'font-weight' => 'normal',
                    'letter-spacing' =>'',
                    'line-height' => '18px',
                    'text-decoration' => 'none',
                    'text-transform' => 'none',
                ),
                'type'        => 'typography',
                'section'     => 'typo_option',
            ),


            /* Blog Options */

            array(
                'id'          => 'show_post_meta',
                'label'       => __( 'Show Post Metadata', 'yoga' ),
                'desc'       => __( 'This will show/hide the post details.', 'yoga' ).'<br>'. __('For example: Post Author, Published Date, Post Categories','yoga'),
                'std'         => 'on',
                'type'        => 'on-off',
                'section'     => 'layout_options',
                'class'     => 'switch_div',
            ),

            array(
                'id'          => 'blog_layout_radio',
                'label'       => __( 'Blog Listing - Page Layout', 'yoga' ),
                'desc'        => __( 'This will change the visibility and position of sidebar on the blog post listing pages.', 'yoga' ),
                'std'         => 'full-width',
                'type'        => 'radio-image',
                'section'     => 'layout_options',
                'choices' => array(
                    array(
                        'value' => 'right-sidebar',
                        'label' => __('Right Sidebar', 'yoga'),
                        'src' => get_template_directory_uri().'/option-tree/assets/images/layout/right-sidebar.png',
                    ),
                    array(
                        'value' => 'full-width',
                        'label' => __('No Sidebar', 'yoga'),
                        'src' => get_template_directory_uri().'/option-tree/assets/images/layout/full-width.png',
                    ),
                    array(
                        'value' => 'left-sidebar',
                        'label' => __('Left Sidebar', 'yoga'),
                        'src' => get_template_directory_uri().'/option-tree/assets/images/layout/left-sidebar.png',
                    ),
                )
            ),

            array(
                'id'          => 'single_layout_radio',
                'label'       => __( 'Single Post - Page Layout', 'yoga' ),
                'desc'        => __( 'This will change the visibility and position of sidebar on the post details pages.', 'yoga' ),
                'std'         => 'right-sidebar',
                'type'        => 'radio-image',
                'section'     => 'layout_options',
                'choices' => array(
                    array(
                        'value' => 'right-sidebar',
                        'label' => __('Right Sidebar', 'yoga'),
                        'src' => get_template_directory_uri().'/option-tree/assets/images/layout/right-sidebar.png',
                    ),
                    array(
                        'value' => 'full-width',
                        'label' => __('No Sidebar', 'yoga'),
                        'src' => get_template_directory_uri().'/option-tree/assets/images/layout/full-width.png',
                    ),
                    array(
                        'value' => 'left-sidebar',
                        'label' => __('Left Sidebar', 'yoga'),
                        'src' => get_template_directory_uri().'/option-tree/assets/images/layout/left-sidebar.png',
                    ),
                )
            ),

            /* Social Links */
            array(
                'id'          => 'social_icons',
                'label'       => __( 'Social Links', 'yoga' ),
                'desc'        => __( 'Enter your social profile links here:', 'yoga' ),
                'type'        => 'list-item',
                'section'     => 'social_links',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'min_max_step'=> '',
                'class'       => 'hide_title social_grid align_top',
                'operator'    => 'and',
                'settings'    => array(
                    array(
                        'id'          => 'social_icon_entry',
                        'label'       => __( 'Social Profile Icon', 'yoga' ),
                        'desc'        => '',
                        'class'         => 'social_icons_array',
                        'type'        => 'radio-image',
                        'choices' => array(
                            array(
                                'value' => 'google',
                                'label' => 'Google Plus',
                                'src' => get_template_directory_uri().'/assets/images/social/google_plus.svg',
                            ),
                            array(
                                'value' => 'facebook',
                                'label' => 'Facebook',
                                'src' => get_template_directory_uri().'/assets/images/social/facebook.svg',
                            ),
                            array(
                                'value' => 'linkedin',
                                'label' => 'LinkedIn',
                                'src' => get_template_directory_uri().'/assets/images/social/linkedin.svg',
                            ),
                            array(
                                'value' => 'twitter',
                                'label' => 'Twitter',
                                'src' => get_template_directory_uri().'/assets/images/social/twitter.svg',
                            ),
                            array(
                                'value' => 'instagram',
                                'label' => 'Instagram',
                                'src' => get_template_directory_uri().'/assets/images/social/instagram.svg',
                            ),
                            array(
                                'value' => 'skype',
                                'label' => 'Skype',
                                'src' => get_template_directory_uri().'/assets/images/social/skype.svg',
                            ),
                            array(
                                'value' => 'youtube',
                                'label' => 'Youtube',
                                'src' => get_template_directory_uri().'/assets/images/social/youtube.svg',
                            ),
                            array(
                                'value' => 'vimeo',
                                'label' => 'Vimeo',
                                'src' => get_template_directory_uri().'/assets/images/social/vimeo.svg',
                            ),
                            array(
                                'value' => 'pinterest',
                                'label' => 'Pinterest',
                                'src' => get_template_directory_uri().'/assets/images/social/pinterest.svg',
                            ),
                            array(
                                'value' => 'stumbleupon',
                                'label' => 'Stumblupon',
                                'src' => get_template_directory_uri().'/assets/images/social/stumblupon.svg',
                            ),
                            array(
                                'value' => 'tumblr',
                                'label' => 'Tumblr',
                                'src' => get_template_directory_uri().'/assets/images/social/tumblr.svg',
                            ),
                            array(
                                'value' => 'behance',
                                'label' => 'Behance',
                                'src' => get_template_directory_uri().'/assets/images/social/behance.svg',
                            ),
                            array(
                                'value' => 'blogger',
                                'label' => 'Blogger',
                                'src' => get_template_directory_uri().'/assets/images/social/blogger.svg',
                            ),
                            array(
                                'value' => 'delicios',
                                'label' => 'Delicios',
                                'src' => get_template_directory_uri().'/assets/images/social/delicios.svg',
                            ),
                            array(
                                'value' => 'github',
                                'label' => 'Github',
                                'src' => get_template_directory_uri().'/assets/images/social/github.svg',
                            ),


                            array(
                                'value' => 'amazon',
                                'label' => 'Amazon',
                                'src' => get_template_directory_uri().'/assets/images/social/amazon.svg',
                            ),
                            array(
                                'value' => 'android',
                                'label' => 'Android',
                                'src' => get_template_directory_uri().'/assets/images/social/android.svg',
                            ),
                            array(
                                'value' => 'apple',
                                'label' => 'Apple',
                                'src' => get_template_directory_uri().'/assets/images/social/apple.svg',
                            ),

                            array(
                                'value' => 'digg',
                                'label' => 'Digg',
                                'src' => get_template_directory_uri().'/assets/images/social/digg.svg',
                            ),
                            array(
                                'value' => 'dribble',
                                'label' => 'Dribble',
                                'src' => get_template_directory_uri().'/assets/images/social/dribble.svg',
                            ),
                            array(
                                'value' => 'dropbox',
                                'label' => 'Dropbox',
                                'src' => get_template_directory_uri().'/assets/images/social/dropbox.svg',
                            ),
                            array(
                                'value' => 'ebay',
                                'label' => 'Ebay',
                                'src' => get_template_directory_uri().'/assets/images/social/ebay.svg',
                            ),

                            array(
                                'value' => 'foursquare',
                                'label' => 'Foursquare',
                                'src' => get_template_directory_uri().'/assets/images/social/foursquare.svg',
                            ),


                            array(
                                'value' => 'myspace',
                                'label' => 'Myspace',
                                'src' => get_template_directory_uri().'/assets/images/social/myspace.svg',
                            ),


                            array(
                                'value' => 'soundcloud',
                                'label' => 'Soundcloud',
                                'src' => get_template_directory_uri().'/assets/images/social/soundcloud.svg',
                            ),
                            array(
                                'value' => 'stackoverflow',
                                'label' => 'Stackoverflow',
                                'src' => get_template_directory_uri().'/assets/images/social/stackoverflow.svg',
                            ),


                            array(
                                'value' => 'windows',
                                'label' => 'Windows',
                                'src' => get_template_directory_uri().'/assets/images/social/windows.svg',
                            ),

                            array(
                                'value' => 'wordpress',
                                'label' => 'WordPress',
                                'src' => get_template_directory_uri().'/assets/images/social/wordpress.svg',
                            ),
                            array(
                                'value' => 'rss',
                                'label' => 'RSS',
                                'src' => get_template_directory_uri().'/assets/images/social/rss.svg',
                            ),

                            array(
                                'value' => 'connection',
                                'label' => 'Social',
                                'src' => get_template_directory_uri().'/assets/images/social/general.svg',
                            ),




                        ),
                    ),
                    array(
                        'id'          => 'social_profile_link',
                        'label'       => __( 'Social Profile Link', 'yoga' ),
                        'std'         => '#',
                        'type'        => 'text',
                    ),
                ),
                'std'         => array(
                    array(
                        'title' => 'Google',
                        'social_icon_entry' => 'google',
                        'social_icon_link'  => '#'
                    ),
                    array(
                        'title' => 'Twitter',
                        'social_icon_entry' => 'twitter',
                        'social_icon_link' => '#',
                    ),
                    array(
                        'title' => 'Facebook',
                        'social_icon_entry' => 'facebook',
                        'social_icon_link' => '#',
                    ),

                    array(
                        'title' => 'LinkedIn',
                        'social_icon_entry' => 'linkedin',
                        'social_icon_link' => '#',
                    ),
                ),
            ),




            array(
                'id'          => 'footer_color',
                'label'       => __( 'Footer Color', 'yoga' ),
                'type'        => 'colorpicker',
                'section'     => 'footer_options',
                'condition'     => 'footer_widgets_switch:is(on)',
                'std'         => '#ffffff',
            ),

            array(
                'id'          => 'copyright_text',
                'label'       => __( 'Copyright Text', 'yoga' ),
                'std'         => 'Copyright &copy; All Rights Reserved.',
                'type'        => 'text',
                'section'     => 'footer_options',
            ),



            array(
                'id'          => 'footer_widgets_url',
                'label'        => __('Manage Footer Widgets', 'yoga'),
                'desc'        => sprintf('<span class="dashicons dashicons-external"></span> <a href="%s" target="_blank">'.__( 'Edit Footer Widgets', 'yoga' ).'</a>', admin_url('widgets.php')),
                'type'        => 'textblock-titled',
                'section'     => 'footer_options',
            ),

            /* Miscellaneous */

            /* Custom CSS */
            array(
                'id'          => 'custom_css',
                'label'       => __( 'Custom CSS', 'yoga' ),
                'desc'         => __( 'The rules added here will be applied as additional CSS.', 'yoga' ),
                'type'        => 'css',
                'section'     => 'advanced_options',
                'std'     => '/* Your custom CSS goes here */',
            ),

            array(
                'id'          => 'head_scripts',
                'label'       => __( 'Head Scripts', 'yoga' ),
                'desc'        => __( 'Scripts to be inserted in "head" tag.', 'yoga' ),
                'std'         => '',
                'type'        => 'textarea-simple',
                'rows'        => '3',
                'section'     => 'advanced_options',
            ),

            array(
                'id'          => 'footer_scripts',
                'label'       => __( 'Footer Scripts', 'yoga' ),
                'desc'        => __( 'Scripts to be inserted after footer.', 'yoga' ),
                'std'         => '',
                'type'        => 'textarea-simple',
                'rows'        => '3',
                'section'     => 'advanced_options',
            ),

            array(
                'id'          => '404_content',
                'label'       => __( '404 Page Content', 'yoga' ),
                'type'        => 'textarea',
                'section'     => 'advanced_options',
                'std'         => '<h1>{404} Not Found!</h1><h3>Sorry, we could not find what you were looking for.</h3>',
            ),

            array(
                'id'          => 'importer_button',
                'label'       => __( 'Import', 'yoga' ),
                'type'        => 'onecom_importer',
                'section'     => 'importer_section',
                'class'     => 'importer',
            ),
        )
    );

    /* allow settings to be filtered before saving */
    $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );

    /* settings are not the same update the DB */
    if ( $saved_settings !== $custom_settings ) {
        update_option( ot_settings_id(), $custom_settings );
    }

    /* Lets OptionTree know the UI Builder is being overridden */
    global $ot_has_custom_theme_options;
    $ot_has_custom_theme_options = true;

}