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
      <h1 class="school-logo-text float-left"><a href="<?php echo site_url('');?>">Studentenzentrum <strong>Z10</strong></a></h1>
      <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <ul>
            <li <?php if (is_page('das-z10') or wp_get_post_parent_id(0)== 10) echo 'class="current-menu-item"' ;?>><a href="<?php echo site_url('/das-z10');?>">Das Z10</a></li>
            <li <?php if (is_page('programm') or wp_get_post_parent_id(0)== 38 or get_post_type() == 'event') echo 'class="current-menu-item"' ;?>><a href="<?php echo site_url('/programm');?>">Programm</a></li>
            <li <?php if (is_page('kurse') or wp_get_post_parent_id(0)== 150 or get_post_type() == 'kurs') echo 'class="current-menu-item"' ;?>><a href="<?php echo site_url('/kurse');?>">Kurse</a></li>
            <li <?php if (is_page('news')) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/news'); ?>">News</a></li>
            <li <?php if (is_page('kontakt') or wp_get_post_parent_id(0)== 50) echo 'class="current-menu-item"' ;?>><a href="<?php echo site_url('/kontakt');?>">Kontakt</a></li>
          </ul>
        </nav>
        <div class="site-header__util">
          <?php if(is_user_logged_in()) { ?>
            <a href="<?php echo esc_url(site_url('/meine-anmeldungen'));?>" class="btn btn--small  btn--dark-orange float-left push-right">Meine Anmeldungen</a>
            <a href="<?php echo wp_logout_url();?>" class="btn btn--small  btn--orange float-left push-right btn--with-photo">
            <span class="site-header__avatar"><?php echo get_avatar(get_current_user_id(), 60);?></span>
            <span class="btn__text">Abmelden</span>
             </a>
          <?php } else { ?>
            <a href="<?php echo wp_registration_url();?>" class="btn btn--small  btn--dark-orange float-left push-right">Registrieren</a>
            <a href="<?php echo wp_login_url(); ?>" class="btn btn--small  btn--orange float-left push-right">Anmelden</a>
          <?php }
          ?>
          
          <a href="#" class="btn btn--small  btn--orange float-left">Mitmachen</a>
          <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
      </div>
    </div>
  </header>