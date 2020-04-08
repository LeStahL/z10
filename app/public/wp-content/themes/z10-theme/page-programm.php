<?php

get_header();

pageBanner();  ?>

  <div class="container container--narrow page-section">  
  
  <?php

    $aMonthNamesDE = [
          'Jan', 'Feb', 'Mrz', 'Apr', 'Mai', 'Jun',
          'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'
      ];

     $aMonthNamesDElong = [
          'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
          'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
      ]; 

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

      $eventDate = new DateTime(get_field('event_date'));
      $monthDe = $aMonthNamesDE[$eventDate->format('n')-1]; 
      $monthDelong = $aMonthNamesDElong[$eventDate->format('n')-1]; 
      $dateDe = $eventDate->format('d') . '. ' . $monthDelong . ' ' . $eventDate->format('Y');
      ?>

      <?php $eventImage = get_field('event_image') ['sizes'] ['eventBild']; ?>
      
      <div class="event-template">
      <div class="event-template__image" style="background-image: url(<?php echo $eventImage ;?>);">  
      </div> 
      
      <div class="event-template__content">
        <div class="event-template__header">
          <div class="event-template__title">
            <h3 class="headline headline--large-medium"><?php echo get_the_title();?></h3>
            <h6 class="headline--date"><?php echo $dateDe ;?></h6>
          </div> 
          <a class="event-template__date t-center">
            <span class="event-template__day"><?php echo $eventDate->format('d');?>.</span>  
            <span class="event-template__month">
              <?php echo $monthDe; ?>
            </span>
          </a>
        </div>
        <div class="event-template__text">
          <p>
            <?php the_content();?>
          </p>
        </div>
      </div>
       
    </div>






    <?php

    }
    echo paginate_links(array(
      'total' => $HomepageEvents->max_num_pages
    )); ?>

    <hr class="section-break">

    <p>Du möchtest vergangene Veranstaltungen ansehen? Dann schau dir unser <a href="<?php echo site_url('/terminarchiv')?>">Terminarchiv</a> an</p>


    
    </div>



  <?php get_footer(); 

  ?>