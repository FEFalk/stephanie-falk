<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Yoga
 * @since 1.0
 * @version 1.0
 */

get_header();

?>
<?php get_template_part('template-parts/internal', 'banner'); ?>
<!-- Blog Layout -->
<?php $blog_layout = ot_get_option('blog_layout_radio'); ?>
    <!-- START Page Content -->
    <section class="page-content" role="main">
        <?php if (have_posts()): ?>
            <div class="container">
                <div class="row">

                    <div class="col-md-12 <?php echo ($blog_layout == 'left-sidebar')?'offset-md-4':''; ?>">
                        <!-- CPT Pagination -->
                        <?php
                            the_posts_pagination(array(
                                'prev_text' => '<span class="dashicons dashicons-arrow-left-alt"></span><span class="screen-reader-text">' . sprintf('Previous page') . '</span>',

                                'next_text' => '<span class="dashicons dashicons-arrow-right-alt"></span><span class="screen-reader-text">' . sprintf('Next page') . '</span>',

                                'before_page_number' => '<span class="meta-nav screen-reader-text">' . sprintf('Page') . ' </span>',
                            ));
                        ?>
                    </div>


                    <?php if($blog_layout == 'right-sidebar' || $blog_layout == 'left-sidebar'): ?>

                        <?php if($blog_layout == 'left-sidebar'): ?>

                            <!-- Left Sidebar -->
                            <aside class="col-md-4 sidebar blog_sidebar left_sidebar">
                                <?php dynamic_sidebar('blog_sidebar'); ?>
                            </aside>

                        <?php endif; ?>

                        <div class="col-md-8 col-sm-12">
                        <?php else: ?>
                        <div class="col-md-12">

                    <?php endif; ?>

                    <!-- Blog Content -->
                    <?php get_template_part('template-parts/content', 'blog'); ?>

                    <?php if($blog_layout == 'right-sidebar' || $blog_layout == 'left-sidebar'): ?>

                        </div>

                        <?php if($blog_layout == 'right-sidebar'): ?>

                            <!-- Right Sidebar -->
                            <aside class="col-md-4 sidebar blog_sidebar">
                                <?php dynamic_sidebar('blog_sidebar'); ?>
                            </aside>

                        <?php endif; ?>

                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <?php get_template_part('template-parts/content', 'none'); ?>
        <?php endif; ?>
    </section>

<?php get_footer(); ?>