<?php
/**
 * Name: Origines Child Theme
 * GitHub URI: https://github.com/haroldparis/origines-child
 * Description: MyOrigines functions and definitions.
 * Author: Harold Paris
 * Twitter: @haroldparis
 * Author website: http://www.tribeleadr.com/
 */

require_once( trailingslashit( get_template_directory() ) . 'includes/origines-init.php'); // Style, scripts, lang and custom category init
require_once( trailingslashit( get_template_directory() ) . 'includes/origines-admin.php'); // Origines Panel for admin purpose
require_once( trailingslashit( get_template_directory() ) . 'includes/origines-walker.php'); // Custom walkers and other functions to marry WordPress and Bootstrap 
require_once( trailingslashit( get_template_directory() ) . 'includes/origines-entry-meta.php'); // Custom entry meta inspired by TwentyTen
require_once( trailingslashit( get_template_directory() ) . 'includes/origines-functions.php'); // Origines functions for the home, logo, the magic footer and Google Analytics

/**
 * Registering the style.css in... the css call.
 */
remove_action('wp_enqueue_scripts', 'origines_styles');
function myorigines_styles(){ 
 	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false, false, 'all' );
 	wp_enqueue_style( 'origines', get_template_directory_uri() . '/css/origines.css', array('bootstrap'), false, 'all' );
 	wp_enqueue_style( 'bootstrap-responsive', get_template_directory_uri() . '/css/bootstrap-responsive.min.css', array('origines', 'bootstrap'), false, 'all' );
 	wp_enqueue_style( 'origines-child', get_stylesheet_directory_uri() . '/style.css', array('bootstrap', 'origines', 'bootstrap-responsive'), false, 'all' );
}
add_action('wp_enqueue_scripts', 'myorigines_styles');

/**
 * Add user after form submit 
 * 
 * @uses `wpuf_add_post_after_insert` filter hook
 * 
 * @param int $post_id the newly created post id
 */
function wpufe_add_user_participants( $post_id ) {
	echo '<div id="message" class="error"><p>' . $post_id . '</p></div>';
	$meta_values = get_post_meta( $post_id );
	
	echo '<div id="message" class="error"><p>';
	var_dump($meta_values);
	echo '</p></div>';
	
	return true;
}
add_filter( 'wpuf_add_post_after_insert', 'wpufe_add_user_participants' );

?>