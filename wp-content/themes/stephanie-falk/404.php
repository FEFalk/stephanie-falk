<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

    <!-- START Page Content -->
    <section class="page-content" role="main">
        <div class="container">
            <div class="row">
                <div class="post-content not_found">
                    <br class="clear" />
                    <br class="clear" />
                    <br class="clear" />
                    <br class="clear" />

                    <?php echo ot_get_option('404_content'); ?>
                    <?php get_search_form(); ?>

                    <br class="clear" />
                    <br class="clear" />
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>