<?php
/* Template Name: Instructors */
?>
<?php get_header(); ?>

<?php if (have_posts()) the_post(); ?>

<?php get_template_part('template-parts/internal', 'banner'); ?>
    <!-- START Page Content -->
    <section class="page-content" role="main">
        <div class="container">
            <div class="row">

                <!-- Page content -->
                <div class="col-md-12">
                    <?php the_content(); ?>
                </div>
            </div>


            <?php
            /* Query Lessons */
            $args = array(
                'post_type' => array('instructor'),
                'post_status' => array('publish'),
                'nopaging' => false,
            );

            $instructors = new WP_Query($args);

            if ($instructors->have_posts()): ?>

            <div class="row">

                <?php while ($instructors->have_posts()) :
                    $instructors->the_post(); ?>

                    <!-- START Single CPT -->
                    <div class="col-md-6">
                        <article id="lesson-<?php the_ID(); ?>" <?php post_class('cpt-single-item'); ?>>

                            <header>
                                <?php the_title('<h2>', '</h2>'); ?>
                                <?php the_subtitle(); ?>
                            </header>

                            <!-- CPT Featured Image -->
                            <?php if (has_post_thumbnail()) { ?>
                                <div class=featured-image>
                                    <?php the_post_thumbnail('instructor', array('class' => 'featured-image')); ?>
                                </div>
                            <?php } ?>

                            <!-- CPT Content -->
                            <div class="post-content">
                                <?php add_filter('the_content', 'wpautop') ?>
                                <?php the_content(); ?>
                            </div>

                        </article>
                        <!-- END Single CPT -->

                    </div>
                <?php endwhile; ?>

                <!-- CPT Pagination -->
                <?php
                    the_posts_pagination(array(
                        'prev_text' => '<span class="dashicons dashicons-arrow-left-alt"></span><span class="screen-reader-text">' . sprintf('Previous page') . '</span>',

                        'next_text' => '<span class="dashicons dashicons-arrow-right-alt"></span><span class="screen-reader-text">' . sprintf('Next page') . '</span>',

                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . sprintf('Page') . ' </span>',
                    ));
                ?>

                <?php else: ?>
                    <?php get_template_part('template-parts/content', 'none'); ?>
                <?php endif; ?>

                <?php
                    /*Restore original Post Data*/
                    wp_reset_postdata();
                ?>

            </div>
        </div>
    </section>
    <!-- END Page Content -->


<?php get_footer(); ?>