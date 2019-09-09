<?php get_header(); ?> 

<h2>Register</h2>
<div class='loginFormDiv flex-container'>
    <form class='user-register' action="" method="post">
    <p class="login-username">
        <label for="username">Username</label>
        <input id="username" type="text" name="username">
    </p>
    <p class="login-password">
        <label for="password">Password</label>
        <input id="password" type="password" name="password">
    </p>
    <p class='italic'>
    Your username will be displayed with your posts.
    </p>
    <p class="login-remember">
        <label>
            <input id="rememberme" name="rememberme" type="checkbox" value="forever">Remember Me
        </label>
    </p>
    <p class="login-submit">
        <input type="submit" name="wp-submit" id="registerUser" class="register-user" value="Register" />
    </p>
    <?php wp_nonce_field( 'login-nonce', 'security' ); ?>
    </form>
</div>

<?php
if(isset($_POST['wp-submit'])) {
    $user_name = $_POST['username'];
    $password = $_POST['password'];

    //Insert the user
    $userdata = array(
        'user_pass' => $password,
        'user_login' => $user_name
    );
    $user_id = wp_insert_user( $userdata );

    if( is_wp_error( $user_id ) ) {
        $error_msg = $user_id->get_error_message();
        echo "<p class='error'>" . $error_msg . "</p>"; 
    } else {

        //After creating the user, sign them in
        $creds = array();
        $creds['user_login'] = $user_name;
        $creds['user_password'] = $password;
        $creds['remember'] = true;

        $user = wp_signon( $creds, false );
                    
        wp_redirect( home_url('/post-team/') ); 
        exit;
    }

}
?>

<?php get_footer(); ?>