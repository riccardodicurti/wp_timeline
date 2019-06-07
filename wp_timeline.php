<?php
/**
 * Plugin Name: WordPress Timeline
 * Plugin URI:  https://example.com/plugins/the-basics/
 * Description: Basic WordPress Plugin Header Comment
 * Version:     20160911
 * Author:      WordPress.org
 * Author URI:  https://author.example.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: rdc_wpt
 * Domain Path: /languages
 */


function rdc_wpt_register_dependencies() {
  wp_register_style( 'rdc_wpt_style', plugin_dir_url( __FILE__ ) . 'public/css/jquery.mCustomScrollbar.css', array(), "1.0");
  wp_register_style( 'rdc_wpt_style_2', plugin_dir_url( __FILE__ ) . 'public/css/style.css', array(), "1.0");

 	wp_register_script( 'rdc_wpt_scripts', plugin_dir_url( __FILE__ ) . 'public/js/jquery-ui.min.js', array( 'jquery' ), "1.0");
  wp_register_script( 'rdc_wpt_scripts_2', plugin_dir_url( __FILE__ ) . 'public/js/jquery.mousewheel.min.js"', array( 'jquery' ), "1.0");
  wp_register_script( 'rdc_wpt_scripts_3', plugin_dir_url( __FILE__ ) . 'public/js/jquery.mCustomScrollbar.js"', array( 'jquery' ), "1.0");
  wp_register_script( 'rdc_wpt_scripts_5', plugin_dir_url( __FILE__ ) . 'public/js/init.js"', array( 'jquery' ), "1.0");
 }

 add_action( 'wp_enqueue_scripts', 'rdc_wpt_register_dependencies');

 function rdc_wpt_timeline_custom_init() {
   $labels = array(
   		'name'               => _x( 'Timeline', 'post type general name', 'rdc_wpt' ),
   		'singular_name'      => _x( 'Timeline', 'post type singular name', 'rdc_wpt' ),
   		'menu_name'          => _x( 'Timeline', 'admin menu', 'rdc_wpt' ),
   		'name_admin_bar'     => _x( 'Timeline', 'add new on admin bar', 'rdc_wpt' ),
   		'add_new'            => _x( 'Add New', 'Timeline', 'rdc_wpt' ),
   		'add_new_item'       => __( 'Add New Timeline', 'rdc_wpt' ),
   		'new_item'           => __( 'New Timeline', 'rdc_wpt' ),
   		'edit_item'          => __( 'Edit Timeline', 'rdc_wpt' ),
   		'view_item'          => __( 'View Timeline', 'rdc_wpt' ),
   		'all_items'          => __( 'All Timeline', 'rdc_wpt' ),
   		'search_items'       => __( 'Search Timeline', 'rdc_wpt' ),
   		'parent_item_colon'  => __( 'Parent Timeline:', 'rdc_wpt' ),
   		'not_found'          => __( 'No Timeline found.', 'rdc_wpt' ),
   		'not_found_in_trash' => __( 'No Timeline found in Trash.', 'rdc_wpt' )
   	);

   	$args = array(
   		'labels'             => $labels,
   		'description'        => __( 'Description.', 'rdc_wpt' ),
   		'public'             => false,
   		'publicly_queryable' => true,
   		'show_ui'            => true,
   		'show_in_menu'       => true,
   		'query_var'          => true,
   		'rewrite'            => array( 'slug' => 'timeline_event' ),
   		'capability_type'    => 'post',
   		'has_archive'        => true,
   		'hierarchical'       => false,
   		'menu_position'      => null,
   		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
   	);

   	register_post_type( 'Timeline', $args );
}

add_action( 'init', 'rdc_wpt_timeline_custom_init' );

function rdc_wpt_register_shortcode() {
   wp_enqueue_style( 'rdc_wpt_style' );
   wp_enqueue_style( 'rdc_wpt_style_2' );

   wp_enqueue_script( 'rdc_wpt_scripts' );
   wp_enqueue_script( 'rdc_wpt_scripts_2' );
   wp_enqueue_script( 'rdc_wpt_scripts_3' );
   wp_enqueue_script( 'rdc_wpt_scripts_5' );

   $content = '
     <h1>Timeline</h1>
     <div id="container">
       <div class="slider">
         <div class="my_container">

   ';


   query_posts(array(
     'post_type' => 'Timeline',
     'showposts' => 10,
     'orderby'=> 'title',
     'order' => 'ASC'
   ) );

   while (have_posts()) : the_post();

     $content .= '

      <div id="' . get_the_title() . '" class="line-element">
        <div class="cont-page">
          <h2>' . get_the_title() . '</h2>
          <p>' . get_the_excerpt() . '</p>
        </div>
      </div>

     ';

   endwhile;

   $content .= '

         </div>
       </div>
       <span class="draggable-label"> DRAG TO SCROLL </span>
     </div>
   ';

   return $content;
 }

 add_shortcode( 'wpt', 'rdc_wpt_register_shortcode' );
