<?php 

get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/seproSose20.png') ;?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <img class="page-banner__logo-image" src="<?php echo get_theme_file_uri('/images/Z10-Logo.png') ;?>">
      <h1 class="headline headline--medium">Das Studentenzentrum von Studis für Studis</h1>
      <h3 class="headline headline--small">oder auch die Kneipe, die keine Kneipe ist</h3>
      <!-- <a href="#" class="btn btn--large btn--blue">Find Your Major</a> -->
    </div>
  </div>

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
        )
      )
    )); ?>


  <div class="container" style="margin-bottom: 50px;">

    <h2 class="headline headline--medium headline--post-title t-center"><a href="<?php echo site_url('/programm');?>">Kommende Veranstaltungen</a></h2>

      <div class="for_slick_slider multiple-items">
        <?php 
          while($homepageEvents->have_posts()) {
            $homepageEvents->the_post();
            $eventDate = new DateTime(get_field('event_date'));
            ?>
        <div class="items">
          <a href="<?php the_permalink();?>" class="slideImage nu" style="background-image: url(<?php echo get_field('event_image')['sizes']['large'];?>);">
            <span class="slideTitle headline--tiny nu"><?php the_title();?></span>
            <div class="t-center slideDate" href="#"><span class="slideDay"><?php echo $eventDate->format('j.n.');
            ?></span>
              <span class="event-summary__month" ><?php echo $eventDate->format('Y');
            ?></span>
            </div>
            
          </a>
        </div> 
        <?php
          }
        ?>
      </div>  
  </div>



  <div class="container container--narrow">
        
        <h2 class="headline headline--medium headline--post-title t-center"><a href="<?php echo site_url('/news');?>">News</a></h2>
        <?php 
          $homepagePosts = new WP_Query(array(
            'posts_per_page' => 2
            // 'category_name' => 'awards'
            // 'post_type' => 'pages'
          ));


          while ($homepagePosts->have_posts()) {
            $homepagePosts->the_post(); ?>
            <div class="event-summary">
              <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink() ;?>">
                <span class="event-summary__month"><?php the_time('M') ;?></span>
                <span class="event-summary__day"><?php the_time('d') ;?></span>  
              </a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ;?>"><?php the_title() ;?></a></h5>
                <p><?php echo wp_trim_words(get_the_content(), 18); ?><a href="<?php the_permalink() ;?>" class="nu gray"> Read more</a></p>
              </div>
            </div>
          <?php } 

        ?>
        
        <p class="t-center no-margin"><a href="<?php echo site_url('/news'); ?>" class="btn btn--yellow">Mehr</a></p>
  </div>


<?php get_footer();
?>






