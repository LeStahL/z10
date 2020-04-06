<?php get_header(); 

while(have_posts()) {
  the_post(); 
  pageBanner();
  ?>


  <div class="container container--narrow page-section"> <?php
    single_metabox(array(
      'parentUrl' => '/programm', 
      'parentName' => 'Programm'
    ));
    the_content(); 
    ?>

  </div>



  <?php }

get_footer(); ?>