<?php
/*
Stolen right from Bones Theme, 
why reinvent the wheel, right? :)

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for Artist types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the Artist
function init_artist() { 
	// creating (registering) the Artist 
	register_post_type( 'artist', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Artists', 'page-strings' ), /* This is the Title of the Group */
			'singular_name' => __( 'Artist', 'page-strings' ), /* This is the individual type */
			'all_items' => __( 'All Artists', 'page-strings' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'page-strings' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Artist', 'page-strings' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'page-strings' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Post Types', 'page-strings' ), /* Edit Display Title */
			'new_item' => __( 'New Post Type', 'page-strings' ), /* New Display Title */
			'view_item' => __( 'View Post Type', 'page-strings' ), /* View Display Title */
			'search_items' => __( 'Search Post Type', 'page-strings' ), /* Search Artist Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'page-strings' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'page-strings' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example Artist type', 'page-strings' ), /* Artist Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/img/admin/custom-post-icon.png', /* the icon for the Artist type menu */
			'rewrite'	=> false, /* you can specify its url slug */
			'has_archive' => false, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your Artist type */
	//register_taxonomy_for_object_type( 'category', 'artist' );
	/* this adds your post tags to your Artist type */
	//register_taxonomy_for_object_type( 'post_tag', 'artist' );
	
}

	// adding the function to the Wordpress init
	//add_action( 'init', 'init_artist');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	// register_taxonomy( 'custom_cat', 
	// 	array('artist'), /* if you change the name of register_post_type( 'artist', then you have to change this */
	// 	array('hierarchical' => true,     /* if this is true, it acts like categories */
	// 		'labels' => array(
	// 			'name' => __( 'Custom Categories', 'page-strings' ), /* name of the custom taxonomy */
	// 			'singular_name' => __( 'Custom Category', 'page-strings' ), /* single taxonomy name */
	// 			'search_items' =>  __( 'Search Custom Categories', 'page-strings' ), /* search title for taxomony */
	// 			'all_items' => __( 'All Custom Categories', 'page-strings' ), /* all title for taxonomies */
	// 			'parent_item' => __( 'Parent Custom Category', 'page-strings' ), /* parent title for taxonomy */
	// 			'parent_item_colon' => __( 'Parent Custom Category:', 'page-strings' ), /* parent taxonomy title */
	// 			'edit_item' => __( 'Edit Custom Category', 'page-strings' ), /* edit custom taxonomy title */
	// 			'update_item' => __( 'Update Custom Category', 'page-strings' ), /* update title for taxonomy */
	// 			'add_new_item' => __( 'Add New Custom Category', 'page-strings' ), /* add new title for taxonomy */
	// 			'new_item_name' => __( 'New Custom Category Name', 'page-strings' ) /* name title for taxonomy */
	// 		),
	// 		'show_admin_column' => true, 
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 		'rewrite' => array( 'slug' => 'custom-slug' ),
	// 	)
	// );
	
	// // now let's add custom tags (these act like categories)
	// register_taxonomy( 'custom_tag', 
	// 	array('artist'), /* if you change the name of register_post_type( 'artist', then you have to change this */
	// 	array('hierarchical' => false,    /* if this is false, it acts like tags */
	// 		'labels' => array(
	// 			'name' => __( 'Custom Tags', 'page-strings' ), /* name of the custom taxonomy */
	// 			'singular_name' => __( 'Custom Tag', 'page-strings' ), /* single taxonomy name */
	// 			'search_items' =>  __( 'Search Custom Tags', 'page-strings' ), /* search title for taxomony */
	// 			'all_items' => __( 'All Custom Tags', 'page-strings' ), /* all title for taxonomies */
	// 			'parent_item' => __( 'Parent Custom Tag', 'page-strings' ), /* parent title for taxonomy */
	// 			'parent_item_colon' => __( 'Parent Custom Tag:', 'page-strings' ), /* parent taxonomy title */
	// 			'edit_item' => __( 'Edit Custom Tag', 'page-strings' ), /* edit custom taxonomy title */
	// 			'update_item' => __( 'Update Custom Tag', 'page-strings' ), /* update title for taxonomy */
	// 			'add_new_item' => __( 'Add New Custom Tag', 'page-strings' ), /* add new title for taxonomy */
	// 			'new_item_name' => __( 'New Custom Tag Name', 'page-strings' ) /* name title for taxonomy */
	// 		),
	// 		'show_admin_column' => true,
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 	)
	// );
	
	/*
		looking for custom meta boxes?
		check out this fantastic tool:
		https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
	*/

?>
