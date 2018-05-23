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
    <?php get_template_part('template-parts/home/section', 'courses'); ?>
    <!--- END White-Solid Section --->


    <!--- START Features Section --->
    <?php get_template_part('template-parts/home/section', 'features'); ?>
    <!--- END Features Section --->


    <!--- START BG Section --->
    <?php get_template_part('template-parts/home/section', 'appointment'); ?>
    <!--- END BG Section --->


    <!--- START Testimonial Section --->
    <?php get_template_part('template-parts/home/section', 'testimonials'); ?>
    <!--- END Testimonial Section --->


    <!--- START Newsletter Section --->
    <?php get_template_part('template-parts/home/section', 'newsletter'); ?>
    <!--- END Newsletter Section --->

<?php get_footer(); ?>