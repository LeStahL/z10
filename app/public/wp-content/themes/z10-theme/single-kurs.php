<?php get_header(); 

while(have_posts()) {
  the_post();
  pageBanner();
   ?>


  <div class="container container--narrow page-section"> <?php
    single_metabox(array(
      'parentUrl' => '/kurse', 
      'parentName' => 'Kurse'
    )); ?>

    <p> <?php echo get_field('kurs_beschreibung'); ?> </p>


  </div>



  <?php }

get_footer(); ?>