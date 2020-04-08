<?php

require get_theme_file_path('/inc/anmeldung-route.php');
require get_theme_file_path('/inc/search-route.php');

function z10_custom_rest() {
	register_rest_field('post', 'authorName', array(
		'get_callback' => function() {return get_the_author();}
	));

	register_rest_field('note', 'userNoteCount', array(
		'get_callback' => function() {return count_user_posts(get_current_user_id(), 'note');}
	));
}

add_action('rest_api_init', 'z10_custom_rest');

function pageBanner($args=NULL){
	if (!$args['title']) {
		$args['title'] = get_the_title();
	}

	if (!$args['subtitle']) {
		$args['subtitle'] = get_field('page_banner_subtitle');
	}

	if (!$args['photo']) {
		if (get_field('page_banner_background_image')) {
			$args['photo'] = get_field('page_banner_background_image') ['sizes'] ['pageBanner'];
		} else {
			$args['photo'] = get_theme_file_uri('/images/generic_background_1.jpg');
		}
	}
		?>
		<div class="page-banner__page">
	  <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'] ;?>);"></div>
	  <div class="page-banner__content-page container container--narrow">
	    <h1 class="page-banner__title"><?php echo $args['title'];?></h1>
	    <div class="page-banner__intro">
	      <p><?php echo $args['subtitle']; ?></p>
	    </div>
	  </div>  
	</div>
<?php }



function single_metabox($args=NULL) { 
	if (!$args['title']) {
		$args['title'] = get_the_title();
	}?>

	<div class="metabox metabox--position-up metabox--with-home-link">
    <p><a class="metabox__blog-home-link" href="<?php echo site_url($args['parentUrl']);?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo $args['parentName'];?> </a> <span class="metabox__main"><?php echo $args['title'];?></span></p>
  </div> <?php
}

function header_main($args=NULL) { ?>

	<li <?php if (is_page($args['name']) or wp_get_post_parent_id(0)== $args['id'] or get_post_type() == $args['post_type']) echo 'class=" current-menu-item"' ;?>><div <?php if ($args['id'] != 1000) echo 'class="dropdown"' ;?> ><a href="<?php echo site_url($args['slug']);?>" class="dropbtn" ><?php echo $args['title']; ?></a>
		<?php header_sub(array('parentID' => $args['id'])); ?>
	</div></li> <?php
}


function header_sub($args=NULL){ ?>
	<div class="dropdown-content">
    <ul> <?php
      wp_list_pages(array(
        'title_li' => NULL, 
        'child_of' => $args['parentID'],
        'sort_column' => 'menu-order'
        ));?>
    </ul>
  </div> <?php
}




function z10_files() {
	wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyB0NKanlSrlnqtrZnCI-cViW3JGp875_A0', NULL, microtime(), true);
	wp_enqueue_script('main-z10-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
	wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	// wp_enqueue_style('custom-google-fonts-again', '//fonts.googleapis.com/css2?family=Permanent+Marker&display=swap');
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('z10_main_styles', get_stylesheet_uri(), NULL, microtime());
	wp_localize_script('main-z10-js', 'z10Data', array(
		'root_url' => get_site_url(),
		'nonce' => wp_create_nonce('wp_rest')
	));
}

add_action('wp_enqueue_scripts', 'z10_files');

function z10_features() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_image_size('mitgliedBild', 500, 540, true);
	add_image_size('pageBanner', 1500, 350, true);
	add_image_size('eventBild', 400, 564, true);
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


function z10MapKey($api){
	$api['key'] = 'AIzaSyB0NKanlSrlnqtrZnCI-cViW3JGp875_A0';
	return $api;
}

add_filter('acf/fields/google_map/api', 'z10MapKey');

add_action( 'init', 'cp_change_post_object' );
// Change dashboard Posts to News
function cp_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
        $labels->name = 'News';
        $labels->singular_name = 'News';
        $labels->edit_item = 'Bearbeite News';
        $labels->view_item = 'Zeige News';
        $labels->search_items = 'Suche News';
        $labels->not_found = 'Keine News gefunden';
        $labels->not_found_in_trash = 'Keine News gefunden';
        $labels->all_items = 'Alle News';
        $labels->menu_name = 'News';
        $labels->name_admin_bar = 'News';
}

//Redirect Subscriber accounts out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend() {
	$ourCurrentUser = wp_get_current_user();

	if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
		wp_redirect(site_url('/'));
		exit;
	}
}

add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {
	$ourCurrentUser = wp_get_current_user();

	if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
		show_admin_bar(false);
	}
}

//Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl' );

function ourHeaderUrl() {
	return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCSS'); 

function ourLoginCSS(){
	wp_enqueue_style('z10_main_styles', get_stylesheet_uri());
	wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle() {
	return get_bloginfo('name');
}


// Force note posts to be private
add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);  //10 ist Prioritaet, 2 ist Anzahl parameter

function makeNotePrivate($data, $postarr) {
	if ($data['post_type'] == 'note') {
		if (count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID']) {
			die("Du hast dein Postlimit erreicht.");
		}
		$data['post_title'] = sanitize_textarea_field($data['post_title']);
		$data['post_content'] = sanitize_textarea_field($data['post_content']);
	}

	if ($data['post_type'] == 'note' AND $data['post_status'] != 'trash') {
		$data['post_status'] = "private";
	}
	return $data;
}


add_filter('allow_major_auto_core_updates', '__return_true');  //Enable major updates



