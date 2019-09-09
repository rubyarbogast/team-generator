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

<?php 
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if (strpos($url,'?')) {
    echo "<p class='error'>Username or password is incorrect. Please try again.</p>";
} 
?>

<?php get_footer(); ?>