<?php

get_header(); 

pageBanner(); ?>

  <div class="container container--narrow page-section">

  <?php 
  // get_template_part('template-parts/content', 'metabox'); 
  // get_template_part('template-parts/content-sidemenu'); 

	$today = date('Ymd');
  $pastKurse = new WP_Query(array(
  	'paged' => get_query_var('paged',1),
    'post_type' => 'kurs',
    'meta_key' => 'kurs_anmeldeschluss',
    'orderby' => 'meta_value',       //'rand'
    'order' => 'ASC',
    'meta_query' => array(
      array(
        'key' => 'kurs_anmeldeschluss',
        'compare' => '<',
        'value' => $today,
        'type' => 'numeric'
      )
    )
  ));

  	while($pastKurse->have_posts()) {
      $pastKurse->the_post();
      get_template_part('template-parts/content', 'kurs');

    }
    wp_reset_postdata();

  	echo paginate_links(array(
  		'total' => $pastEvents->max_num_pages
  	));
  ?>
	</div>

  <?php get_footer(); 

  ?>