<?php get_header(); ?> 

<?php 
global $wpdb;
$team_id_list = $wpdb->get_col( "SELECT id FROM rma_team" );
$newest_first_team_list = array_reverse($team_id_list);

$limit = 3;

$total = count($newest_first_team_list);
$pages = ceil($total / $limit);
$result = ceil($total / $limit);

$current = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$next = $current < $pages ? $current + 1 : null;
$previous = $current > 1 ? $current - 1 : null;

$offset = ($current - 1) * $limit;
$newest_first_team_list = array_slice($newest_first_team_list, $offset, $limit);

$customPagHTML     = "";

/* $customPagHTML     = "";
$query             = "SELECT id FROM rma_team";
$total_query     = "SELECT COUNT(3) FROM (${query}) AS combined_table";
$total             = $wpdb->get_var( $total_query );
$items_per_page = 3;
$page             = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$offset         = ( $page * $items_per_page ) - $items_per_page;
$result         = $wpdb->get_results( $query . " ORDER BY field DESC LIMIT ${offset}, ${items_per_page}" );
$totalPage         = ceil($total / $items_per_page); */


?>

<h2 class='blog-header'>User-Submitted Teams</h2>
<?php foreach ($newest_first_team_list as $team_id): ?>
    <?php 
    global $wpdb;

    //Get player IDs (returns a string; has to be cast to int)
    $lw_id_array = $wpdb->get_col( "SELECT lw_id FROM rma_line WHERE team_id = $team_id" );
    $c_id_array = $wpdb->get_col( "SELECT c_id FROM rma_line WHERE team_id = $team_id" );
    $rw_id_array = $wpdb->get_col( "SELECT rw_id FROM rma_line WHERE team_id = $team_id" );
    $ld_id_array = $wpdb->get_col( "SELECT ld_id FROM rma_pair WHERE team_id = $team_id" );
    $rd_id_array = $wpdb->get_col( "SELECT rd_id FROM rma_pair WHERE team_id = $team_id" );
    $g1_str_id = $wpdb->get_col( "SELECT g1_id FROM rma_tandem WHERE team_id = $team_id" );
    $g2_str_id = $wpdb->get_col( "SELECT g2_id FROM rma_tandem WHERE team_id = $team_id" );
    $user_id = $wpdb->get_var( "SELECT user FROM rma_team WHERE id = $team_id" );
    $date = $wpdb->get_var( "SELECT date_posted FROM rma_team WHERE id = $team_id" );

    $user_info = get_userdata($user_id);
    $submitted_by = $user_info->display_name;

    $lw_id1 = (int)$lw_id_array[0];
    $lw_id2 = (int)$lw_id_array[1];
    $lw_id3 = (int)$lw_id_array[2];
    $lw_id4 = (int)$lw_id_array[3];

    $c_id1 = (int)$c_id_array[0];
    $c_id2 = (int)$c_id_array[1];
    $c_id3 = (int)$c_id_array[2];
    $c_id4 = (int)$c_id_array[3];

    $rw_id1 = (int)$rw_id_array[0];
    $rw_id2 = (int)$rw_id_array[1];
    $rw_id3 = (int)$rw_id_array[2];
    $rw_id4 = (int)$rw_id_array[3];

    $ld_id1 = (int)$ld_id_array[0];
    $ld_id2 = (int)$ld_id_array[1];
    $ld_id3 = (int)$ld_id_array[2];

    $rd_id1 = (int)$rd_id_array[0];
    $rd_id2 = (int)$rd_id_array[1];
    $rd_id3 = (int)$rd_id_array[2];

    $g1_id = (int)$g1_str_id[0];
    $g2_id = (int)$g2_str_id[0];

    //From the players table, select the player with the id from the position array
    $lw1 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $lw_id1", ARRAY_A );
    $lw2 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $lw_id2", ARRAY_A );
    $lw3 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $lw_id3", ARRAY_A );
    $lw4 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $lw_id4", ARRAY_A );

    $c1 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $c_id1", ARRAY_A );
    $c2 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $c_id2", ARRAY_A );
    $c3 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $c_id3", ARRAY_A );
    $c4 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $c_id4", ARRAY_A );

    $rw1 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $rw_id1", ARRAY_A );
    $rw2 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $rw_id2", ARRAY_A );
    $rw3 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $rw_id3", ARRAY_A );
    $rw4 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $rw_id4", ARRAY_A );

    $ld1 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $ld_id1", ARRAY_A );
    $ld2 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $ld_id2", ARRAY_A );
    $ld3 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $ld_id3", ARRAY_A );

    $rd1 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $rd_id1", ARRAY_A );
    $rd2 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $rd_id2", ARRAY_A );
    $rd3 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $rd_id3", ARRAY_A );

    $g1 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $g1_id", ARRAY_A );
    $g2 = $wpdb->get_row( "SELECT * FROM rma_all_players WHERE nhlId = $g2_id", ARRAY_A );

    ?>

    <div class='entries show-mobile'>
        <!-- Forwards -->
        <div>
            <h3>Forwards</h3>
            <!-- First line -->
            <div class='flex-container row'>
                <div class='player forward col-4'>
                    <?php echo $lw1['name'][0] . ". " . substr($lw1['name'], strpos($lw1['name'], " ") + 1); ?><p> #<?php echo $lw1['number'] ?>  <?php echo $lw1['teamAbbr'] ?></p>
                </div>
                <div class='player forward col-4'>
                    <?php echo $c1['name'][0] . ". " . substr($c1['name'], strpos($c1['name'], " ") + 1); ?><p> #<?php echo $c1['number'] ?>  <?php echo $c1['teamAbbr'] ?></p>
                </div>
                <div class='player forward col-4'>
                    <?php echo $rw1['name'][0] . ". " . substr($rw1['name'], strpos($rw1['name'], " ") + 1); ?><p> #<?php echo $rw1['number'] ?>  <?php echo $rw1['teamAbbr'] ?></p>
                </div>
            </div>
            <!-- Second line -->
            <div class='flex-container row'>
                <div class='player forward col-4'>
                    <?php echo $lw2['name'][0] . ". " . substr($lw2['name'], strpos($lw2['name'], " ") + 1); ?><p> #<?php echo $lw2['number'] ?>  <?php echo $lw2['teamAbbr'] ?></p>
                </div>
                <div class='player forward col-4'>
                    <?php echo $c2['name'][0] . ". " . substr($c2['name'], strpos($c2['name'], " ") + 1); ?><p> #<?php echo $c2['number'] ?>  <?php echo $c2['teamAbbr'] ?></p>
                </div>
                <div class='player forward col-4'>
                    <?php echo $rw2['name'][0] . ". " . substr($rw2['name'], strpos($rw2['name'], " ") + 1); ?><p> #<?php echo $rw2['number'] ?>  <?php echo $rw2['teamAbbr'] ?></p>
                </div>
            </div>
            <!-- Third line -->
            <div class='flex-container row'>
                <div class='player forward col-4'>
                    <?php echo $lw3['name'][0] . ". " . substr($lw3['name'], strpos($lw3['name'], " ") + 1); ?><p> #<?php echo $lw3['number'] ?>  <?php echo $lw3['teamAbbr'] ?></p>
                </div>
                <div class='player forward col-4'>
                    <?php echo $c3['name'][0] . ". " . substr($c3['name'], strpos($c3['name'], " ") + 1); ?><p> #<?php echo $c3['number'] ?>  <?php echo $c3['teamAbbr'] ?></p>
                </div>
                <div class='player forward col-4'>
                    <?php echo $rw3['name'][0] . ". " . substr($rw3['name'], strpos($rw3['name'], " ") + 1); ?><p> #<?php echo $rw3['number'] ?>  <?php echo $rw3['teamAbbr'] ?></p>
                </div>
            </div>
            <!-- Fourth line -->
            <div class='flex-container row'>
                <div class='player forward col-4'>
                    <?php echo $lw4['name'][0] . ". " . substr($lw4['name'], strpos($lw4['name'], " ") + 1); ?><p> #<?php echo $lw4['number'] ?>  <?php echo $lw4['teamAbbr'] ?></p>
                </div>
                <div class='player forward col-4'>
                    <?php echo $c4['name'][0] . ". " . substr($c4['name'], strpos($c4['name'], " ") + 1); ?><p> #<?php echo $c4['number'] ?>  <?php echo $c4['teamAbbr'] ?></p>
                </div>
                <div class='player forward col-4'>
                    <?php echo $rw4['name'][0] . ". " . substr($rw4['name'], strpos($rw4['name'], " ") + 1); ?><p> #<?php echo $rw4['number'] ?>  <?php echo $rw4['teamAbbr'] ?></p>
                </div>
            </div>
        </div>

    <!-- Defensemen -->
    <div>
        <h3>Defensemen</h3>
        <!-- First pair -->
        <div class='flex-container row'>
            <div class='player dman col-6'>
                <?php echo $ld1['name'][0] . ". " . substr($ld1['name'], strpos($ld1['name'], " ") + 1); ?><p> #<?php echo $ld1['number'] ?>  <?php echo $ld1['teamAbbr'] ?></p>
            </div>
            <div class='player dman col-6'>
                <?php echo $rd1['name'][0] . ". " . substr($rd1['name'], strpos($rd1['name'], " ") + 1); ?><p> #<?php echo $rd1['number'] ?>  <?php echo $rd1['teamAbbr'] ?></p>
            </div>
        </div>
        <!-- Second pair -->
        <div class='flex-container row'>
            <div class='player dman col-6'>
                <?php echo $ld2['name'][0] . ". " . substr($ld2['name'], strpos($ld2['name'], " ") + 1); ?><p> #<?php echo $ld2['number'] ?>  <?php echo $ld2['teamAbbr'] ?></p>
            </div>
            <div class='player dman col-6'>
                <?php echo $rd2['name'][0] . ". " . substr($rd2['name'], strpos($rd2['name'], " ") + 1); ?><p> #<?php echo $rd2['number'] ?>  <?php echo $rd2['teamAbbr'] ?></p>
            </div>
        </div>
        <!-- Third pair -->
        <div class='flex-container row'>
            <div class='player dman col-6'>
                <?php echo $ld3['name'][0] . ". " . substr($ld3['name'], strpos($ld3['name'], " ") + 1); ?><p> #<?php echo $ld3['number'] ?>  <?php echo $ld3['teamAbbr'] ?></p>
            </div>
            <div class='player dman col-6'>
                <?php echo $rd3['name'][0] . ". " . substr($rd3['name'], strpos($rd3['name'], " ") + 1); ?><p> #<?php echo $rd3['number'] ?>  <?php echo $rd3['teamAbbr'] ?></p>
            </div>
        </div>
        
    </div>
    <!-- Goalie tandem --> 
    <div>
        <h3>Goalies</h3>
        <div class='flex-container row'>
            <div class='player goalie col-6'>
                <?php echo $g1['name'][0] . ". " . substr($g1['name'], strpos($g1['name'], " ") + 1); ?><p> #<?php echo $g1['number'] ?>  <?php echo $g1['teamAbbr'] ?></p>
            </div>
            <div class='player goalie col-6'>
                <?php echo $g2['name'][0] . ". " . substr($g2['name'], strpos($g2['name'], " ") + 1); ?><p> #<?php echo $g2['number'] ?>  <?php echo $g2['teamAbbr'] ?></p>
            </div>
        </div>
        <p>Submitted by <?php echo $submitted_by; ?> | <?php echo date('F d, Y',strtotime($date)); ?></p>
        <p class='link-address'>http://rubyarbogast.com/oneforone</p>
    </div>
