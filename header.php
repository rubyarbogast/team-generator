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

    <div class='mobile-menu'>
      <div class='menu'>
        <div id="mySidenav" class="sidenav">
          <?php if(is_user_logged_in()): ?>
            <a href="javascript:void(0)" class="closebtn-logged-in" onclick="closeNav()">&times;</a>
          <?php else: ?>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <?php endif; ?>
          <?php wp_nav_menu( array('theme_location' => is_user_logged_in() ? 'logged-in-menu' : 'logged-out-menu') ); ?> 
        </div>
        <span class="menu-icon" onclick="openNav()">&#9776;</span>
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