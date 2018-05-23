<?php
/* Template Name: Lessons */
?>
<?php get_header(); ?>

<?php if (have_posts()) the_post(); ?>

<?php get_template_part('template-parts/internal', 'banner'); ?>
    <!-- START Page Content -->
    <section class="page-content" role="main">
        <div class="container">
            <div class="row">
                <!-- Page content -->
                <div class="col-md-12">
                    <?php the_content(); ?>
                </div>
            </div>
                <?php $read_more_title = get_post_meta(get_the_ID(), 'info_btn_title', true); ?>
                <?php
                /* Query Lessons */
                $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
                $args = array(
                    'post_type' => array('lesson'),
                    'post_status' => array('publish'),
                    'nopaging' => true,
                );

                $lessons = new WP_Query($args);

                if ($lessons->have_posts()): ?>

                    <div class="cpt-listing">

                        <?php while ($lessons->have_posts()):
                            $lessons->the_post(); ?>

                            <!-- START Single CPT -->
                            <article id="lesson-<?php the_ID(); ?>" <?php post_class('cpt-single-item'); ?>>

                                <div class="row">
                                    <!-- CPT Featured Image -->
                                    <div class="cpt-thumb col-md-5">
                                        <?php if (has_post_thumbnail()) { ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('lesson_medium', array('class'=>'featured-image')); ?>
                                            </a>
                                        <?php } ?>
                                    </div>

                                    <!-- CPT Content -->
                                    <div class="cpt-content col-md-7">
                                        <header class="cpt-title">
                                            <?php the_title('<h2><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                                            <?php the_subtitle(); ?>
                                        </header>

                                        <div class="cpt-excerpt">
                                            <?php the_excerpt(); ?>
                                            <?php onecom_edit_icon('page_meta', '', get_the_ID(), 'inline'); ?>
                                        </div>

                                        <?php
                                            $info_blocks = get_post_meta(get_the_ID(), 'booking_info_list_item', true);
                                            $booking_link = get_post_meta(get_the_ID(), 'booking_link', true);
                                            $booking_title = get_post_meta(get_the_ID(), 'booking_title', true);
                                        ?>
                                        <!-- CPT Custom Fields -->
                                        <?php if(!empty($info_blocks)){ ?>
                                            <div class="row cpt-custom-fields">
                                                <?php foreach($info_blocks as $info_block){ ?>
                                                    <?php if(!empty($info_block)){ ?>
                                                        <div class="field-block col-md-6 col-sm-6">
                                                            <h5 class="cursive-font"><?php echo $info_block['title']; ?></h5>
                                                            <?php echo lesson_display_details($info_block['booking_info_content']); ?>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>

                                            <br class="clear"/>
                                        <?php } ?>

                                            <div class="row cpt-buttons">
                                                <div class="col-md-6 col-sm-6 cpt-button">
                                                    <?php
                                                        if('#' == $booking_link || '' == $booking_link){
                                                            $booking_link = get_permalink( get_page_by_path( 'contact' ) );
                                                        }
                                                    ?>
                                                    <?php if(strlen($booking_title)): ?>
                                                        <a href="<?php echo $booking_link; ?>" class="button border"><?php echo $booking_title; ?></a>
                                                    <?php endif; ?>

                                                </div>
                                                <div class="col-md-6 col-sm-6 cpt-button">
                                                    <?php if(strlen($read_more_title)): ?>
                                                        <a href="<?php the_permalink(); ?>" class="button border"><?php echo $read_more_title; ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </article>
                            <!-- END Single CPT -->

                        <?php endwhile; ?>

                    </div>

                <?php else: ?>
                    <?php get_template_part('template-parts/content', 'none'); ?>
                <?php endif; ?>

                <?php
                    /*Restore original Post Data*/
                    wp_reset_postdata();
                ?>

        </div>
    </section>
    <!-- END Page Content -->


<?php get_footer(); ?>