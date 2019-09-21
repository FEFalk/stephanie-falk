<?php
    /*
     *  Plugin Name: Instagram Import
    *   Description: Imports Instagram photos as posts to your WordPress site
    *   Version: 1.0
    *   Author: Filiph Eriksson Falk
    *   Author URI: https://www.linkedin.com/in/filiph-eriksson-falk-a89914145/
     *
    */

    // Load WordPress
require_once ABSPATH . '/wp-load.php';
require_once ABSPATH . '/wp-admin/includes/taxonomy.php';

// Set the timezone so times are calculated correctly
date_default_timezone_set('Europe/London');

function instagram_import() {
    $user_id = 1362124742;
    $accessToken = '54974439.3a81a9f.c81154a577c94e86a35b21ee2c007aea';

    // Get photos from Instagram
    // $url = 'https://api.instagram.com/v1/users/self/media/recent?access_token='.$accessToken;
    // $args = stream_context_create(
    //     array('http'=>
    //         array(
    //             'timeout' => 2500,
    //         )
    //     )
    // );
    // $json_feed = file_get_contents( $url, false, $args );
    // $json_feed = json_decode( $json_feed );

    $return = rudr_instagram_api_curl_connect('https://api.instagram.com/v1/users/self/media/recent?access_token=' . $accessToken);

    
    foreach ($return->data as $photo) {
        // $postsTitle = get_posts( [
        //     'post_type'  =>  'instagram-post',
        //     'title' => sanitize_title_with_dashes($photo->caption->text)
        //   ]);
        //   $postsSlug = get_posts( [
        //     'post_type'  =>  'instagram-post',
        //     'name' => sanitize_title_with_dashes($photo->id)
        //   ]);
        
        $date_stamp = strtotime('+1 hour', strtotime(date("Y-m-d H:i:s", $photo->created_time)));
        $dateTimeExploded = explode(" " , date("Y-m-d H:i:s", $date_stamp));
        $dateExploded = explode("-", $dateTimeExploded[0]);
        $timeExploded = explode(":", $dateTimeExploded[1]);
        $postsDate = get_posts( [
            'post_type'  =>  'instagram-post',
            'date_query' => array(
                array(
                    'year'      =>  $dateExploded[0],
                    'month'     =>  $dateExploded[1],
                    'day'       =>  $dateExploded[2],
                    'hour'      =>  $timeExploded[0],
                    'minute'    =>  $timeExploded[1],
                    'second'    =>  $timeExploded[2]
                ),
            ),
        ]);
        if (empty($postsDate)) {
            $new_post = array(
                'post_content'  => '<div class="grid-item"><a href="'. esc_url($photo->link) .'" target="_blank"><img src="'. esc_url($photo->link) . "media/?size=l" .'" alt="'. $photo->caption->text .'" /></a></div>',
                'post_date'     => date("Y-m-d H:i:s", $date_stamp),
                'post_date_gmt' => date("Y-m-d H:i:s", $date_stamp),
                'post_status'   => 'publish',
                'post_title'    => $photo->caption->text,
                'post_name'     => $photo->id
            );
            $pod = pods('instagram-post');
            $post_id = $pod->add($new_post);
            wp_set_object_terms($post_id, $photo->tags, 'hashtag');
            wp_publish_post($post_id);
        }
        // else if()
    }
}
add_action( 'instagram_auto_fetch', 'instagram_import' );

if ( ! wp_next_scheduled( 'instagram_auto_fetch' ) ) {
    wp_schedule_event( time(), 'daily', 'instagram_auto_fetch');
}

