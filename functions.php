<?php
add_theme_support( 'menus' );

function my_enqueue() {
    wp_enqueue_script( 'ajax-team', get_template_directory_uri() . '/js/site-scripts/ajax-team.js', array('jquery') );
    wp_localize_script( 'ajax-team', 'nhl_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'my_enqueue' );

function theme_styles() {	
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

//Register custom navigation menu
function register_my_menu() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'theme-slug' ) );
}
add_action( 'init', 'register_my_menu' );

//TODO: Write handler function for login form
    //Get data from ajax-team
    //TODO: review WP security and validation
    //If data validates:
    //Set the current user without logging them in
    //Return a confirmation message, hide the form and button, and show the "Post" button
    //If data does not validate:
    //Show error messages

function rma_user_login(){
    $creds = array(
        'user_login'    => $_POST['username'],
        'user_password' => $_POST['password'],
        'remember'      => true
    );
 
    $user = wp_signon( $creds, false );
 
    if ( is_wp_error( $user ) ) {
        echo $user->get_error_message();
    }
}
add_action( 'wp_ajax_nopriv_rma_user_login', 'rma_user_login' );
add_action( 'wp_ajax_rma_user_login', 'rma_user_login' );

//Send an AJAX query to the DB; save and output the results to the browser
function get_team() {
    global $wpdb;

    //ARRAY_A outputs numerically indexed array of associative arrays with column names as keys
    $lw_result_array = $wpdb->get_results( "SELECT lw.name, lw.number, lw.currentTeam, lw.position, lw.teamAbbr FROM lwing AS lw ORDER BY rand() LIMIT 4", ARRAY_A );
    $c_result_array = $wpdb->get_results( "SELECT c.name, c.number, c.currentTeam, c.position, c.teamAbbr FROM center AS c ORDER BY rand() LIMIT 4", ARRAY_A );
    $rw_result_array = $wpdb->get_results( "SELECT rw.name, rw.number, rw.currentTeam, rw.position, rw.teamAbbr FROM rwing AS rw ORDER BY rand() LIMIT 4", ARRAY_A );
    $d_result_array = $wpdb->get_results( "SELECT d.name, d.number, d.currentTeam, d.position, d.teamAbbr FROM defenseman AS d ORDER BY rand() LIMIT 6", ARRAY_A );
    $g_result_array = $wpdb->get_results( "SELECT g.name, g.number, g.currentTeam, g.position, g.teamAbbr FROM goalie AS g ORDER BY rand() LIMIT 2", ARRAY_A );

    echo "<div class='team'>";

    echo "<h2>Forwards</h2>";

    echo "<div class='flex-container row'>";

    echo "<div class='player forward col-4'>" . $lw_result_array[0][name][0] . ". " . strstr(($lw_result_array[0][name]), ' ') . "<p>#" . $lw_result_array[0][number] . " " . $lw_result_array[0][teamAbbr] . " " . "</div>";
    echo "<div class='player forward col-4'>" . $c_result_array[0][name][0] . ". " . strstr(($c_result_array[0][name]), ' ') . "<p>#" . $c_result_array[0][number] . " " . $c_result_array[0][teamAbbr] . " " . "</div>";
    echo "<div class='player forward col-4'>". $rw_result_array[0][name][0] . ". " . strstr(($rw_result_array[0][name]), ' ') . "<p>#" . $rw_result_array[0][number] . " " . $rw_result_array[0][teamAbbr] . "</div>";
    
    echo "</div>";

    echo "<div class='flex-container row'>";

    echo "<div class='player forward col-4'>" . $lw_result_array[1][name][0] . ". " . strstr(($lw_result_array[1][name]), ' ') . "<p>#" . $lw_result_array[1][number] . " " . $lw_result_array[1][teamAbbr] . " " . "</div>";
    echo "<div class='player forward col-4'>" . $c_result_array[1][name][0] . ". " . strstr(($c_result_array[1][name]), ' ') . "<p>#" . $c_result_array[1][number] . " " . $c_result_array[1][teamAbbr] . " " . "</div>";
    echo "<div class='player forward col-4'>". $rw_result_array[1][name][0] . ". " . strstr(($rw_result_array[1][name]), ' ') . "<p>#" . $rw_result_array[1][number] . " " . $rw_result_array[1][teamAbbr] . "</div>";

    echo "</div>";

    echo "<div class='flex-container row'>";

    echo "<div class='player forward col-4'>" . $lw_result_array[2][name][0] . ". " . strstr(($lw_result_array[2][name]), ' ') . "<p>#" . $lw_result_array[2][number] . " " . $lw_result_array[2][teamAbbr] . " " . "</div>";
    echo "<div class='player forward col-4'>" . $c_result_array[2][name][0] . ". " . strstr(($c_result_array[2][name]), ' ') . "<p>#" . $c_result_array[2][number] . " " . $c_result_array[2][teamAbbr] . " " . "</div>";
    echo "<div class='player forward col-4'>". $rw_result_array[2][name][0] . ". " . strstr(($rw_result_array[2][name]), ' ') . "<p>#" . $rw_result_array[2][number] . " " . $rw_result_array[2][teamAbbr] . "</div>";

    echo "</div>";

    echo "<div class='flex-container row'>";

    echo "<div class='player forward col-4'>" . $lw_result_array[3][name][0] . ". " . strstr(($lw_result_array[3][name]), ' ') . "<p>#" . $lw_result_array[3][number] . " " . $lw_result_array[3][teamAbbr] . " " . "</div>";
    echo "<div class='player forward col-4'>" . $c_result_array[3][name][0] . ". " . strstr(($c_result_array[3][name]), ' ') . "<p>#" . $c_result_array[3][number] . " " . $c_result_array[3][teamAbbr] . " " . "</div>";
    echo "<div class='player forward col-4'>". $rw_result_array[3][name][0] . ". " . strstr(($rw_result_array[3][name]), ' ') . "<p>#" . $rw_result_array[3][number] . " " . $rw_result_array[3][teamAbbr] . "</div>";
    
    echo "</div>";

    echo "<h2>Defensemen</h2>";

    echo "<div class='flex-container row'>";

    echo "<div class='player dman col-6'>" . $d_result_array[0][name][0] . ". " . strstr(($d_result_array[0][name]), ' ') . "<p>#" . $d_result_array[0][number] . " " . $d_result_array[0][teamAbbr] . " ". "</div>";
    echo "<div class='player dman col-6'>" . $d_result_array[1][name][0] . ". " . strstr(($d_result_array[1][name]), ' ') . "<p>#" . $d_result_array[1][number] . " " . $d_result_array[1][teamAbbr] . "</div>";

    echo "</div>";

    echo "<div class='flex-container row'>";

    echo "<div class='player dman col-6'>" . $d_result_array[2][name][0] . ". " . strstr(($d_result_array[2][name]), ' ') . "<p>#" . $d_result_array[2][number] . " " . $d_result_array[2][teamAbbr] . " ". "</div>";
    echo "<div class='player dman col-6'>" . $d_result_array[3][name][0] . ". " . strstr(($d_result_array[3][name]), ' ') . "<p>#" . $d_result_array[3][number] . " " . $d_result_array[3][teamAbbr] . "</div>";

    echo "</div>";

    echo "<div class='flex-container row'>";

    echo "<div class='player dman col-6'>" . $d_result_array[4][name][0] . ". " . strstr(($d_result_array[4][name]), ' ') . "<p>#" . $d_result_array[4][number] . " " . $d_result_array[4][teamAbbr] . " ". "</div>";
    echo "<div class='player dman col-6'>" . $d_result_array[5][name][0] . ". " . strstr(($d_result_array[5][name]), ' ') . "<p>#" . $d_result_array[5][number] . " " . $d_result_array[5][teamAbbr] . "</div>";

    echo "</div>";

    echo "<h2>Goalies</h2>";

    echo "<div class='flex-container row'>";

    echo "<div class='player goalie col-6'>" . $g_result_array[0][name][0] . ". " . strstr(($g_result_array[0][name]), ' ') . "<p>#" . $g_result_array[0][number] . " " . $g_result_array[0][teamAbbr] . " " . "</div>";
    echo "<div class='player goalie col-6'>" . $g_result_array[1][name][0] . ". " . strstr(($g_result_array[1][name]), ' ') . "<p>#" . $g_result_array[1][number] . " " . $g_result_array[1][teamAbbr] . " " . "</div>";

    echo "</div>";
    echo "<p class='link-address'>http://rubyarbogast.com/oneforone</p>";
    echo "</div>";

    wp_die(); 
}

