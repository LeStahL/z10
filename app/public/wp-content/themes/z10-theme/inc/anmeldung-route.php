<?php

add_action('rest_api_init', 'z10AnmeldungRoute');

function z10AnmeldungRoute() {
	register_rest_route('z10/v1', 'manageAnmeldung', array(
		'methods' => 'POST',
		'callback' => 'createAnmeldung'
	));

	register_rest_route('z10/v1', 'manageAnmeldung', array(
		'methods' => 'DELETE',
		'callback' => 'deleteAnmeldung'
	));
}

function createAnmeldung($data) {
	if (is_user_logged_in()) {
		$kurs = sanitize_text_field($data['kursId']);

	return wp_insert_post(array(
		'post_type' => 'anmeldung',
		'post_status' => 'publish', 
		'post_title' => 'Second PHP Test', 
		'meta_input' => array(
		'kursanmeldung_id' => $kurs
		)
	));
	} else {
		die("Um dich für einen Kurs anmelden zu können, musst du eingeloggt sein.");
	}


	
}

function deleteAnmeldung() {
	return 'Schade, dass du dich von einem Kurs abmelden möchtest.';
}