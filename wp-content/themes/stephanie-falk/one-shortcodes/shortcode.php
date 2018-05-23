<?php
/* ONECOM Shortcodes */

add_action( 'wp_enqueue_scripts', 'one_shortcodes_scripts' );
function one_shortcodes_scripts() {

	$resource_extension = ( SCRIPT_DEBUG || SCRIPT_DEBUG == 'true') ? '' : '.min'; // Adding .min extension if SCRIPT_DEBUG is enabled
	$resource_min_dir = ( SCRIPT_DEBUG || SCRIPT_DEBUG == 'true') ? '' : 'min-'; // Adding min- as a minified directory of resources if SCRIPT_DEBUG is enabled

	wp_register_style( 'one-shortcode-styles', get_template_directory_uri() . '/one-shortcodes/'.$resource_min_dir.'css/shortcode'.$resource_extension.'.css' );
	wp_register_style( 'one-shinybox', get_template_directory_uri() . '/one-shortcodes/'.$resource_min_dir.'css/shinybox'.$resource_extension.'.css' );
	wp_register_style( 'one-shortcode-css', get_template_directory_uri() . '/one-shortcodes/min-css/one-shortcodes.min.css' );

    wp_register_script( 'one-shinybox-ios-fix', get_template_directory_uri() . '/one-shortcodes/'.$resource_min_dir.'js/ios-orientationchange-fix'.$resource_extension.'.js', array('jquery'), null, true );
	wp_register_script( 'one-shinybox', get_template_directory_uri() . '/one-shortcodes/'.$resource_min_dir.'js/shinybox'.$resource_extension.'.js', array('jquery'), null, true );

	wp_register_script( 'one-shortcode-scripts', get_template_directory_uri() . '/one-shortcodes/'.$resource_min_dir.'js/shortcode'.$resource_extension.'.js', array('jquery'), null, true );
	wp_register_script( 'one-shortcode-js', get_template_directory_uri() . '/one-shortcodes/min-js/one-shortcodes.min.js', array('jquery'), null, true );
}

function one_gallery_shinybox($output, $attr){
	if( (WP_DEBUG != true || WP_DEBUG != 'true' ) && (SCRIPT_DEBUG != true || SCRIPT_DEBUG != 'true' ) ) {
		wp_enqueue_script( 'one-shortcode-js' );
		wp_enqueue_style( 'one-shortcode-css' );
	} else {
		wp_enqueue_script( 'one-shinybox-ios-fix' );
		wp_enqueue_script( 'one-shinybox' );
		wp_enqueue_style( 'one-shinybox' );
		wp_enqueue_script( 'one-shortcode-scripts' );
		wp_enqueue_style( 'one-shortcode-styles' );
	}
}

/* Loads shinybox on attachment pages */
global $wp_query;
if($wp_query->is_attachment()){
    if( (WP_DEBUG != true || WP_DEBUG != 'true' ) && (SCRIPT_DEBUG != true || SCRIPT_DEBUG != 'true' ) ) {
        wp_enqueue_script( 'one-shortcode-js' );
        wp_enqueue_style( 'one-shortcode-css' );
    } else {
        wp_enqueue_script( 'one-shinybox-ios-fix' );
        wp_enqueue_script( 'one-shinybox' );
        wp_enqueue_style( 'one-shinybox' );
        wp_enqueue_script( 'one-shortcode-scripts' );
        wp_enqueue_style( 'one-shortcode-styles' );
    }
}

/**
* Function to change type of gallery to alwayes open in shinybox
**/
function file_gallery_shortcode( $atts ) {
    $atts['link'] = 'file';
	$atts['size'] = 'medium';
    return gallery_shortcode( $atts );
}
add_shortcode( 'gallery', 'file_gallery_shortcode' );

/**
* Function to check if URL is image
**/
function one_is_url_image($filename) {
   $regex = '/\.(jpe?g|bmp|png|JPE?G|BMP|PNG)(?:[\?\#].*)?$/';
   return preg_match($regex, $filename);
}