<?php

add_theme_support( 'menus' );

function my_enqueue() {
    wp_enqueue_script( 'ajax-team', get_template_directory_uri() . '/js/site-scripts/ajax-team.js', array('jquery') );
    wp_localize_script( 'ajax-team', 'nhl_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'my_enqueue' );

function enqueue_db_post() {
    wp_enqueue_script( 'post-team', get_template_directory_uri() . '/js/site-scripts/post-team.js', array('jquery') );
    wp_localize_script( 'post-team', 'team_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_db_post' );

function theme_styles() {	
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

//Register custom navigation menu
function register_my_menu() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'theme-slug' ) );
}
add_action( 'init', 'register_my_menu' );

//Send an AJAX query to the DB; save and output the results to the browser
function get_team() {
    $ini = parse_ini_file('config.ini');

    $mysqli = new mysqli($ini['db_host'], $ini['db_user'], $ini['db_password'], $ini['db_name']);

    if($mysqli->connect_error) {
        exit('<h2>Oops! Something went wrong ...</h2>');
        }

    $lwQuery = "SELECT lw.name, lw.number, lw.currentTeam, lw.position, lw.teamAbbr FROM lwing AS lw ORDER BY rand() LIMIT 4";
    $cQuery = "SELECT c.name, c.number, c.currentTeam, c.position, c.teamAbbr FROM center AS c ORDER BY rand() LIMIT 4";
    $rwQuery = "SELECT rw.name, rw.number, rw.currentTeam, rw.position, rw.teamAbbr FROM rwing AS rw ORDER BY rand() LIMIT 4";
    $dQuery = "SELECT d.name, d.number, d.currentTeam, d.position, d.teamAbbr FROM defenseman AS d ORDER BY rand() LIMIT 6";
    $gQuery = "SELECT g.name, g.number, g.currentTeam, g.position, g.teamAbbr FROM goalie AS g ORDER BY rand() LIMIT 2";

    //Instantiate arrays to hold players
    $lw_result_array = array();
    $c_result_array = array();
    $rw_result_array = array();
    $d_result_array = array();
    $g_result_array = array();

    $result = mysqli_query($mysqli, $lwQuery);
    if (mysqli_num_rows($result) > 0) {
        //Save data from each row to array
        while($row = mysqli_fetch_assoc($result)) {
            $lw_result_array[] = $row;
        }
    } else {
        echo "<h2>Oops! Something went wrong ...</h2>";
        exit;
    }

    $result = mysqli_query($mysqli, $cQuery);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $c_result_array[] = $row;
        }
    } else {
        echo "<h2>Oops! Something went wrong ...</h2>";
        exit;
    }

    $result = mysqli_query($mysqli, $rwQuery);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $rw_result_array[] = $row;
        }
    } else {
        echo "<h2>Oops! Something went wrong ...</h2>";
        exit;
    }

    $result = mysqli_query($mysqli, $dQuery);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $d_result_array[] = $row;
        }
    } else {
        echo "<h2>Oops! Something went wrong ...</h2>";
        exit;
    }

    $result = mysqli_query($mysqli, $gQuery);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $g_result_array[] = $row;
        }
    } else {
        echo "<h2>Oops! Something went wrong ...</h2>";
        exit;
    }


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
    $ini = parse_ini_file('config.ini');

    $mysqli = new mysqli($ini['db_host'], $ini['db_user'], $ini['db_password'], $ini['db_name']);
    if($mysqli->connect_error) {
        exit('<h2>Oops! Something went wrong ...</h2>');
        }

    $lwQuery = "SELECT lw.name, lw.number, lw.currentTeam, lw.position, lw.teamAbbr FROM lwing AS lw ORDER BY rand() LIMIT 4";
    $cQuery = "SELECT c.name, c.number, c.currentTeam, c.position, c.teamAbbr FROM center AS c ORDER BY rand() LIMIT 4";
    $rwQuery = "SELECT rw.name, rw.number, rw.currentTeam, rw.position, rw.teamAbbr FROM rwing AS rw ORDER BY rand() LIMIT 4";
    $dQuery = "SELECT d.name, d.number, d.currentTeam, d.position, d.teamAbbr FROM defenseman AS d ORDER BY rand() LIMIT 6";
    $gQuery = "SELECT g.name, g.number, g.currentTeam, g.position, g.teamAbbr FROM goalie AS g ORDER BY rand() LIMIT 2";

    //Instantiate arrays to hold players
    $lw_result_array = array();
    $c_result_array = array();
    $rw_result_array = array();
    $d_result_array = array();
    $g_result_array = array();

    $result = mysqli_query($mysqli, $lwQuery);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $lw_result_array[] = $row;
        }
    } else {
        echo "<h2>Oops! Something went wrong ...</h2>";
        exit;
    }

    $result = mysqli_query($mysqli, $cQuery);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $c_result_array[] = $row;
        }
    } else {
        echo "<h2>Oops! Something went wrong ...</h2>";
        exit;
    }

    $result = mysqli_query($mysqli, $rwQuery);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $rw_result_array[] = $row;
        }
    } else {
        echo "<h2>Oops! Something went wrong ...</h2>";
        exit;
    }

    $result = mysqli_query($mysqli, $dQuery);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $d_result_array[] = $row;
        }
    } else {
        echo "<h2>Oops! Something went wrong ...</h2>";
        exit;
    }

    $result = mysqli_query($mysqli, $gQuery);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $g_result_array[] = $row;
        }
    } else {
        echo "<h2>Oops! Something went wrong ...</h2>";
        exit;
    }

    //TODO:
    //Add form: action, method
    //When button is clicked:
    //Show/hide Name field with JS
    //When submitted:
    //Validate Name field
    //Write each player to DB: team number (auto generate ... how?), position, number, current team
    //Or should this ^ just be part of the post?? yes, probably
    //Call function to submit post (custom or wp's???)
    //Use plugin or something to make sure IP address isn't submitting too many posts (25/hour; 100/day)
    //Redirect to blog page (to specific entry on blog page? what if multiple entries submitted at once?)


    echo "<p></p>";

    echo "<div class='team'>";

    echo "<div class='line'>";
    echo "<h2 class='player-type'>Forwards</h2>";

    echo "<div class='flex-container row'>";

    echo "<div class='player forward col-4'>" . $lw_result_array[0][name] . "<p>#" . $lw_result_array[0][number] . " " . $lw_result_array[0][currentTeam] . " " . "</div>";
    echo "<div class='player forward col-4'>" . $c_result_array[0][name] . "<p>#" . $c_result_array[0][number] . " " . $c_result_array[0][currentTeam] . " " . "</div>";
    echo "<div class='player forward col-4'>". $rw_result_array[0][name] . "<p>#" . $rw_result_array[0][number] . " " . $rw_result_array[0][currentTeam] . "</div>";
    
    echo "</div>";

    echo "<div class='flex-container row'>";

    echo "<div class='player forward col-4'>" . $lw_result_array[1][name] . "<p>#" . $lw_result_array[1][number] . " " . $lw_result_array[1][currentTeam] . " " . "</div>";
    echo "<div class='player forward col-4'>" . $c_result_array[1][name] . "<p>#" . $c_result_array[1][number] . " " . $c_result_array[1][currentTeam] . " " . "</div>";
    echo "<div class='player forward col-4'>". $rw_result_array[1][name] . "<p>#" . $rw_result_array[1][number] . " " . $rw_result_array[1][currentTeam] . "</div>";

    echo "</div>";

    echo "<div class='flex-container row'>";

    echo "<div class='player forward col-4'>" . $lw_result_array[2][name] . "<p>#" . $lw_result_array[2][number] . " " . $lw_result_array[2][currentTeam] . " " . "</div>";
    echo "<div class='player forward col-4'>" . $c_result_array[2][name] . "<p>#" . $c_result_array[2][number] . " " . $c_result_array[2][currentTeam] . " " . "</div>";
    echo "<div class='player forward col-4'>". $rw_result_array[2][name] . "<p>#" . $rw_result_array[2][number] . " " . $rw_result_array[2][currentTeam] . "</div>";

    echo "</div>";

    echo "<div class='flex-container row'>";

    echo "<div class='player forward col-4'>" . $lw_result_array[3][name] . "<p>#" . $lw_result_array[3][number] . " " . $lw_result_array[3][currentTeam] . " " . "</div>";
    echo "<div class='player forward col-4'>" . $c_result_array[3][name] . "<p>#" . $c_result_array[3][number] . " " . $c_result_array[3][currentTeam] . " " . "</div>";
    echo "<div class='player forward col-4'>". $rw_result_array[3][name] . "<p>#" . $rw_result_array[3][number] . " " . $rw_result_array[3][currentTeam] . "</div>";
    
    echo "</div>";
    echo "</div>";

    echo "<div class='pairing'>";
    echo "<h2 class='player-type'>Defensemen</h2>";

    echo "<div class='flex-container row'>";

    echo "<div class='player dman col-6'>" . $d_result_array[0][name] . "<p>#" . $d_result_array[0][number] . " " . $d_result_array[0][currentTeam] . " ". "</div>";
    echo "<div class='player dman col-6'>" . $d_result_array[1][name] . "<p>#" . $d_result_array[1][number] . " " . $d_result_array[1][currentTeam] . "</div>";

    echo "</div>";

    echo "<div class='flex-container row'>";

    echo "<div class='player dman col-6'>" . $d_result_array[2][name] . "<p>#" . $d_result_array[2][number] . " " . $d_result_array[2][currentTeam] . " ". "</div>";
    echo "<div class='player dman col-6'>" . $d_result_array[3][name] . "<p>#" . $d_result_array[3][number] . " " . $d_result_array[3][currentTeam] . "</div>";

    echo "</div>";

    echo "<div class='flex-container row'>";

    echo "<div class='player dman col-6'>" . $d_result_array[4][name] . "<p>#" . $d_result_array[4][number] . " " . $d_result_array[4][currentTeam] . " ". "</div>";
    echo "<div class='player dman col-6'>" . $d_result_array[5][name] . "<p>#" . $d_result_array[5][number] . " " . $d_result_array[5][currentTeam] . "</div>";

    echo "</div>";
    echo "</div>";

    echo "<div class='pairing'>";
    echo "<h2 class='player-type'>Goalies</h2>";

    echo "<div class='flex-container row'>";

    echo "<div class='player goalie col-6'>" . $g_result_array[0][name] . "<p>#" . $g_result_array[0][number] . " " . $g_result_array[0][currentTeam] . " " . "</div>";
    echo "<div class='player goalie col-6'>" . $g_result_array[1][name] . "<p>#" . $g_result_array[1][number] . " " . $g_result_array[1][currentTeam] . " " . "</div>";

    echo "</div>";
    echo "</div>";
    echo "<p class='link-address'>http://rubyarbogast.com/oneforone</p>";
    echo "</div>";

    echo "<div class='flex-container' id='optionButtons'>";

    echo "<form action='' id='postTeam' method='post'>
    <input type='text' name='lw1name' value='" . $lw_result_array[0][name] . "' >
    <input type='text' name='lw1number' value='" . $lw_result_array[0][number] . "' >
    <input type='text' name='lw1team' value='" . $lw_result_array[0][currentTeam] . "' >";
    
    echo "<button id='submitTeamButton' type='submit' name='submit' value='submit'>Post Team to Blog</button>";

    echo "<button class='get-team-button' id='secondaryButton'>New Team</button>";

    echo "</form></div>";

    
    wp_die(); 
}

