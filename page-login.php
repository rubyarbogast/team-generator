<?php get_header(); ?> 

<!--     <form id="login" action="../post-team" method="post">
        <h1>Site Login</h1>
        <p class="status"></p>
        <label for="username">Username</label>
        <input id="username" type="text" name="username">
        <label for="password">Password</label>
        <input id="password" type="password" name="password">
        <a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Lost your password?</a>
        <input class="submit_button" type="submit" value="Login" name="submit">
        <a class="close" href="">(close)</a>
        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
    </form> -->
    
    <?php
        $args = array(
        'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . ('/wp-hockey-laptop-2/post-team'),
        'label_username' => __( 'Username' ),
    );
    ?>
    <?php wp_login_form( $args ); ?> 

<?php get_footer(); ?>