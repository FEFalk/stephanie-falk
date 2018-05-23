
    <?php $blog_layout = ot_get_option('single_layout_radio'); ?>
        <article id="lesson-<?php the_ID(); ?>" <?php post_class('cpt-single single-post'); ?> role="article">
            <!-- CPT Content -->
            <div class="cpt-content <?php echo ($blog_layout == 'full-width')?'full-width':''; ?>">

                <!-- CPT Title -->
                <header class="cpt-title">
                    <?php the_title('<h1>', '</h1>'); ?>
                    <?php the_subtitle(); ?>
                </header>

                <?php if('off' != ot_get_option('show_post_meta')): ?>
                    <!-- CPT Metadata -->
                    <?php get_template_part('template-parts/post', 'meta'); ?>
                <?php endif; ?>

                <!-- CPT Featured Image -->
                <?php if (has_post_thumbnail()) { ?>
                    <div class="cpt-thumb" role="img">
                        <?php if($blog_layout == 'full-width'): ?>
                            <?php the_post_thumbnail('full'); ?>
                        <?php else: ?>
                            <?php the_post_thumbnail('lesson_big'); ?>
                        <?php endif; ?>
                    </div>
                <?php } ?>

                <!-- CPT Text -->
                <div class="post-content" role="main">
                    <?php add_filter('the_content', 'wpautop') ?>
                    <?php the_content(); ?>
                </div>


                <!-- CPT Tags -->
                <?php if (!empty(wp_get_post_tags(get_the_ID()))): ?>
                    <footer role="contentinfo">
                        <div class="cpt-tags">
                            <?php the_tags(''); ?>
                        </div>
                    </footer>
                <?php endif; ?>

            </div>
        </article>
        <?php if (comments_open()) : ?>
            <!-- CTP Comments -->
            <div class="post-comments <?php echo get_comments_number() ? 'border' : ''; ?>">
                <?php comments_template(); ?>
            </div>
        <?php endif; ?>