add_action('wp_ajax_nopriv_get_team', 'get_team');
add_action('wp_ajax_get_team', 'get_team');

function get_team_desktop() {

    //TODO: 
    //Finish WPF setup
    //Finish username plugin setup
    //Add, customize login and registration forms
    //Review accessibility issues? 
    //When button clicked, show/hide name input and show/hide buttons
    //Add date field to blog submission
    //Add nonce to ajax-team
    //Update stylesheet (buttons)
    //In future, possibly use custom post type. For now, assume all posts will be teams
    //Testing
    //NOTE: will need to change DB name for username when on live site

    //Refactor post handler below; update mobile function 

    if($_SERVER['REQUEST_METHOD'] == 'GET') { 
        global $wpdb;

        //ARRAY_A outputs numerically indexed array of associative arrays with column names as keys
        $lw_result_array = $wpdb->get_results( "SELECT lw.name, lw.number, lw.currentTeam, lw.position, lw.teamAbbr FROM lwing AS lw ORDER BY rand() LIMIT 4", ARRAY_A );
        $c_result_array = $wpdb->get_results( "SELECT c.name, c.number, c.currentTeam, c.position, c.teamAbbr FROM center AS c ORDER BY rand() LIMIT 4", ARRAY_A );
        $rw_result_array = $wpdb->get_results( "SELECT rw.name, rw.number, rw.currentTeam, rw.position, rw.teamAbbr FROM rwing AS rw ORDER BY rand() LIMIT 4", ARRAY_A );
        $d_result_array = $wpdb->get_results( "SELECT d.name, d.number, d.currentTeam, d.position, d.teamAbbr FROM defenseman AS d ORDER BY rand() LIMIT 6", ARRAY_A );
        $g_result_array = $wpdb->get_results( "SELECT g.name, g.number, g.currentTeam, g.position, g.teamAbbr FROM goalie AS g ORDER BY rand() LIMIT 2", ARRAY_A );

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
            echo "<input id='lw1name' type='hidden' value='" . $lw_result_array[0][name] . "' >
            <input id='lw1number' type='hidden' value='" . $lw_result_array[0][number] . "' >
            <input id='lw1team' type='hidden' value='" . $lw_result_array[0][currentTeam] . "' >
            <input id='lw1abbr' type='hidden' value='" . $lw_result_array[0][teamAbbr] . "' >

            <input id='c1name' type='hidden' value='" . $c_result_array[0][name] . "' >
            <input id='c1number' type='hidden' value='" . $c_result_array[0][number] . "' >
            <input id='c1team' type='hidden' value='" . $c_result_array[0][currentTeam] . "' >
            <input id='c1abbr' type='hidden' value='" . $c_result_array[0][teamAbbr] . "' >

            <input id='rw1name' type='hidden' value='" . $rw_result_array[0][name] . "' >
            <input id='rw1number' type='hidden' value='" . $rw_result_array[0][number] . "' >
            <input id='rw1team' type='hidden' value='" . $rw_result_array[0][currentTeam] . "' >
            <input id='rw1abbr' type='hidden' value='" . $rw_result_array[0][teamAbbr] . "' >
            
            ";

            //Second line
            echo "<input id='lw2name' type='hidden' value='" . $lw_result_array[1][name] . "' >
            <input id='lw2number' type='hidden' value='" . $lw_result_array[1][number] . "' >
            <input id='lw2team' type='hidden' value='" . $lw_result_array[1][currentTeam] . "' >
            <input id='lw2abbr' type='hidden' value='" . $lw_result_array[1][teamAbbr] . "' >

            <input id='c2name' type='hidden' value='" . $c_result_array[1][name] . "' >
            <input id='c2number' type='hidden' value='" . $c_result_array[1][number] . "' >
            <input id='c2team' type='hidden' value='" . $c_result_array[1][currentTeam] . "' >
            <input id='c2abbr' type='hidden' value='" . $c_result_array[1][teamAbbr] . "' >

            <input id='rw2name' type='hidden' value='" . $rw_result_array[1][name] . "' >
            <input id='rw2number' type='hidden' value='" . $rw_result_array[1][number] . "' >
            <input id='rw2team' type='hidden' value='" . $rw_result_array[1][currentTeam] . "' >
            <input id='rw2abbr' type='hidden' value='" . $rw_result_array[1][teamAbbr] . "' >

            ";

            //Third line
            echo "<input id='lw3name' type='hidden' value='" . $lw_result_array[2][name] . "' >
            <input id='lw3number' type='hidden' value='" . $lw_result_array[2][number] . "' >
            <input id='lw3team' type='hidden' value='" . $lw_result_array[2][currentTeam] . "' >
            <input id='lw3abbr' type='hidden' value='" . $lw_result_array[2][teamAbbr] . "' >

            <input id='c3name' type='hidden' value='" . $c_result_array[2][name] . "' >
            <input id='c3number' type='hidden' value='" . $c_result_array[2][number] . "' >
            <input id='c3team' type='hidden' value='" . $c_result_array[2][currentTeam] . "' >
            <input id='c3abbr' type='hidden' value='" . $c_result_array[2][teamAbbr] . "' >

            <input id='rw3name' type='hidden' value='" . $rw_result_array[2][name] . "' >
            <input id='rw3number' type='hidden' value='" . $rw_result_array[2][number] . "' >
            <input id='rw3team' type='hidden' value='" . $rw_result_array[2][currentTeam] . "' >
            <input id='rw3abbr' type='hidden' value='" . $rw_result_array[2][teamAbbr] . "' >

            ";

            //Fourth line
            echo "<input id='lw4name' type='hidden' value='" . $lw_result_array[3][name] . "' >
            <input id='lw4number' type='hidden' value='" . $lw_result_array[3][number] . "' >
            <input id='lw4team' type='hidden' value='" . $lw_result_array[3][currentTeam] . "' >
            <input id='lw4abbr' type='hidden' value='" . $lw_result_array[3][teamAbbr] . "' >

            <input id='c4name' type='hidden' value='" . $c_result_array[3][name] . "' >
            <input id='c4number' type='hidden' value='" . $c_result_array[3][number] . "' >
            <input id='c4team' type='hidden' value='" . $c_result_array[3][currentTeam] . "' >
            <input id='c4abbr' type='hidden' value='" . $c_result_array[3][teamAbbr] . "' >

            <input id='rw4name' type='hidden' value='" . $rw_result_array[3][name] . "' >
            <input id='rw4number' type='hidden' value='" . $rw_result_array[3][number] . "' >
            <input id='rw4team' type='hidden' value='" . $rw_result_array[3][currentTeam] . "' >
            <input id='rw4abbr' type='hidden' value='" . $rw_result_array[3][teamAbbr] . "' >
            ";
            
            //First pair
            echo "<input id='d1name' type='hidden' value='" . $d_result_array[0][name] . "' >
            <input id='d1number' type='hidden' value='" . $d_result_array[0][number] . "' >
            <input id='d1team' type='hidden' value='" . $d_result_array[0][currentTeam] . "' >
            <input id='d1abbr' type='hidden' value='" . $d_result_array[0][teamAbbr] . "' >

            <input id='d2name' type='hidden' value='" . $d_result_array[1][name] . "' >
            <input id='d2number' type='hidden' value='" . $d_result_array[1][number] . "' >
            <input id='d2team' type='hidden' value='" . $d_result_array[1][currentTeam] . "' >
            <input id='d2abbr' type='hidden' value='" . $d_result_array[1][teamAbbr] . "' >
            ";

            //Second pair
            echo "<input id='d3name' type='hidden' value='" . $d_result_array[2][name] . "' >
            <input id='d3number' type='hidden' value='" . $d_result_array[2][number] . "' >
            <input id='d3team' type='hidden' value='" . $d_result_array[2][currentTeam] . "' >
            <input id='d3abbr' type='hidden' value='" . $d_result_array[2][teamAbbr] . "' >

            <input id='d4name' type='hidden' value='" . $d_result_array[3][name] . "' >
            <input id='d4number' type='hidden' value='" . $d_result_array[3][number] . "' >
            <input id='d4team' type='hidden' value='" . $d_result_array[3][currentTeam] . "' >
            <input id='d4abbr' type='hidden' value='" . $d_result_array[3][teamAbbr] . "' >
            ";

            //Third pair
            echo "<input id='d5name' type='hidden' value='" . $d_result_array[4][name] . "' >
            <input id='d5number' type='hidden' value='" . $d_result_array[4][number] . "' >
            <input id='d5team' type='hidden' value='" . $d_result_array[4][currentTeam] . "' >
            <input id='d5abbr' type='hidden' value='" . $d_result_array[4][teamAbbr] . "' >

            <input id='d6name' type='hidden' value='" . $d_result_array[5][name] . "' >
            <input id='d6number' type='hidden' value='" . $d_result_array[5][number] . "' >
            <input id='d6team' type='hidden' value='" . $d_result_array[5][currentTeam] . "' >
            <input id='d6abbr' type='hidden' value='" . $d_result_array[5][teamAbbr] . "' >
            ";

            //Tandem
            echo "<input id='g1name' type='hidden' value='" . $g_result_array[0][name] . "' >
            <input id='g1number' type='hidden' value='" . $g_result_array[0][number] . "' >
            <input id='g1team' type='hidden' value='" . $g_result_array[0][currentTeam] . "' >
            <input id='g1abbr' type='hidden' value='" . $g_result_array[0][teamAbbr] . "' >

            <input id='g2name' type='hidden' value='" . $g_result_array[1][name] . "' >
            <input id='g2number' type='hidden' value='" . $g_result_array[1][number] . "' >
            <input id='g2team' type='hidden' value='" . $g_result_array[1][currentTeam] . "' >
            <input id='g2abbr' type='hidden' value='" . $g_result_array[1][teamAbbr] . "' >
            ";

            echo "<button id='showHideSubmitButton'>Post Team to Blog</button>
            <button class='get-team-button' id='secondaryButton'>New Team</button>";

            //Use WP function to see if the user is already logged in
            if(is_user_logged_in()){
                echo "<input id='loggedIn' type='hidden' value='true'>";
            } else {
                echo "<input id='loggedIn' type='hidden' value='false'>";
            };

            echo "<button id='submitTeamButton' class='submit-team'>Post!</button>
            <button id='cancelPost'>Cancel</button>";

            echo "<button id='logInButton'>Log In</button>
            <button id='registerButton'>Register</button>
            ";

            echo "</form>";

            //If the user is not logged in, show either the login or register form (depending on what button they cick; handled in ajax-team)
            echo "
            <div id='loginFromTeamView'>
            <form id='loginToPost'>
            <label for='username'>Username</label>
            <input id='username' type='text' />
            <label for='password'>Password</label>
            <input id='password' type='password' />
            <button id='processLogin'>Log In!</button>
            </form>
            </div>
            ";

            echo "
            <div id='registerFromTeamView'>
            <form id='registerToPost'>
            <label for='username'>Username</label>
            <input id='username' type='text' />
            <label for='password'>Password</label>
            <input id='password' type='password' />
            <button id='registerUser'>Register!</button>
            </form>
            </div>
            ";

            echo "</div>";
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        global $wpdb;
    
        //TODO: Get the user id and log them in
        $current_user = wp_get_current_user();
        $current_user_id = $current_user->ID;

        //$submittedby = $_POST['submittedby'];
        //TODO: escape string data

        //First line
        $lw1name = $_POST['lw1name'];
        $lw1number = $_POST['lw1number'];
        $lw1team = $_POST['lw1team'];  
        $lw1abbr = $_POST['lw1abbr'];

        $c1name = $_POST['c1name'];
        $c1number = $_POST['c1number'];
        $c1team = $_POST['c1team'];
        $c1abbr = $_POST['c1abbr'];

        $rw1name = $_POST['rw1name'];
        $rw1number = $_POST['rw1number'];
        $rw1team = $_POST['rw1team'];
        $rw1abbr = $_POST['rw1abbr'];

        //Second line
        $lw2name = $_POST['lw2name'];
        $lw2number = $_POST['lw2number'];
        $lw2team = $_POST['lw2team'];  
        $lw2abbr = $_POST['lw2abbr'];

        $c2name = $_POST['c2name'];
        $c2number = $_POST['c2number'];
        $c2team = $_POST['c2team'];
        $c2abbr = $_POST['c2abbr'];

        $rw2name = $_POST['rw2name'];
        $rw2number = $_POST['rw2number'];
        $rw2team = $_POST['rw2team'];
        $rw2abbr = $_POST['rw2abbr'];

        //Third line
        $lw3name = $_POST['lw3name'];
        $lw3number = $_POST['lw3number'];
        $lw3team = $_POST['lw3team'];  
        $lw3abbr = $_POST['lw3abbr'];

        $c3name = $_POST['c3name'];
        $c3number = $_POST['c3number'];
        $c3team = $_POST['c3team'];
        $c3abbr = $_POST['c3abbr'];

        $rw3name = $_POST['rw3name'];
        $rw3number = $_POST['rw3number'];
        $rw3team = $_POST['rw3team'];
        $rw3abbr = $_POST['rw3abbr'];

        //Fourth line
        $lw4name = $_POST['lw4name'];
        $lw4number = $_POST['lw4number'];
        $lw4team = $_POST['lw4team'];  
        $lw4abbr = $_POST['lw4abbr'];

        $c4name = $_POST['c4name'];
        $c4number = $_POST['c4number'];
        $c4team = $_POST['c4team'];
        $c4abbr = $_POST['c4abbr'];

        $rw4name = $_POST['rw4name'];
        $rw4number = $_POST['rw4number'];
        $rw4team = $_POST['rw4team'];
        $rw4abbr = $_POST['rw4abbr'];

        //First pair
        $d1name = $_POST['d1name'];
        $d1number = $_POST['d1number'];
        $d1team = $_POST['d1team'];  
        $d1abbr = $_POST['d1abbr'];

        $d2name = $_POST['d2name'];
        $d2number = $_POST['d2number'];
        $d2team = $_POST['d2team'];
        $d2abbr = $_POST['d2abbr'];

        //Second pair
        $d3name = $_POST['d3name'];
        $d3number = $_POST['d3number'];
        $d3team = $_POST['d3team'];  
        $d3abbr = $_POST['d3abbr'];

        $d4name = $_POST['d4name'];
        $d4number = $_POST['d4number'];
        $d4team = $_POST['d4team'];
        $d4abbr = $_POST['d4abbr'];

        //Third pair
        $d5name = $_POST['d5name'];
        $d5number = $_POST['d5number'];
        $d5team = $_POST['d5team'];  
        $d5abbr = $_POST['d5abbr'];

        $d6name = $_POST['d6name'];
        $d6number = $_POST['d6number'];
        $d6team = $_POST['d6team'];
        $d6abbr = $_POST['d6abbr'];

        //Tandem
        $g1name = $_POST['g1name'];
        $g1number = $_POST['g1number'];
        $g1team = $_POST['g1team'];  
        $g1abbr = $_POST['g1abbr'];

        $g2name = $_POST['g2name'];
        $g2number = $_POST['g2number'];
        $g2team = $_POST['g2team'];
        $g2abbr = $_POST['g2abbr'];
    
        //Insert submitted team
        $wpdb->insert( 
            //Insert submitted_by into team 
            'rma_team',
            array(
                //'submitted_by' => $submittedby
                'user_id' => $current_user_id
            ),
            array ('%s')
        );
        //Get ID for team 
        $team_id = $wpdb->insert_id;
        //Insert players and save IDs to variables
        //Insert line 1 players
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $lw1name,
                'number' => $lw1number,
                'current_team' => $lw1team,
                'team_abbr' => $lw1abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $lw1id = $wpdb->insert_id;
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $c1name,
                'number' => $c1number,
                'current_team' => $c1team,
                'team_abbr' => $c1abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $c1id = $wpdb->insert_id;
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $rw1name,
                'number' => $rw1number,
                'current_team' => $rw1team,
                'team_abbr' => $rw1abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $rw1id = $wpdb->insert_id;

        //Insert line 2 players
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $lw2name,
                'number' => $lw2number,
                'current_team' => $lw2team,
                'team_abbr' => $lw2abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $lw2id = $wpdb->insert_id;
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $c2name,
                'number' => $c2number,
                'current_team' => $c2team,
                'team_abbr' => $c2abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $c2id = $wpdb->insert_id;
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $rw2name,
                'number' => $rw2number,
                'current_team' => $rw2team,
                'team_abbr' => $rw2abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $rw2id = $wpdb->insert_id;

        //Insert line 3 players
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $lw3name,
                'number' => $lw3number,
                'current_team' => $lw3team,
                'team_abbr' => $lw3abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $lw3id = $wpdb->insert_id;
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $c3name,
                'number' => $c3number,
                'current_team' => $c3team,
                'team_abbr' => $c3abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $c3id = $wpdb->insert_id;
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $rw3name,
                'number' => $rw3number,
                'current_team' => $rw3team,
                'team_abbr' => $rw3abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $rw3id = $wpdb->insert_id;

        //Insert line 4 players
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $lw4name,
                'number' => $lw4number,
                'current_team' => $lw4team,
                'team_abbr' => $lw4abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $lw4id = $wpdb->insert_id;
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $c4name,
                'number' => $c4number,
                'current_team' => $c4team,
                'team_abbr' => $c4abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $c4id = $wpdb->insert_id;
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $rw4name,
                'number' => $rw4number,
                'current_team' => $rw4team,
                'team_abbr' => $rw4abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $rw4id = $wpdb->insert_id;

        //Insert pair 1 players
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $d1name,
                'number' => $d1number,
                'current_team' => $d1team,
                'team_abbr' => $d1abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $d1id = $wpdb->insert_id;
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $d2name,
                'number' => $d2number,
                'current_team' => $d2team,
                'team_abbr' => $d2abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $d2id = $wpdb->insert_id;

        //Insert pair 2 players
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $d3name,
                'number' => $d3number,
                'current_team' => $d3team,
                'team_abbr' => $d3abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $d3id = $wpdb->insert_id;
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $d4name,
                'number' => $d4number,
                'current_team' => $d4team,
                'team_abbr' => $d4abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $d4id = $wpdb->insert_id;

        //Insert pair 3 players
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $d5name,
                'number' => $d5number,
                'current_team' => $d5team,
                'team_abbr' => $d5abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $d5id = $wpdb->insert_id;
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $d6name,
                'number' => $d6number,
                'current_team' => $d6team,
                'team_abbr' => $d6abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $d6id = $wpdb->insert_id;

        //Insert tandem players
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $g1name,
                'number' => $g1number,
                'current_team' => $g1team,
                'team_abbr' => $g1abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $g1id = $wpdb->insert_id;
        $wpdb->insert(
            'rma_player',
            array(
                'name' => $g2name,
                'number' => $g2number,
                'current_team' => $g2team,
                'team_abbr' => $g2abbr
            ),
            array('%s', '%d', '%s', '%s')
        );
        $g2id = $wpdb->insert_id;

        //Add IDs (saved in variables) to line, pair, tandem tables
        $wpdb->insert(
            'rma_line',
            array(
                'team_id' => $team_id,
                'lw_id' => $lw1id,
                'c_id' => $c1id,
                'rw_id' => $rw1id
            ),
            array('%d', '%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_line',
            array(
                'team_id' => $team_id,
                'lw_id' => $lw2id,
                'c_id' => $c2id,
                'rw_id' => $rw2id
            ),
            array('%d', '%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_line',
            array(
                'team_id' => $team_id,
                'lw_id' => $lw3id,
                'c_id' => $c3id,
                'rw_id' => $rw3id
            ),
            array('%d', '%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_line',
            array(
                'team_id' => $team_id,
                'lw_id' => $lw4id,
                'c_id' => $c4id,
                'rw_id' => $rw4id
            ),
            array('%d', '%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_pair',
            array(
                'team_id' => $team_id,
                'ld_id' => $d1id,
                'rd_id' => $d2id
            ),
            array('%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_pair',
            array(
                'team_id' => $team_id,
                'ld_id' => $d3id,
                'rd_id' => $d4id
            ),
            array('%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_pair',
            array(
                'team_id' => $team_id,
                'ld_id' => $d5id,
                'rd_id' => $d6id
            ),
            array('%d', '%d', '%d')
        );
        $wpdb->insert(
            'rma_tandem',
            array(
                'team_id' => $team_id,
                'g1_id' => $g1id,
                'g2_id' => $g2id
            ),
            array('%d', '%d', '%d')
        );
        } 
    wp_die(); 
}
add_action('wp_ajax_nopriv_get_team_desktop', 'get_team_desktop');
add_action('wp_ajax_get_team_desktop', 'get_team_desktop');

