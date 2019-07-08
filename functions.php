<?php

//TODO: change values
function my_enqueue() {
    wp_enqueue_script( 'makeTeam', get_template_directory_uri() . '/js/site-scripts/site-scripts.js', array('jquery') );
    wp_localize_script( 'makeTeam', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'my_enqueue' );

function theme_styles() {	

	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

function get_team() {
    $ini = parse_ini_file('config.ini');

    $mysqli = new mysqli($ini['db_host'], $ini['db_user'], $ini['db_password'], $ini['db_name']);
    if($mysqli->connect_error) {
        exit('Could not connect');
        }

    $lwQuery = "SELECT lw.name, lw.number, lw.currentTeam, lw.position FROM lwing AS lw ORDER BY rand() LIMIT 4";
    $cQuery = "SELECT c.name, c.number, c.currentTeam, c.position FROM center AS c ORDER BY rand() LIMIT 4";
    $rwQuery = "SELECT rw.name, rw.number, rw.currentTeam, rw.position FROM rwing AS rw ORDER BY rand() LIMIT 4";
    $dQuery = "SELECT d.name, d.number, d.currentTeam, d.position FROM defenseman AS d ORDER BY rand() LIMIT 6";
    $gQuery = "SELECT g.name, g.number, g.currentTeam, g.position FROM goalie AS g ORDER BY rand() LIMIT 2";

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
        echo "0 results";
    }

    $result = mysqli_query($mysqli, $cQuery);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $c_result_array[] = $row;
        }
    } else {
        echo "0 results";
    }

    $result = mysqli_query($mysqli, $rwQuery);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $rw_result_array[] = $row;
        }
    } else {
        echo "0 results";
    }

    $result = mysqli_query($mysqli, $dQuery);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $d_result_array[] = $row;
        }
    } else {
        echo "0 results";
    }

    $result = mysqli_query($mysqli, $gQuery);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $g_result_array[] = $row;
        }
    } else {
        echo "0 results";
    }

    echo "<div class='flex-container'>";

    echo "<div class='player'>" . $lw_result_array[0][name] . " #" . $lw_result_array[0][number] . " " . $lw_result_array[0][currentTeam] . "</div>";
    echo "<div class='player'>" . $c_result_array[0][name] . " #" . $c_result_array[0][number] . " " . $c_result_array[0][currentTeam] . "</div>";
    echo "<div class='player'>". $rw_result_array[0][name] . " #" . $rw_result_array[0][number] . " " . $rw_result_array[0][currentTeam] . "</div>";
    
    echo "</div>";

    echo "<div class='flex-container'>";

    echo "<div class='player'>";
    echo $lw_result_array[1][name] . " #" . $lw_result_array[1][number] . " " . $lw_result_array[1][currentTeam];
    echo "</div>";
    echo "<div class='player'>";
    echo $c_result_array[1][name] . " #" . $c_result_array[1][number] . " " . $c_result_array[1][currentTeam];
    echo "</div>";
    echo "<div class='player'>";
    echo $rw_result_array[1][name] . " #" . $rw_result_array[1][number] . " " . $rw_result_array[1][currentTeam];
    echo "</div>";

    echo "</div>";

    echo "<div class='flex-container'>";

    echo "<div class='player'>";
    echo $lw_result_array[2][name] . " #" . $lw_result_array[2][number] . " " . $lw_result_array[2][currentTeam];
    echo "</div>";
    echo "<div class='player'>";
    echo $c_result_array[2][name] . " #" . $c_result_array[2][number] . " " . $c_result_array[2][currentTeam];
    echo "</div>";
    echo "<div class='player'>";
    echo $rw_result_array[2][name] . " #" . $rw_result_array[2][number] . " " . $rw_result_array[2][currentTeam];
    echo "</div>";

    echo "</div>";

    echo "<div class='flex-container'>";

    echo "<div class='player'>";
    echo $lw_result_array[3][name] . " #" . $lw_result_array[3][number] . " " . $lw_result_array[3][currentTeam];
    echo "</div>";
    echo "<div class='player'>";
    echo $c_result_array[3][name] . " #" . $c_result_array[3][number] . " " . $c_result_array[3][currentTeam];
    echo "</div>";
    echo "<div class='player'>";
    echo $rw_result_array[3][name] . " #" . $rw_result_array[3][number] . " " . $rw_result_array[3][currentTeam];
    echo "</div>";

    echo "</div>";

    echo "<div class='flex-container'>";

    echo "<div class='player'>";
    echo $d_result_array[0][name] . " #" . $d_result_array[0][number] . " " . $d_result_array[0][currentTeam];
    echo "</div>";
    echo "<div class='player'>";
    echo $d_result_array[1][name] . " #" . $d_result_array[1][number] . " " . $d_result_array[1][currentTeam];
    echo "</div>";

    echo "</div>";

    echo "<div class='flex-container'>";

    echo "<div class='player'>";
    echo $d_result_array[2][name] . " #" . $d_result_array[2][number] . " " . $d_result_array[2][currentTeam];
    echo "</div>";
    echo "<div class='player'>";
    echo $d_result_array[3][name] . " #" . $d_result_array[3][number] . " " . $d_result_array[3][currentTeam];
    echo "</div>";

    echo "</div>";

    echo "<div class='flex-container'>";

    echo "<div class='player'>";
    echo $d_result_array[4][name] . " #" . $d_result_array[4][number] . " " . $d_result_array[4][currentTeam];
    echo "</div>";
    echo "<div class='player'>";
    echo $d_result_array[5][name] . " #" . $d_result_array[5][number] . " " . $d_result_array[5][currentTeam];
    echo "</div>";

    echo "</div>";

    echo "<div class='flex-container'>";

    echo "<div class='player'>";
    echo $g_result_array[0][name] . " #" . $g_result_array[0][number] . " " . $g_result_array[0][currentTeam];
    echo "</div>";
    echo "<div class='player'>";
    echo $g_result_array[1][name] . " #" . $g_result_array[1][number] . " " . $g_result_array[1][currentTeam];
    echo "</div>";

    echo "</div>";

    wp_die(); 
}

add_action('wp_ajax_nopriv_get_team', 'get_team');
add_action('wp_ajax_get_team', 'get_team');
