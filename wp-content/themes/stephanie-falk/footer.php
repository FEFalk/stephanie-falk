<?php global $custom; ?>

<?php
    $footer_widgets = wp_get_sidebars_widgets();
    if(!empty($footer_widgets['footer'])){
        $footer_widgets_count = count($footer_widgets['footer']);
        $footer_class = '';
        if($footer_widgets_count > 3){
            $footer_class = ' extra_columns columns-'.$footer_widgets_count;
        }
    }
?>


<!-- Footer markup here --->
<footer id="site-footer" role="footer">
    <?php if(!empty($footer_widgets['footer'])): ?>
        <div class="footer-widgets">
            <div class="container">
                <div class="row flex-row <?php echo $footer_class; ?>">
                    <?php dynamic_sidebar('footer'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(strlen(ot_get_option('copyright_text'))): ?>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p><?php echo ot_get_option('copyright_text'); ?> <?php onecom_edit_icon('ot_option', 'section_footer_options', '', 'inline'); ?> </p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</footer>


</div>
<!-- END Page Wrapper -->

<?php

function mobile_menu(){
    echo '<!--- START Mobile Menu --->
    <div id="sticky_menu_wrapper" class="mobile-only">';
    wp_nav_menu(
        array(
            'theme_location' => 'mobile_yoga',
            'menu_id' => 'sticky_menu',
            'container' => '',
        )
    );

    echo '<div class="sticky_menu_collapse"><i></i></div></div>';
}
add_action('wp_footer', 'mobile_menu');
?>
<?php wp_footer(); ?>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<!-- <script src="<?php echo get_parent_theme_file_uri('assets/js/instafeed.min.js')?>"></script> -->
<script src="<?php echo get_parent_theme_file_uri('assets/js/instagram.js')?>"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>