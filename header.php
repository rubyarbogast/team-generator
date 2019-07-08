<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?><?php echo get_bloginfo('name'); ?></title> 

    <?php wp_head(); ?>

  </head>
  
  <body <?php body_class(); ?>>

<!--TODO: add navigation-->

  <h1><?php bloginfo('name'); ?></h1>