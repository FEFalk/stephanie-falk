<?php
$theme = wp_get_theme();
if(!defined('THM_NAME')) define('THM_NAME', $theme->get('Name'));
if(!defined('THM_VER'))  define('THM_VER', $theme->get('Version'));
if(!defined('THM_DIR_PATH')) define('THM_DIR_PATH', get_parent_theme_file_path());
if(!defined('THM_DIR_URI')) define('THM_DIR_URI', get_parent_theme_file_uri());

/** 
* Include API hook file
**/
include_once trailingslashit( get_template_directory() ).'inc/api-hooks.php';

/* Required files */
require( trailingslashit( THM_DIR_PATH ) . 'option-tree/ot-loader.php' );
require( trailingslashit( THM_DIR_PATH ) . 'inc/theme_metaboxes.php' );
require( trailingslashit( THM_DIR_PATH ) . 'inc/theme_options.php' );
require_once ( THM_DIR_PATH.'/inc/core_functions.php' );
require_once ( THM_DIR_PATH.'/inc/widgets.php' );
require_once ( THM_DIR_PATH.'/one-shortcodes/shortcode.php' );
require_once get_parent_theme_file_path( '/inc/social_icons_svg.php' );
require get_parent_theme_file_path( '/inc/customizer.php' );


/* Theme's default frontpage */
function onecom_theme_default_frontpage( $template ){
    return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'onecom_theme_default_frontpage' );

/* TODO Move default settings inside theme-setup function */
/* Theme Setup */
function onecom_theme_setup() {

	load_theme_textdomain( 'yoga', get_template_directory() . '/languages' );

	if (function_exists('add_theme_support')) {
		add_theme_support('menus');
	}
	
	add_theme_support('post-thumbnails');
	add_image_size('lesson_big', 780, 540, true);
	add_image_size('lesson_medium', 480, 520, true);
	add_image_size('lesson_thumb', 370, 250, true);
	add_image_size('instructor', 570, 400, true);
	if(500 != get_option('medium_size_w')) update_option( 'medium_size_w', 500 );
	if(640 != get_option('medium_size_h')) update_option( 'medium_size_h', 640 );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

    remove_theme_support( 'custom-logo');

    add_theme_support( 'customize-selective-refresh-widgets' );

    /* HTML5 Captions are compatible with shinybox. */
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

}
add_action( 'after_setup_theme', 'onecom_theme_setup' );

function remove_extra_image_sizes(){
    delete_option( 'thumbnail_size_h');
    delete_option( 'thumbnail_size_w');
    delete_option( 'large_size_h');
    delete_option( 'large_size_w');
    delete_option( 'medium_large_size_w');
    delete_option( 'medium_large_size_h');
}
add_action( 'init', 'remove_extra_image_sizes' );



