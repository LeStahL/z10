<?php

function z10_post_types() {
	// Event Post Type
	register_post_type('event', array(
		'supports' => array('title', 'editor'),
		'rewrite' => array('slug' => 'events'),
		'has_archive' => true,
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
		'supports' => array('title'),
		'rewrite' => array('slug' => 'test'),
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



}


add_action('init', 'z10_post_types');