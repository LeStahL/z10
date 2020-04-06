<?php get_header(); 

while(have_posts()) {
	the_post(); 
  pageBanner();
  ?>

  <div class="container container--narrow page-section"> <?php
    single_metabox(array(
      'parentUrl' => '/news', 
      'parentName' => 'News',
      'title' => 'Am ' . get_the_time('d.n.y') . ' gepostet'
    ));

    the_content(); ?>


  </div>



	<?php }

get_footer(); ?>