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

		$existQuery = new WP_Query(array(
      'author' => get_current_user_id(),
      'post_type' => 'anmeldung', 
      'meta_query' => array(
        array(
          'key' => 'kursanmeldung_id',
          'compare' => '=',
          'value' => $kurs
        )
      )
    ));

		if ($existQuery->found_posts == 0 AND get_post_type($kurs) == 'kurs') {
			return wp_insert_post(array(
			'post_type' => 'anmeldung',
			'post_status' => 'publish', 
			'post_title' => 'Second PHP Test', 
			'meta_input' => array(
			'kursanmeldung_id' => $kurs
			)
		));
		}	else {
			die("Invalid professor id");
		}

	
	} else {
		die("Um dich für einen Kurs anmelden zu können, musst du eingeloggt sein.");
	}
	
}

function deleteAnmeldung($data) {
	$anmeldungID = sanitize_text_field($data['anmeldung']);
	if (get_current_user_id() == get_post_field('post_author', $anmeldungID) AND get_post_type($anmeldungID) =='anmeldung') {
		wp_delete_post($anmeldungID, true);
		return 'Anmeldung, entfernt';
	} else {
		die("Du hast keine Rechte, dies zu tun.");
	}
}


