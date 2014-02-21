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

	$meta_values = get_post_meta( $post_id );

    if ( email_exists($user_email) == false ) {
        $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
        $user_id = wp_create_user( $user_name, $random_password, $user_email );
    } else {
        $random_password = __('User already exists.  Password inherited.');
    }

}
//add_filter( 'wpuf_add_post_after_insert', 'wpufe_add_user_participants' );


function add_new_post( $post_id )
{
    if( $post_id == 'new' ) {
        // Create a new post
        $post = array(
            'post_title' => $_POST["fields"]['field_52c810cb44c7a'],
            'post_category' => array(4),
            'post_status'  => 'draft',
            'post_type'  => 'post'
        );

        // insert the post
        $post_id = wp_insert_post( $post );

        return $post_id;
    }
    else {
        $post = array(
            'ID' => $post_id,
            'post_title' => $_POST["fields"]['field_52c810cb44c7a']
        );

        // update the post
        $post_id = wp_update_post( $post );

        return $post_id;
        return $post_id;
    }
}add_filter('acf/pre_save_post' , 'add_new_post' );