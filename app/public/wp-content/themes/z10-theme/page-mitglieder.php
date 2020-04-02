<?php

get_header(); ?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/generic_background_1.jpg');?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Mitglieder</h1>
      <div class="page-banner__intro">
        <p>Die Menschen, die alles hier erst möglich machen.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">	
  	<h2 class="headline headline--small-plus">Aktive Mitglieder</h2>
	  <?php

    $aktiveMitglieder = new WP_Query(array(
    	'posts_per_page' => -1,
    	'paged' => get_query_var('paged',1),
      'post_type' => 'mitglied',
      'orderby' => 'rand',       //'rand'
      'meta_query' => array(
        array(
          'key' => 'aktives_mitglied',
          'compare' => '=',
          'value' => 1,
        )
      )
    ));

  	while($aktiveMitglieder->have_posts()) {
  		$aktiveMitglieder->the_post(); ?>

			<?php
		      $today = date('Ymd');
		      $homepageEvents = new WP_Query(array(
		        'posts_per_page' => -1,
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
		          ),
		          array(
		            'key' => 'orga',
		            'compare' => 'LIKE',
		            'value' => '"' . get_the_ID() . '"'
		          )
		        )
		      )); ?>

			<div class="event-summary">
        <a class="event-summary__date t-center" href="#">
          <span class="event-summary__month"><?php the_title(); ?></span>  
        </a>
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><?php echo get_field('name'); ?></h5>
          <?php 
          if($homepageEvents->have_posts()){ ?>
          	<p>Orga von</p>
          
				      <ul>
				      <?php	
				      while($homepageEvents->have_posts()) {
				        $homepageEvents->the_post(); ?>
				            <li class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
				      <?php } ?>
				      </ul>
        	<?php } ?>

        </div>
      </div>

  	<?php } wp_reset_postdata();
  	?>

	  <hr class="section-break">

	  <h2 class="headline headline--small-plus">Ehemalige Mitglieder</h2>
	  <?php

    $ehemaligeMitglieder = new WP_Query(array(
    	'posts_per_page' => -1,
    	'paged' => get_query_var('paged',1),
      'post_type' => 'mitglied',
      'orderby' => 'rand',       //'rand'
      'meta_query' => array(
        array(
          'key' => 'aktives_mitglied',
          'compare' => '!=',
          'value' => 1,
        )
      )
    ));

  	while($ehemaligeMitglieder->have_posts()) {
  		$ehemaligeMitglieder->the_post(); ?>	

			<div class="event-summary">
        <a class="event-summary__date t-center" href="#">
          <span class="event-summary__month"><?php the_title(); ?></span>  
        </a>
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"> <?php echo get_field('name'); ?></h5>          
        </div>
      </div>

  	<?php } wp_reset_postdata();
  	?>


	</div>

  <?php get_footer(); 

  ?>