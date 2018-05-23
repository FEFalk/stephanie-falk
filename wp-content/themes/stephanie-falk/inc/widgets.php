<?php
add_action( 'load-widgets.php', 'my_custom_load' );

function my_custom_load() {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
}

/* Logo Widget */
class one_footer_logo_widget extends WP_Widget {


    public function widget( $args, $instance ) {
        // Our variables from the widget settings
        $image = ! empty( $instance['logo'] ) ? $instance['logo'] : '';
        $title = $instance['title'];
        $description = $instance['description'];

        ob_start();
        echo $args['before_widget'];

        if($image){
            $image_src = wp_get_attachment_image_src($image, 'medium_large');
            if(!empty($image_src) && strlen($image_src[0])){
                $image_src = $image_src[0];
                printf('<div class="site-logo footer-logo"><a href="%s" title="%s"><img src="%s" alt="%s"></a></div>',home_url('/'), get_bloginfo('name'), $image_src, get_bloginfo('name'));
            }
            else{
                printf('<div class="site-logo footer-logo"><h2 class="site-title">%s</h2></div>', get_bloginfo('name'));
            }

        }
        else{
            printf('<div class="site-logo footer-logo"><h2 class="site-title">%s</h2></div>', get_bloginfo('name'));
        }
        ?>

        <?php
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        ?>

        <?php if($description){
            printf('<p>%s</p>', $description);
        } ?>

        <?php
        echo $args['after_widget'];
        ob_end_flush();
    }

    public function form( $instance ) {
        $image = ! empty( $instance['logo'] ) ? $instance['logo'] : '';
        $title = ! empty( $instance['title'] ) ? $instance['title'] : sprintf( 'Lorem ipsum sitame an ullamcs uisaue velitesse.' );
        $description = ! empty( $instance['description'] ) ? $instance['description'] : sprintf( 'Lorem ipsum dolor sit amet donec est eget sunt consectetuer maecenas am mauris sit semper nibh vestibulum vel morbi purus aliquam.');
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'logo' ); ?>"><?php echo __( 'Upload Logo', 'yoga' ); ?>: </label><br>
            <input class="widefat" id="<?php echo $this->get_field_id( 'logo' ); ?>" name="<?php echo $this->get_field_name( 'logo' ); ?>" type="text" value="<?php echo (int) $image; ?>" style="width:70%" />
            <button style="width:27%" class="upload_image_button button alignright"><?php echo __('Upload Logo', 'yoga'); ?></button>
            <br><small>Site Title will be displayed if logo not uploaded.</small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Subtext', 'yoga' ); ?>: </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php echo __( 'Description', 'yoga' ); ?>: </label>
            <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $description ); ?></textarea>
        </p>
        <?php
    }


    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['logo'] = ( ! empty( $new_instance['logo'] ) ) ? $new_instance['logo'] : '';
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';

        return $instance;
    }

    public function scripts()
    {
	    if(get_current_screen()->base == 'widgets' || is_customize_preview()){
		    wp_enqueue_script( 'media-upload' );
	    }
        wp_enqueue_media();
        wp_enqueue_script('our_admin', get_template_directory_uri() . '/inc/widgets.js', array('jquery'));
    }

    function __construct() {

        /*Add Widget scripts*/
        add_action('admin_enqueue_scripts', array($this, 'scripts'));

        parent::__construct(
            'one_footer_logo', // Base ID
            __( 'Logo & Description', 'yoga' ), // Name
            array( 'description' => __( 'Brand description.', 'yoga' ), ) // Args
        );
    }


}

add_action( 'widgets_init', create_function('', 'return register_widget("one_footer_logo_widget");') );





/* Call To Action Banner [cta-banner] */

class one_cta_banner_widget extends WP_Widget {


