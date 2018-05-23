<?php
/* Single CPT Page */
?>

<?php get_header(); ?>

<?php if (have_posts()) the_post(); ?>

<!-- START Banner Container -->
<?php get_template_part('template-parts/internal', 'banner'); ?>
<!-- END Banner Container -->


<section class="page-content" role="main">

    <article id="lesson-<?php the_ID(); ?>" <?php post_class('cpt-single'); ?> role="article">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- CPT Title -->
                    <header class="cpt-title">
                        <?php the_title('<h2>', '</h2>'); ?>
                        <?php the_subtitle(); ?>
                    </header>
                </div>
                <div class="clear"></div>
                <div class="col-md-8">

                    <!-- CPT Content -->
                    <div class="cpt-content">

                        <!-- CPT Featured Image -->
                        <?php if (has_post_thumbnail()) { ?>
                            <div class="cpt-thumb" role="img">
                                <?php the_post_thumbnail('lesson_big', array('class'=>'featured-image')); ?>
                            </div>
                        <?php } ?>


                        <!-- CPT Excerpt -->
                        <?php if (has_excerpt()) { ?>
                            <div class="cpt-excerpt" role="complementary">
                                <?php add_filter('the_excerpt', 'wpautop') ?>
                                <?php the_excerpt(); ?>
                            </div>
                        <?php } ?>

                        <!-- CPT Text -->
                        <div class="post-content" role="main">
                            <?php add_filter('the_content', 'wpautop') ?>
                            <?php the_content(); ?>
                        </div>

                    </div>
                </div>
                <!-- Sidebar --->
                <aside class="col-md-4 sidebar primary" role="complementary">
                    <!-- CPT Custom Fields -->
                    <?php
                        $info_blocks = get_post_meta(get_the_ID(), 'booking_info_list_item', true);
                        $book_link = get_post_meta(get_the_ID(), 'booking_link', true);
                        $booking_title = get_post_meta(get_the_ID(), 'booking_title', true);
                    ?>
                    <?php if(!empty($info_blocks)){ ?>
                            <div class="cpt-custom-fields">
                                <?php foreach($info_blocks as $info_block){ ?>
                                    <?php if(!empty($info_block)){ ?>
                                        <div class="field-block">
                                            <h5 class="cursive-font"><?php echo $info_block['title']; ?></h5>
                                            <?php echo lesson_display_details($info_block['booking_info_content']); ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>

                    <?php if(strlen($booking_title)): ?>
                        <div class="cpt-buttons">
                            <?php
                            if('#' == $book_link || '' == $book_link){
                                $book_link = get_permalink( get_page_by_path( 'contact' ) );
                            }
                            ?>

                                <a href="<?php echo $book_link; ?>" class="button border"><?php echo $booking_title; ?></a>

                        </div>
                        <br class="clear" />
                        <br class="clear" />
                    <?php endif; ?>

                    <!-- Sidebar Widgets -->
                    <?php dynamic_sidebar('content_sidebar'); ?>

                </aside>

            </div>
        </div>
    </article>
</section>


<?php get_footer(); ?>