add_action('wp_ajax_nopriv_get_team_desktop', 'get_team_desktop');
add_action('wp_ajax_get_team_desktop', 'get_team_desktop');

function rma_team_post() {

        global $wpdb;

/*         $lw1name = $lw_result_array[0][name];
        $lw1number = $lw_result_array[0][number];
        $lw1team = $lw_result_array[0][currentTeam]; */

        $lw1name = $_POST['lw1name'];
        $lw1number = $_POST['lw1number'];
        $lw1team = $_POST['lw1team'];

        echo $lw1name;
    
        $wpdb->insert( 
            'team', 
            array( 
                'lw_1_name' => $lw1name, 
                'lw_1_number' => $lw1number,
                'lw_1_current_team' => $lw1team
            ), 
            array( 
                '%s', 
                '%d',
                '%s' 
            ) 
        );
    
}

/*     $ini = parse_ini_file('config.ini');

    $mysqli = new mysqli($ini['db_host'], $ini['db_user'], $ini['db_password'], $ini['db_name']);
    if($mysqli->connect_error) {
        exit('<h2>Oops! Something went wrong ...</h2>');
        }

    $lw1name = 'John';
    $lw1number = 1;
    $lw1team = 'Wheat Kings';

    $sql = "INSERT INTO team (lw_1_name, lw_1_number, lw_1_current_team) VALUES ('$lw1name', '$lw1number', '$lw1team')";

    mysqli_query($mysqli, $sql);
    wp_die();  */
//}
add_action('wp_ajax_nopriv_rma_team_post', 'rma_team_post');
add_action('wp_ajax_rma_team_post', 'rma_team_post');
