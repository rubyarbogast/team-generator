<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"> 
    <title><?php wp_title('|', true, 'right'); ?><?php echo get_bloginfo('name'); ?></title> 

    <?php wp_head(); ?>

  </head>
  
  <body <?php body_class(); ?>>

<!--TODO: add div for mobile menu and div for desktop; show/hide with media queries in CSS -->
<!--TODO: figure out how to get each link on one line -->
<!--TODO: styles -->

<div class='mobile-menu'>
  <div class="menu">
    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <?php wp_nav_menu( array('theme_location' => is_user_logged_in() ? 'logged-in-menu' : 'logged-out-menu') ); ?> 
    </div>
    <span onclick="openNav()">open</span>
</div>
</div>

<div class='desktop-menu'>
<div class="menu">
      <?php wp_nav_menu( array('theme_location' => is_user_logged_in() ? 'logged-in-menu' : 'logged-out-menu') ); ?> 
    </div>
</div>


    <div id="pageContainer">
      <h1><?php bloginfo('name'); ?></h1>
      <p class=site-description><?php bloginfo('description') ?></p>