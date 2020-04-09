<?php

$aMonthNamesDElong = [
          'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
          'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
      ]; 

get_header(); 
pageBanner(array(
  'title' => 'News',
  'subtitle' => 'Die neuesten Neuigkeiten'
));
?>


  <div class="container container--narrow page-section">	
  <?php
  	while(have_posts()) {
  		the_post(); 
      $monthDelong = $aMonthNamesDElong[get_the_time('n')-1]; 
      $dateDe = get_the_time('d') . '. ' . $monthDelong . ' ' . get_the_time('Y'); ?>

			<div class="post-item">
				<h2 class="headline headline--medium"><?php the_title();?></h2>
				<h6 class="headline--date"><?php echo $dateDe ;?></h6>
				

				<div class="generic-content">
					<?php the_content(); ?>
				</div>	

			</div>

  	<?php }
  	echo paginate_links();
  ?>
	</div>

  <?php get_footer(); 

  ?>