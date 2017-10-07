<?php 

function partystarter() {
	require_once( 'resources/core/core.php' );
	require_once( 'resources/core/custom-post-types.php' );
	require_once( 'resources/core/enqueue.php' );
  require_once( 'resources/core/bem-menu-walker.php' );

	add_action( 'init', 'head_cleanup' );

  	add_filter( 'wp_title', 'rw_title', 10, 3 );

  	add_filter( 'the_generator', 'rss_version' );

  	add_filter( 'wp_head', 'remove_wp_widget_recent_comments_style', 1 );

  	add_action( 'wp_head', 'remove_recent_comments_style', 1 );

  	add_filter( 'gallery_style', 'gallery_style' );

  	add_action( 'wp_enqueue_scripts', 'load_scripts_and_styles' );

  	add_filter( 'the_content', 'filter_ptags_on_images' );

  	add_filter( 'excerpt_more', 'excerpt_more' );

  	blankslate_setup();

}

add_action( 'after_setup_theme', 'partystarter' );
