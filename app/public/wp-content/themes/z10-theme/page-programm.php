<?php

get_header();

pageBanner();  ?>

  <div class="container container--narrow page-section">  
    
    <?php
    get_template_part('template-parts/content-sidemenu');

    $today = date('Ymd');
    $HomepageEvents = new WP_Query(array(
      'paged' => get_query_var('paged',1),
      'post_type' => 'event',
      'meta_key' => 'event_date',
      'orderby' => 'meta_value',       //'rand'
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
        )
      )
    ));

    while($HomepageEvents->have_posts()) {
      $HomepageEvents->the_post();
      get_template_part('template-parts/content', 'event');
    }
    echo paginate_links(array(
      'total' => $HomepageEvents->max_num_pages
    )); ?>

    <hr class="section-break">

    <p>Du möchtest vergangene Veranstaltungen ansehen? Dann schau dir unser <a href="<?php echo site_url('/terminarchiv')?>">Terminarchiv</a> an</p>
  </div>



  <?php get_footer(); 

  ?>