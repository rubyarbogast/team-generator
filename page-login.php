<?php get_header(); ?> 

<h2>Log In</h2>
<div class='loginFormDiv flex-container'>
    <?php
    $args = array(
    'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . ('/wp-hockey-laptop-2/post-team'),
    'label_username' => __( 'Username' ),);
    ?>
    <?php wp_login_form( $args ); ?> 
</div>

<?php get_footer(); ?>