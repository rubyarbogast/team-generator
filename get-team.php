<?php 
// TODO: on upload, place config files in private folder 
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

    $stmt = $mysqli->prepare($lwQuery);
    $stmt->bind_param("s", $_GET['q']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($name, $number, $currentTeam, $position);
    $stmt->fetch();
    $stmt->close();

    echo "<p>";
    echo $name . $number . $currentTeam . $position;
    echo "</p>";
}
?>