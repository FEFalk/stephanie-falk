
    <?php
    $home_surfing_switch            =   get_post_meta(get_the_ID(), 'home_surfing_switch', true);
    $experience_section_bg          =   get_section_background_image('experience_section_bg');
    $experience_section_title       =   get_post_meta(get_the_ID(), 'experience_section_title', true);
    $experience_section_content     =   get_post_meta(get_the_ID(), 'experience_section_content', true);
    $apt_link                       =   get_post_meta(get_the_ID(), 'experience_section_btn_link', true);
    $experience_section_btn_title   =   get_post_meta(get_the_ID(), 'experience_section_btn_title', true);

    ?>

    <?php if($home_surfing_switch != 'off' && (strlen($experience_section_title) || strlen($experience_section_content))): ?>
        <section class="section background text-center text-dark" style="background-image: url(<?php echo $experience_section_bg; ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2><?php echo $experience_section_title; ?></h2>
                            <?php onecom_edit_icon('page_meta', '#setting_home_experience', get_the_ID()); ?>
                        </div>
                        <div class="section-content">
                            <?php echo nl2br($experience_section_content); ?>
                        </div>

                        <div class="section-button">
                            <?php
                                if('#' == $apt_link || '' == $apt_link){
                                    $apt_link = get_permalink( get_page_by_path( 'contact' ) );
                                }
                            ?>
                            <?php if(strlen($experience_section_btn_title)): ?>
                                <a href="<?php echo $apt_link; ?>" class="button"><?php echo $experience_section_btn_title; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>