function importBackup()
{
    $path = ABSPATH . '/wp-content/uploads/instagram-backup/media.json';
    $string = file_get_contents($path);
    $json = json_decode($string, true);



    //echo '<pre>' . print_r($json, true) . '</pre>';

    //echo '<pre>' . print_r($json['photos'], true) . '</pre>';

    $count = 0;
    foreach($json['photos'] as $field => $value)
    {   
        // $count++;
        // if($count > 10)
        //     return;
        // $posts = get_posts( [
        //     'post_type'  =>  'instagram-post',
        //     'title' => $value['caption']
        //   ]);
        $date_string = $value['taken_at']; // or any string like "20110911" or "2011-09-11"
        // returns: string(13) "Sept 11, 2001"
        
        $date_stamp = strtotime('+9 hours', strtotime($date_string));
        // returns: int(1000166400)
        
        $postdate = date("Y-m-d H:i:s", $date_stamp);

        $dateTimeExploded = explode(" " , $postdate);
        $dateExploded = explode("-", $dateTimeExploded[0]);
        $timeExploded = explode(":", $dateTimeExploded[1]);
        $postsDate = get_posts( [
            'post_type'  =>  'instagram-post',
            'date_query' => array(
                array(
                    'year'      =>  $dateExploded[0],
                    'month'     =>  $dateExploded[1],
                    'day'       =>  $dateExploded[2],
                    'hour'      =>  $timeExploded[0],
                    'minute'    =>  $timeExploded[1],
                    'second'    =>  $timeExploded[2]
                ),
            ),
        ]);

        if (empty($postsDate)) {
            $matches = '';

            preg_match_all('/#([^\s]+)/', $value['caption'], $matches);
            $hashtags = [];
            foreach ($matches[1] as $match) {
                $hashtags[] = $match;
            }

            $image_path = wp_upload_dir()['baseurl'] . '/instagram-backup/' . $value['path'];

            //echo '<pre>' . print_r("postdate: ".$postdate." date_stamp: ".$date_stamp." date_string: ".$date_string, true) . '</pre>';

            $new_post = array(
                'post_content'  => '<div class="grid-item"><a href="' . esc_url("https://www.instagram.com/stephanie_falk/") . '" target="_blank"><img src="'. $image_path .'" alt="'. $value['caption'] .'" /></a></div>',
                'post_date'     => $postdate,
                'post_date_gmt' => $postdate,
                'post_status'   => 'publish',
                'post_title'    => $value['caption'],
                'post_name'     => $value['caption'],
            );
            $pod = pods('instagram-post');
            $post_id = $pod->add($new_post);
            wp_set_object_terms($post_id, $hashtags, 'hashtag');
        }
    }
}
add_action( 'instagram_backup', 'importBackup' );

if ( ! wp_next_scheduled( 'instagram_backup' ) ) {
    wp_schedule_event( time(), 'daily', 'instagram_backup');
}

// function tag_reg()
// {
//     register_taxonomy_for_object_type( 'post_tag', 'instagram-post' );
// }
// add_action( 'init', 'tag_reg' );

// function slug_exists($post_name)
// {
//     $post_name = pods_sanitize($post_name);
//     $pod = pods('instagram-post', $post_name);
//     return $pod->exists();
//     // global $wpdb;
//     // if ($wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_type = 'instagram-post' AND post_name = '" . $post_name . "'", 'ARRAY_A'))  :
//     //     return true; else :
//     //     return false;
//     // endif;
// }
function slug_exists( $post_name, $post_type='post' ) {
	global $wpdb;

	$query = "SELECT ID FROM $wpdb->posts WHERE 1=1";
	$args = array();

	if ( !empty ( $post_name ) ) {
	     $query .= " AND post_name LIKE '%s' ";
	     $args[] = $post_name;
	}
	if ( !empty ( $post_type ) ) {
	     $query .= " AND post_type = '%s' ";
	     $args[] = $post_type;
	}

	if ( !empty ( $args ) )
	     return $wpdb->get_var( $wpdb->prepare($query, $args) );

    return 0;
}
function rudr_instagram_api_curl_connect($api_url)
{
    $connection_c = curl_init(); // initializing
    curl_setopt($connection_c, CURLOPT_URL, $api_url); // API URL to connect
    curl_setopt($connection_c, CURLOPT_RETURNTRANSFER, 1); // return the result, do not print
    curl_setopt($connection_c, CURLOPT_TIMEOUT, 20);
    $json_return = curl_exec($connection_c); // connect and get json data
    curl_close($connection_c); // close connection
    return json_decode($json_return); // decode and return
}

