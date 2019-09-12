<?php
        $home_courses_switch        =   get_post_meta(get_the_ID(), 'home_courses_switch', true);
        $courses_section_title      =   get_post_meta(get_the_ID(), 'courses_section_title', true);
        $courses_section_content    =   get_post_meta(get_the_ID(), 'courses_section_content', true);
        $home_courses_posts_switch  =   get_post_meta(get_the_ID(), 'home_courses_posts_switch', true);
        $home_courses_ids           =   get_post_meta(get_the_ID(), 'home_courses_ids', true);
        $home_courses_btn_title     =   get_post_meta(get_the_ID(), 'home_courses_btn_title', true);

        $page = get_page_by_path('about');

        $content = $page->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
?>

<?php if ($home_courses_switch != 'off' && (strlen($courses_section_title) || strlen($courses_section_content) || !empty($home_courses_ids))): ?>
<section class="section solid white-bg text-center" id="about-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-content">
                    <?php echo $page->post_content; ?>
                </div>
            </div>

        </div>
    </div>
    <div class="sax-poly">
        <?php echo file_get_contents(wp_get_upload_dir()["basedir"] . '\2018\05\sax.svg'); ?>


    </div>
    <div class="overlay"></div>
</section>
<?php endif;
