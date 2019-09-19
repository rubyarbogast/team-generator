<?php get_header(); ?> 

<h2>Register</h2>
<div class='loginFormDiv flex-container'>
    <form class='user-register' action="" method="post">
    <p class="login-username">
        <label for="log">Username</label>
        <input id="log" type="text" name="log">
    </p>
    <p class="login-password">
        <label for="pwd">Password</label>
        <input id="pwd" type="password" name="pwd">
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
        <input type="submit" onclick="changeText()" name="wp-submit" id="registerUser" class="register-user" value="Register" />
    </p>
    </form>
</div>

<?php get_footer(); ?>