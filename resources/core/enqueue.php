<?php 

function load_scripts_and_styles () {
	global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

	if (!is_admin()) {
		wp_register_style( 'styles', get_stylesheet_directory_uri() . '/public/css/app.css', array(), '', 'all' );
		wp_register_script( 'scripts', get_stylesheet_directory_uri() . '/public/js/app.js', array(), '', true );


		wp_enqueue_style( 'styles' );
		wp_enqueue_script( 'scripts' );
	} else {
		// wp_register_script( 'admin-js', get_stylesheet_directory_uri() . '/library/dist/admin.js', array(), '', true );
		// wp_enqueue_script( 'admin-js' );
	}
}

?>