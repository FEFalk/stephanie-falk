
    <?php
        $home_courses_switch        =   get_post_meta(get_the_ID(), 'home_courses_switch', true);
        $courses_section_title      =   get_post_meta(get_the_ID(), 'courses_section_title', true);
        $courses_section_content    =   get_post_meta(get_the_ID(), 'courses_section_content', true);
        $home_courses_posts_switch  =   get_post_meta(get_the_ID(), 'home_courses_posts_switch', true);
        $home_courses_ids           =   get_post_meta(get_the_ID(), 'home_courses_ids', true);
        $home_courses_btn_title     =   get_post_meta(get_the_ID(), 'home_courses_btn_title', true);
    ?>

    <?php if($home_courses_switch != 'off' && (strlen($courses_section_title) || strlen($courses_section_content) || !empty($home_courses_ids))): ?>
        <section class="section solid white-bg text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2>
                                <?php echo $courses_section_title; ?>
                                <?php onecom_edit_icon('page_meta', '#setting_home_courses', get_the_ID()); ?>

                            </h2>
                        </div>
                        <div class="section-content">
                            <?php echo $courses_section_content; ?>
                        </div>
                        <?php if($home_courses_posts_switch != 'off'): ?>

                            <div class="section-columns">

                                    <?php

                                    $args = array(
                                        'post_type' => array('lesson'),
                                        'post_status' => array('publish'),
                                        'posts_per_page' => '6',
                                    );

                                    $center_align = '';

                                    if(is_array($home_courses_ids) && !empty($home_courses_ids)){
                                        $args['post__in'] = $home_courses_ids;
                                        unset($args['posts_per_page']);
                                        $center_align = 'col-centered';
                                    }

                                    // The Query
                                    $lessons = new WP_Query($args);

                                    // The Loop
                                    if ($lessons->have_posts()) { ?>
                                        <div class="row <?php echo $center_align; ?>">
                                            <?php while ($lessons->have_posts()) {
                                                $lessons->the_post(); ?>
                                                <div class="col-md-4 cpt-col">
                                                    <div class="cta-block">
                                                        <?php if (has_post_thumbnail()) { ?>
                                                            <div class="cta-banner">
                                                                <?php the_post_thumbnail('lesson_thumb'); ?>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="cta-content">
                                                            <h3 class="cursive-font"><?php the_title(); ?></h3>
                                                            <?php $ids = get_the_ID(); ?>
                                                            <p><?php echo get_the_subtitle($ids); ?></p>
                                                            <?php if(strlen($home_courses_btn_title)): ?>
                                                                <a href="<?php the_permalink(); ?>" class="button inline border"><?php echo $home_courses_btn_title; ?></a>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php onecom_edit_icon('page_meta', '', get_the_ID()); ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } else{ /* no posts found */ }
                                    // Restore original Post Data
                                    wp_reset_postdata();
                                    ?>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </section>
    <?php endif; ?>