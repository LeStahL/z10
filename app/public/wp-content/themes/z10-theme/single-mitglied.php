<?php get_header(); 

while(have_posts()) {
  the_post(); 
  pageBanner();
  ?>


  <div class="container container--narrow page-section"> <?php

    single_metabox(array(
      'parentUrl' => '/mitglieder', 
      'parentName' => 'Mitglieder'
    ));

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

      while($homepageEvents->have_posts()) {
        $homepageEvents->the_post(); ?>
        <div class="event-summary">
          <a class="event-summary__date t-center" href="#">
            <span class="event-summary__month"><?php
              $aMonthNamesDE = [
                  'Jan', 'Feb', 'Mrz', 'Apr', 'Mai', 'Jun',
                  'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'
              ];

              $eventDate = new DateTime(get_field('event_date'));
              echo $aMonthNamesDE[$eventDate->format('n')-1];
            ?></span>
            <span class="event-summary__day"><?php echo $eventDate->format('d') ;?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
            <p><?php echo wp_trim_words(get_the_content(), 18); ?><a href="<?php the_permalink();?>" class="nu gray">Learn more</a></p>
          </div>
        </div>
      <?php }
    ?>    

  </div>



  <?php }

get_footer(); ?>