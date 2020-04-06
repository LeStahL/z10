<?php

add_action('rest_api_init', 'z10RegisterSearch');

function z10RegisterSearch() {
	register_rest_route('z10/v1', 'search', array(
		'methods' => 'GET',
		'callback'=> 'z10SearchResults'
	));
}

function z10SearchResults($data){
	$mainQuery = new WP_Query(array(
		'post_type' => array('post', 'page', 'mitglied', 'event', 'kurs'),
		's' => sanitize_text_field($data['term'])
	));

	$results = array(
		'generalInfo' => array(),
		'events' => array(), 
		'pastevents' => array(),
		'kurse' => array(),
		'pastkurse' => array(),
		'news' => array() 
	);

	while($mainQuery->have_posts()) {
		$mainQuery->the_post();

		if (get_post_type() == 'page' OR get_post_type() =='mitglied') {
			array_push($results['generalInfo'], array(
			'title' => get_the_title(),
			'permalink' => get_the_permalink()
		));
		}

	

		if (get_post_type() =='event') {
			$today = date('Ymd');
			$aMonthNamesDE = [
								          'Jan', 'Feb', 'Mrz', 'Apr', 'Mai', 'Jun',
								          'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'
								      ];

			$eventDate = new DateTime(get_field('event_date'));
			$date = get_field('event_date');
			
			if ($date >= $today) {
				array_push($results['events'], array(
					'title' => get_the_title(),
					'past' => false,
					'permalink' => get_the_permalink(),
					'month' => $aMonthNamesDE[$eventDate->format('n')-1],
					'day' => $eventDate->format('d'),
					'description' => wp_trim_words(get_the_content(), 18)
				));
			} else {
				array_push($results['pastevents'], array(
					'title' => get_the_title(),
					'past' => true,
					'permalink' => get_the_permalink(),
					'month' => $aMonthNamesDE[$eventDate->format('n')-1],
					'day' => $eventDate->format('d'),
					'description' => wp_trim_words(get_the_content(), 18)
				));
			}

		}

		if (get_post_type() =='kurs') {
			$today = date('Ymd');
			$aMonthNamesDE = [
								          'Jan', 'Feb', 'Mrz', 'Apr', 'Mai', 'Jun',
								          'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'
								      ];

			$eventDate = new DateTime(get_field('kurs_anmeldeschluss'));
			$date = get_field('kurs_anmeldeschluss');
			
			if ($date >= $today) {
				array_push($results['kurse'], array(
					'title' => get_the_title(),
					'past' => false,
					'permalink' => get_the_permalink(),
					'month' => $aMonthNamesDE[$eventDate->format('n')-1],
					'day' => $eventDate->format('d'),
					'description' => wp_trim_words(get_the_content(), 18)
				));
			} else {
				array_push($results['pastkurse'], array(
					'title' => get_the_title(),
					'past' => true,
					'permalink' => get_the_permalink(),
					'month' => $aMonthNamesDE[$eventDate->format('n')-1],
					'day' => $eventDate->format('d'),
					'description' => wp_trim_words(get_the_content(), 18)
				));
			}

		}

		if (get_post_type() =='post') {
			array_push($results['news'], array(
			'title' => get_the_title(),
			'permalink' => get_the_permalink(),
			'postType' => get_post_type(),
			'authorName' => get_the_author(),
			'postDate' => get_the_time('d.n.y')
		));
		}
		
	}

	return $results;
}