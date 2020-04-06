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

    <div class="acf-map">
      <?php $mapLocation = get_field('map_location'); ?> 
      <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
        <h3>Studentenzentrum Z10</h3>
        <?php echo $mapLocation['address'];?>
      </div>     
    </div>

  </div>

  <?php
$headers = 'From: admin <noreply@admin>';
$to = $_POST['email'];
$subject = 'Confirm';
// The unique token can be inserted in the message with %s
//$message = 'Thank you. Please <a href="http://localhost:3000/kontakt/?token=%s">confirm</a> to continue';

if ($isAllValid) {
  EmailConfirmation::send($to, $subject, $message, $headers);
}


}

get_footer(); ?>