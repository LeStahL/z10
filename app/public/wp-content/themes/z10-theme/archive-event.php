<?php

get_header(); ?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/generic_background_1.jpg');?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Events</h1>
      <div class="page-banner__intro">
        <p>Konzerte, Krümel, Partys, Kurse & mehr</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">	
  <?php
  	while(have_posts()) {
  		the_post(); ?>
			<div class="event-summary">
        <a class="event-summary__date t-center" href="#">
          <span class="event-summary__month"><?php
            $aMonthNamesDE = [
                'Jan', 'Feb', 'Mrz', 'Apr', 'Mai', 'Jun',
                'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'
            ];

            $eventDate = new DateTime(get_field('event_date'));
            echo $aMonthNamesDE[$eventDate->format('n')-1];
          ?></span>
          <span class="event-summary__day"><?php echo $eventDate->format('d') ;?></span>  
        </a>
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
          <p><?php echo wp_trim_words(get_the_content(), 18); ?><a href="<?php the_permalink();?>" class="nu gray">Learn more</a></p>
        </div>
      </div>

  	<?php }
  	echo paginate_links();
  ?>

  <hr class="section-break">

  <p>Du möchtest vergangene Veranstaltungen ansehen? Dann schau dir unser <a href="<?php echo site_url('/terminarchiv')?>">Terminarchiv</a> an</p>
	</div>

  <?php get_footer(); 

  ?>