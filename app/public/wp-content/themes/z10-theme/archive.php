<?php

get_header(); 
pageBanner(array(
  'title' => the_archive_title();
  'subtitle' => the_archive_description();
));
?>


  <div class="container container--narrow page-section">	
  <?php
  	while(have_posts()) {
  		the_post(); ?>
			<div class="post-item">
				<h2 class="headline headline--small"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
				<div class="metabox">
					<p>Am <?php the_time('d.n.y');?> gepostet</p>
				</div>

				<div class="generic-content">
					<?php the_content(); ?>
					<p><a class="btn btn--blue" href="<?php the_permalink(); ?>"></a></p>
				</div>	

			</div>

  	<?php }
  	echo paginate_links();
  ?>
	</div>

  <?php get_footer(); 

  ?>