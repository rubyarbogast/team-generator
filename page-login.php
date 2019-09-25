<?php get_header(); ?> 

<h2>Log In</h2>

<?php 
$args = array(
	'echo'           => true,
	'remember'       => true,
	'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . '/oneforone/post-team/',
	'form_id'        => 'loginform',
	'id_username'    => 'user_login',
	'id_password'    => 'user_pass',
	'id_remember'    => 'rememberme',
	'id_submit'      => 'wp-submit',
	'label_username' => __( 'Username' ),
	'label_password' => __( 'Password' ),
	'label_remember' => __( 'Remember Me' ),
	'label_log_in'   => __( 'Log In' ),
	'value_username' => '',
	'value_remember' => false
); ?>

<div class='loginFormDiv flex-container'>

<?php wp_login_form($args); ?>

</div>

<?php $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if (strpos($url,'?')) {
    echo "<p class='error'>Username or password is incorrect. Please try again.</p>";
}

?>

<!-- <div class='loginFormDiv flex-container'>

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
</div> -->

<?php
/* $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

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
                
    $redirect_to = 'http://rubyarbogast.com/oneforone/post-team/';
    wp_safe_redirect($redirect_to);

    exit;
} */
?>

<?php get_footer(); ?>