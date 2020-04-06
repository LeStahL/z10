<?php get_header(); 

while(have_posts()) {
	the_post(); 
  pageBanner();
  ?>
	


  <div class="container container--narrow page-section">

  	<?php 
    get_template_part('template-parts/content', 'metabox');
    get_template_part('template-parts/content-sidemenu');  	
  	
    ?>

    <div class="generic-content">
      <?php the_content(); ?>
    </div> 
  </div>


	<?php }

get_footer(); ?>