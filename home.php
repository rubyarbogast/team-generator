<?php get_header(); ?> 

<!--TODO: query DB and add styles-->
<?php 
global $wpdb;
$team_id_list = $wpdb->get_col( "SELECT id FROM rma_team" );
echo "Team IDs: {$team_id_list[0]}, {$team_id_list[1]}, {$team_id_list[2]}";
?>

<?php foreach ($team_id_list as $team_id): ?>
    <?php 
    global $wpdb;
    //Get lines, pairs, tandem
/*     $line1 = $wpdb->get_row( "SELECT * FROM rma_line WHERE team_id = $team_id LIMIT 1", ARRAY_A );
    $pairs = $wpdb->get_row( "SELECT * FROM rma_pair WHERE team_id = $team_id", ARRAY_A );
    $tandem = $wpdb->get_row( "SELECT * FROM rma_tandem WHERE team_id = $team_id", ARRAY_A ); */

    //Get player IDs (returns a string; has to be cast to int)
    $lw_id_array = $wpdb->get_col( "SELECT lw_id FROM rma_line WHERE team_id = $team_id" );
    var_dump($lw_id_array);

    $lw_id1 = (int)$lw_id_array[0];
    var_dump($lw_id1);

    foreach ($lw_id_array as $lw_id) {
    //From the players table, select the player with the id from $lines array
        $lw = $wpdb->get_row( "SELECT * FROM rma_player WHERE id = $lw_id", ARRAY_A );
    }

    ?>

    <div class="entries">
        <p>A team</p>
        <?php echo $lw1['name'] ?>
    </div>
<?php endforeach; ?>



<?php get_footer(); ?>