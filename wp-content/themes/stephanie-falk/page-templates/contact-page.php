<?php
/* Template Name: Contact Us */
?>
<?php get_header(); ?>

<?php if (have_posts()) the_post(); ?>

<?php get_template_part('template-parts/internal', 'banner'); ?>

    <!-- START Page Content -->
    <section class="page-content" role="main">

        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="container">
                <div class="row">

                    <!-- Featured Image -->
                    <?php if (has_post_thumbnail()) { ?>
                        <div class="col-md-5 page-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', array('class' => 'featured-image')); ?>
                            </a>
                        </div>


                    <?php } ?>

                    <!-- Content -->
                    <div class="<?php echo (has_post_thumbnail())?' col-md-7': ' col-md-12'; ?>">

                        <div class="post-content">

                            <?php the_content(); ?>

                            <?php $contact_blocks = get_post_meta(get_the_ID(), 'contact_page_blocks', true); ?>

                            <?php if(!empty($contact_blocks)): ?>
                                <div class="row cpt-custom-fields contact_fields" role="contentinfo">
                                    <?php foreach ($contact_blocks as $block): ?>

                                        <div class="field-block col-md-6">
                                            <h5 class="cursive-font"><?php echo $block['title']; ?></h5>
                                            <?php echo wpautop(nl2br($block['block_content'])); ?>
                                        </div>
                                        <br class="clear" />

                                    <?php endforeach; ?>

                                </div>
                            <?php endif; ?>
                        </div>


                    </div>

                </div>
            </div>
        </article>
    </section>


    <!-- Background Section -->
    <?php if(get_post_meta(get_the_ID(), 'booking_sec_switch', true) != 'off'): ?>
        <section class="section background text-center"
                 style="background-image: url(<?php echo get_section_background_image('booking_section_bg'); ?>); ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2><?php echo get_post_meta(get_the_ID(), 'booking_section_title', true); ?></h2>
                        </div>

                        <?php
                          $booking_form_embed =   get_post_meta(get_the_ID(), 'booking_form_embed', true);
                          $custom_form_switch =   get_post_meta(get_the_ID(), 'custom_form_switch', true);
                        ?>

                        <?php if(strlen(trim($booking_form_embed)) && $custom_form_switch == 'on'){ ?>

                        <?php echo do_shortcode($booking_form_embed); ?>

                        <?php } else { ?>

                            <div class="form-container contact-form">
                                <form id="booking_form" class="form text-left" role="form">
                                    <fieldset>
                                        <?php
                                            $label_1 = get_post_meta(get_the_ID(), 'form_label_1', true);
                                            $label_1 = (isset($label_1) && strlen($label_1))? $label_1 : __("Email", "upsurge");
                                        ?>
                                        <label><?php echo $label_1; ?> *</label>
                                        <input type="email" class="input booking_email" maxlength="120" required />
                                        <input type="hidden" name="label_1" id="label_1" value="<?php echo $label_1; ?>" />
                                    </fieldset>
                                    <fieldset>
                                        <?php
                                            $label_2 = get_post_meta(get_the_ID(), 'form_label_2', true);
                                            $label_2 = (isset($label_2) && strlen($label_2))? $label_2 : __("Name", "upsurge");
                                        ?>
                                        <label><?php echo $label_2; ?> *</label>
                                        <input type="text" class="input booking_name"  maxlength="120" required />
                                        <input type="hidden" name="label_2" id="label_2" value="<?php echo $label_2; ?>" />
                                    </fieldset>
                                    <fieldset>
                                        <?php
                                            $label_3 = get_post_meta(get_the_ID(), 'form_label_3', true);
                                            $label_3 = (isset($label_3) && strlen($label_3))? $label_3 : __("Message", "upsurge");
                                        ?>
                                        <label><?php echo $label_3; ?> *</label>
                                        <textarea rows="10" cols="50" class="input booking_msg" name="message" required></textarea>
                                        <input type="hidden" name="label_3" id="label_3" value="<?php echo $label_3; ?>" />
                                    </fieldset>

                                    <?php
                                        /* Subject of the contact email */
                                        $subject = get_post_meta(get_the_ID(), 'cmail_subject', true);

                                        if(!isset($subject) && !strlen($subject)){
                                            /* Set default if not subject saved from admin */
                                            $subject = 'Booking Query From '.get_bloginfo('name');
                                        }

                                        $contact_recipient = get_post_meta(get_the_ID(), 'recipient_email', true);
                                        if(!isset($contact_recipient) && !strlen($contact_recipient)){
                                            /* Set default recipient to Admin Email */
                                            $contact_recipient = get_option('admin_email');
                                        }

                                    ?>
                                    <input type="hidden" name="contact_subject" id="contact_subject" value="<?php echo $subject; ?>" />
                                    <input type="hidden" name="contact_recipient" id="contact_recipient" value="<?php echo $contact_recipient; ?>" />

                                    <fieldset>
                                        <?php wp_nonce_field('booking_form', 'validate_nonce'); ?>
                                        <?php $label_4 = get_post_meta(get_the_ID(), 'form_label_4', true); ?>
                                        <input type="submit" class="submit button small pull-right" value="<?php echo ((isset($label_4) && strlen($label_4))? $label_4 : __('SEND MESSAGE', 'yoga')); ?>" name="booking-submit" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form_message"></div>
                                    </fieldset>
                                </form>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!--Map Section -->
    <?php if( get_post_meta(get_the_ID(), 'map_sec_switch', true) != 'off'): ?>
        <section class="section solid white text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2><?php echo get_post_meta(get_the_ID(), 'map_section_title', true); ?></h2>
                        </div>

                        <div class="section-content">
                            <?php echo wpautop(nl2br(get_post_meta(get_the_ID(), 'map_section_content', true))); ?>
                            <div class="map"><?php echo get_post_meta(get_the_ID(), 'map_section_code', true); ?></div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <!-- END Page Content -->

<?php get_footer(); ?>