add_action( 'wp_enqueue_scripts', 'onecom_theme_assets' );
function onecom_theme_assets(){
	wp_enqueue_script('jquery');

	$resource_extension = ( SCRIPT_DEBUG || SCRIPT_DEBUG == 'true') ? '' : '.min'; // Adding .min extension if SCRIPT_DEBUG is enabled
	$resource_min_dir = ( SCRIPT_DEBUG || SCRIPT_DEBUG == 'true') ? '' : 'min-'; // Adding min- as a minified directory of resources if SCRIPT_DEBUG is enabled

    wp_register_style( 'normalize-css', THM_DIR_URI . '/assets/'.$resource_min_dir.'css/normalize'.$resource_extension.'.css', '', THM_VER);
    wp_register_style( 'bootstrap-reboot', THM_DIR_URI . '/assets/'.$resource_min_dir.'css/bootstrap-reboot'.$resource_extension.'.css', '', THM_VER);
    wp_register_style( 'bootstrap-grid', THM_DIR_URI . '/assets/'.$resource_min_dir.'css/bootstrap-grid'.$resource_extension.'.css', '', THM_VER);
    wp_register_style( 'base-css', THM_DIR_URI . '/assets/'.$resource_min_dir.'css/base'.$resource_extension.'.css', '', THM_VER);
    wp_register_style( 'theme-css', THM_DIR_URI . '/assets/'.$resource_min_dir.'css/theme'.$resource_extension.'.css', '', THM_VER);
    wp_register_style( 'theme-stylesheet', get_stylesheet_uri() );

    wp_register_style( 'style-yoga-all', THM_DIR_URI . '/assets/min-css/style.min.css', '', THM_VER);


    wp_register_style( 'responsive-css', THM_DIR_URI . '/assets/'.$resource_min_dir.'css/responsive'.$resource_extension.'.css', '', THM_VER);

    /* Fallback : If Option Tree failed to Enqueue the theme's default font families */
    if(!wp_style_is( 'ot-google-fonts' )){
        wp_register_style( 'arimo-google-font', '//fonts.googleapis.com/css?family=Arimo:400,400i,700,700i|Oregano:400,400i&amp;subset=latin-ext',false );
        wp_enqueue_style( 'arimo-google-font' );
    }

    wp_register_script('custom-js', THM_DIR_URI . '/assets/'.$resource_min_dir.'js/z-custom'.$resource_extension.'.js', array( 'jquery'), THM_VER, true );
    wp_register_script('instagram-js', THM_DIR_URI . '/assets/'.$resource_min_dir.'js/instagram'.$resource_extension.'.js', array( 'jquery'), THM_VER, true );
	wp_register_script( 'script-yoga-all', THM_DIR_URI . '/assets/min-js/script.min.js', array('jquery'), THM_VER, true );


	if( (WP_DEBUG != true || WP_DEBUG != 'true' ) && (SCRIPT_DEBUG != true || SCRIPT_DEBUG != 'true' ) ) {

		wp_enqueue_style('style-yoga-all');
		wp_enqueue_script('script-yoga-all');
		
		/* Localization */
		wp_localize_script( 'script-yoga-all', 'one_ajax',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'msg' => __('Please wait...', 'yoga'),
                'subscribe_btn' => __('Subscribe', 'yoga'),
                'send' => __('SEND MESSAGE', 'yoga'),
            )
        );

	} else {
		wp_enqueue_style( 'normalize-css');
		wp_enqueue_style( 'bootstrap-reboot');
		wp_enqueue_style( 'bootstrap-grid');
		wp_enqueue_style( 'base-css' );
		wp_enqueue_style( 'theme-css' );
		wp_enqueue_style( 'theme-stylesheet' );
		/*wp_enqueue_style( 'responsive-css' );*/

		wp_enqueue_script('custom-js');
		/* Localization */
		wp_localize_script( 'custom-js', 'one_ajax',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'msg' => __('Please wait...', 'yoga'),
                'subscribe_btn' => __('Subscribe', 'yoga'),
                'send' => __('SEND MESSAGE', 'yoga'),
            )
        );
	}
	wp_enqueue_style('dashicons');
}

/* Register navigation menus */
function register_my_menus() {
	register_nav_menus(
		array(
            'primary_yoga' => 'Primary',
            'mobile_yoga' => 'Mobile Menu',
        )
	);
}
add_action( 'init', 'register_my_menus' );

/* Add custom classes to body */
add_filter( 'body_class', 'body_custom_classes' );
function body_custom_classes( $classes ) {
    if ( is_single() && 'post' === get_post_type() ) {
        $classes[] = 'no-banner';
    }
    return $classes;
}


/* show attachment data */
function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}

/* Remove Auto Paragraph from content and excerpts */
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

