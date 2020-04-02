<?php

function z10_files() {
	wp_enqueue_script('main-z10-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
	wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('z10_main_styles', get_stylesheet_uri(), NULL, microtime());
}

add_action('wp_enqueue_scripts', 'z10_files');

function z10_features() {
	add_theme_support('title-tag');
}


add_action('after_setup_theme', 'z10_features');

function z10_adjust_queries($query) {
	if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
		$today = date('Ymd');
		$query->set('meta_key', 'event_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', array(
              array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
              )
            ));
	}

}

add_action('pre_get_posts', 'z10_adjust_queries');

function wpb_change_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'mitglied' == $screen->post_type ) {
          $title = 'Kürzel';
     }
  
     return $title;
}
  
add_filter( 'enter_title_here', 'wpb_change_title_text' );

