
        <!-- START banner container -->
        <?php
            $banner_post_id = get_the_ID();
            /*var_dump(get_the_ID());*/

            /* Category Page Banner */
            if (is_home() || is_category() || is_author() || is_tag() || is_archive() || is_month() || is_year() || is_search()) {
                $banner_post_id = get_option('page_for_posts');
                $banner_img = get_the_post_thumbnail_url($banner_post_id, 'full');
            }

            /* Single "Lesson" Page Banner */
            if (is_single() && 'lesson' === get_post(get_the_ID())->post_type) {
                $img_id = get_post_meta($banner_post_id, 'int_ban_img', true);
                /* TO DO  : Remove the hardcoded page id from above. */
            }

            /* Check if Custom Banner Image set */
            $img_id = get_post_meta($banner_post_id, 'int_ban_img', true);

            if(isset($img_id) && strlen($img_id) && 'on' === get_post_meta($banner_post_id, 'internal_banner_switch', true)){
                $banner_img = wp_get_attachment_url($img_id);
            }
            /* If NOT, Check if Featured Image set */
            if(!isset($banner_img)){
                $banner_img = get_the_post_thumbnail_url($banner_post_id, 'full');
            }
            /* If NOT, leave it empty */
            if (!strlen($banner_img)) {
                /*$banner_img = get_template_directory_uri() . '/assets/images/surfing-lessons.png';*/
                $banner_img = '';
            }

        ?>
        <?php if('off' != get_post_meta($banner_post_id, 'internal_banner_switch', true)): ?>
        <div class="banner internal-banner <?php echo get_post_meta(get_the_ID(), 'int_banner_height', true); ?> " role="banner" style="background-image:url(<?php echo $banner_img ?>);">
            <div class="container banner-content align-left">
                <div class="banner-caption text-left">

                    <?php

                    /* Search Page Title */
                    if(is_search()){
                        echo '<h2>'.sprintf( __( 'Search: %s', 'yoga' ), '<span>' . get_search_query() . '</span>' ).'</h2>';
                        get_search_form();
                    }


                    /* Category Page Title */
                    else if (is_category() || is_tag() || is_archive() || is_month()) {
                        the_archive_title('<h2>', '</h2>');
                        the_archive_description( '<div class="archive-description">', '</div>' );
                    }

                    /* Author Page Title */
                    elseif (is_author()){

                        if (strlen(get_the_author_meta('first_name'))) {
                            echo '<h2>'.__('Author', 'yoga').': '.get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name').'</h2>';
                        } else {
                            the_author('<h2>'.__('Author'), ': </h2>');
                        }
                        ?>
                        <div class="archive-description"><p><?php echo nl2br(get_the_author_meta('description')); ?></p></div>
                    <?php

                    }
                    /* General Pages Title */
                    else if(is_page()){
                        $banner_text_switch = get_post_meta(get_the_ID(), 'internal_banner_switch', true);
                        $banner_text = get_post_meta(get_the_ID(), 'int_ban_text', true);
                        if(strlen($banner_text) && $banner_text_switch == 'on'){
                            printf('<h2>%s</h2>', nl2br($banner_text));
                        }
                        else{
                            add_filter('the_title', 'break_page_title', 10);
                            the_title('<h2>', '</h2>');
                            remove_filter('the_title', 'break_page_title');
                        }
                    }
                    else if( 'lesson' == get_post_type() ){
                        $banner_text_switch = get_post_meta(get_the_ID(), 'internal_banner_switch', true);
                        $banner_text = get_post_meta(get_the_ID(), 'int_ban_text', true);
                        if(strlen($banner_text) && $banner_text_switch == 'on'){
                            printf('<h2>%s</h2>', nl2br($banner_text));
                        }
                    }
                    /* Blog Page Title */
                    else if(is_home()){
                        add_filter('the_title', 'break_page_title', 10);
                        echo '<h2>'.get_the_title($banner_post_id).'</h2>';
                        remove_filter('the_title', 'break_page_title');
                    }

                    /* Rest All Pages */
                    else {
                        add_filter('the_title', 'break_page_title', 10);
                        the_title('<h2>', '</h2>');
                        remove_filter('the_title', 'break_page_title');
                    }

                    ?>

                </div>
            </div>
        </div>
        <!-- END banner container -->
        <?php endif; ?>