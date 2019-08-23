<?php get_header(); ?> 

<!--TODO: query DB and add styles-->
<?php 
global $wpdb;
$team_id_list = $wpdb->get_col( "SELECT id FROM rma_team" );
//echo "Team IDs: {$team_id_list[0]}, {$team_id_list[1]}, {$team_id_list[2]}";
?>

<?php foreach ($team_id_list as $team_id): ?>
    <?php 
    global $wpdb;

    //Get player IDs (returns a string; has to be cast to int)
    $lw_id_array = $wpdb->get_col( "SELECT lw_id FROM rma_line WHERE team_id = $team_id" );


    $lw_id1 = (int)$lw_id_array[0];
    $lw_id2 = (int)$lw_id_array[1];
    $lw_id3 = (int)$lw_id_array[2];
    $lw_id4 = (int)$lw_id_array[3];

    //From the players table, select the player with the id from the position array
    $lw1 = $wpdb->get_row( "SELECT * FROM rma_player WHERE id = $lw_id1", ARRAY_A );
    $lw2 = $wpdb->get_row( "SELECT * FROM rma_player WHERE id = $lw_id2", ARRAY_A );
    $lw3 = $wpdb->get_row( "SELECT * FROM rma_player WHERE id = $lw_id3", ARRAY_A );
    $lw4 = $wpdb->get_row( "SELECT * FROM rma_player WHERE id = $lw_id4", ARRAY_A );

    ?>

    <div class="entries">
        <p>A team</p>
        <?php echo $lw1['name'] ?>
        <?php echo $lw2['name'] ?>
        <?php echo $lw3['name'] ?>
        <?php echo $lw4['name'] ?>
    </div>
<?php endforeach; ?>



<?php get_footer(); ?>