/* Modified wp_get_attachment_link to have the caption compatible with shinybox. */
function caption_for_shinybox( $markup, $id, $size, $permalink, $icon, $text ){
    $_post = get_post( $id );
    if ( $permalink ) {
        $url = get_attachment_link( $_post->ID );
    }

    if ( empty( $_post ) || ( 'attachment' !== $_post->post_type ) || ! $url = wp_get_attachment_url( $_post->ID ) ) {
        return 'Missing Attachment';
    }

    $link_text = wp_get_attachment_image( $id, $size, $icon );
    if ( trim( $link_text ) == '' ){ $link_text = $_post->post_title; }

    $link_title = get_post($id)->post_excerpt;
    if ( trim( $link_title ) == '' ){ $link_title = $text; }

    return '<a href="'.$url.'" title="'.$link_title.'">'.$link_text.'</a>';
}
add_filter( 'wp_get_attachment_link', 'caption_for_shinybox', 10, 6 );


/* Remove BR tags from gallery */
add_filter('use_default_gallery_style', '__return_false');
add_filter( 'the_content', 'remove_br_gallery', 11, 2);
function remove_br_gallery($output) {
    return preg_replace('/\<br[^\>]*\>/','',$output);
}

/* Register Sidebars */
function onecom_widgets_init() {

    /* TODO: Prevent this sidebar from having default widgets. */
    /* Use starter_content for this sidebar. */
    register_sidebar(array(
        'name' => 'Content Sidebar',
        'id' => 'content_sidebar',
        'description' => 'This widget area shows the widgets on single CPT details page.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title"><h4>',
        'after_title' => '</h4></div>',
    ));
    register_sidebar(array(
        'name' => 'Blog Sidebar',
        'id' => 'blog_sidebar',
        'description' => 'This area for home page first sidebar that is top right after nvigation',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title"><h4>',
        'after_title' => '</h4></div>',
    ));
    register_sidebar(array(
        'name' => 'Footer',
        'id' => 'footer',
        'description' => 'This widget area shows the widgets in Footer columns',
        'before_widget' => '<div class="col-lg-4 col-md-6 flex-column"><div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<div class="widget-title"><h4>',
        'after_title' => '</h4></div>',
    ));
    register_sidebar(array(
        'name' => 'Tag Cloud',
        'id' => 'tag_cloud',
        'description' => 'This widget area shows the widgets in Tag Cloud-area',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));
}
add_action( 'widgets_init', 'onecom_widgets_init' );

/* Custom scripts coming from Theme Options */
if(!defined('onecom_head_scripts')){
    function onecom_head_scripts(){
        /* Head Scripts */
        $head_scripts = ot_get_option('head_scripts');
        if(strlen($head_scripts)){
            echo $head_scripts;
        }
        return;
    }
    add_action('wp_head', 'onecom_head_scripts', 30);
}
/* Custom scripts coming from Theme Options */
if(!defined('onecom_footer_scripts')){
    function onecom_footer_scripts(){
        /* Footer Scripts */
        $footer_scripts = ot_get_option('footer_scripts');
        if(strlen($footer_scripts)){
            echo $footer_scripts;
        }
        return;
    }
    add_action('wp_footer', 'onecom_footer_scripts', 30);
}




/* ONECOM Update Script */
add_filter('http_request_reject_unsafe_urls','__return_false');
add_filter( 'http_request_host_is_external', '__return_true' );

if( ! class_exists( 'ONECOM_UPDATER' ) ) {
    require_once THM_DIR_PATH.'/inc/update.php';
}

/* Include the One Click Importer */
if(!class_exists('OCDI_Plugin')){
	require_once ( THM_DIR_PATH .'/importer/importer.php' );
}

/* Pass the importable files to the Importer. */
if(!function_exists('ocdi_import_files')){
    function ocdi_import_files(){
        return array(
            array(
                'import_file_name'             => 'Theme demo data',
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'importer/content.xml',
                'import_widget_file_url'       => trailingslashit( get_template_directory_uri() ) . 'importer/widgets.json',
            ),
        );
    }
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );

