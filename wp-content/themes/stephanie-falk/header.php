<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>"  />
    <!-- Mobile Specific Metas ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php wp_head(); ?>
    <?php include(TEMPLATEPATH . '/assets/css/header-css.php'); ?>

    <link rel='stylesheet' id='responsive-css'  href='<?php echo get_parent_theme_file_uri('assets/css/responsive.css').'?ver='.THM_VER; ?> 'type='text/css' media='all' />

    <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>
</head>

<body <?php body_class(); ?>>
<!-- START master wrapper -->
<div id="wrapper">
    <!-- START page wrapper -->
    <div id="page">
        <!-- START header container-->
        <header id="site-header" role="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <button class="menu-toggle mobile-only" aria-controls="sticky_menu" aria-expanded="false">Menu</button>
                        <?php if('off' != ot_get_option('logo_switch')): ?>
                            <div class="site-logo">
                                <h1 class="site-title">
                                    <a href="<?php echo home_url('/'); ?>" rel="home">
                                        <?php $logo = ot_get_option('logo_img');
                                            if(strlen($logo)){
                                                printf('<img src="%s" alt="%s" role="logo" />', $logo, get_bloginfo('name'));
                                            }
                                            else{
                                                echo break_page_title(get_bloginfo('title'));
                                            }
                                        ?>
                                    </a>
                                </h1>
                            </div>
                            <!-- END logo container -->
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8 desktop-only">
                        <!-- START nav container -->
                        <nav class="nav primary-nav" id="primary-nav" role="navigation">
                            <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'primary_yoga',
                                        'container' => '',
                                        'fallback_cb' => 'onecom_add_nav_menu',
                                    )
                                );
                            ?>
                        </nav>
                        <!-- END nav container -->
                    </div>
                </div>
            </div>
        </header>
        <!-- END nav container -->