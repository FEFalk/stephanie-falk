
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
                    </div>

                </div>
            </div>
        </section>
    <?php endif; ?>