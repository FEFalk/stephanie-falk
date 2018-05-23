<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>

<?php get_header(); ?>
<!-- Blog Layout -->
<?php $blog_layout = ot_get_option('single_layout_radio'); ?>

<?php if (have_posts()) the_post(); ?>

    <section class="page-content" role="main">

        <div class="container">
            <div class="row">

                <?php if($blog_layout == 'right-sidebar' || $blog_layout == 'left-sidebar'): ?>

                    <?php if($blog_layout == 'left-sidebar'): ?>

                        <!-- Left Sidebar -->
                        <aside class="col-md-4 sidebar blog_sidebar left_sidebar" role="complementary">
                            <?php dynamic_sidebar('blog_sidebar'); ?>
                        </aside>

                    <?php endif; ?>

                    <div class="col-md-8">
                    <?php else: ?>
                    <div class="col-md-12">

                <?php endif; ?>

                    <!-- Post Content -->
                    <?php get_template_part('template-parts/content', 'single'); ?>




                    </div>

                <?php if($blog_layout == 'right-sidebar'): ?>

                    <!-- Right Sidebar -->
                    <aside class="col-md-4 sidebar blog_sidebar" role="complementary">
                        <?php dynamic_sidebar('blog_sidebar'); ?>
                    </aside>

                <?php endif; ?>

            </div>
        </div>

    </section>

<?php get_footer(); ?>