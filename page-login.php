<?php get_header(); ?> 

<h2>Log In</h2>

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
    <p class="login-remember">
        <label>
            <input id="rememberme" name="rememberme" type="checkbox" value="forever">Remember Me
        </label>
    </p>
    <p class="login-submit">
        <input type="submit" onclick="changeText()" name="wp-submit" id="registerUser" class="register-user" value="Log In" />
    </p>
    </form>
</div>

<?php
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if (strpos($url,'?')) {
    echo "<p class='error'>Username or password is incorrect. Please try again.</p>";
}

if(isset($_POST['wp-submit'])) {

    $user_name = $_POST['username'];
    $password = $_POST['password'];
    $rem_user = $_POST['rememberme'];

    $creds = array();
    $creds['user_login'] = $user_name;
    $creds['user_password'] = $password;
    $creds['remember'] = $rem_user;

    $user = wp_signon( $creds, false );
                
    wp_redirect( home_url('/post-team/') ); 
    exit;
}
?>

<?php get_footer(); ?>