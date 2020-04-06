<?php

function z10_post_types() {
	// Event Post Type
	register_post_type('event', array(
		'show_in_rest' => true,
		'capability_type' => 'event',  //neue Userrole
		'map_meta_cap' => true,
		'supports' => array('title', 'editor'),
		'public' => true,				// sichtbar fuer Admins
		'labels' => array(
			'name' => 'Events', 
			'add_new_item' => 'Neues Event',
			'edit_item' => 'Bearbeite Event',
			'all_items' => 'Alle Events', 
			'singular_name' => 'Event'
		),
		'menu_icon' => 'dashicons-calendar'
	));

	// Mitglieder Post Type
	register_post_type('mitglied', array(
		'show_in_rest' => true,
		'supports' => array('title', 'thumbnail'),
		'rewrite' => array('slug' => 'mitglieder'),
		'has_archive' => false,
		'public' => true,				// sichtbar fuer Admins
		'labels' => array(
			'name' => 'Mitglieder', 
			'add_new_item' => 'Neues Mitglied',
			'edit_item' => 'Bearbeite Mitglied',
			'all_items' => 'Alle Mitglieder', 
			'singular_name' => 'Mitglied'
		),
		'menu_icon' => 'dashicons-admin-users'
	));


	// Kurse Post Type
	register_post_type('kurs', array(
		'supports' => array('title'),
		'public' => true,				// sichtbar fuer Admins
		'labels' => array(
			'name' => 'Kurse', 
			'add_new_item' => 'Neuer Kurs',
			'edit_item' => 'Bearbeite Kurs',
			'all_items' => 'Alle Kurse', 
			'singular_name' => 'Kurs'
		),
		'menu_icon' => 'dashicons-welcome-learn-more'
	));

	// Note Post Type
	register_post_type('note', array(
		'show_in_rest' => true,
		'supports' => array('title', 'editor'),
		'public' => false,				
		'show_ui' => true,		// sichtbar fuer Admins
		'labels' => array(
			'name' => 'Notizen', 
			'add_new_item' => 'Neue Notiz',
			'edit_item' => 'Bearbeite Notiz',
			'all_items' => 'Alle Notizen', 
			'singular_name' => 'Notiz'
		),
		'menu_icon' => 'dashicons-welcome-write-blog'
	));


	// Kursanmeldung Post Type
	register_post_type('anmeldung', array(
		'supports' => array('title'),
		'public' => false,				
		'show_ui' => true, // sichtbar fuer Admins
		'labels' => array(
			'name' => 'Anmeldungen', 
			'add_new_item' => 'Neue Anmeldung',
			'edit_item' => 'Bearbeite Anmeldung',
			'all_items' => 'Alle Anmeldungen', 
			'singular_name' => 'Anmeldung'
		),
		'menu_icon' => 'dashicons-heart'
	));
	
}

add_action( 'init', 'my_customer_cpt' );
  function my_customer_cpt() {
    $labels = array(
        'name'               => _x( 'Customers', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Customer', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Customers', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Customer', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New', 'Customer', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Customer', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Customer', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Customer', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Customer', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Customers', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Customers', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Customers:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No customers found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No customers found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'customer' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'show_in_rest'       => true,
        'rest_base'          => 'customers-api',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'customer', $args );
}


add_action('init', 'z10_post_types');