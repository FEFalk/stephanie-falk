<?php
/* Post Category Page */
?>

<?php get_header(); ?>


<?php get_template_part('template-parts/internal', 'banner'); ?>

<!-- START Page Content -->
<section class="page-content" role="main">
    <?php if (have_posts()): ?>
        <div class="container">
            <div class="row">
                <div class="cpt-listing">

                    <?php while (have_posts()): the_post(); ?>
                        <!-- START Single CPT -->
                        <article id="post-<?php the_ID(); ?>" <?php post_class('cpt-single-item single-post'); ?>>

                            <!-- CPT Featured Image -->
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="cpt-thumb col-md-5">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('lesson_medium', array('class' => 'featured-image')); ?>
                                    </a>
                                </div>
                            <?php } ?>

                            <!-- CPT Content -->
                            <div class="cpt-content <?php echo((has_post_thumbnail()) ? ' col-md-7' : ' col-md-12 full-width'); ?>">

                                <!-- CPT Title -->
                                <header class="cpt-title">
                                    <?php the_title('<h2 class="post-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                                    <?php the_subtitle(); ?>
                                </header>

                                <!-- CPT Metadata -->
                                <?php get_template_part('template-parts/post', 'meta'); ?>

                                <!-- CPT Excerpt -->
                                <div class="cpt-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>


                                <!-- CPT Tags -->
                                <?php if (!empty(wp_get_post_tags(get_the_ID()))): ?>
                                    <div class="cpt-tags">
                                        <?php the_tags(''); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- CPT Link -->
                                <div class="row cpt-buttons">
                                    <div class="col-md-6">
                                        <a href="<?php the_permalink(); ?>" class="button border">Read More</a>
                                    </div>
                                </div>

                            </div>

                        </article>
                        <!-- END Single CPT -->
                    <?php endwhile; ?>


                    <!-- CPT Pagination -->
                    <?php
                    the_posts_pagination(array(
                        'prev_text' => '<span class="dashicons dashicons-arrow-left-alt"></span><span class="screen-reader-text">' . sprintf('Previous page') . '</span>',

                        'next_text' => '<span class="dashicons dashicons-arrow-right-alt"></span><span class="screen-reader-text">' . sprintf('Next page') . '</span>',

                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . sprintf('Page') . ' </span>',
                    ));
                    ?>


                </div>
            </div>
        </div>
    <?php endif; ?>
</section>



<?php get_footer(); ?>