</div>

    <div class='entries show-desktop'>
         <!-- Forwards -->
            <div>
                <h3>Forwards</h3>
                <!-- First line -->
                <div class='flex-container row'>
                    <div class='player forward col-4'>
                        <?php echo $lw1['name'] ?><p> #<?php echo $lw1['number'] ?>  <?php echo $lw1['currentTeam'] ?></p>
                    </div>
                    <div class='player forward col-4'>
                        <?php echo $c1['name'] ?><p> #<?php echo $c1['number'] ?>  <?php echo $c1['currentTeam'] ?></p>
                    </div>
                    <div class='player forward col-4'>
                        <?php echo $rw1['name'] ?><p> #<?php echo $rw1['number'] ?>  <?php echo $rw1['currentTeam'] ?></p>
                    </div>
                </div>
                <!-- Second line -->
                <div class='flex-container row'>
                    <div class='player forward col-4'>
                        <?php echo $lw2['name'] ?><p> #<?php echo $lw2['number'] ?>  <?php echo $lw2['currentTeam'] ?></p>
                    </div>
                    <div class='player forward col-4'>
                        <?php echo $c2['name'] ?><p> #<?php echo $c2['number'] ?>  <?php echo $c2['currentTeam'] ?></p>
                    </div>
                    <div class='player forward col-4'>
                        <?php echo $rw2['name'] ?><p> #<?php echo $rw2['number'] ?>  <?php echo $rw2['currentTeam'] ?></p>
                    </div>
                </div>
                <!-- Third line -->
                <div class='flex-container row'>
                    <div class='player forward col-4'>
                        <?php echo $lw3['name'] ?><p> #<?php echo $lw3['number'] ?>  <?php echo $lw3['currentTeam'] ?></p>
                    </div>
                    <div class='player forward col-4'>
                        <?php echo $c3['name'] ?><p> #<?php echo $c3['number'] ?>  <?php echo $c3['currentTeam'] ?></p>
                    </div>
                    <div class='player forward col-4'>
                        <?php echo $rw3['name'] ?><p> #<?php echo $rw3['number'] ?>  <?php echo $rw3['currentTeam'] ?></p>
                    </div>
                </div>
                <!-- Fourth line -->
                <div class='flex-container row'>
                    <div class='player forward col-4'>
                        <?php echo $lw4['name'] ?><p> #<?php echo $lw4['number'] ?>  <?php echo $lw4['currentTeam'] ?></p>
                    </div>
                    <div class='player forward col-4'>
                        <?php echo $c4['name'] ?><p> #<?php echo $c4['number'] ?>  <?php echo $c4['currentTeam'] ?></p>
                    </div>
                    <div class='player forward col-4'>
                        <?php echo $rw4['name'] ?><p> #<?php echo $rw4['number'] ?>  <?php echo $rw4['currentTeam'] ?></p>
                    </div>
                </div>
            </div>

            <!-- Defensemen -->
            <div>
                <h3>Defensemen</h3>
                <!-- First pair -->
                <div class='flex-container row'>
                    <div class='player dman col-6'>
                        <?php echo $ld1['name'] ?><p> #<?php echo $ld1['number'] ?>  <?php echo $ld1['currentTeam'] ?></p>
                    </div>
                    <div class='player dman col-6'>
                        <?php echo $rd1['name'] ?><p> #<?php echo $rd1['number'] ?>  <?php echo $rd1['currentTeam'] ?></p>
                    </div>
                </div>
                <!-- Second pair -->
                <div class='flex-container row'>
                    <div class='player dman col-6'>
                        <?php echo $ld2['name'] ?><p> #<?php echo $ld2['number'] ?>  <?php echo $ld2['currentTeam'] ?></p>
                    </div>
                    <div class='player dman col-6'>
                        <?php echo $rd2['name'] ?><p> #<?php echo $rd2['number'] ?>  <?php echo $rd2['currentTeam'] ?></p>
                    </div>
                </div>
                <!-- Third pair -->
                <div class='flex-container row'>
                    <div class='player dman col-6'>
                        <?php echo $ld3['name'] ?><p> #<?php echo $ld3['number'] ?>  <?php echo $ld3['currentTeam'] ?></p>
                    </div>
                    <div class='player dman col-6'>
                        <?php echo $rd3['name'] ?><p> #<?php echo $rd3['number'] ?>  <?php echo $rd3['currentTeam'] ?></p>
                    </div>
                </div>
            </div>
            <!-- Goalie tandem --> 
            <div>
                <h3>Goalies</h3>
                <div class='flex-container row'>
                    <div class='player goalie col-6'>
                        <?php echo $g1['name'] ?><p> #<?php echo $g1['number'] ?>  <?php echo $g1['currentTeam'] ?></p>
                    </div>
                    <div class='player goalie col-6'>
                        <?php echo $g2['name'] ?><p> #<?php echo $g2['number'] ?>  <?php echo $g2['currentTeam'] ?></p>
                    </div>
                </div>
            </div>
            <p>Submitted by <?php echo $submitted_by; ?> | <?php echo date('F d, Y',strtotime($date)); ?></p>
            <p class='link-address'>http://rubyarbogast.com/oneforone</p>
    </div>

<?php endforeach; ?>

<!-- <? if($previous): ?>
    <a href="<?php bloginfo('url'); ?>/blog?paged=<?= $previous ?>">Previous</a>
<? endif ?>
<? if($next) : ?>
    <a href="<?php bloginfo('url'); ?>/blog?paged=<?= $next ?>">Next</a>
<?php endif; ?> -->

<?php 
if($pages > 1){
    $customPagHTML     =  '<div><span>Page '.$page.' of '.$pages.'</span>'.paginate_links( array(
    'base' => add_query_arg( 'cpage', '%#%' ),
    'format' => '',
    'prev_text' => __('&laquo;'),
    'next_text' => __('&raquo;'),
    'total' => $pages,
    'current' => $current
    )).'</div>';
    }

echo $customPagHTML;
?>

<?php get_footer(); ?>