<?php

get_header(); 

pageBanner();

?>
  <div class="container container--narrow page-section">	

<!--   <?php 
  get_template_part('template-parts/content', 'metabox');
  get_template_part('template-parts/content', 'sidemenu');
  ?> -->

  
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
    )); ?>

    <ul class="professor-cards">
    <?php   
  	while($aktiveMitglieder->have_posts()) {
  		$aktiveMitglieder->the_post(); ?>

			<?php
          // wp_reset_postdata();

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
		      )); 

          // wp_reset_postdata();

          $homepageKurse = new WP_Query(array(
            'posts_per_page' => -1,
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
              ),
              array(
                'key' => 'kurs_betreuer',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
              )
            )
          )); ?>

      <li class="professor-card__list-item">
        <a class='professor-card' href="<?php the_permalink(); ?>">
          <img class="professor-card__image" src="<?php the_post_thumbnail_url('mitgliedBild') ?>">
          <span class="professor-card__name"><?php the_title();?> (<?php echo get_field('name');?>)</span>
        </a>
        <?php 
        if($homepageEvents->have_posts() OR $homepageKurse->have_posts()){ ?>
              <p>Betreuer von</p>
            
                <ul>
                <?php 
                while($homepageEvents->have_posts()) {
                  $homepageEvents->the_post(); ?>
                      <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
                <?php } 
                while($homepageKurse->have_posts()) {
                  $homepageKurse->the_post(); ?>
                      <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
                <?php } ?>              
                </ul>
            <?php } ?>
      </li>

  	<?php } ?>
    </ul> <?php 
    wp_reset_postdata();
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
    )); ?>

    <ul class="professor-cards">
    <?php  

    while($ehemaligeMitglieder->have_posts()) {
      $ehemaligeMitglieder->the_post(); ?>

      <?php
          // wp_reset_postdata();

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
          )); 

          // wp_reset_postdata();

          $homepageKurse = new WP_Query(array(
            'posts_per_page' => -1,
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
              ),
              array(
                'key' => 'kurs_betreuer',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
              )
            )
          )); ?>

      <li class="professor-card__list-item">
        <a class='professor-card' href="<?php the_permalink(); ?>">
          <img class="professor-card__image" src="<?php the_post_thumbnail_url('mitgliedBild') ?>">
          <span class="professor-card__name"><?php the_title();?> (<?php echo get_field('name');?>)</span>
        </a>
        <?php 
        if($homepageEvents->have_posts() OR $homepageKurse->have_posts()){ ?>
              <p>Betreuer von</p>
            
                <ul>
                <?php 
                while($homepageEvents->have_posts()) {
                  $homepageEvents->the_post(); ?>
                      <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
                <?php } 
                while($homepageKurse->have_posts()) {
                  $homepageKurse->the_post(); ?>
                      <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
                <?php } ?>              
                </ul>
            <?php } ?>
      </li>

    <?php } ?>
    </ul> <?php
    wp_reset_postdata();
    ?>

	</div>

  <?php get_footer(); 

  ?>