<?php
    $home_newsletter_switch         =   get_post_meta(get_the_ID(), 'home_newsletter_switch', true);
    $newsletter_section_title       =   get_post_meta(get_the_ID(), 'newsletter_section_title', true);
    $newsletter_section_content     =   get_post_meta(get_the_ID(), 'newsletter_section_content', true);
    $newsletter_form_switch         =   get_post_meta(get_the_ID(), 'newsletter_form_switch', true);
    $newsletter_embed_code          =   get_post_meta(get_the_ID(), 'newsletter_embed_code', true);
    $newsletter_btn_title           =   get_post_meta(get_the_ID(), 'newsletter_btn_title', true);

    $page = get_page_by_path('contact');

    ?>

<?php if ($home_newsletter_switch != 'off' && (strlen($newsletter_section_title) || strlen($newsletter_section_content))): ?>
<section class="page-content" id="contact-section" role="main">
    <div class="container">
        <div class="row">

            <!-- Featured Image -->
            <?php if (has_post_thumbnail()) {
        ?>
            <div class="col-md-5 page-thumb">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium', array('class' => 'featured-image')); ?>
                </a>
            </div>


            <?php
    } ?>

            <!-- Content -->
            <div class="<?php echo (has_post_thumbnail())?' col-md-7': ' col-md-12'; ?>">

                <div class="post-content">
                    <?php $contact_blocks = get_post_meta($page->ID, 'contact_page_blocks', true); ?>

                    <?php if (!empty($contact_blocks)): ?>
                    <div class="row cpt-custom-fields contact_fields" role="contentinfo">
                        <div class="field-block col-md-6">
                            <?php   echo wpautop($page->post_content); ?>
                            <div class="contact-items">
                            <?php foreach ($contact_blocks as $key => $block): ?>
                            <?php
                            if ($block['title'] == "Adress") {
        ?>
                            <div class="col-md-12 no-padding margin-vbottom-10 contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                                <a href="https://goo.gl/maps/oHA3UPn3QF6ZENsS8">
                                    <?php echo strip_tags($block['block_content']); ?>
                                </a>
                            </div>
                            <?php
    } elseif ($block['title'] == "Email") {
        ?>
                            <div class="col-md-12 no-padding margin-vbottom-10 contact-item">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:<?php echo strip_tags($block['block_content']); ?>">
                                    <?php echo strip_tags($block['block_content']); ?>
                                </a>
                            </div>
                            <?php
    } elseif ($block['title'] == "Phone") {
        ?>
                            <div class="col-md-12 no-padding contact-item">
                                <i class="fas fa-phone"></i>
                                <a href="tel:<?php echo strip_tags($block['block_content']); ?>">
                                    <?php echo strip_tags($block['block_content']); ?>
                                </a>
                            </div>
                            <?php
    } ?>

                            <?php endforeach; ?>
                            </div>
                        </div>
                        <?php if (get_post_meta(get_the_ID(), 'booking_sec_switch', true) != 'off'): ?>
                        <section class="section background col-md-6" id="contact-form" style="background-image: url(<?php echo get_section_background_image('booking_section_bg'); ?>); ">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="section-title">
                                            <h2>
                                                <?php echo get_post_meta($page->ID, 'booking_section_title', true); ?>
                                            </h2>
                                        </div>

                                        <?php
                          $booking_form_embed =   get_post_meta($page->ID, 'booking_form_embed', true);
                          $custom_form_switch =   get_post_meta($page->ID, 'custom_form_switch', true);
                        ?>

                                        <?php if (strlen(trim($booking_form_embed)) && $custom_form_switch == 'on') {
                            ?>

                                        <?php echo do_shortcode($booking_form_embed); ?>

                                        <?php
                        } else {
                            ?>

                                        <div class="form-container contact-form">
                                            <form id="booking_form" class="form text-left" role="form">
                                                <fieldset>
                                                    <?php
                                            $label_1 = get_post_meta($page->ID, 'form_label_1', true);
                            $label_1 = (isset($label_1) && strlen($label_1))? $label_1 : __("Email", "upsurge"); ?>
                                                    <label>
                                                        <?php echo $label_1; ?>*</label>
                                                    <input type="email" class="input booking_email" maxlength="120" required />
                                                    <input type="hidden" name="label_1" id="label_1" value="<?php echo $label_1; ?>"
                                                    />
                                                </fieldset>
                                                <fieldset>
                                                    <?php
                                            $label_2 = get_post_meta($page->ID, 'form_label_2', true);
                            $label_2 = (isset($label_2) && strlen($label_2))? $label_2 : __("Name", "upsurge"); ?>
                                                    <label>
                                                        <?php echo $label_2; ?>*</label>
                                                    <input type="text" class="input booking_name" maxlength="120" required />
                                                    <input type="hidden" name="label_2" id="label_2" value="<?php echo $label_2; ?>"
                                                    />
                                                </fieldset>
                                                <fieldset>
                                                    <?php
                                            $label_3 = get_post_meta($page->ID, 'form_label_3', true);
                            $label_3 = (isset($label_3) && strlen($label_3))? $label_3 : __("Message", "upsurge"); ?>
                                                    <label>
                                                        <?php echo $label_3; ?>*</label>
                                                    <textarea rows="10" cols="50" class="input booking_msg" name="message" required></textarea>
                                                    <input type="hidden" name="label_3" id="label_3" value="<?php echo $label_3; ?>"
                                                    />
                                                </fieldset>

                                                <?php
                                        /* Subject of the contact email */
                                        $subject = get_post_meta($page->ID, 'cmail_subject', true);

                            if (!isset($subject) && !strlen($subject)) {
                                /* Set default if not subject saved from admin */
                                $subject = 'Booking Query From '.get_bloginfo('name');
                            }

                            $contact_recipient = get_post_meta($page->ID, 'recipient_email', true);
                            if (!isset($contact_recipient) && !strlen($contact_recipient)) {
                                /* Set default recipient to Admin Email */
                                $contact_recipient = get_option('admin_email');
                            } ?>
                                                <input type="hidden" name="contact_subject" id="contact_subject" value="<?php echo $subject; ?>"
                                                />
                                                <input type="hidden" name="contact_recipient" id="contact_recipient" value="<?php echo $contact_recipient; ?>"
                                                />

                                                <fieldset>
                                                    <?php wp_nonce_field('booking_form', 'validate_nonce'); ?>
                                                    <?php $label_4 = get_post_meta($page->ID, 'form_label_4', true); ?>
                                                    <input type="submit" class="submit button small pull-right" value="<?php echo((isset($label_4) && strlen($label_4))? $label_4 : __('SEND MESSAGE', 'yoga')); ?>"
                                                        name="booking-submit" />
                                                </fieldset>
                                                <fieldset>
                                                    <div class="form_message"></div>
                                                </fieldset>
                                            </form>
                                        </div>

                                        <?php
                        } ?>

                                    </div>
                                </div>
                            </div>
                        </section>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>


            </div>

        </div>
    </div> 
</section>

    <?php endif; ?>
    <div class="col-md-12 no-padding" id="map-section">
        <div class="section-title text-center col-md-12">
            <h2>
                <?php echo get_post_meta($page->ID, 'map_section_title', true); ?>
            </h2>
        </div>
        <div class="map">
        <iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2034.9065670246296!2d18.08080751647364!3d59.334513717648406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x465f9d5a9e39582f%3A0x111d000991e5a7e6!2zRsOlZsOkbmcgU3RobG0!5e0!3m2!1sen!2sse!4v1569018864847!5m2!1sen!2sse" 
            width="100%" height="720" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
        </div>
    </div>