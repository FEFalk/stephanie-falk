<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<?php if (have_posts()) the_post(); ?>

<?php get_template_part('template-parts/internal', 'banner'); ?>

    <!-- START Page Content -->
    <section class="page-content" role="main">

        <!-- START Single CPT -->
        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="container">
                <div class="row">
                    <!-- Featured Image -->
                    <?php if (has_post_thumbnail()) { ?>
                        <div class="col-md-5">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', array('class'=>'featured-image')); ?>
                            </a>
                        </div>
                    <?php } ?>

                    <!-- Content -->
                    <div class="<?php echo (has_post_thumbnail())?'col-md-7':'col-md-12'; ?>">
                        <header>
                            <?php the_title('<h1>', '</h1>'); ?>
                            <?php the_subtitle(); ?>
                        </header>

                        <div class="post-content">
                            <?php //add_filter('the_content', 'wpautop') ?>
                            <?php the_content(); ?>
                        </div>

                    </div>

                </div>
            </div>
        </article>
        <!-- END Single CPT -->
    </section>


    <!-- END Page Content -->

<?php get_footer(); ?>