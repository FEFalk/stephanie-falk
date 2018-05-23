<?php
/* Template Name: About Us */
?>
<?php get_header(); ?>

<?php global $custom; ?>
<?php if (have_posts()) the_post(); ?>
<?php get_template_part('template-parts/internal', 'banner'); ?>

    <!-- START Page Content -->
    <section class="page-content" role="main">

        <!-- START Single CPT -->
        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
            <div class="container">
                <div class="row">
                    <!-- Featured Image -->
                    <?php if (has_post_thumbnail()) { ?>
                        <div class="col-md-5 page-thumb" role="img">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', array('class'=>'featured-image')); ?>
                                </a>
                        </div>
                    <?php } ?>

                    <!-- Content -->
                    <div class="col-md-7">
                        <div class="post-content" role="main">
                            <?php add_filter('the_content', 'wpautop'); ?>
                            <?php the_content(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </article>
        <!-- END Single CPT -->
    </section>


    <?php
        $about_bg_switch     = get_post_meta(get_the_ID(), 'about_bg_switch', true);
        $about_bg_img        = get_section_background_image('about_bg_img');
        $about_bg_title      = get_post_meta(get_the_ID(), 'about_bg_title', true);
        $about_bg_btn_title  = get_post_meta(get_the_ID(), 'about_bg_btn_title', true);
        $surf_link           = get_post_meta(get_the_ID(), 'about_bg_btn_link', true);
    ?>
    <?php if($about_bg_switch != 'off' && (strlen($about_bg_title) || strlen($about_bg_btn_title))): ?>
        <!-- Background Section -->
        <section class="section background text-center text-white" style="background-image: url(<?php echo $about_bg_img; ?>); " >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2><?php echo nl2br($about_bg_title); ?></h2>
                        </div>

                        <?php if(strlen($about_bg_btn_title)): ?>
                            <div class="section-button">
                                <?php
                                    if('#' == $surf_link || '' == $surf_link){
                                        $surf_link = get_permalink( get_page_by_path( 'lessons' ) );
                                    }
                                ?>
                                <a href="<?php echo $surf_link; ?>" class="button medium"><?php echo $about_bg_btn_title; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <?php
        $about_evt_title = get_post_meta(get_the_ID(), 'about_evt_title', true);
        $upcoming_events = get_post_meta(get_the_ID(), 'about_events', true);
        $about_events_desc = get_post_meta(get_the_ID(), 'about_events_desc', true);
        $about_evt_switch = get_post_meta(get_the_ID(), 'about_evt_switch', true);
    ?>
    <!--Upcoming Events -->
    <?php if($about_evt_switch != 'off' && (strlen($about_evt_title) || strlen($about_events_desc) || !empty($upcoming_events))): ?>
    <section class="section solid white text-left" role="region">
        <div class="container">
            <div class="row">
                <div class="col-md-12"><h5 class="cursive-font"><?php echo $about_evt_title; ?></h5></div>
                    <?php if(!empty($upcoming_events)): ?>
                    <div class="col-md-5">
                        <!-- START Upcoming Events -->
                        <div class="upcoming-events" role="list">
                            <?php foreach($upcoming_events as $event): ?>
                                <!-- Event -->
                                <div class="event" role="listitem">
                                    <date class="event-date">
                                        <?php echo $event['event_month']; ?>
                                        <span class="day"><?php echo $event['event_day']; ?><sup><?php echo $event['event_acr']; ?></sup></span>
                                    </date>
                                    <div class="event-content">
                                        <h6 class="event-title"><?php echo $event['title']; ?></h6>
                                        <?php echo $event['event_desc']; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- END Upcoming Events -->
                    </div>
                <?php endif; ?>

                <div class="col-md-6 offset-md-1" role="complementary">
                    <?php echo wpautop($about_events_desc); ?>
                </div>

            </div>
        </div>
    </section>
    <?php endif; ?>




    <!-- END Page Content -->

<?php get_footer(); ?>