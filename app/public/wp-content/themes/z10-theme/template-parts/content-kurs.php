
<?php 

if ($pastKurse) {
        echo "hallo";
      }


$anmeldungCount = new WP_Query(array(
  'post_type' => 'anmeldung', 
  'meta_query' => array(
    array(
      'key' => 'kursanmeldung_id',
      'compare' => '=',
      'value' => get_the_ID()
    )
  )
));

$anmeldungpostCount = $anmeldungCount->found_posts;

$existStatus= 'no';

if (is_user_logged_in()) {
  $existQuery = new WP_Query(array(
    'author' => get_current_user_id(),
    'post_type' => 'anmeldung', 
    'meta_query' => array(
      array(
        'key' => 'kursanmeldung_id',
        'compare' => '=',
        'value' => get_the_ID()
      )
    )
  ));

  if ($existQuery->found_posts) {
    $existStatus = 'yes';
  }
}

?>


<!-- <div class="kurs-summary">
  <a class="kurs-summary__date t-center" href="#">
    <span class="kurs-summary__month"><?php
      $aMonthNamesDE = [
          'Jan', 'Feb', 'Mrz', 'Apr', 'Mai', 'Jun',
          'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'
      ];

      $kursDate = new DateTime(get_field('kurs_anmeldeschluss'));
      echo $aMonthNamesDE[$kursDate->format('n')-1];
    ?></span>
    <span class="kurs-summary__day"><?php echo $kursDate->format('d') ;?></span>  
  </a>

  <div class="kurs-summary__content">
    <h5 class="kurs-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
    <p><?php echo wp_trim_words(get_the_content(), 18); ?><a href="<?php the_permalink();?>" class="nu gray">Learn more</a></p>
    <p>Betreuer:
    <?php 
      $relatedMitglied = get_field('kurs_betreuer'); 
      foreach($relatedMitglied as $mitglied) { ?>
        <a href="<?php echo get_the_permalink($mitglied);?> "> <?php echo get_the_title($mitglied) ;?></a> 
      <?php } ?>
     </p>
     <p>Gebühr: <?php echo get_field('kurs_gebuhr');?> &#8364; </p>
     <p>max. Teilnehmerzahl: <?php echo get_field('kurs_teilnehmeranzahl');?> Personen </p>
     <p>Anmeldeschluss: <?php echo get_field('kurs_anmeldeschluss');?></p>
     
     <div class="generic-content">
      <div class="one-third">
        <span class="like-box" data-anmeldung="<?php echo $existQuery->posts[0]->ID; ?>" data-kurs="<?php the_ID(); ?>" data-exists="<?php echo $existStatus; ?>">
          <i class="fa fa-heart-o" aria-hidden="true"> </i>
          <i class="fa fa-heart" aria-hidden="true"> </i>
          <span class="like-count"><?php echo $anmeldungpostCount;?></span>
        </span>
      </div>
    </div>

  </div>
</div> -->


<!-- define variables -->
<?php 
$kursDate = new DateTime(get_field('kurs_anmeldeschluss'));
$aMonthNamesDE = [
        'Jan', 'Feb', 'Mrz', 'Apr', 'Mai', 'Jun',
        'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'
    ];

$aMonthNamesDElong = [
    'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
    'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
]; 


$monthDe = $aMonthNamesDE[$kursDate->format('n')-1]; 
$monthDelong = $aMonthNamesDElong[$kursDate->format('n')-1]; 
$dateDe = $kursDate->format('d') . '. ' . $monthDelong . ' ' . $kursDate->format('Y');
$id = "anchor-" . $post->post_name;
$kursImage = get_field('kurs_image') ['sizes'] ['eventBild'];
$teilnehmer = get_field('kurs_teilnehmeranzahl') . " Teilnehmern";
$gebuhr = get_field('kurs_gebuhr') . "&#8364";
?>


<span id="<?php echo $id ;?>" style="visibility: hidden; margin:0; padding:0;"><?php echo $id;?></span>

  <div class="kurs-template__image" style="background-image: url(<?php echo $kursImage ;?>);">  
  </div> 

  <div class="kurs-template__content">
    <div class="kurs-template__header">
      <div class="kurs-template__title">
        <h3 class="headline headline--large-medium"><?php echo get_the_title();?></h3>
        <ul style="padding:0">
          <li class="headline--kurs">Anmeldeschluss: <?php echo $kursDate->format('d.m.y');?></li>
          <li class="headline--kurs"> <?php echo $anmeldungpostCount;?>
          / <?php echo $teilnehmer;?> angemeldet</li>
          <li class="headline--kurs">Beitrag: <?php echo $gebuhr ;?></li>
          <li class="headline--kurs">Betreuer:
          <?php 
          $relatedMitglied = get_field('kurs_betreuer'); 
          foreach($relatedMitglied as $mitglied) { ?>
            <a class="kurs-template__link nu" href="<?php echo get_the_permalink($mitglied);?> "> <?php echo get_the_title($mitglied) ;?></a> 
          <?php } ?>
          </li>
        </ul>
      </div> 
    </div>
    <div class="kurs-template__text">
      <p>
        <?php echo get_field('kurs_beschreibung');?>
      </p>
    </div>  
  </div>
     
  <?php

  if (!$pastKurs) { ?>
  <span class="like-box" data-anmeldung="<?php echo $existQuery->posts[0]->ID; ?>" data-kurs="<?php the_ID(); ?>" data-exists="<?php echo $existStatus; ?>">
      <i class="fa fa-heart-o" aria-hidden="true"> </i>
      <i class="fa fa-heart" aria-hidden="true"> </i>
      <span class="padding-left: 10px;">Anmelden</span>
    </span>
    <?php }?>      

  
</div>