<?php
/* Single CPT Page */
?>

<?php get_header(); ?>

<?php if (have_posts()) the_post(); ?>

<!-- START Banner Container -->
<?php get_template_part('template-parts/internal', 'banner'); ?>
<!-- END Banner Container -->


<section class="page-content" role="main">

    <article id="lesson-<?php the_ID(); ?>" <?php post_class('cpt-single'); ?>>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- CPT Title -->
                    <header class="cpt-title">
                        <?php the_title('<h2>', '</h2>'); ?>
                        <?php the_subtitle(); ?>
                    </header>
                </div>
                <div class="clear"></div>
                <div class="col-md-8">

                    <!-- CPT Content -->
                    <div class="cpt-content">

                        <!-- CPT Featured Image -->
                        <?php if (has_post_thumbnail()) { ?>
                            <div class="cpt-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('lesson_big'); ?>
                                </a>
                            </div>
                        <?php } ?>

                        <!-- CPT Text -->
                        <div class="post-content">
                            <?php add_filter('the_content', 'wpautop') ?>
                            <?php the_content(); ?>
                        </div>

                    </div>
                </div>
                <!-- Sidebar --->
                <aside class="col-md-4 sidebar primary">
                    <!-- Sidebar Widgets -->
                    <?php dynamic_sidebar('content_sidebar'); ?>

                </aside>

            </div>
        </div>
    </article>
</section>


<?php get_footer(); ?>
