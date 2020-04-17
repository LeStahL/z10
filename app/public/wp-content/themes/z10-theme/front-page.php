<?php 

get_header();
$aMonthNamesDElong = [
          'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
          'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
      ];   
 ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/seproSose20.png') ;?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <img class="page-banner__logo-image" src="<?php echo get_theme_file_uri('/images/Z10-Logo.png') ;?>">
      <h1 class="page-banner__title-front">Das Studentenzentrum von Studis für Studis</h1>
      <div class="page-banner__intro t-center">
        <p class="t-center">Kultur, Kommunikation, Konzerte, Kurse und viel mehr</p>
      </div>
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


  <div class="container">

    <h4 class="headline headline--tiny headline--post-section t-center p-top-large"><a href="<?php echo site_url('/programm');?>">/Programm</a></h4>
    <h2 class="headline headline--medium headline--post-title t-center"><a href="<?php echo site_url('/programm');?>">Kommende Veranstaltungen</a></h2>

      <div class="for_slick_slider multiple-items">
        <?php 
          while($homepageEvents->have_posts()) {
            $homepageEvents->the_post();
            $eventDate = new DateTime(get_field('event_date'));
            $id = "programm/#anchor-" . $post->post_name;
            ?>
        <div class="items">
          <a href="<?php echo $id;?>" class="slideImage nu" style="background-image: url(<?php echo get_field('event_image')['sizes']['large'];?>);">
            <span class="slideTitle">
              <h4 class="headline--tiny nu"><?php the_title();?></h4>
              <h5><?php echo $eventDate->format('j.n.Y');?></h5>
            </span>
            <!-- <div class="t-center slideDate" href="#"><span class="slideDay"><?php echo $eventDate->format('j.n.');
            ?></span>
              <span class="slideMonth" ><?php echo $eventDate->format('Y');
            ?></span>
            </div> -->
            
          </a>
        </div> 
        <?php
          }
        ?>
      </div>  
  </div>



  <div class="container container--narrow">
    <h4 class="headline headline--tiny headline--post-section t-center p-top-large"><a href="<?php echo site_url('/programm');?>">/News</a></h4>
    <h2 class="headline headline--medium headline--post-title t-center p-bottom-large"><a href="<?php echo site_url('/news');?>">Neuigkeiten aus dem Z10</a></h2>
    <?php 
      $homepagePosts = new WP_Query(array(
        'posts_per_page' => 2
        // 'category_name' => 'awards'
        // 'post_type' => 'pages'
      ));


      while ($homepagePosts->have_posts()) {
        $homepagePosts->the_post(); 

        $monthDelong = $aMonthNamesDElong[get_the_time('n')-1]; 
        $dateDe = get_the_time('d') . '. ' . $monthDelong . ' ' . get_the_time('Y'); ?>


        <div>
          <div class="event-summary__content">
            <h5 class=" headline headline--small"><a href="<?php echo site_url('/news') ;?>"><?php the_title() ;?></a></h5>
            <h6 class="headline--date"><?php echo $dateDe ;?></h6>
            <p class="p-bottom-large"><?php echo wp_trim_words(get_the_content(), 60); ?><a href="<?php echo site_url('/news') ;?>" class="nu gray"> Weiterlesen</a></p>
          </div>
        </div>
      <?php } 

    ?>
    
    <p class="t-center no-margin"><a href="<?php echo site_url('/news'); ?>" class="btn btn--lightorange">Mehr</a></p>
  </div>


<?php get_footer();
?>