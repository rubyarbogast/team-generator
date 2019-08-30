<?php get_header(); ?> 

<h2>Register</h2>
    <form class='user-register' action="" method="post">
    <p class="login-username">
        <label for="username">Username</label>
        <input id="username" type="text" name="username">
    </p>
    <p>
    Your username will display with your posts.
    </p>
    <p class="login-password">
        <label for="password">Password</label>
        <input id="password" type="password" name="password">
    </p>
    <p class="login-remember">
        <label>
            <input id="rememberme" name="rememberme" type="checkbox" value="forever">Remember Me
        </label>
    </p>
    <p class="login-submit">
        <input type="submit" name="wp-submit" id="register" class="register-user" value="Register" />
    </p>
    <?php wp_nonce_field( 'login-nonce', 'security' ); ?>

</form>

<?php
if(isset($_POST['wp-submit'])) {
    $user_name = $_POST['username'];
    $password = $_POST['password'];
        
    $user_id = username_exists( $user_name );

    if ( !$user_id ) {
        $user_id = wp_create_user( $user_name, $password );

        //After creating the user, sign them in
        $creds = array();
        $creds['user_login'] = $user_name;
        $creds['user_password'] = $password;
        $creds['remember'] = true;

        $user = wp_signon( $creds, false );
        if ( is_wp_error($user) )
            echo $user->get_error_message();
    } else {
        echo '<div class="error">That username is taken. Please choose a different one.</div>';
    }

    wp_redirect( home_url('/post-team/') ); exit;
}
?>

<?php get_footer(); ?>