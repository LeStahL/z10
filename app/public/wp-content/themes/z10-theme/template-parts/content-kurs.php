
        <?php 
        $anmeldungCount = new WP_Query(array(
          'post_type' => 'anmeldung', 
          'meta_query' => array(
            array(
              'key' => 'kursanmeldung_id',
              'compare' => '=',
              'value' => get_the_ID()
            )
          )
        ));

        $anmeldungpostCount = $anmeldungCount->found_posts;

        $existStatus= 'no';

        if (is_user_logged_in()) {
          $existQuery = new WP_Query(array(
            'author' => get_current_user_id(),
            'post_type' => 'anmeldung', 
            'meta_query' => array(
              array(
                'key' => 'kursanmeldung_id',
                'compare' => '=',
                'value' => get_the_ID()
              )
            )
          ));

          if ($existQuery->found_posts) {
            $existStatus = 'yes';
          }
        }

        
        
        ?>


<div class="event-summary">
  <a class="event-summary__date t-center" href="#">
    <span class="event-summary__month"><?php
      $aMonthNamesDE = [
          'Jan', 'Feb', 'Mrz', 'Apr', 'Mai', 'Jun',
          'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'
      ];

      $eventDate = new DateTime(get_field('kurs_anmeldeschluss'));
      echo $aMonthNamesDE[$eventDate->format('n')-1];
    ?></span>
    <span class="event-summary__day"><?php echo $eventDate->format('d') ;?></span>  
  </a>

  <div class="event-summary__content">
    <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
    <p><?php echo wp_trim_words(get_the_content(), 18); ?><a href="<?php the_permalink();?>" class="nu gray">Learn more</a></p>
    <p>Betreuer:
    <?php 
      $relatedMitglied = get_field('kurs_betreuer'); 
      foreach($relatedMitglied as $mitglied) { ?>
        <a href="<?php echo get_the_permalink($mitglied);?> "> <?php echo get_the_title($mitglied) ;?></a> 
      <?php } ?>
     </p>
     <p>Gebühr: <?php echo get_field('kurs_gebuhr');?> &#8364; </p>
     <p>max. Teilnehmerzahl: <?php echo get_field('kurs_teilnehmeranzahl');?> Personen </p>
     <p>Anmeldeschluss: <?php echo get_field('kurs_anmeldeschluss');?></p>
     
     <div class="generic-content">
      <div class="one-third">
        <span class="like-box" data-anmeldung="<?php echo $existQuery->posts[0]->ID; ?>" data-kurs="<?php the_ID(); ?>" data-exists="<?php echo $existStatus; ?>">
          <i class="fa fa-heart-o" aria-hidden="true"> </i>
          <i class="fa fa-heart" aria-hidden="true"> </i>
          <span class="like-count"><?php echo $anmeldungpostCount;?></span>
        </span>
      </div>
    </div>

  </div>
</div>