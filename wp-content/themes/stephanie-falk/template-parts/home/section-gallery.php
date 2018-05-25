
    <?php
        $home_features_switch =         get_post_meta(get_the_ID(), 'home_features_switch', true);
        $features_section_title =       get_post_meta(get_the_ID(), 'features_section_title', true);
        $features_section_content =     get_post_meta(get_the_ID(), 'features_section_content', true);
        $features_blocks    =           get_post_meta(get_the_ID(), 'features_list_item', true);
        $features_section_btn_title =   get_post_meta(get_the_ID(), 'features_section_btn_title', true);
        $ftr_link =                     get_post_meta(get_the_ID(), 'features_section_btn_link', true);
        $features_section_bg =          get_section_background_image('features_section_bg');
    ?>

    <?php if( $home_features_switch != 'off' && (strlen($features_section_title) || strlen($features_section_content) || !empty($features_blocks) )): ?>
        <section class="section background text-white text-center" style="background-image: url(<?php echo $features_section_bg; ?>);">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2><?php echo $features_section_title; ?></h2>
                            <?php onecom_edit_icon('page_meta', '#setting_home_features', get_the_ID()); ?>
                        </div>
                        <div class="section-content">
                            <?php echo $features_section_content; ?>
                        </div>
                        <?php
                            if(!empty($features_blocks)):
                        ?>
                        <div class="section-features">
                            <div class="row">
                                <?php $ftr_count = 1; ?>
                                <?php foreach ($features_blocks as $features_block): ?>
                                    <!-- Feature Box -->
                                    <div class="col-md-6 feature-box <?php echo ($ftr_count%2==1)?'text-right':'text-left'; ?>">

                                        <div class="feature-image">
                                            <?php if(strlen($features_block['feature_list_item_icon'])){
                                                $icon_url = wp_get_attachment_image_src($features_block['feature_list_item_icon'], 'thumb');
                                                if(!empty($icon_url)){ $icon_url = $icon_url[0]; }
                                            } ?>
                                            <img src="<?php echo $icon_url; ?>"/>
                                        </div>

                                        <div class="feature-text">
                                            <h4 class="cursive-font feature-heading"><?php echo $features_block['title']; ?></h4>
                                            <p><?php echo nl2br($features_block['features_list_item_content']); ?></p>
                                        </div>

                                    </div>
                                <?php $ftr_count++; endforeach; ?>

                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(strlen($features_section_btn_title)): ?>
                            <div class="section-button">
                                <?php
                                    if('#' == $ftr_link || '' == $ftr_link){
                                        $ftr_link = get_permalink( get_page_by_path( 'contact' ) );
                                    }
                                ?>
                                <a href="<?php echo $ftr_link; ?>" class="button"><?php echo $features_section_btn_title; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>