    public function widget( $args, $instance ) {
        // Our variables from the widget settings
        $image = ! empty( $instance['banner'] ) ? $instance['banner'] : 215;
        $banner_caption = ! empty( $instance['banner_caption'] ) ? $instance['banner_caption'] : 'WANT <br>TO HIRE <br>SURFBOARD';
        $btn_label = ! empty( $instance['btn_label'] ) ? $instance['btn_label'] : 'HIRE SURF BOARD';
        $btn_link = ! empty( $instance['btn_link'] ) ? $instance['btn_link'] : '#';
        $target_blank = ! empty( $instance['target_blank'] ) ? true : false;
        $banner_height = ! empty( $instance['banner_height'] ) ? $instance['banner_height'] : '460';
        $text_spacing = ! empty( $instance['text_spacing'] ) ? $instance['text_spacing'] : '74';

        ob_start();
        echo $args['before_widget'];
        $html ='';

        if($image){

            if(strlen($banner_height)){
                $banner_height =$banner_height.'px';
            }
            else{
                $banner_height = 'auto';
            }

            $image_src = wp_get_attachment_image_src($image, 'medium_large');
            if(!empty($image_src) && strlen($image_src[0])){
                $image_src = $image_src[0];
                $html .= '<div class="widget_cta_banner" style="background-image: url('.$image_src.'); min-height:'.$banner_height.'">';
            }




            if ( ! empty( $banner_caption ) ) {


                if(strlen($text_spacing)){
                    $text_spacing = $text_spacing.'px';
                }
                else{
                    $text_spacing = 'auto';
                }

                $html .= '<div class="widget_banner_caption" style="margin-bottom: '.$text_spacing.';"><h4>'.nl2br($banner_caption).'</h4></div>';
            }

            if ( ! empty( $btn_label ) ||   ! empty( $btn_link )) {
                $html .= sprintf('<a class="button banner_button" href="%s" target="%s">%s</a>', $btn_link, (($target_blank)?'_blank':'_self'), $btn_label);
            }

            $html .='</div>';

        }
        ?>

        <?php echo $html; ?>

        <?php
        echo $args['after_widget'];
        ob_end_flush();
    }

