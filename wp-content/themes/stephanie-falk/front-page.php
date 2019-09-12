<?php
/**
 * @package WordPress
 * @subpackage Yoga
 */
?>
<?php get_header(); ?>

    <!-- START banner container -->
    <?php get_template_part('template-parts/home/home', 'banner'); ?>
    <!-- END banner container -->

    <!-- START banner container -->
    <?php get_template_part('template-parts/home/home', 'content'); ?>
    <!-- END banner container -->


    <!--- START White-Solid Section --->
    <?php get_template_part('template-parts/home/section', 'about'); ?>
    <!--- END White-Solid Section --->


    <!--- START Instagram Section --->
    <?php get_template_part('template-parts/home/section', 'instagram'); ?>
    <!--- END Instagram Section --->

    <!--- START Treatments Section --->
        <?php get_template_part('template-parts/home/section', 'treatments'); ?>
    <!--- END Treatments Section --->


    <!--- START BG Section --->
    <?php //get_template_part('template-parts/home/section', 'gallery'); ?>
    <!--- END BG Section --->


    <!--- START Testimonial Section --->
    <?php //get_template_part('template-parts/home/section', 'testimonials'); ?>
    <!--- END Testimonial Section --->


    <!--- START Newsletter Section --->
    <?php get_template_part('template-parts/home/section', 'contact'); ?>
    <!--- END Newsletter Section --->

<?php get_footer(); ?>