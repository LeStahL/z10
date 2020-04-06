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
    <?php 
    if (is_page('programm')) { ?>
      <p>Betreuer:
      <?php 
        $relatedMitglied = get_field('orga'); 
        foreach($relatedMitglied as $mitglied) { ?>
          <a href="<?php echo get_the_permalink($mitglied);?> "> <?php echo get_the_title($mitglied) ;?></a> 
        <?php } ?>
      </p> <?php 
    }?>
  </div>
</div>