if( ! function_exists( 'ocdi_after_import_setup' ) ){
	function ocdi_after_import_setup() {
		/* Assign menus to their locations. */
		$main_menu = get_term_by( 'name', 'Primary - Yoga', 'nav_menu' );
		$mobile_menu = get_term_by( 'name', 'Primary - Yoga', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary_yoga' => $main_menu->term_id,
				'mobile_yoga' => $mobile_menu->term_id,
			)
		);

        /* Assign front page and posts page (blog page). */
        $front_page_id = get_page_by_title('Home');

        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);

        $blog_page_id = get_page_by_title('Blog');
        update_option('page_for_posts', $blog_page_id->ID);

    }
}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );

/**
 * Include API hook file
 **/
include_once trailingslashit( get_template_directory() ).'inc/api-hooks.php';


// function my_scripts_method() {
//     wp_register_script(
//         'instagram',
//         get_template_directory_uri() . '/assets/js/instagram.js',
//         array('jquery')     );
//     wp_enqueue_script('instagram');
//     wp_localize_script( 'instagram', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) ); 

// }
// add_action('wp_enqueue_scripts', 'my_scripts_method');


function update_instagram_posts(){
    $tags = json_decode(stripslashes($_POST['tags']));

    //TODO: PARRSE TAGS TO ARRAY AND FILTER BY IT

    //$tagsArray = implode(',', $tags);

    $query = '';

    // foreach($tags as $tag){
    //     echo print_r($tag);

    // }

    



    $paramsArray = ['operator' => 'AND'];
    foreach($tags as $key => $value)
    {
        array_push($paramsArray, array(  
            'taxonomy'  => 'hashtag',
            'field'     => 'slug',
            'terms'     => $value
        ));
    }
    //echo print_r($paramsArray);
    //echo $query;

    $param = array(
        'limit'     =>  15,
        'orderby'   =>  'date DESC',
        'tax_query'      => $paramsArray,
        'post_type' => 'instagram-post',
        'posts_per_page' => 15
    );
    $the_query = new WP_Query( $param );

    //$instagram_posts = pods('instagram-post', $param);

    //echo print_r($instagram_posts);
    
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            echo get_the_content();
        }
    }

    // if (0 < $instagram_posts->total()) {
    //     while ($instagram_posts->fetch()) {
    //         echo $instagram_posts->field('post_content');
    //     }
    // }
    //return 'test';
    wp_die();
}
add_action('wp_ajax_update_instagram', 'update_instagram_posts');
add_action('wp_ajax_nopriv_update_instagram', 'update_instagram_posts');

function loadmore_instagram_posts(){
    $tags = json_decode(stripslashes($_POST['tags']));
    $page = stripslashes($_POST['page']);

    echo $page;

    //TODO: PARRSE TAGS TO ARRAY AND FILTER BY IT

    //$tagsArray = implode(',', $tags);

    $query = '';

    // foreach($tags as $tag){
    //     echo print_r($tag);

    // }

    



    $paramsArray = ['operator' => 'AND'];
    foreach($tags as $key => $value)
    {
        array_push($paramsArray, array(  
            'taxonomy'  => 'hashtag',
            'field'     => 'slug',
            'terms'     => $value
        ));
    }
    //echo print_r($paramsArray);
    //echo $query;

    $param = array(
        'limit'     =>  15,
        'orderby'   =>  'date DESC',
        'tax_query'      => $paramsArray,
        'post_type' => 'instagram-post',
        'page' => $page,
        'offset' => $page * 15,
        'posts_per_page' => 15
    );
    $the_query = new WP_Query( $param );

    //$instagram_posts = pods('instagram-post', $param);

    //echo print_r($instagram_posts);
    
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            echo get_the_content();
        }
    }

    // if (0 < $instagram_posts->total()) {
    //     while ($instagram_posts->fetch()) {
    //         echo $instagram_posts->field('post_content');
    //     }
    // }
    //return 'test';
    wp_die();
}
add_action('wp_ajax_loadmore_instagram', 'loadmore_instagram_posts');
add_action('wp_ajax_nopriv_loadmore_instagram', 'loadmore_instagram_posts');