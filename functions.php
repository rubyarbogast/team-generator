<?php
add_theme_support( 'menus' );

//Prevent offensive words from being used in usernames
function rma_illegal_user_logins( $banned ) {
    $banned = include_once( get_template_directory() . '/banned-words.php' );
    return $banned;
}
add_filter( 'illegal_user_logins', 'rma_illegal_user_logins' );

//Session use
function start_session() {
    //If the user clicks "post" and there's no session ID
    if(!session_id()) {
        session_start();
    }
}
add_action('init', 'start_session', 1);

function end_session() {
    session_destroy ();
}
add_action('wp_logout','end_session');
add_action('end_session_action','end_session');

//Enqueue scripts
function rma_enqueue_get_team() {
    wp_enqueue_script( 'ajax-team', get_template_directory_uri() . '/js/site-scripts/ajax-team.js', array('jquery') );
    wp_localize_script( 'ajax-team', 'nhl_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'rma_enqueue_get_team' );

function rma_enqueue_post_team(){
    wp_enqueue_script( 'ajax-post', get_template_directory_uri() . '/js/site-scripts/ajax-post.js', array('jquery') );
    wp_localize_script( 'ajax-post', 'post_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'rma_enqueue_post_team' );

function rma_scripts() {
    wp_enqueue_script( 'cancelPostLoggedIn', get_stylesheet_directory_uri() . '/js/site-scripts/scripts.js', array(), true );
    wp_enqueue_script( 'cancelLogin', get_stylesheet_directory_uri() . '/js/site-scripts/scripts.js', array(), true );
    wp_enqueue_script( 'loggedInOptions', get_stylesheet_directory_uri() . '/js/site-scripts/scripts.js', array(), true );
    wp_enqueue_script( 'changeText', get_stylesheet_directory_uri() . '/js/site-scripts/scripts.js', array(), true );
    wp_enqueue_script( 'openNav', get_stylesheet_directory_uri() . '/js/site-scripts/nav-menu.js', array(), true );
    wp_enqueue_script( 'closeNav', get_stylesheet_directory_uri() . '/js/site-scripts/nav-menu.js', array(), true );
}
add_action( 'wp_enqueue_scripts', 'rma_scripts' );

//Enqueue styles
function rma_theme_styles() {	
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'rma_theme_styles' );

//Register custom navigation menus
function rma_register_menu() {
    register_nav_menu( 'logged-in-menu', __( 'Logged In Menu' ) );
    register_nav_menu( 'logged-out-menu', __( 'Logged Out Menu') );
}
add_action( 'init', 'rma_register_menu' );

//Change the default registration form link
function my_register_page( $register_url ) {
    return home_url( '/register/' );
}
add_filter( 'register_url', 'my_register_page' );

function rma_login_fail( $username ) {
     $referrer = $_SERVER['HTTP_REFERER'];
     //If the referrer is valid and is not the default log-in screen
     if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
          wp_redirect(home_url( '/login' ) . '?login=failed' );
          exit;
     }
}
add_action( 'wp_login_failed', 'rma_login_fail' ); 

//Send an AJAX query to the DB; save and output the results to the browser
function get_team() {
    if($_SERVER['REQUEST_METHOD'] == 'GET') { 
        global $wpdb;

        //ARRAY_A outputs numerically indexed array of associative arrays with column names as keys
        $lw_result_array = $wpdb->get_results( "SELECT lw.name, lw.nhlId, lw.number, lw.teamAbbr FROM rma_all_players AS lw WHERE position = 'Left Wing' AND active = 1 ORDER BY rand() LIMIT 4", ARRAY_A );
        $c_result_array = $wpdb->get_results( "SELECT c.name, c.nhlId, c.number, c.teamAbbr FROM rma_all_players AS c WHERE position = 'Center' AND active = 1 ORDER BY rand() LIMIT 4", ARRAY_A );
        $rw_result_array = $wpdb->get_results( "SELECT rw.name, rw.nhlId, rw.number, rw.teamAbbr FROM rma_all_players AS rw WHERE position = 'Right Wing' AND active = 1 ORDER BY rand() LIMIT 4", ARRAY_A );
        $d_result_array = $wpdb->get_results( "SELECT d.name, d.nhlId, d.number, d.teamAbbr FROM rma_all_players AS d WHERE position = 'Defenseman' AND active = 1 ORDER BY rand() LIMIT 6", ARRAY_A );
        $g_result_array = $wpdb->get_results( "SELECT g.name, g.nhlId, g.number, g.teamAbbr FROM rma_all_players AS g WHERE position = 'Goalie' AND active = 1 ORDER BY rand() LIMIT 2", ARRAY_A );

        //Save arrays to session to hold data if user wants to post a team and isn't logged in
        $_SESSION['lw_array'] = $lw_result_array;
        $_SESSION['c_array'] = $c_result_array;
        $_SESSION['rw_array'] = $rw_result_array;
        $_SESSION['d_array'] = $d_result_array;
        $_SESSION['g_array'] = $g_result_array;

        //If the data is missing, show an error message. Otherwise, output the team 
        if(!$lw_result_array || !$c_result_array || !$rw_result_array || !$d_result_array || !$g_result_array) {
            echo "<h2>Oops! Something went wrong ...</h2>";
        } else {

            echo "<div class='team'>
            
            <h2>Forwards</h2>

            <div class='flex-container row'>

            <div class='player forward col-4'>" . $lw_result_array[0][name][0] . ". " . strstr(($lw_result_array[0][name]), ' ') . "<p>#" . $lw_result_array[0][number] . " " . $lw_result_array[0][teamAbbr] . " " . "</div>
            <div class='player forward col-4'>" . $c_result_array[0][name][0] . ". " . strstr(($c_result_array[0][name]), ' ') . "<p>#" . $c_result_array[0][number] . " " . $c_result_array[0][teamAbbr] . " " . "</div>
            <div class='player forward col-4'>". $rw_result_array[0][name][0] . ". " . strstr(($rw_result_array[0][name]), ' ') . "<p>#" . $rw_result_array[0][number] . " " . $rw_result_array[0][teamAbbr] . "</div>
            
            </div>

            <div class='flex-container row'>

            <div class='player forward col-4'>" . $lw_result_array[1][name][0] . ". " . strstr(($lw_result_array[1][name]), ' ') . "<p>#" . $lw_result_array[1][number] . " " . $lw_result_array[1][teamAbbr] . " " . "</div>
            <div class='player forward col-4'>" . $c_result_array[1][name][0] . ". " . strstr(($c_result_array[1][name]), ' ') . "<p>#" . $c_result_array[1][number] . " " . $c_result_array[1][teamAbbr] . " " . "</div>
            <div class='player forward col-4'>". $rw_result_array[1][name][0] . ". " . strstr(($rw_result_array[1][name]), ' ') . "<p>#" . $rw_result_array[1][number] . " " . $rw_result_array[1][teamAbbr] . "</div>

            </div>

            <div class='flex-container row'>

            <div class='player forward col-4'>" . $lw_result_array[2][name][0] . ". " . strstr(($lw_result_array[2][name]), ' ') . "<p>#" . $lw_result_array[2][number] . " " . $lw_result_array[2][teamAbbr] . " " . "</div>
            <div class='player forward col-4'>" . $c_result_array[2][name][0] . ". " . strstr(($c_result_array[2][name]), ' ') . "<p>#" . $c_result_array[2][number] . " " . $c_result_array[2][teamAbbr] . " " . "</div>
            <div class='player forward col-4'>". $rw_result_array[2][name][0] . ". " . strstr(($rw_result_array[2][name]), ' ') . "<p>#" . $rw_result_array[2][number] . " " . $rw_result_array[2][teamAbbr] . "</div>

            </div>

            <div class='flex-container row'>

            <div class='player forward col-4'>" . $lw_result_array[3][name][0] . ". " . strstr(($lw_result_array[3][name]), ' ') . "<p>#" . $lw_result_array[3][number] . " " . $lw_result_array[3][teamAbbr] . " " . "</div>
            <div class='player forward col-4'>" . $c_result_array[3][name][0] . ". " . strstr(($c_result_array[3][name]), ' ') . "<p>#" . $c_result_array[3][number] . " " . $c_result_array[3][teamAbbr] . " " . "</div>
            <div class='player forward col-4'>". $rw_result_array[3][name][0] . ". " . strstr(($rw_result_array[3][name]), ' ') . "<p>#" . $rw_result_array[3][number] . " " . $rw_result_array[3][teamAbbr] . "</div>
            
            </div>

            <h2>Defensemen</h2>

            <div class='flex-container row'>

            <div class='player dman col-6'>" . $d_result_array[0][name][0] . ". " . strstr(($d_result_array[0][name]), ' ') . "<p>#" . $d_result_array[0][number] . " " . $d_result_array[0][teamAbbr] . " ". "</div>
            <div class='player dman col-6'>" . $d_result_array[1][name][0] . ". " . strstr(($d_result_array[1][name]), ' ') . "<p>#" . $d_result_array[1][number] . " " . $d_result_array[1][teamAbbr] . "</div>

            </div>

            <div class='flex-container row'>

            <div class='player dman col-6'>" . $d_result_array[2][name][0] . ". " . strstr(($d_result_array[2][name]), ' ') . "<p>#" . $d_result_array[2][number] . " " . $d_result_array[2][teamAbbr] . " ". "</div>
            <div class='player dman col-6'>" . $d_result_array[3][name][0] . ". " . strstr(($d_result_array[3][name]), ' ') . "<p>#" . $d_result_array[3][number] . " " . $d_result_array[3][teamAbbr] . "</div>

            </div>

            <div class='flex-container row'>

            <div class='player dman col-6'>" . $d_result_array[4][name][0] . ". " . strstr(($d_result_array[4][name]), ' ') . "<p>#" . $d_result_array[4][number] . " " . $d_result_array[4][teamAbbr] . " ". "</div>
            <div class='player dman col-6'>" . $d_result_array[5][name][0] . ". " . strstr(($d_result_array[5][name]), ' ') . "<p>#" . $d_result_array[5][number] . " " . $d_result_array[5][teamAbbr] . "</div>

            </div>

            <h2>Goalies</h2>

            <div class='flex-container row'>

            <div class='player goalie col-6'>" . $g_result_array[0][name][0] . ". " . strstr(($g_result_array[0][name]), ' ') . "<p>#" . $g_result_array[0][number] . " " . $g_result_array[0][teamAbbr] . " " . "</div>
            <div class='player goalie col-6'>" . $g_result_array[1][name][0] . ". " . strstr(($g_result_array[1][name]), ' ') . "<p>#" . $g_result_array[1][number] . " " . $g_result_array[1][teamAbbr] . " " . "</div>

            </div>
            <p class='link-address'>http://rubyarbogast.com/oneforone</p>
            </div>";

            echo "<div class='flex-container' id='optionButtons'>";

            //Form to submit team
            echo "<form action='' id='postTeam' method='post'>";

            //First line
            echo "
            <input id='lw1Id' type='hidden' value='" . $lw_result_array[0][nhlId] . "' >
            <input id='c1Id' type='hidden' value='" . $c_result_array[0][nhlId] . "' >
            <input id='rw1Id' type='hidden' value='" . $rw_result_array[0][nhlId] . "' >
            ";

            //Second line
            echo "
            <input id='lw2Id' type='hidden' value='" . $lw_result_array[1][nhlId] . "' >
            <input id='c2Id' type='hidden' value='" . $c_result_array[1][nhlId] . "' >
            <input id='rw2Id' type='hidden' value='" . $rw_result_array[1][nhlId] . "' >
            ";

            //Third line
            echo "
            <input id='lw3Id' type='hidden' value='" . $lw_result_array[2][nhlId] . "' >
            <input id='c3Id' type='hidden' value='" . $c_result_array[2][nhlId] . "' >
            <input id='rw3Id' type='hidden' value='" . $rw_result_array[2][nhlId] . "' >
            ";

            //Fourth line
            echo "
            <input id='lw4Id' type='hidden' value='" . $lw_result_array[3][nhlId] . "' >
            <input id='c4Id' type='hidden' value='" . $c_result_array[3][nhlId] . "' >
            <input id='rw4Id' type='hidden' value='" . $rw_result_array[3][nhlId] . "'
            ";
            
            //First pair
            echo "
            <input id='d1Id' type='hidden' value='" . $d_result_array[0][nhlId] . "' >
            <input id='d2Id' type='hidden' value='" . $d_result_array[1][nhlId] . "' >
            ";

            //Second pair
            echo "
            <input id='d3Id' type='hidden' value='" . $d_result_array[2][nhlId] . "' >
            <input id='d4Id' type='hidden' value='" . $d_result_array[3][nhlId] . "' >
            ";

            //Third pair
            echo "
            <input id='d5Id' type='hidden' value='" . $d_result_array[4][nhlId] . "' >
            <input id='d6Id' type='hidden' value='" . $d_result_array[5][nhlId] . "' >
            ";

            //Tandem
            echo "
            <input id='g1Id' type='hidden' value='" . $g_result_array[0][nhlId] . "' >
            <input id='g2Id' type='hidden' value='" . $g_result_array[1][nhlId] . "' >
            ";

            echo "<button id='showHideSubmitButton' class='secondary-button' onclick='loggedInOptions(event)'>Post to Blog</button>
            <button class='get-team-button secondary-button' id='newTeam'>New Team</button>";

            //Use WP function to see if the user is already logged in
            if(is_user_logged_in()){
                echo "<input id='loggedIn' type='hidden' value='true'>";
            } else {
                echo "<input id='loggedIn' type='hidden' value='false'>";
            };

            echo "<button id='submitTeamButton' class='submit-team secondary-button' type='submit'>Post!</button>
            <button id='cancelPostButton' class='secondary-button' onclick='cancelPostLoggedIn(event)'>Cancel</button>";

            echo "</form>";

            //If the user is not logged in, show either the login or register form (depending on what button they cick; handled in ajax-team)
            echo "
            <div id='loginFromTeamView'>
            <a href='./login' id='logIn'>Log In</a>
            | 
            <a href='" . wp_registration_url() . "' id='register'>Register</a>
            |
            <a href='#' id='cancel' onclick='cancelLogin();return false;'>Cancel</a>
            </div>
            ";

            echo "</div>";
        }
    }
    wp_die(); 
}
add_action('wp_ajax_nopriv_get_team', 'get_team');
add_action('wp_ajax_get_team', 'get_team');

function get_team_desktop() {

    //TODO: 
    //INSTALLATION:
        //Set up DB constraints, new tables
        //Update names for databases; redirect in code -- current paths won't work 

        //Activate SeedProd

        //Add pages: register, log in, post team, log out
        //Set up menus
        //Add "images" folder
        //Remove these to-dos before uploading files
        //Remove config file since not using it
        //FTP files: front-page, header, home, index, page-login, page-logout, page-post-team, page-register, banned-words, style.css, ajax-post, ajax-team, nav-menu, scripts, preview.JPG
        //Test everything works

        //Deactivate SeedProd; share

    if($_SERVER['REQUEST_METHOD'] == 'GET') { 
        global $wpdb;

        //ARRAY_A outputs numerically indexed array of associative arrays with column names as keys
        $lw_result_array = $wpdb->get_results( "SELECT lw.name, lw.nhlId, lw.number, lw.currentTeam FROM rma_all_players AS lw WHERE position = 'Left Wing' AND active = 1 ORDER BY rand() LIMIT 4", ARRAY_A );
        $c_result_array = $wpdb->get_results( "SELECT c.name, c.nhlId, c.number, c.currentTeam FROM rma_all_players AS c WHERE position = 'Center' AND active = 1 ORDER BY rand() LIMIT 4", ARRAY_A );
        $rw_result_array = $wpdb->get_results( "SELECT rw.name, rw.nhlId, rw.number, rw.currentTeam FROM rma_all_players AS rw WHERE position = 'Right Wing' AND active = 1 ORDER BY rand() LIMIT 4", ARRAY_A );
        $d_result_array = $wpdb->get_results( "SELECT d.name, d.nhlId, d.number, d.currentTeam FROM rma_all_players AS d WHERE position = 'Defenseman' AND active = 1 ORDER BY rand() LIMIT 6", ARRAY_A );
        $g_result_array = $wpdb->get_results( "SELECT g.name, g.nhlId, g.number, g.currentTeam FROM rma_all_players AS g WHERE position = 'Goalie' AND active = 1 ORDER BY rand() LIMIT 2", ARRAY_A );

        //Save arrays to session to hold data if user wants to post a team and isn't logged in
        $_SESSION['lw_array'] = $lw_result_array;
        $_SESSION['c_array'] = $c_result_array;
        $_SESSION['rw_array'] = $rw_result_array;
        $_SESSION['d_array'] = $d_result_array;
        $_SESSION['g_array'] = $g_result_array;

        //If the data is missing, show an error message. Otherwise, output the team 
        if(!$lw_result_array || !$c_result_array || !$rw_result_array || !$d_result_array || !$g_result_array) {
            echo "<h2>Oops! Something went wrong ...</h2>";
        } else {

            echo "<p></p>

            <div class='team'>

            <div class='line'>
            <h2 class='player-type'>Forwards</h2>

            <div class='flex-container row'>

            <div class='player forward col-4'>" . $lw_result_array[0][name] . "<p>#" . $lw_result_array[0][number] . " " . $lw_result_array[0][currentTeam] . "</p></div>
            <div class='player forward col-4'>" . $c_result_array[0][name] . "<p>#" . $c_result_array[0][number] . " " . $c_result_array[0][currentTeam] . " " . "</div>
            <div class='player forward col-4'>". $rw_result_array[0][name] . "<p>#" . $rw_result_array[0][number] . " " . $rw_result_array[0][currentTeam] . "</div>
            
            </div>

            <div class='flex-container row'>

            <div class='player forward col-4'>" . $lw_result_array[1][name] . "<p>#" . $lw_result_array[1][number] . " " . $lw_result_array[1][currentTeam] . " " . "</div>
            <div class='player forward col-4'>" . $c_result_array[1][name] . "<p>#" . $c_result_array[1][number] . " " . $c_result_array[1][currentTeam] . " " . "</div>
            <div class='player forward col-4'>". $rw_result_array[1][name] . "<p>#" . $rw_result_array[1][number] . " " . $rw_result_array[1][currentTeam] . "</div>

            </div>

            <div class='flex-container row'>

            <div class='player forward col-4'>" . $lw_result_array[2][name] . "<p>#" . $lw_result_array[2][number] . " " . $lw_result_array[2][currentTeam] . " " . "</div>
            <div class='player forward col-4'>" . $c_result_array[2][name] . "<p>#" . $c_result_array[2][number] . " " . $c_result_array[2][currentTeam] . " " . "</div>
            <div class='player forward col-4'>". $rw_result_array[2][name] . "<p>#" . $rw_result_array[2][number] . " " . $rw_result_array[2][currentTeam] . "</div>

            </div>

            <div class='flex-container row'>

            <div class='player forward col-4'>" . $lw_result_array[3][name] . "<p>#" . $lw_result_array[3][number] . " " . $lw_result_array[3][currentTeam] . " " . "</div>
            <div class='player forward col-4'>" . $c_result_array[3][name] . "<p>#" . $c_result_array[3][number] . " " . $c_result_array[3][currentTeam] . " " . "</div>
            <div class='player forward col-4'>". $rw_result_array[3][name] . "<p>#" . $rw_result_array[3][number] . " " . $rw_result_array[3][currentTeam] . "</div>
            
            </div>
            </div>

            <div class='pairing'>
            <h2 class='player-type'>Defensemen</h2>

            <div class='flex-container row'>

            <div class='player dman col-6'>" . $d_result_array[0][name] . "<p>#" . $d_result_array[0][number] . " " . $d_result_array[0][currentTeam] . " ". "</div>
            <div class='player dman col-6'>" . $d_result_array[1][name] . "<p>#" . $d_result_array[1][number] . " " . $d_result_array[1][currentTeam] . "</div>

            </div>

            <div class='flex-container row'>

            <div class='player dman col-6'>" . $d_result_array[2][name] . "<p>#" . $d_result_array[2][number] . " " . $d_result_array[2][currentTeam] . " ". "</div>
            <div class='player dman col-6'>" . $d_result_array[3][name] . "<p>#" . $d_result_array[3][number] . " " . $d_result_array[3][currentTeam] . "</div>

            </div>

            <div class='flex-container row'>

            <div class='player dman col-6'>" . $d_result_array[4][name] . "<p>#" . $d_result_array[4][number] . " " . $d_result_array[4][currentTeam] . " ". "</div>
            <div class='player dman col-6'>" . $d_result_array[5][name] . "<p>#" . $d_result_array[5][number] . " " . $d_result_array[5][currentTeam] . "</div>

            </div>
            </div>

            <div class='pairing'>
            <h2 class='player-type'>Goalies</h2>

            <div class='flex-container row'>

            <div class='player goalie col-6'>" . $g_result_array[0][name] . "<p>#" . $g_result_array[0][number] . " " . $g_result_array[0][currentTeam] . " " . "</div>
            <div class='player goalie col-6'>" . $g_result_array[1][name] . "<p>#" . $g_result_array[1][number] . " " . $g_result_array[1][currentTeam] . " " . "</div>

            </div>
            </div>
            <p class='link-address'>http://rubyarbogast.com/oneforone</p>
            </div>

            <div class='flex-container' id='optionButtons'>";

            //Form to submit team
            echo "<form action='' id='postTeam' method='post'>";

            //First line
            echo "
            <input id='lw1Id' type='hidden' value='" . $lw_result_array[0][nhlId] . "' >
            <input id='c1Id' type='hidden' value='" . $c_result_array[0][nhlId] . "' >
            <input id='rw1Id' type='hidden' value='" . $rw_result_array[0][nhlId] . "' >            
            ";

            //Second line
            echo "
            <input id='lw2Id' type='hidden' value='" . $lw_result_array[1][nhlId] . "' >
            <input id='c2Id' type='hidden' value='" . $c_result_array[1][nhlId] . "' >
            <input id='rw2Id' type='hidden' value='" . $rw_result_array[1][nhlId] . "' >
            ";

            //Third line
            echo "
            <input id='lw3Id' type='hidden' value='" . $lw_result_array[2][nhlId] . "' >
            <input id='c3Id' type='hidden' value='" . $c_result_array[2][nhlId] . "' >
            <input id='rw3Id' type='hidden' value='" . $rw_result_array[2][nhlId] . "' >
            ";

            //Fourth line
            echo "
            <input id='lw4Id' type='hidden' value='" . $lw_result_array[3][nhlId] . "' >
            <input id='c4Id' type='hidden' value='" . $c_result_array[3][nhlId] . "' >
            <input id='rw4Id' type='hidden' value='" . $rw_result_array[3][nhlId] . "'
            ";
            
            //First pair
            echo "
            <input id='d1Id' type='hidden' value='" . $d_result_array[0][nhlId] . "' >
            <input id='d2Id' type='hidden' value='" . $d_result_array[1][nhlId] . "' >
            ";

            //Second pair
            echo "
            <input id='d3Id' type='hidden' value='" . $d_result_array[2][nhlId] . "' >
            <input id='d4Id' type='hidden' value='" . $d_result_array[3][nhlId] . "' >
            ";

            //Third pair
            echo "
            <input id='d5Id' type='hidden' value='" . $d_result_array[4][nhlId] . "' >
            <input id='d6Id' type='hidden' value='" . $d_result_array[5][nhlId] . "' >
            ";

            //Tandem
            echo "
            <input id='g1Id' type='hidden' value='" . $g_result_array[0][nhlId] . "' >
            <input id='g2Id' type='hidden' value='" . $g_result_array[1][nhlId] . "' >
            ";

            echo "<button id='showHideSubmitButton' class='secondary-button' onclick='loggedInOptions(event)'>Post Team to Blog</button>
            <button class='get-team-button secondary-button' id='newTeam'>New Team</button>";

            //Use WP function to see if the user is already logged in
            if(is_user_logged_in()){
                echo "<input id='loggedIn' type='hidden' value='true'>";
            } else {
                echo "<input id='loggedIn' type='hidden' value='false'>";
            };

            echo "<button id='submitTeamButton' class='submit-team secondary-button' type='submit'>Post!</button>
            <button id='cancelPostButton' class='secondary-button' onclick='cancelPostLoggedIn(event)'>Cancel</button>";

            echo "</form>";

            //If the user is not logged in, show either the login or register form (depending on what button they cick; handled in ajax-team)
            echo "
            <div id='loginFromTeamView'>
            <a href='./login' id='logIn'>Log In</a>
            | 
            <a href='" . wp_registration_url() . "' id='register'>Register</a>
            |
            <a href='#' id='cancel' onclick='cancelLogin();return false;'>Cancel</a>
            </div>
            ";

            echo "</div>";
        }
    }

    wp_die(); 
}
add_action('wp_ajax_nopriv_get_team_desktop', 'get_team_desktop');
add_action('wp_ajax_get_team_desktop', 'get_team_desktop');

function rma_post_team() {

        global $wpdb;

        $current_user = wp_get_current_user();
        $current_user_id = $current_user->ID;

        //Get date and time
        //date_default_timezone_set("America/Los_Angeles");
        //$time = date('Y.d.m h:i:sa');
    
        //Insert submitted team
        $wpdb->insert( 
            'rma_team',
            array(
                'user' => $current_user_id
            ),
            array ('%s')
        );
        //Get ID for team 
        $team_id = $wpdb->insert_id;
        
        //Add IDs to line, pair, tandem tables
        $wpdb->insert(
            'rma_line',
            array('team_id' => $team_id, 'lw_id' => $_POST['lw1Id'], 'c_id' => $_POST['c1Id'], 'rw_id' => $_POST['rw1Id']),
            array('%d', '%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_line',
            array('team_id' => $team_id, 'lw_id' => $_POST['lw2Id'], 'c_id' => $_POST['c2Id'], 'rw_id' => $_POST['rw2Id']),
            array('%d', '%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_line',
            array('team_id' => $team_id, 'lw_id' => $_POST['lw3Id'], 'c_id' => $_POST['c3Id'], 'rw_id' => $_POST['rw3Id']),
            array('%d', '%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_line',
            array('team_id' => $team_id, 'lw_id' => $_POST['lw4Id'], 'c_id' => $_POST['c4Id'], 'rw_id' => $_POST['rw4Id']),
            array('%d', '%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_pair',
            array('team_id' => $team_id, 'ld_id' => $_POST['d1Id'], 'rd_id' => $_POST['d2Id']),
            array('%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_pair',
            array('team_id' => $team_id, 'ld_id' => $_POST['d3Id'], 'rd_id' => $_POST['d4Id']),
            array('%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_pair',
            array('team_id' => $team_id, 'ld_id' => $_POST['d5Id'], 'rd_id' => $_POST['d6Id']),
            array('%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_tandem',
            array(
                'team_id' => $team_id, 'g1_id' => $_POST['g1Id'], 'g2_id' => $_POST['g2Id']),
            array('%d', '%d', '%d')
        );
        

    wp_die(); 
}
add_action('wp_ajax_rma_post_team', 'rma_post_team');