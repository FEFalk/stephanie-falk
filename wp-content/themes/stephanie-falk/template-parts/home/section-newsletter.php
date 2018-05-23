
    <?php
    $home_newsletter_switch         =   get_post_meta(get_the_ID(), 'home_newsletter_switch', true);
    $newsletter_section_title       =   get_post_meta(get_the_ID(), 'newsletter_section_title', true);
    $newsletter_section_content     =   get_post_meta(get_the_ID(), 'newsletter_section_content', true);
    $newsletter_form_switch         =   get_post_meta(get_the_ID(), 'newsletter_form_switch', true);
    $newsletter_embed_code          =   get_post_meta(get_the_ID(), 'newsletter_embed_code', true);
    $newsletter_btn_title           =   get_post_meta(get_the_ID(), 'newsletter_btn_title', true);
    ?>

    <?php if($home_newsletter_switch != 'off' && (strlen($newsletter_section_title) || strlen($newsletter_section_content))): ?>
        <section class="section solid white text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2><?php echo $newsletter_section_title; ?></h2>
                            <?php onecom_edit_icon('page_meta', '#setting_home_newsletter', get_the_ID()); ?>
                        </div>
                        <div class="section-content">
                            <?php echo wpautop($newsletter_section_content); ?>
                        </div>
                        <?php if($newsletter_form_switch != 'off'): ?>

                            <div class="form-container newsletter-form">
                                <?php if(strlen(trim($newsletter_embed_code))){ ?>
                                    <?php echo do_shortcode($newsletter_embed_code); ?>
                                <?php } else{ ?>
                                    <form id="subscribe_form" class="form text-center">
                                        <fieldset>
                                            <input type="email" name="email" class="input sub_email" placeholder="<?php echo __('Please enter your email.', 'yoga'); ?>" required />
                                        </fieldset>
                                        <fieldset>
                                            <?php wp_nonce_field('subscribe_form', 'validate_nonce'); ?>
                                            <?php if(strlen($newsletter_btn_title)): ?>
                                                <input type="submit" class="submit button small dark pull-right" value="<?php echo $newsletter_btn_title; ?>" name="newsletter-submit"/>
                                            <?php endif; ?>
                                        </fieldset>
                                        <div class="form_message"></div>
                                    </form>
                                <?php } ?>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>