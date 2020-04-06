<?php

get_header();
pageBanner(); ?>

  <div class="container container--narrow page-section">	

  <?php 
  get_template_part('template-parts/content-sidemenu');   


  	$today = date('Ymd');
    $HomepageKurse = new WP_Query(array(
    	'paged' => get_query_var('paged',1),
      'post_type' => 'kurs',
      'meta_key' => 'kurs_anmeldeschluss',
      'orderby' => 'meta_value',       //'rand'
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'kurs_anmeldeschluss',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
        )
      )
    ));

  	while($HomepageKurse->have_posts()) {
  		$HomepageKurse->the_post();
      $kursID = get_the_ID();
			get_template_part('template-parts/content', 'kurs'); 
      wp_reset_postdata();
  	} ?>

    <?php
  	echo paginate_links(array(
  		'total' => $HomepageKurse->max_num_pages
  	));
    ?>

    <hr class="section-break">

    <p>Du möchtest vergangene Veranstaltungen ansehen? Dann schau dir unser <a href="<?php echo site_url('/kursarchiv')?>">Kursarchiv</a> an</p>
	</div>

  <?php get_footer(); 

  ?>