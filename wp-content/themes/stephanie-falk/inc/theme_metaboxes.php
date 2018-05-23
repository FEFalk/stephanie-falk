<?php
/**
 * Initialize the custom Meta Boxes.
 */
add_action('admin_init', 'custom_meta_boxes');

global $post;
/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types in demo-theme-options.php.
 *
 * @return    void
 * @since     2.0
 */
function custom_meta_boxes()
{

    /**
     * Create a custom meta boxes array that we pass to
     * the OptionTree Meta Box API Class.
     */
    $homepage_sections = array(
        'id' => 'home_sections',
        'title' => __('Page Sections', 'yoga'),
        'desc' => '',
        'pages' => array('page'),
        'context' => 'normal',
        'class' => 'ot_meta',
        'priority' => 'high',
        'fields' => array(

            /* Banner Section */
            array(
                'label' => __('Banner', 'yoga'),
                'id' => 'home_banner',
                'type' => 'tab'
            ),

            array(
                'label' => __('Show Banner', 'yoga'),
                'id' => 'home_banner_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on',
            ),

            array(
                'id' => 'home_banner_image',
                'label' => __('Banner Image', 'yoga'),
                'type' => 'upload',
                'class' => 'ot-upload-attachment-id',
                'condition' => 'home_banner_switch:is(on)',
            ),

            array(
                'id' => 'banner_caption_align',
                'label' => __('Caption Alignment', 'yoga'),
                'std' => 'center',
                'type' => 'select',
                'class'     => 'inline-cols',
                'condition' => 'home_banner_switch:is(on)',
                'section' => 'option_types',
                'choices' => array(
                    array(
                        'value' => 'align-right',
                        'label' => __('Right', 'yoga'),
                    ),
                    array(
                        'value' => 'align-center',
                        'label' => __('Center', 'yoga'),
                    ),
                    array(
                        'value' => 'align-left',
                        'label' => __('Left', 'yoga'),
                    )
                )
            ),

            array(
                'label'     => __( 'Banner Height', 'yoga' ),
                'desc'        => '<span class="dashicons dashicons-external"></span> '.sprintf('<a href="%s" target="_blank">'.__( 'Change the font for this banner', 'yoga' ).'</a>', admin_url('admin.php?page=octheme_settings#section_typo_option')),
                'id'        => 'banner_height',
                'type'      => 'select',
                'std'		=> 'custom_height',
                'choices'     => array(
                    array(
                        'value'       => 'auto_height',
                        'label'       => __( 'Auto', 'yoga' ),
                    ),
                    array(
                        'value'       => 'full_view',
                        'label'       => __( 'Full Viewport', 'yoga' ),
                    ),
                    array(
                        'value'       => 'custom_height',
                        'label'       => __( 'Custom', 'yoga' ),
                    ),
                ),
                'condition' => 'home_banner_switch:is(on)',
            ),

            array(
                'id' => 'hbanner_height',
                'label' => __('Banner Custom Height', 'yoga'),
                'class'     => 'inline-cols',
                'std'       => array('630', 'px'),
                'type'      => 'measurement',
                'condition' 	=> 'banner_height:is(custom_height),home_banner_switch:is(on)',
            ),

            array(
                'id' => 'banner_caption_title',
                'label' => __('Banner Caption - Title', 'yoga'),
                'type' => 'text',
                'std' => '',
                'rows' => '1',
                'condition' => 'home_banner_switch:is(on)',
            ),

            array(
                'id' => 'banner_caption_subtitle',
                'label' => __('Banner Caption - Subtitle', 'yoga'),
                'type' => 'textarea',
                'std' => '',
                'rows' => '3',
                'condition' => 'home_banner_switch:is(on)',
            ),
            array(
                'id' => 'banner_button_label',
                'label' => __('Button Label', 'yoga'),
                'type' => 'text',
                'std' => '',
                'condition' => 'home_banner_switch:is(on)',
            ),
            array(
                'id' => 'banner_button_link',
                'label' => __('Button Link', 'yoga'),
                'type' => 'text',
                'std' => get_permalink('contact'),
                'condition' => 'home_banner_switch:is(on)',
            ),



            /* Courses Section */
            array(
                'label' => __('Services', 'yoga'),
                'id' => 'home_courses',
                'type' => 'tab'
            ),
            array(
                'label' => __('Show Section', 'yoga'),
                'id' => 'home_courses_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on'
            ),
            array(
                'label' => __('Section Title', 'yoga'),
                'id' => 'courses_section_title',
                'type' => 'text',
                'std' => '',
                'condition' => 'home_courses_switch:is(on)'
            ),
            array(
                'label' => __('Section Content', 'yoga'),
                'id' => 'courses_section_content',
                'type' => 'textarea',
                'row' => '3',
                'condition' => 'home_courses_switch:is(on)'
            ),

            array(
                'label' => __('Show Courses', 'yoga'),
                'id' => 'home_courses_posts_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on',
                'condition' => 'home_courses_switch:is(on)'
            ),

            /*array(
                'label'       => __( 'Number of courses to show', 'yoga' ),
                'id'          => 'courses_count',
                'type'        => 'text',
                'std'        => '3',
                'operator'    => 'and',
                'condition'   => 'home_courses_switch:is(on),home_courses_posts_switch:is(on)'
            ),*/
            array(
                'id' => 'home_courses_ids',
                'label' => __('Please select the courses to be diplayed.', 'yoga'),
                'desc' => __('The selected courses/lessons will be displayed.', 'yoga'),
                'std' => '',
                'type' => 'custom-post-type-checkbox',
                'post_type' => 'lesson',
                'condition' => 'home_courses_switch:is(on),home_courses_posts_switch:is(on)',
                'operator' => 'and'
            ),
            array(
                'id' => 'home_courses_btn_title',
                'label' => __('Button Title', 'yoga'),
                'type' => 'text',
                'std' => '',
                'operator' => 'and',
                'condition' => 'home_courses_switch:is(on),home_courses_posts_switch:is(on)',
            ),
            array(
                'label' => __('Features', 'yoga'),
                'id' => 'home_features',
                'type' => 'tab'
            ),

            array(
                'label' => __('Show Section', 'yoga'),
                'id' => 'home_features_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on'
            ),
            array(
                'label' => __('Section Title', 'yoga'),
                'id' => 'features_section_title',
                'type' => 'text',
                'std' => '',
                'condition' => 'home_features_switch:is(on)'
            ),
            array(
                'label' => __('Section Content', 'yoga'),
                'id' => 'features_section_content',
                'type' => 'textarea',
                'row' => '5',
                'std' => '',
                'condition' => 'home_features_switch:is(on)'
            ),


            array(
                'id' => 'features_list_item',
                'label' => __('Features List', 'yoga'),
                'desc' => __('The added features will be displayed in the order they are arranged here.', 'yoga'),
                'type' => 'list-item',
                'condition' => 'home_features_switch:is(on)',
                'operator' => 'and',
                'settings' => array(
                    array(
                        'id' => 'features_list_item_content',
                        'label' => __('Short Description', 'yoga'),
                        'type' => 'textarea-lite',
                        'rows' => '3',
                    ),
                    array(
                        'id' => 'feature_list_item_icon',
                        'label' => __('Icon', 'yoga'),
                        'type' => 'upload',
                        'class' => 'ot-upload-attachment-id',
                    ),
                ),
                'std'   => [['title'=>'']],
            ),
            array(
                'label' => __('Button Title', 'yoga'),
                'id' => 'features_section_btn_title',
                'type' => 'text',
                'std' => '',
                'condition' => 'home_features_switch:is(on)',
            ),

            array(
                'label' => __('Button Link', 'yoga'),
                'id' => 'features_section_btn_link',
                'type' => 'text',
                'std' => '#',
                'condition' => 'home_features_switch:is(on)',
            ),

            array(
                'label' => __('Section Background', 'yoga'),
                'id' => 'features_section_bg',
                'type' => 'upload',
                'class' => 'ot-upload-attachment-id',
                'condition' => 'home_features_switch:is(on)',
            ),


            array(
                'label' => __('Background Section', 'yoga'),
                'id' => 'home_experience',
                'type' => 'tab'
            ),

            array(
                'label' => __('Show Section', 'yoga'),
                'id' => 'home_surfing_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on'
            ),

            array(
                'label' => __('Section Title', 'yoga'),
                'id' => 'experience_section_title',
                'type' => 'text',
                'std' => '',
                'condition' => 'home_surfing_switch:is(on)'
            ),
            array(
                'label' => __('Section Content', 'yoga'),
                'id' => 'experience_section_content',
                'type' => 'textarea',
                'row' => '5',
                'condition' => 'home_surfing_switch:is(on)'
            ),


            array(
                'label' => __('Button Title', 'yoga'),
                'id' => 'experience_section_btn_title',
                'type' => 'text',
                'std' => '',
                'condition' => 'home_surfing_switch:is(on)'
            ),

            array(
                'label' => __('Button Link', 'yoga'),
                'id' => 'experience_section_btn_link',
                'type' => 'text',
                'std' => '#',
                'condition' => 'home_surfing_switch:is(on)'
            ),


            array(
                'label' => __('Section Background', 'yoga'),
                'id' => 'experience_section_bg',
                'type' => 'upload',
                'class' => 'ot-upload-attachment-id',
                'condition' => 'home_surfing_switch:is(on)',
            ),


            /* Testimonials Section */
            array(
                'label' => __('Testimonials', 'yoga'),
                'id' => 'home_testimonial',
                'type' => 'tab'
            ),

            array(
                'label' => __('Show Section', 'yoga'),
                'id' => 'home_testimonial_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on'
            ),

            array(
                'label' => __('Section Title', 'yoga'),
                'id' => 'testimonial_section_title',
                'type' => 'text',
                'std' => '',
                'condition' => 'home_testimonial_switch:is(on)'
            ),


            array(
                'id' => 'testimonial_list_item',
                'label' => __('Testimonials', 'yoga'),
                'desc' => __('The added testimonial will be displayed in the order they are arranged here.', 'yoga'),
                'type' => 'list-item',
                'condition' => 'home_testimonial_switch:is(on)',
                'operator' => 'and',
                'settings' => array(
                    array(
                        'id' => 'testimonial_content',
                        'label' => __('Testimonial Text', 'yoga'),
                        'type' => 'textarea-lite',
                        'rows' => '3',
                    ),
                ),
                'std'   => [['title'=>'']],
            ),

            array(
                'id' => 'testimonial_bg',
                'label' => __('Section Background', 'yoga'),
                'type' => 'upload',
                'class' => 'ot-upload-attachment-id',
                'condition' => 'home_testimonial_switch:is(on)'
            ),


            /* Newsletter Section */
            array(
                'label' => __('Newsletter', 'yoga'),
                'id' => 'home_newsletter',
                'type' => 'tab'
            ),

            array(
                'label' => __('Show Section', 'yoga'),
                'id' => 'home_newsletter_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on'
            ),

            array(
                'label' => __('Section Title', 'yoga'),
                'id' => 'newsletter_section_title',
                'type' => 'text',
                'std' => '',
                'condition' => 'home_newsletter_switch:is(on)'
            ),

            array(
                'label' => __('Section Content', 'yoga'),
                'id' => 'newsletter_section_content',
                'type' => 'textarea',
                'row' => '5',
                'std' => '',
                'condition' => 'home_newsletter_switch:is(on)'
            ),

            array(
                'label' => __('Button Title', 'yoga'),
                'id' => 'newsletter_btn_title',
                'type' => 'text',
                'std' => '',
                'condition' => 'home_newsletter_switch:is(on)'
            ),

            array(
                'label' => __('Custom Form', 'yoga'),
                'desc' => __('This will replace the default form.', 'yoga'),
                'id' => 'newsletter_form_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on',
                'condition' => 'home_newsletter_switch:is(on)'
            ),

            array(
                'label' => __('Form Embed Code or Shortcode', 'yoga'),
                'id' => 'newsletter_embed_code',
                'desc' => __('Please copy and paste the Embed Code or Shortcode of the custom form (if any). This will replace the default form.', 'yoga'),
                'type' => 'textarea',
                'row' => '5',
                'operator' => 'and',
                'condition' => 'home_newsletter_switch:is(on),newsletter_form_switch:is(on)'
            ),


        )
    );


    $about_sections = array(
        'id' => 'about_sections',
        'title' => __('Page Sections', 'yoga'),
        'desc' => '',
        'pages' => array('page'),
        'context' => 'normal',
        'priority' => 'low',
        'fields' => array(

            array(
                'label' => __('Banner', 'yoga'),
                'id' => 'about_banner',
                'type' => 'tab'
            ),

            array(
                'label' => __('Show Banner?', 'yoga'),
                'id' => 'internal_banner_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on'
            ),
            array(
                'label' => __('Banner Text', 'yoga'),
                'id' => 'int_ban_text',
                'type' => 'textarea-simple',
                'rows' => '2',
                'condition' => 'internal_banner_switch:is(on)'
            ),
            array(
                'label' => __('Banner Image', 'yoga'),
                'id' => 'int_ban_img',
                'type' => 'upload',
                'class' => 'ot-upload-attachment-id',
                'condition' => 'internal_banner_switch:is(on)'
            ),
            array(
                'label'     => __( 'Banner Height', 'yoga' ),
                'desc'        => '<span class="dashicons dashicons-external"></span> '.sprintf('<a href="%s" target="_blank">'.__( 'Change the font for this internal banner', 'yoga' ).'</a>', admin_url('admin.php?page=octheme_settings#section_typo_option')),
                'id'        => 'int_banner_height',
                'type'      => 'select',
                'std'		=> 'custom_height',
                'choices'     => array(
                    array(
                        'value'       => 'auto_height',
                        'label'       => __( 'Auto', 'yoga' ),
                    ),
                    array(
                        'value'       => 'full_view',
                        'label'       => __( 'Full Viewport', 'yoga' ),
                    ),
                    array(
                        'value'       => 'custom_height',
                        'label'       => __( 'Custom', 'yoga' ),
                    ),
                )
            ),

            array(
                'id'          => 'intbanner_height',
                'label'       => __( 'Internal Banner Height', 'yoga' ),
                'std'         => array('310', 'px'),
                'type'        => 'measurement',
                'condition'        => 'int_banner_height:is(custom_height)',
            ),

            array(
                'label' => __('Background Section', 'yoga'),
                'id' => 'about_bg_section',
                'type' => 'tab'
            ),

            array(
                'label' => __('Show Section', 'yoga'),
                'id' => 'about_bg_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on'
            ),

            array(
                'label' => __('Section Title', 'yoga'),
                'id' => 'about_bg_title',
                'type' => 'textarea-simple',
                'rows' => '3',
                'condition' => 'about_bg_switch:is(on)'
            ),
            array(
                'label' => __('Button Title', 'yoga'),
                'id' => 'about_bg_btn_title',
                'type' => 'text',
                'std' => '',
                'condition' => 'about_bg_switch:is(on)'
            ),
            array(
                'label' => __('Button Link', 'yoga'),
                'id' => 'about_bg_btn_link',
                'type' => 'text',
                'std' => '#',
                'condition' => 'about_bg_switch:is(on)'
            ),

            array(
                'label' => __('Section Background', 'yoga'),
                'id' => 'about_bg_img',
                'type' => 'upload',
                'class' => 'ot-upload-attachment-id',
                'condition' => 'about_bg_switch:is(on)'
            ),

            array(
                'label' => __('Events Section', 'yoga'),
                'id' => 'about_evt_section',
                'type' => 'tab'
            ),

            array(
                'label' => __('Show Section', 'yoga'),
                'id' => 'about_evt_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on'
            ),

            array(
                'label' => __('Section Title', 'yoga'),
                'id' => 'about_evt_title',
                'type' => 'text',
                'condition' => 'about_evt_switch:is(on)'
            ),


            array(
                'label' => __('Section Content', 'yoga'),
                'id' => 'about_events_desc',
                'type' => 'textarea',
                'rows' => '8',
                'std' => '',
                'condition' => 'about_evt_switch:is(on)'
            ),

            array(
                'label' => __('Events', 'yoga'),
                'id' => 'about_events',
                'desc' => __('The added testimonial will be displayed in the order they are arranged here.', 'yoga'),
                'type' => 'list-item',
                'condition' => 'about_evt_switch:is(on)',
                'operator' => 'and',
                'settings' => array(
                    array(
                        'label' => __('Short Description', 'yoga'),
                        'id' => 'event_desc',
                        'type' => 'textarea-lite',
                        'rows' => '3',
                    ),
                    array(
                        'label' => __('Month', 'yoga'),
                        'id' => 'event_month',
                        'type' => 'text',
                    ),
                    array(
                        'label' => __('Day', 'yoga'),
                        'id' => 'event_day',
                        'type' => 'text',
                    ),
                    array(
                        'label' => __('Acronym', 'yoga'),
                        'id' => 'event_acr',
                        'type' => 'text',
                    ),
                ),
                'std'   => [['title'=>'']],
            ),



        )
    );


    $contact_sections = array(
        'id' => 'contact_sections',
        'title' => __('Page Section', 'yoga'),
        'desc' => '',
        'pages' => array('page'),
        'context' => 'normal',
        'priority' => 'low',
        'fields' => array(


            array(
                'label' => __('Banner', 'yoga'),
                'id' => 'about_banner',
                'type' => 'tab'
            ),

            array(
                'label' => __('Show Banner?', 'yoga'),
                'id' => 'internal_banner_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on'
            ),
            array(
                'label' => __('Banner Text', 'yoga'),
                'id' => 'int_ban_text',
                'type' => 'textarea-simple',
                'rows' => '2',
                'condition' => 'internal_banner_switch:is(on)'
            ),
            array(
                'label' => __('Banner Image', 'yoga'),
                /*'desc' => __('Select an image by clicking the <b>+</b> button', 'yoga'),*/
                'id' => 'int_ban_img',
                'type' => 'upload',
                'class' => 'ot-upload-attachment-id',
                'condition' => 'internal_banner_switch:is(on)'
            ),

            array(
                'label'     => __( 'Banner Height', 'yoga' ),
                'desc'        => '<span class="dashicons dashicons-external"></span> '.sprintf('<a href="%s" target="_blank">'.__( 'Change the font for this internal banner', 'yoga' ).'</a>', admin_url('admin.php?page=octheme_settings#section_typo_option')),
                'id'        => 'int_banner_height',
                'type'      => 'select',
                'std'		=> 'custom_height',
                'choices'     => array(
                    array(
                        'value'       => 'auto_height',
                        'label'       => __( 'Auto', 'yoga' ),
                    ),
                    array(
                        'value'       => 'full_view',
                        'label'       => __( 'Full Viewport', 'yoga' ),
                    ),
                    array(
                        'value'       => 'custom_height',
                        'label'       => __( 'Custom', 'yoga' ),
                    ),
                ),
                'condition' => 'internal_banner_switch:is(on)'
            ),

            array(
                'id'          => 'intbanner_height',
                'label'       => __( 'Internal Banner Height', 'yoga' ),
                'std'         => array('310', 'px'),
                'type'        => 'measurement',
                'condition'        => 'internal_banner_switch:is(on),int_banner_height:is(custom_height)',
            ),
            array(
                'label' => __('Information Blocks', 'yoga'),
                'id' => 'contact_tab',
                'type' => 'tab',
            ),

            array(
                'label' => __('Information Blocks', 'yoga'),
                'id' => 'contact_page_blocks',
                'type' => 'list-item',
                'operator' => 'and',
                'settings' => array(
                    array(
                        'label' => __('Content', 'yoga'),
                        'id' => 'block_content',
                        'type' => 'textarea-lite',
                        'rows' => '3',
                    ),
                ),
	            'std'   => [['title'=>'']],
            ),

            array(
                'label' => __('Form Section', 'yoga'),
                'id' => 'booking_tab',
                'type' => 'tab',
            ),

            array(
                'label' => __('Show Section', 'yoga'),
                'id' => 'booking_sec_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on',
            ),

            array(
                'label' => __('Section Title', 'yoga'),
                'id' => 'booking_section_title',
                'type' => 'text',
                'std' => '',
                'condition' => 'booking_sec_switch:is(on)',
            ),

            array(
                'id'          => 'form_labels',
                'label'       => __( 'Form Fields Labels', 'yoga' ),
                'std'         => '',
                'type'        => 'textblock-titled',
                'section'     => 'contact_options',
                'class'     => 'inline_cols',
                'condition' => 'booking_sec_switch:is(on)',
                'operator'    => 'and'
            ),

            array(
                'id'          => 'form_label_1',
                'label'       => __('Email', 'yoga'),
                'std'         => 'Email',
                'type'        => 'text',
                'section'     => 'contact_options',
                'class'     => 'inline_cols',
                'condition' => 'booking_sec_switch:is(on)',
                'operator'    => 'and'
            ),
            array(
                'id'          => 'form_label_2',
                'label'       => __('Name', 'yoga'),
                'std'         => 'Name',
                'type'        => 'text',
                'section'     => 'contact_options',
                'class'     => 'inline_cols',
                'condition' => 'booking_sec_switch:is(on)',
                'operator'    => 'and'
            ),
            array(
                'id'          => 'form_label_3',
                'label'       => __('Message', 'yoga'),
                'std'         => 'Message',
                'type'        => 'text',
                'section'     => 'contact_options',
                'class'     => 'inline_cols',
                'condition' => 'booking_sec_switch:is(on)',
                'operator'    => 'and'
            ),
            array(
                'id'          => 'form_label_4',
                'label'       => __('Button Text', 'yoga'),
                'std'         => 'SEND MESSAGE',
                'type'        => 'text',
                'section'     => 'contact_options',
                'class'     => 'inline_cols',
                'condition' => 'booking_sec_switch:is(on)',
                'operator'    => 'and'
            ),

            array(
                'id'          => 'cmail_subject',
                'label'       => __( 'Email Subject', 'yoga' ),
                'std'         => 'Contact query from website '.get_bloginfo('name'),
                'type'        => 'text',
                'section'     => 'contact_options',
                'condition' => 'booking_sec_switch:is(on)',
                'operator'    => 'and'
            ),

            array(
                'id'          => 'recipient_email',
                'label'       => __( 'Recipients', 'yoga' ),
                'desc'        => __( 'Provide email accounts where you want to receive emails from this form.', 'yoga' ),
                'std'         => get_option('admin_email'),
                'type'        => 'text',
                'section'     => 'contact_options',
                'condition' => 'booking_sec_switch:is(on)',
                'operator'    => 'and'
            ),

            array(
                'label' => __('Custom Form', 'yoga'),
                'desc' => 'This will replace the default form.',
                'id'   => 'custom_form_switch',
                'type' => 'on-off',
                'std'  => 'off',
                'condition' => 'booking_sec_switch:is(on)',
            ),

            array(
                'label' => __('Form Embed Code or Shortcode', 'yoga'),
                'desc' => __('Please copy and paste the Embed Code or Shortcode of the custom form (if any). This will replace the default form.', 'yoga'),
                'id' => 'booking_form_embed',
                'type' => 'textarea',
                'rows' => '3',
                'condition' => 'custom_form_switch:is(on), booking_sec_switch:is(on)',
            ),

            array(
                'label' => __('Section Background', 'yoga'),
                'id' => 'booking_section_bg',
                'type' => 'upload',
                'class' => 'ot-upload-attachment-id',
                'condition' => 'booking_sec_switch:is(on)',
            ),


            array(
                'label' => __('Map Section', 'yoga'),
                'id' => 'map_tab',
                'type' => 'tab',
            ),

            array(
                'label' => __('Show Section', 'yoga'),
                'id' => 'map_sec_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on',
            ),

            array(
                'label' => __('Section Title', 'yoga'),
                'id' => 'map_section_title',
                'type' => 'text',
                'condition' => 'map_sec_switch:is(on)',
            ),

            array(
                'label' => __('Section Content', 'yoga'),
                'id' => 'map_section_content',
                'type' => 'textarea',
                'rows' => '6',
                'condition' => 'map_sec_switch:is(on)',
            ),

            array(
                'label' => __('Map Embed Code', 'yoga'),
                'id' => 'map_section_code',
                'type' => 'textarea',
                'rows' => '3',
                'condition' => 'map_sec_switch:is(on)',
            ),


        )
    );


    $blog_settings = array(
        'id' => 'blog_settings',
        'title' => __('Page Sections', 'yoga'),
        'desc' => '',
        'pages' => array('page'),
        'context' => 'normal',
        'priority' => 'low',
        'fields' => array(

            array(
                'label' => __('Banner Settings', 'yoga'),
                'id' => 'banner_settings',
                'type' => 'tab',
            ),

            array(
                'label' => __('Show Banner?', 'yoga'),
                'id' => 'internal_banner_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on'
            ),
            array(
                'label' => __('Banner Text', 'yoga'),
                'id' => 'int_ban_text',
                'type' => 'textarea-simple',
                'rows' => '2',
                'condition' => 'internal_banner_switch:is(on)'
            ),
            array(
                'label' => __('Banner Image', 'yoga'),
                'id' => 'int_ban_img',
                'type' => 'upload',
                'class' => 'ot-upload-attachment-id',
                'condition' => 'internal_banner_switch:is(on)'
            ),
            array(
                'label'     => __( 'Banner Height', 'yoga' ),
                'desc'        => '<span class="dashicons dashicons-external"></span> '.sprintf('<a href="%s" target="_blank">'.__( 'Change the font for this internal banner', 'yoga' ).'</a>', admin_url('admin.php?page=octheme_settings#section_typo_option')),
                'id'        => 'int_banner_height',
                'type'      => 'select',
                'std'		=> 'custom_height',
                'choices'     => array(
                    array(
                        'value'       => 'auto_height',
                        'label'       => __( 'Auto', 'yoga' ),
                    ),
                    array(
                        'value'       => 'full_view',
                        'label'       => __( 'Full Viewport', 'yoga' ),
                    ),
                    array(
                        'value'       => 'custom_height',
                        'label'       => __( 'Custom', 'yoga' ),
                    ),
                )
            ),

            array(
                'id'          => 'intbanner_height',
                'label'       => __( 'Banner Custom Height', 'yoga' ),
                'desc'        => __( 'This will change the height of the banner.', 'yoga' ).'<br><br>'.__( 'To change Banner Font Style', 'yoga' ).': <b>'.__( 'Theme Options > Typography > Font Styles > Internal Banners', 'yoga' ).'</b>',
                'std'         => array('310', 'px'),
                'type'        => 'measurement',
                'condition'        => 'int_banner_height:is(custom_height)',
            ),

            array(
                'label' => __('Button Title', 'yoga'),
                'id' => 'btn_settings',
                'type' => 'tab',
            ),

            array(
                'label' => __('Button Title', 'yoga'),
                'id' => 'blg_btn_title',
                'type' => 'text',
            ),
        )
    );


    $page_banners = array(
        'id' => 'int_ban_box',
        'title' => __('Banner Setting', 'yoga'),
        'desc' => '',
        'pages' => array('page'),
        'context' => 'normal',
        'priority' => 'low',
        'fields' => array(

            array(
                'label' => __('Banner Settings', 'yoga'),
                'id' => 'banner_settings',
                'type' => 'tab',
            ),

            array(
                'label' => __('Page Subtitle', 'yoga'),
                'id' => 'page_subtitle',
                'type' => 'text',
            ),

            array(
                'label' => __('Show Banner?', 'yoga'),
                'id' => 'internal_banner_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on'
            ),
            array(
                'label' => __('Banner Text', 'yoga'),
                'id' => 'int_ban_text',
                'type' => 'textarea-simple',
                'rows' => '2',
                'condition' => 'internal_banner_switch:is(on)'
            ),
            array(
                'label' => __('Banner Image', 'yoga'),
                'id' => 'int_ban_img',
                'type' => 'upload',
                'class' => 'ot-upload-attachment-id',
                'condition' => 'internal_banner_switch:is(on)'
            ),
            array(
                'label'     => __( 'Banner Height', 'yoga' ),
                'desc'        => '<span class="dashicons dashicons-external"></span> '.sprintf('<a href="%s" target="_blank">'.__( 'Change the font for this internal banner', 'yoga' ).'</a>', admin_url('admin.php?page=octheme_settings#section_typo_option')),
                'id'        => 'int_banner_height',
                'type'      => 'select',
                'std'		=> 'custom_height',
                'choices'     => array(
                    array(
                        'value'       => 'auto_height',
                        'label'       => __( 'Auto', 'yoga' ),
                    ),
                    array(
                        'value'       => 'full_view',
                        'label'       => __( 'Full Viewport', 'yoga' ),
                    ),
                    array(
                        'value'       => 'custom_height',
                        'label'       => __( 'Custom', 'yoga' ),
                    ),
                )
            ),

            array(
                'id'          => 'intbanner_height',
                'label'       => __( 'Banner Custom Height', 'yoga' ),

                'std'         => array('310', 'px'),
                'type'        => 'measurement',
                'condition'        => 'int_banner_height:is(custom_height)',
            ),
        )
    );

    $lessons_listing = array(
        'id' => 'int_ban_box',
        'title' => __('Banner Setting', 'yoga'),
        'desc' => '',
        'pages' => array('page'),
        'context' => 'normal',
        'priority' => 'low',
        'fields' => array(

            array(
                'label' => __('Page Sections', 'yoga'),
                'id' => 'lesslist_tab',
                'type' => 'tab',
            ),

            array(
                'label' => __('Page Subtitle', 'yoga'),
                'id' => 'page_subtitle',
                'type' => 'text',
            ),

            array(
                'label' => __('Show Banner?', 'yoga'),
                'id' => 'internal_banner_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on'
            ),
            array(
                'label' => __('Banner Text', 'yoga'),
                'id' => 'int_ban_text',
                'type' => 'textarea-simple',
                'rows' => '2',
                'condition' => 'internal_banner_switch:is(on)'
            ),
            array(
                'label' => __('Banner Image', 'yoga'),
                'id' => 'int_ban_img',
                'type' => 'upload',
                'class' => 'ot-upload-attachment-id',
                'condition' => 'internal_banner_switch:is(on)'
            ),
            array(
                'label'     => __( 'Banner Height', 'yoga' ),
                'desc'        => '<span class="dashicons dashicons-external"></span> '.sprintf('<a href="%s" target="_blank">'.__( 'Change the font for this internal banner', 'yoga' ).'</a>', admin_url('admin.php?page=octheme_settings#section_typo_option')),
                'id'        => 'int_banner_height',
                'type'      => 'select',
                'std'		=> 'custom_height',
                'choices'     => array(
                    array(
                        'value'       => 'auto_height',
                        'label'       => __( 'Auto', 'yoga' ),
                    ),
                    array(
                        'value'       => 'full_view',
                        'label'       => __( 'Full Viewport', 'yoga' ),
                    ),
                    array(
                        'value'       => 'custom_height',
                        'label'       => __( 'Custom', 'yoga' ),
                    ),
                )
            ),

            array(
                'id'          => 'intbanner_height',
                'label'       => __( 'Banner Custom Height', 'yoga' ),

                'std'         => array('310', 'px'),
                'type'        => 'measurement',
                'condition'        => 'int_banner_height:is(custom_height)',
            ),

            array(
                'label' => __('Information Blocks', 'yoga'),
                'id' => 'info_tab',
                'type' => 'tab',
            ),

            array(
                'label' => __('Button Title', 'yoga'),
                'id' => 'info_btn_title',
                'type' => 'text',
            ),


        )
    );


    $lesson_banners = array(
        'id' => 'int_ban_box',
        'title' => __('Page Sections', 'yoga'),
        'desc' => '',
        'pages' => array('lesson'),
        'context' => 'normal',
        'priority' => 'low',
        'fields' => array(

            array(
                'label' => __('Banner Setting', 'yoga'),
                'id' => 'lesson_tabs',
                'type' => 'tab',
            ),
            array(
                'label' => __('Page Subtitle', 'yoga'),
                'id' => 'page_subtitle',
                'type' => 'text',
            ),

            array(
                'label' => __('Show Banner?', 'yoga'),
                'id' => 'internal_banner_switch',
                'type' => 'on-off',
                'class'     => 'switch_div',
                'std' => 'on'
            ),
            array(
                'label' => __('Banner Text', 'yoga'),
                'id' => 'int_ban_text',
                'type' => 'textarea-simple',
                'rows' => '2',

                'condition' => 'internal_banner_switch:is(on)'
            ),
            array(
                'label' => __('Banner Image', 'yoga'),
                'id' => 'int_ban_img',
                'type' => 'upload',
                'class' => 'ot-upload-attachment-id',
                'condition' => 'internal_banner_switch:is(on)'
            ),
            array(
                'label'     => __( 'Banner Height', 'yoga' ),
                'desc'        => '<span class="dashicons dashicons-external"></span> '.sprintf('<a href="%s" target="_blank">'.__( 'Change the font for this internal banner', 'yoga' ).'</a>', admin_url('admin.php?page=octheme_settings#section_typo_option')),
                'id'        => 'int_banner_height',
                'type'      => 'select',
                'std'		=> 'custom_height',
                'choices'     => array(
                    array(
                        'value'       => 'auto_height',
                        'label'       => __( 'Auto', 'yoga' ),
                    ),
                    array(
                        'value'       => 'full_view',
                        'label'       => __( 'Full Viewport', 'yoga' ),
                    ),
                    array(
                        'value'       => 'custom_height',
                        'label'       => __( 'Custom', 'yoga' ),
                    ),
                )
            ),

            array(
                'id'          => 'intbanner_height',
                'label'       => __( 'Banner Custom Height', 'yoga' ),

                'std'         => array('310', 'px'),
                'type'        => 'measurement',
                'condition'        => 'int_banner_height:is(custom_height)',
            ),
            array(
                'label' => __('Information Blocks', 'yoga'),
                'id' => 'lesson_info',
                'type' => 'tab',
            ),

            array(
                'id' => 'booking_info_list_item',
                'label' => __('Information Blocks', 'yoga'),
                'desc' => __('The added features will be displayed in the order they are arranged here.', 'yoga'),
                'type' => 'list-item',
                'settings' => array(
                    array(
                        'label' => __('Content', 'yoga'),
                        'id' => 'booking_info_content',
                        'type' => 'textarea-lite',
                        'rows' => '3',
                    ),
                ),
                'std'   => [['title'=>'']],
            ),


            array(
                'label' => __('Button Title', 'yoga'),
                'id' => 'booking_title',
                'type' => 'text',
                'std' => '',
            ),
            array(
                'label' => __('Booking Page Link', 'yoga'),
                'id' => 'booking_link',
                'type' => 'text',
                'std' => '#',
            ),
        )
    );

    $instructor_subtitle = array(
        'id' => 'inst_sub',
        'title' => __('Subtitle', 'yoga'),
        'desc' => '',
        'pages' => array('instructor', 'post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'label' => __('Subtitle', 'yoga'),
                'id' => 'page_subtitle',
                'type' => 'text',
            ),
        )
    );
    /**
     * Register our meta boxes using the
     * ot_register_meta_box() function.
     */


    if (function_exists('ot_register_meta_box'))

        /* Exclude these templates from having common metaboxes. */
        $exclude_page_templates = array(
            'page-templates/about-us-page.php',
            'page-templates/contact-page.php',
            'page-templates/lessons-page.php',
        );

        /* Blog Page ID */
        $blog_page_id = get_option('page_for_posts');
        $page_id = get_permalink();
        $page_template_file = '';
        if (isset($_REQUEST['post'])) {
            $page_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
            $page_template_file = get_post_meta($page_id, '_wp_page_template', TRUE);
        }
        if (isset($_POST['post_ID'])) {
            $page_id = $_POST['post_ID'];
            $page_template_file = get_post_meta($page_id, '_wp_page_template', TRUE);
        }

        $front_page = get_option('page_on_front');
        if (isset($page_id) && $front_page == $page_id) {
            ot_register_meta_box($homepage_sections);
        }

        /* About Us Page Metaboxes */
        if($page_template_file == 'page-templates/about-us-page.php'){
            ot_register_meta_box($about_sections);
        }

        /* Contact Page Metaboxes */
        if($page_template_file == 'page-templates/contact-page.php'){
            ot_register_meta_box($contact_sections);
        }
        /* CPT Listing Metaboxes */
        if($page_template_file == 'page-templates/lessons-page.php'){
            ot_register_meta_box($lessons_listing);
        }

        /* Blog Page Metaboxes */
        if($blog_page_id == $page_id){
            ot_register_meta_box($blog_settings);
        }

        /* General Pages Banner Settings */
        if (isset($page_id) && $front_page != $page_id && $blog_page_id != $page_id && !in_array($page_template_file, $exclude_page_templates)) {
            ot_register_meta_box($page_banners);
        }

    ot_register_meta_box($lesson_banners);
    ot_register_meta_box($instructor_subtitle);


    /*ot_register_meta_box($homepage_sections);*/

    /*if (isset($page_template_file) && $page_template_file == 'front-page.php') {
        ot_register_meta_box( $cta_section );
    }*/

    /*ot_register_meta_box( $my_meta_box );*/

}