<!-- define variables -->

<?php 
$eventDate = new DateTime(get_field('event_date'));
$aMonthNamesDE = [
        'Jan', 'Feb', 'Mrz', 'Apr', 'Mai', 'Jun',
        'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'
    ];

$aMonthNamesDElong = [
    'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
    'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
]; 


$monthDe = $aMonthNamesDE[$eventDate->format('n')-1]; 
$monthDelong = $aMonthNamesDElong[$eventDate->format('n')-1]; 
$dateDe = $eventDate->format('d') . '. ' . $monthDelong . ' ' . $eventDate->format('Y');
$id = "anchor-" . $post->post_name;
$eventImage = get_field('event_image') ['sizes'] ['eventBild'];
?>

<!-- html -->


<span id="<?php echo $id ;?>" style="visibility: hidden; margin:0; padding:0;"><?php echo $id;?></span>
<div class="event-template">
  <div class="event-template__image" style="background-image: url(<?php echo $eventImage ;?>);">  
  </div> 

  <div class="event-template__content">
    <div class="event-template__header">
      <div class="event-template__title">
        <h3 class="headline headline--large-medium"><?php echo get_the_title();?></h3>
        <h6 class="headline--date"><?php echo $dateDe ;?></h6>
      </div> 
      <a class="event-template__date t-center">
        <span class="event-template__day"><?php echo $eventDate->format('d');?>.</span>  
        <span class="event-template__month">
          <?php echo $monthDe; ?>
        </span>
      </a>
    </div>
    <div class="event-template__text">
      <p>
        <?php the_content();?>
      </p>
    </div>
  </div>  
</div>