    public function form( $instance ) {
        $image = ! empty( $instance['banner'] ) ? $instance['banner'] : 215;
        $banner_caption = ! empty( $instance['banner_caption'] ) ? $instance['banner_caption'] : 'WANT '.PHP_EOL.'TO HIRE '.PHP_EOL.'SURFBOARD';
        $btn_label = ! empty( $instance['btn_label'] ) ? $instance['btn_label'] : 'HIRE SURF BOARD';
        $btn_link = ! empty( $instance['btn_link'] ) ? $instance['btn_link'] : '#';
        $target_blank = isset( $instance['target_blank'] ) ? (bool) $instance['target_blank'] : false;
        $banner_height = ! empty( $instance['banner_height'] ) ? $instance['banner_height'] : '460';
        $text_spacing = ! empty( $instance['text_spacing'] ) ? $instance['text_spacing'] : '74';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'banner' ); ?>"><?php echo __( 'Banner', 'yoga' ); ?>: </label><br>
            <input class="widefat" id="<?php echo $this->get_field_id( 'banner' ); ?>" name="<?php echo $this->get_field_name( 'banner' ); ?>" type="text" value="<?php echo (int) $image; ?>" style="width:70%" />
            <button style="width:27%" class="upload_image_button button alignright"><?php echo __('Upload Banner', 'yoga'); ?></button>
            <br><small>Site Title will be displayed if logo not uploaded.</small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'banner_caption' ); ?>"><?php echo __( 'Banner Caption', 'yoga' ); ?>:</label>
            <textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id( 'banner_caption' ); ?>" name="<?php echo $this->get_field_name( 'banner_caption' ); ?>"><?php echo esc_attr( $banner_caption ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'btn_label' ); ?>"><?php echo __( 'Button Label' , 'yoga' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'btn_label' ); ?>" name="<?php echo $this->get_field_name( 'btn_label' ); ?>" type="text" value="<?php echo esc_attr( $btn_label ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'btn_link' ); ?>"><?php echo __( 'Button Link', 'yoga' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'btn_link' ); ?>" name="<?php echo $this->get_field_name( 'btn_link' ); ?>" type="text" value="<?php echo esc_attr( $btn_link ); ?>">
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $target_blank ); ?> id="<?php echo $this->get_field_id( 'target_blank' ); ?>" name="<?php echo $this->get_field_name( 'target_blank' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'target_blank' ); ?>"><?php echo __( 'Open in new window?', 'yoga' ); ?></label>
        </p>
        <p style="display: inline-block; width:40%; margin-right:20px;">
            <label for="<?php echo $this->get_field_id( 'banner_height' ); ?>"><?php echo __( 'Banner Height (px)', 'yoga' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'banner_height' ); ?>" name="<?php echo $this->get_field_name( 'banner_height' ); ?>" type="number" value="<?php echo esc_attr( $banner_height ); ?>">
        </p>
        <p style="display: inline-block; width:40%;">
            <label for="<?php echo $this->get_field_id( 'text_spacing' ); ?>"><?php echo __( 'Space after caption (px)', 'yoga' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text_spacing' ); ?>" name="<?php echo $this->get_field_name( 'text_spacing' ); ?>" type="number" value="<?php echo esc_attr( $text_spacing ); ?>">
        </p>
        <?php
    }


    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['banner'] = ( ! empty( $new_instance['banner'] ) ) ? $new_instance['banner'] : '';
        $instance['banner_caption'] = ( ! empty( $new_instance['banner_caption'] ) ) ? strip_tags( $new_instance['banner_caption'] ) : '';
        $instance['btn_label'] = ( ! empty( $new_instance['btn_label'] ) ) ? strip_tags( $new_instance['btn_label'] ) : '';
        $instance['btn_link'] = ( ! empty( $new_instance['btn_link'] ) ) ? strip_tags( $new_instance['btn_link'] ) : '';
        $instance['banner_height'] = ( ! empty( $new_instance['banner_height'] ) ) ? strip_tags( $new_instance['banner_height'] ) : '';
        $instance['text_spacing'] = ( ! empty( $new_instance['text_spacing'] ) ) ? strip_tags( $new_instance['text_spacing'] ) : '';
        $instance['target_blank'] = !empty($new_instance['target_blank']) ? true : false;

        return $instance;
    }

    public function scripts()
    {
	    if(get_current_screen()->base == 'widgets' || is_customize_preview()){
		    wp_enqueue_script( 'media-upload' );
	    }
        wp_enqueue_media();
        wp_enqueue_script('our_admin', get_template_directory_uri() . '/inc/widgets.js', array('jquery'));
    }

    function __construct() {

        /*Add Widget scripts*/
        add_action('admin_enqueue_scripts', array($this, 'scripts'));

        parent::__construct(
            'one_cta_banner', // Base ID
            __( 'Banner Widget', 'yoga' ), // Name
            array( 'description' => __( 'Displays a call to action banner with image.', 'yoga' ), ) // Args
        );
    }


}

add_action( 'widgets_init', create_function('', 'return register_widget("one_cta_banner_widget");') );


