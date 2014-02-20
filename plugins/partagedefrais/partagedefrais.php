<?php
/**
 * Plugin Name: Partage de frais
 * Plugin URI: 
 * Description: Cr�ation des types de contenu, des tables SQL et des formulaires permettant de calculer les frais partag�s
 * Version: 0.1
 * Author: VIRICEL Hugo
 * Author URI: http://hugo.viricel.net
 * License: 
 */
 
 
add_action('init', 'partagedefrais_module');
 
function create_content_type(){
	$args = array(
		'label' => __('Event'),
		'singular_label' => __('Event'),
		'public' => true,
		'show_ui' => true,
		'_builtin' => false, // It's a custom post type, not built in
		//'_edit_link' => 'post.php?post=%d',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array("slug" => "events"),
		'query_var' => "event", // This goes to the WP_Query schema
		'supports' => array('title', 'editor', 'author', 'thumbnail') //titre + zone de texte + champs personnalis�s + miniature valeur possible : 'title','editor','author','thumbnail','excerpt'
	);
	register_post_type( 'evenement' , $args ); // enregistrement de l'entit� projet bas� sur les arguments ci-dessus
}

function create_custom_taxonomy() {
	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Event type', 'taxonomy general name' ),
		'singular_name'              => _x( 'Event type', 'taxonomy singular name' ),
		'search_items'               => __( 'Search event type' ),
		'popular_items'              => __( 'Popular event type' ),
		'all_items'                  => __( 'All events types' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit event type' ),
		'update_item'                => __( 'Update event type' ),
		'add_new_item'               => __( 'Add New event type' ),
		'new_item_name'              => __( 'New event type Name' ),
		'separate_items_with_commas' => __( 'Separate event type with commas' ),
		'add_or_remove_items'        => __( 'Add or remove event type' ),
		'choose_from_most_used'      => __( 'Choose from the most used event type' ),
		'not_found'                  => __( 'No event type found.' ),
		'menu_name'                  => __( 'Event type' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'event_type' ),
	);

	register_taxonomy( 'event_type', 'evenement', $args );
}

function partagedefrais_module() {

	create_custom_taxonomy();
	create_content_type();

}
