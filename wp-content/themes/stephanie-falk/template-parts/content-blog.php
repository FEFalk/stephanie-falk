        <?php $blog_layout = ot_get_option('blog_layout_radio'); ?>
        <div class="cpt-listing <?php echo ($blog_layout == 'right-sidebar' || $blog_layout == 'left-sidebar')? 'has-sidebar':''; ?>">


            <?php while (have_posts()): the_post(); ?>
                <!-- START Single CPT -->
                <article id="post-<?php the_ID(); ?>" <?php post_class('cpt-single-item single-post'); ?>>

                    <div class="row">
                        <?php if($blog_layout == 'full-width'): ?>
                            <!-- CPT Featured Image -->
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="cpt-thumb col-md-5">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('lesson_medium', array('class' => 'featured-image')); ?>
                                    </a>
                                </div>
                            <?php } ?>
                        <?php endif; ?>

                        <!-- CPT Content -->
                        <?php if($blog_layout == 'right-sidebar' || $blog_layout == 'left-sidebar'): ?>
                            <div class="cpt-content col-md-12 full-width">
                        <?php else: ?>
                            <div class="cpt-content <?php echo((has_post_thumbnail()) ? ' col-md-7' : ' reset-padding col-md-12 full-width'); ?>">
                        <?php endif; ?>


                            <?php if($blog_layout == 'right-sidebar' || $blog_layout == 'left-sidebar'): ?>
                                <!-- CPT Featured Image -->
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="cpt-thumb col-md-5">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('lesson_medium', array('class' => 'featured-image')); ?>
                                        </a>
                                    </div>
                                <?php } ?>
                            <?php endif; ?>


                            <!-- CPT Title -->
                            <header class="cpt-title">
                                <?php the_title('<h2 class="post-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                                <?php the_subtitle(); ?>
                            </header>

                            <!-- CPT Metadata -->
                            <?php if('off' != ot_get_option('show_post_meta')): ?>
                                <?php if(!is_page(get_the_ID())): ?>
                                    <?php get_template_part('template-parts/post', 'meta'); ?>
                                <?php endif; ?>
                            <?php endif; ?>

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
                                    <?php $read_btn_title = get_post_meta(get_option('page_for_posts'), 'blg_btn_title', true); ?>
                                    <?php if(strlen($read_btn_title)): ?>
                                        <a href="<?php the_permalink(); ?>" class="button border"><?php echo $read_btn_title; ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </article>
                <!-- END Single CPT -->
            <?php endwhile; ?>


            <!-- CPT Pagination -->
            <div class="row">
                <div class="col-md-12">
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