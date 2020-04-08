<?php get_header(); 

while(have_posts()) {
	the_post(); 
  pageBanner();
  ?>
	


  <div class="container container--narrow page-section">

  

		<div class="page-banner">
	  <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'] ;?>);"></div>





    <div class="generic-content">
      <?php the_content(); ?>
    </div> 
  </div>


	<?php
}


get_footer(); ?>