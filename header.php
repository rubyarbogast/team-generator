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

    <div class="menu">
      <?php 
/*             $args = array(
              'menu'        => 'primary'
            );
            wp_nav_menu( $args ); */
          wp_nav_menu( array(
            'theme_location' => is_user_logged_in() ? 'logged-in-menu' : 'logged-out-menu'
        ) );
      ?> 

    </div>



    <div id="pageContainer">
      <h1><?php bloginfo('name'); ?></h1>
      <p class=site-description><?php bloginfo('description') ?></p>