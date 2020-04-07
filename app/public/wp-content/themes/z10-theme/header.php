<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo('charset') ;?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class();?>>
  <header class="site-header">
    <div class="container">
      <h1 class="school-logo-text float-left"><a href="<?php echo site_url('');?>">
        <img class="site-header__menu-logo" src="<?php echo get_theme_file_uri('/images/Z10-Logo.png') ;?>">
      </a></h1>
      <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <ul>
            
            <?php header_main(array('name' => 'das-z10', 'id' => 10, 'slug' => '/das-z10', 'title' =>'Das Z10')); ?>
            <?php header_main(array('name' => 'programm', 'id' => 38, 'post_type' => 'event', 'slug' => '/programm', 'title' =>'Programm')); ?>
            <?php header_main(array('name' => 'kurse', 'id' => 150, 'post_type' => 'kurs', 'slug' => '/kurse', 'title' =>'Kurse')); ?>
            <?php header_main(array('name' => 'news', 'id' => 1000, 'slug' => '/news', 'title' =>'News')); ?>
            <?php header_main(array('name' => 'kontakt', 'id' => 50, 'slug' => '/kontakt', 'title' =>'Kontakt')); ?>
            <?php header_main(array('name' => 'helfen', 'id' => 1000 , 'slug' => '/helfen', 'title' =>'Helfen')); ?>
          </ul>
        </nav>
        <div class="site-header__util">
          <?php if(is_user_logged_in()) { ?>
            <a href="<?php echo esc_url(site_url('/meine-anmeldungen'));?>" class="btn btn--small  btn--dark-orange float-left push-right">Meine Kurse</a>
            <a href="<?php echo wp_logout_url(); ?>" class="btn btn--small  btn--orange float-left">Abmelden</a>
          <?php } else { ?>
            <a href="<?php echo wp_login_url(); ?>" class="btn btn--small  btn--orange float-left">Anmelden</a>
          <?php }
          ?>
          <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
      </div>
    </div>
  </header>


  