class one_footer_address_widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'one_footer_address', // Base ID
            __( 'Address', 'yoga' ), // Name
            array( 'description' => __( 'Displays an address on your site.', 'yoga' ), ) // Args
        );
    }


    public function widget( $args, $instance ) {
        global $widget_default_color;
        $widget_default_color = true;
        /* Our variables from the widget settings */
        $title = $instance['title'];
        $description = $instance['description'];
        $display_icons = ! empty( $instance['display_icons'] ) ? true : false;

        $icon_color = ! empty( $instance['icon_color'] ) ? true : false;
        $icon_default_color = ! empty( $instance['icon_default_color'] ) ? $instance['icon_default_color'] : '';
        $icon_hover_color = ! empty( $instance['icon_hover_color'] ) ? $instance['icon_hover_color'] : '';

        $widget_id = $args[ 'widget_id' ];



        ob_start();
        echo $args['before_widget'];
        ?>

        <?php
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        ?>

        <?php if($description){
            printf('<p>%s</p>', nl2br($description));
        } ?>

        <?php
            /* Include social media links */
            if($display_icons)
            include(get_parent_theme_file_path().'/template-parts/social-icons.php');

        ?>

        <?php
            if ( empty( $icon_color ) || (int)$icon_color == 0 ) {
                $css = '<style>';
                if ( ! empty( $icon_default_color ) ) {
                    $css .= sprintf("#%s .social-icons ul li a svg *{fill:%s;}",$widget_id ,$icon_default_color);
                }
                else{
                    $css .= sprintf("#%s .social-icons ul li a svg *{fill:%s;}",$widget_id ,ot_get_option('skin_secondary'));
                    $css .= sprintf(".sidebar #%s .social-icons ul li a svg *{fill:%s;}",$widget_id ,ot_get_option('skin_primary'));
                    }
                if ( ! empty( $icon_hover_color ) ) {
                    $css .= sprintf("#%s .social-icons ul li a:hover svg *{fill:%s;}",$widget_id ,$icon_hover_color);
                }
            }
            $css .= '</style>';
            printf($css);
        ?>


        <?php
        echo $args['after_widget'];
        ob_end_flush();
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Get in Touch';
        $description = ! empty( $instance['description'] ) ? $instance['description'] : sprintf('8901 Marmora Road, Glasgow,'.PHP_EOL.'Glasgow 89GR'.PHP_EOL.'Email: mail@demolink.org'.PHP_EOL.'Phone 1: (800) 0123 - 456 - 7890');
        $display_icons = ! empty( $instance['display_icons'] ) ? (bool) $instance['display_icons'] :false;


        $icon_color = ! empty( $instance['icon_color'] ) ? (bool) $instance['icon_color'] : false;
        $icon_default_color = ! empty( $instance['icon_default_color'] ) ? $instance['icon_default_color'] : '';
        $icon_hover_color = ! empty( $instance['icon_hover_color'] ) ? $instance['icon_hover_color'] : '';


        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title', 'yoga' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php echo __( 'Address', 'yoga' ); ?>:</label>
            <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $description ); ?></textarea>
        </p>

        <p>
            <input class="checkbox" id="<?php echo $this->get_field_id( 'display_icons' ); ?>" name="<?php echo $this->get_field_name( 'display_icons' ); ?>" type="checkbox" <?php checked( $display_icons ); ?> data="<?php echo  $display_icons; ?>" >
            <label for="<?php echo $this->get_field_id( 'display_icons' ); ?>"><?php echo __( 'Social Links', 'yoga' ); ?></label>
        </p>

        <div style="<?php echo ( (int) $display_icons == 1)?'':'display: none;'; ?>" class="soc_clr_swc">
            <p>
                <input class="checkbox" id="<?php echo $this->get_field_id( 'icon_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_color' ); ?>" type="checkbox" <?php checked( $icon_color ); ?> data="<?php echo $icon_color; ?>" >
                <label for="<?php echo $this->get_field_id( 'icon_color' ); ?>"><?php echo __( 'Social Icon Default Colors', 'yoga' ); ?></label>
                <!-- TODO: Update translations for respective strings -->
            </p>
        </div>

        <?php /*echo 'Show Icons switch : '.(int) $display_icons; */?><!--
        --><?php /*echo '- AND - Icon color switch : '.(int) $icon_color; */?>

        <div class="cst_soc_clr" style="<?php echo ((int)$icon_color == 0 && $display_icons == 1)?'':'display: none;'; ?> float:left; margin-top:0;">
            <p style="margin:0;">
                <label for="<?php echo $this->get_field_id( 'icon_default_color' ); ?>"><?php echo __( 'Standard', 'yoga' ); ?></label><br>
                <!-- TODO: Update translations for respective strings -->
                <input class="widefat colorpicker" id="<?php echo $this->get_field_id( 'icon_default_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_default_color' ); ?>" type="text" value="<?php echo esc_attr( $icon_default_color ); ?>" />
            </p>
        </div>

        <div class="cst_soc_clr" style="<?php echo ((int)$icon_color == 0 && $display_icons == 1)?'':'display: none;'; ?> float:right; margin-right:20px; margin-top:0;">
            <p style="margin:0;">
                <label for="<?php echo $this->get_field_id( 'icon_hover_color' ); ?>"><?php echo __( 'Hover', 'yoga' ); ?></label><br>
                <!-- TODO: Update translations for respective strings -->
                <input class="widefat colorpicker" id="<?php echo $this->get_field_id( 'icon_hover_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_hover_color' ); ?>" type="text" value="<?php echo esc_attr( $icon_hover_color ); ?>" />
            </p>
        </div>

        <div style="clear:both;"></div>

        <div style="<?php echo ( (int)$icon_color == 0 && $display_icons == 1)?'':'display: none;'; ?> padding: 0;" class="description cst_soc_clr" style="padding: 0;">
            <p style="margin:0;"><?php _e( 'If colors are not set, skin colors will be applied.', 'handmade' ); ?></p>
            <!-- TODO: Update translations for respective strings -->
        </div>

        <p style="<?php echo ($display_icons == 1)?'':'display: none;'; ?>" class="mng_social"><span class="dashicons dashicons-external"></span> <a href="<?php echo menu_page_url('octheme_settings', false).'#section_social_links'; ?>" target="_blank">Manage Social Icons</a></p>

        <script>
            jQuery(document).ready(function(){
                jQuery('#<?php echo $this->get_field_id( 'icon_default_color' ); ?>, #<?php echo $this->get_field_id( 'icon_hover_color' ); ?>').wpColorPicker();

                jQuery('#<?php echo $this->get_field_id( 'display_icons' ); ?>').bind('change', function(){
                    if(jQuery('#<?php echo $this->get_field_id( 'display_icons' ); ?>').is(":checked")) {
                        jQuery('.soc_clr_swc, .mng_social').slideDown();


                        if(jQuery('#<?php echo $this->get_field_id( 'icon_color' ); ?>').is(":checked")){
                            jQuery('.cst_soc_clr').slideUp();
                        }
                    }
                    else{
                        jQuery('.soc_clr_swc, .mng_social, .cst_soc_clr').slideUp();
                    }
                });

                jQuery('#<?php echo $this->get_field_id( 'icon_color' ); ?>').bind('change', function(){
                    if(jQuery('#<?php echo $this->get_field_id( 'icon_color' ); ?>').is(":checked")){
                        jQuery('.cst_soc_clr').slideUp();
                    }
                    else{
                        jQuery('.cst_soc_clr').css('display', 'inline-block').hide().slideDown();
                    }
                });

            });
        </script>
        <?php
    }


    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
        $instance['display_icons'] = !empty($new_instance['display_icons']) ? true : false;

        $instance['icon_color'] = ( ! empty( $new_instance['icon_color'] ) ) ? true : false;
        $instance['icon_hover_color'] = ( ! empty( $new_instance['icon_hover_color'] ) ) ? strip_tags( $new_instance['icon_hover_color'] ) : '';
        $instance['icon_default_color'] = ( ! empty( $new_instance['icon_default_color'] ) ) ? strip_tags( $new_instance['icon_default_color'] ) : '';

        return $instance;
    }

}

add_action( 'widgets_init', create_function('', 'return register_widget("one_footer_address_widget");') );



?>