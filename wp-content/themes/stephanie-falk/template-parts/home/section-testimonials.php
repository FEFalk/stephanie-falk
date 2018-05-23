
    <?php
    $home_testimonial_switch    =   get_post_meta(get_the_ID(), 'home_testimonial_switch', true);
    $testimonial_bg             =   get_section_background_image('testimonial_bg');
    $testimonial_section_title  =   get_post_meta(get_the_ID(), 'testimonial_section_title', true);
    $testimonials               =   get_post_meta(get_the_ID(), 'testimonial_list_item', true);
    ?>

    <?php if ($home_testimonial_switch != 'off' && (strlen($testimonial_section_title) || !empty($testimonials))): ?>
        <section class="section background text-white text-center"
                 style="background-image: url(<?php echo $testimonial_bg; ?>)">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="testimonials">
                            <span class="icon"></span>
                            <div class="section-title">
                                <?php if(strlen($testimonial_section_title)): ?>
                                    <h2><?php echo $testimonial_section_title; ?></h2>
                                <?php endif; ?>
                                <?php onecom_edit_icon('page_meta', '#setting_home_testimonial', get_the_ID()); ?>
                            </div>
                            <?php
                            if (!empty($testimonials)): ?>

                                <div class="testimonials-row">
                                    <?php foreach ($testimonials as $testimonial): ?>
                                        <div class="testimonial">
                                            <blockquote><?php echo nl2br($testimonial['testimonial_content']); ?></blockquote>
                                            <cite class="cursive-font"><?php echo $testimonial['title']; ?></cite>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>