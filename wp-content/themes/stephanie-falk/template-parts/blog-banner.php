        <!-- START banner container -->
        To Do : Blog Banner template-part is redundant.
        <?php
            $blog_page_id = get_option('page_for_posts');
            if($blog_page_id) {
                $banner_img = get_the_post_thumbnail_url($blog_page_id, 'full');
            }
            if (!strlen($banner_img)) {
                $banner_img = get_template_directory_uri() . '/assets/images/surfing-lessons.png';
            }
        ?>
        <div class="banner internal-banner <?php echo get_post_meta(get_the_ID(), 'int_banner_height', true); ?> " role="banner" style="background-image:url(<?php echo $banner_img ?>);">
            <div class="container banner-content align-left">
                <div class="banner-caption text-left">

                    <?php add_filter('the_title', 'break_page_title', 10); ?>

                    <h2><?php echo get_the_title($blog_page_id); ?></h2>

                    <?php remove_filter('the_title', 'break_page_title'); ?>

                </div>
            </div>
        </div>
        <!-- END banner container -->