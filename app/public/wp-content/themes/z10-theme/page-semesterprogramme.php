<?php get_header(); 

while(have_posts()) {
	the_post(); 
  pageBanner();
  ?>
	


  <div class="container container--narrow page-section">

  

		<div class="page-banner">
	  <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'] ;?>);"></div>



    <section class="slider-area slider">
      <div><img src="http://localhost:3000/wp-content/uploads/2020/04/NR42-500x540.jpeg"></div>
      <div><img src="http://localhost:3000/wp-content/uploads/2020/04/NR42-500x540.jpeg"></div>
      <div><img src="http://localhost:3000/wp-content/uploads/2020/04/NR42-500x540.jpeg"></div>
      <div><img src="http://localhost:3000/wp-content/uploads/2020/04/NR42-500x540.jpeg"></div>
      <div><img src="http://localhost:3000/wp-content/uploads/2020/04/NR42-500x540.jpeg"></div>
    </section>


    <div class="generic-content">
      <?php the_content(); ?>
    </div> 
  </div>


	<?php
}


get_footer(); ?>