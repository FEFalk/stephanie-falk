
        <?php
            $home_banner_switch = get_post_meta(get_the_ID(), 'home_banner_switch', true);
            $banner_align = get_post_meta(get_the_ID(), 'banner_caption_align', true);
            if(!strlen($banner_align)){ $banner_align = 'align-right'; }
            $banner_height = get_post_meta(get_the_ID(), 'banner_height', true);
            $home_banner_image = get_section_background_image('home_banner_image');
            $banner_caption_title = get_post_meta(get_the_ID(), 'banner_caption_title', true);
            $banner_caption_subtitle = get_post_meta(get_the_ID(), 'banner_caption_subtitle', true);
            $banner_button_label = get_post_meta(get_the_ID(), 'banner_button_label', true);
            $banner_link = get_post_meta(get_the_ID(), 'banner_button_link', true);
            if('#' == $banner_link || '' == $banner_link){$banner_link = get_permalink( get_page_by_path( 'contact' ) ); }
        ?>

        <?php if( $home_banner_switch != 'off' && (strlen($banner_caption_title) || strlen($banner_caption_subtitle) || strlen($banner_button_label) || strlen($home_banner_image))): ?>
            <div class="video-container">
                <video autoplay muted loop class="banner home-banner <?php echo $banner_height; ?> " id="homeVideo">
                    <source src=".\wp-content\uploads\2018\05\barcelona.mp4" type="video/mp4"></source>
                </video>
            </div>
            <div class="container banner-content  <?php echo $banner_align; ?>">
                <div class="banner-caption text-center">

                    <?php if(strlen($banner_caption_title)): ?>
                        <h2><?php echo $banner_caption_title; ?></h2>
                    <?php endif; ?>

                    <?php onecom_edit_icon('page_meta', '#setting_home_banner', get_the_ID()); ?>

                    <?php if(strlen($banner_caption_subtitle)): ?>
                        <div class="sub-title cursive-font"><?php echo $banner_caption_subtitle; ?></div>
                    <?php endif; ?>

                    <?php if(strlen($banner_button_label)): ?>
                        <div class="banner-button">
                            <a href="<?php echo $banner_link; ?>" class="button"><?php echo $banner_button_label; ?></a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php endif; ?>