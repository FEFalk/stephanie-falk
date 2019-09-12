
    <?php
    $home_testimonial_switch    =   get_post_meta(get_the_ID(), 'home_testimonial_switch', true);
    $testimonial_bg             =   get_section_background_image('testimonial_bg');
    $testimonial_section_title  =   get_post_meta(get_the_ID(), 'testimonial_section_title', true);
    $testimonials               =   get_post_meta(get_the_ID(), 'testimonial_list_item', true);
    ?>

    <?php if ($home_testimonial_switch != 'off' && (strlen($testimonial_section_title) || !empty($testimonials))): ?>
        <section class="section background text-white text-center"
                id="instagram-section"
                style="background-image: url(<?php echo $testimonial_bg; ?>)">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                        <a href="https://www.instagram.com/stephanie_falk"><h2><i class="fab fa-instagram instagram-logo"></i> @STEPHANIE_FALK</h2></a>
                        </div>
                        <div class="filter-tags-container">
                            <div id="filter-button" role="button" aria-label="Visa filtreringsval">
                                <i class="fas fa-filter filter-icon"></i>
                                <p class="filter-text">Filtrera</p>
                            </div>
                            <?php echo do_shortcode('[tag_groups_accordion orderby=count smallest=9 largest=30 show_not_assigned=1 inner_div_class="tags-container" header_class="tag-group"]'); ?>
                        </div>
                        <!-- <div class="active-tags-container">
                            <span class="close-button" id="close-filters"></span>
                        </div> -->
                        <div class="grid" id="instagram-grid" data-page="1">
                            <div class="grid-sizer"></div>
                            <div class="gutter-sizer"></div>
                            <?php 
                                $param = array(
                                    'limit' => 15,
                                    'orderby' => 'date DESC'
                                );
                                $instagram_posts = pods('instagram-post', $param);
                                if (0 < $instagram_posts->total()) {
                                    while ($instagram_posts->fetch()) {
                                        echo $instagram_posts->field('post_content');
                                    }
                                }
                            ?>
                        </div>
                        <div class="btn btn-dark" id="loadMoreButton">Ladda mer...</div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;
    
    // $param = array(
    //     'orderby'   =>  'date DESC',
    //     'post_type' => 'instagram-post',
    //     'posts_per_page' => -1
    // );
    // // $the_query = new WP_Query( $param );

    // $posts = get_posts($param);

    // foreach ($posts as $my_post) {
    //     $id = $my_post->ID;
    //     echo '<pre>' . print_r($id, true) . '</pre>';
    //     $content = $my_post->post_content;
    //     $output_array;
    //     $post_url = preg_match('/href="([^"]*)"/', $content, $output_array);
    //     $post_url = $output_array[1];


        // $alreadyFixed;
        // preg_match('/src="(https:\/\/www.instagram.com\/p\/)/', $content, $alreadyFixed);


    //     if($post_url!="https://www.instagram.com/stephanie_falk/" || $alreadyFixed != null)
    //         continue;
    //     $post_url = $post_url . "media/?size=l";

    //     $newContent = preg_replace('/src="([^"]*)"/', 'src="'. $post_url .'"', $content);

    //     $data = array(
    //         'ID' => $id,
    //         'post_content' => $newContent,
    //     );
    //     wp_update_post($data);

    // }

    // $param = array(
    //     'orderby'   =>  'date DESC',
    //     'post_type' => 'instagram-post',
    //     'posts_per_page' => -1
    // );
    // // $the_query = new WP_Query( $param );

    // $posts = get_posts($param);

    // foreach ($posts as $my_post) {
    //     $id = $my_post->ID;
    //     $content = $my_post->post_content;
    //     $output_array;
    //     $post_url = preg_match('/href="([^"]*)"/', $content, $output_array);
    //     $post_url = $output_array[1];

    //     $alreadyFixed;
    //     preg_match('/src="(http:\/\/stephanie-falk.com\/)/', $content, $alreadyFixed);

    //     if($post_url!="https://www.instagram.com/stephanie_falk/" || $alreadyFixed[0] != null)
    //         continue;
            
    //     echo '<pre>' . print_r($id, true) . '</pre>';

    //     $newContent = preg_replace('/src="(http:\/\/stephanie-falk.local)/', 'src="https://stephanie-falk.com', $content);

    //     $data = array(
    //         'ID' => $id,
    //         'post_content' => $newContent,
    //     );
    //     wp_update_post($data);

    // }
    ?>

    