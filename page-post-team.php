<?php get_header(); ?> 

    <h2>Logged in!</h2>

    <?php if($_SESSION['lw_array']): ?>

        <?php $lw_result_array = $_SESSION['lw_array']; 
        $c_result_array = $_SESSION['c_array']; 
        $rw_result_array = $_SESSION['rw_array']; 
        $d_result_array = $_SESSION['d_array']; 
        $g_result_array = $_SESSION['g_array']; 
        ?>

    <div class='centered'> 
        <form action='' id='postTeam' method='post'>
            <!-- First line -->
            <input id='lw1name' type='hidden' value='<?php echo $lw_result_array[0][name]; ?>' >
            <input id='lw1number' type='hidden' value='<?php echo $lw_result_array[0][number]; ?>' >
            <input id='lw1team' type='hidden' value='<?php echo $lw_result_array[0][currentTeam]; ?>' >
            <input id='lw1abbr' type='hidden' value='<?php echo $lw_result_array[0][teamAbbr]; ?>' >

            <input id='c1name' type='hidden' value='<?php echo $c_result_array[0][name]; ?> ' >
            <input id='c1number' type='hidden' value='<?php echo $c_result_array[0][number]; ?>' >
            <input id='c1team' type='hidden' value='<?php echo $c_result_array[0][currentTeam]; ?>' >
            <input id='c1abbr' type='hidden' value='<?php echo $c_result_array[0][teamAbbr]; ?>' >

            <input id='rw1name' type='hidden' value='<?php echo $rw_result_array[0][name]; ?>' >
            <input id='rw1number' type='hidden' value='<?php echow_result_array[0][number]; ?>' >
            <input id='rw1team' type='hidden' value='<?php echo $rw_result_array[0][currentTeam]; ?>' >
            <input id='rw1abbr' type='hidden' value='<?php echo $rw_result_array[0][teamAbbr]; ?>' >

            <!-- Second line -->
            <input id='lw2name' type='hidden' value='<?php echo $lw_result_array[1][name]; ?>' >
            <input id='lw2number' type='hidden' value='<?php echo $lw_result_array[1][number]; ?>' >
            <input id='lw2team' type='hidden' value='<?php echo $lw_result_array[1][currentTeam]; ?>' >
            <input id='lw2abbr' type='hidden' value='<?php echo $lw_result_array[1][teamAbbr]; ?>' >

            <input id='c2name' type='hidden' value='<?php echo $c_result_array[1][name]; ?>' >
            <input id='c2number' type='hidden' value='<?php echo $c_result_array[1][number]; ?>' >
            <input id='c2team' type='hidden' value='<?php echo $c_result_array[1][currentTeam]; ?>' >
            <input id='c2abbr' type='hidden' value='<?php echo $c_result_array[1][teamAbbr]; ?>' >

            <input id='rw2name' type='hidden' value='<?php echo $rw_result_array[1][name]; ?>' >
            <input id='rw2number' type='hidden' value='<?php echo $rw_result_array[1][number]; ?>' >
            <input id='rw2team' type='hidden' value='<?php echo $rw_result_array[1][currentTeam]; ?>' >
            <input id='rw2abbr' type='hidden' value='<?php echo $rw_result_array[1][teamAbbr]; ?>' >

            <!-- Third line -->
            <input id='lw3name' type='hidden' value='<?php echo $lw_result_array[2][name]; ?>' >
            <input id='lw3number' type='hidden' value='<?php echo $lw_result_array[2][number]; ?>' >
            <input id='lw3team' type='hidden' value='<?php echo $lw_result_array[2][currentTeam]; ?>' >
            <input id='lw3abbr' type='hidden' value='<?php echo $lw_result_array[2][teamAbbr]; ?>' >

            <input id='c3name' type='hidden' value='<?php echo $c_result_array[2][name]; ?>' >
            <input id='c3number' type='hidden' value='<?php echo $c_result_array[2][number]; ?>' >
            <input id='c3team' type='hidden' value='<?php echo $c_result_array[2][currentTeam]; ?>' >
            <input id='c3abbr' type='hidden' value='<?php echo $c_result_array[2][teamAbbr]; ?>' >

            <input id='rw3name' type='hidden' value='<?php echo $rw_result_array[2][name]; ?>' >
            <input id='rw3number' type='hidden' value='<?php echo $rw_result_array[2][number]; ?>' >
            <input id='rw3team' type='hidden' value='<?php echo $rw_result_array[2][currentTeam]; ?>' >
            <input id='rw3abbr' type='hidden' value='<?php echo $rw_result_array[2][teamAbbr]; ?>' >

            <!-- Fourth line --> 
            <input id='lw4name' type='hidden' value='<?php echo $lw_result_array[3][name]; ?>' >
            <input id='lw4number' type='hidden' value='<?php echo $lw_result_array[3][number]; ?>' >
            <input id='lw4team' type='hidden' value='<?php echo $lw_result_array[3][currentTeam]; ?>' >
            <input id='lw4abbr' type='hidden' value='<?php echo $lw_result_array[3][teamAbbr]; ?>' >

            <input id='c4name' type='hidden' value='<?php echo $c_result_array[3][name]; ?>' >
            <input id='c4number' type='hidden' value='<?php echo $c_result_array[3][number]; ?>' >
            <input id='c4team' type='hidden' value='<?php echo $c_result_array[3][currentTeam]; ?>' >
            <input id='c4abbr' type='hidden' value='<?php echo $c_result_array[3][teamAbbr]; ?>' >

            <input id='rw4name' type='hidden' value='<?php echo $rw_result_array[3][name]; ?>' >
            <input id='rw4number' type='hidden' value='<?php echo $rw_result_array[3][number]; ?>' >
            <input id='rw4team' type='hidden' value='<?php echo $rw_result_array[3][currentTeam]; ?>' >
            <input id='rw4abbr' type='hidden' value='<?php echo $rw_result_array[3][teamAbbr]; ?>' >

            <!-- Defense --> 
            <input id='d1name' type='hidden' value='<?php echo $d_result_array[0][name]; ?>' >
            <input id='d1number' type='hidden' value='<?php echo $d_result_array[0][number]; ?>' >
            <input id='d1team' type='hidden' value='<?php echo $d_result_array[0][currentTeam]; ?>' >
            <input id='d1abbr' type='hidden' value='<?php echo $d_result_array[0][teamAbbr]; ?>' >

            <input id='d2name' type='hidden' value='<?php echo $d_result_array[1][name]; ?>' >
            <input id='d2number' type='hidden' value='<?php echo $d_result_array[1][number]; ?>' >
            <input id='d2team' type='hidden' value='<?php echo $d_result_array[1][currentTeam]; ?>' >
            <input id='d2abbr' type='hidden' value='<?php echo $d_result_array[1][teamAbbr]; ?>' >

            <input id='d3name' type='hidden' value='<?php echo $d_result_array[2][name]; ?>' >
            <input id='d3number' type='hidden' value='<?php echo $d_result_array[2][number]; ?>' >
            <input id='d3team' type='hidden' value='<?php echo $d_result_array[2][currentTeam]; ?>' >
            <input id='d3abbr' type='hidden' value='<?php echo $d_result_array[2][teamAbbr]; ?>' >

            <input id='d4name' type='hidden' value='<?php echo $d_result_array[3][name]; ?>' >
            <input id='d4number' type='hidden' value='<?php echo $d_result_array[3][number]; ?>' >
            <input id='d4team' type='hidden' value='<?php echo $d_result_array[3][currentTeam]; ?>' >
            <input id='d4abbr' type='hidden' value='<?php echo $d_result_array[3][teamAbbr]; ?>' >

            <input id='d5name' type='hidden' value='<?php echo $d_result_array[4][name]; ?>' >
            <input id='d5number' type='hidden' value='<?php echo $d_result_array[4][number]; ?>' >
            <input id='d5team' type='hidden' value='<?php echo $d_result_array[4][currentTeam]; ?>' >
            <input id='d5abbr' type='hidden' value='<?php echo $d_result_array[4][teamAbbr]; ?>' >

            <input id='d6name' type='hidden' value='<?php echo $d_result_array[5][name]; ?>' >
            <input id='d6number' type='hidden' value='<?php echo $d_result_array[5][number]; ?>' >
            <input id='d6team' type='hidden' value='<?php echo $d_result_array[5][currentTeam]; ?>' >
            <input id='d6abbr' type='hidden' value='<?php echo $d_result_array[5][teamAbbr]; ?>' >

            <!-- Goalkeepers -->
            <input id='g1name' type='hidden' value='<?php echo $g_result_array[0][name]; ?>' >
            <input id='g1number' type='hidden' value='<?php echo $g_result_array[0][number]; ?>' >
            <input id='g1team' type='hidden' value='<?php echo $g_result_array[0][currentTeam]; ?>' >
            <input id='g1abbr' type='hidden' value='<?php echo $g_result_array[0][teamAbbr]; ?>' >

            <input id='g2name' type='hidden' value='<?php echo $g_result_array[1][name]; ?>' >
            <input id='g2number' type='hidden' value='<?php echo $g_result_array[1][number]; ?>' >
            <input id='g2team' type='hidden' value='<?php echo $g_result_array[1][currentTeam]; ?>' >
            <input id='g2abbr' type='hidden' value='<?php echo $g_result_array[1][teamAbbr]; ?>' >

            <div class='button-container flex-container'>
                <button id='submitTeamButton' class='submit-team post-from-login-button' type='submit'>Submit Your Team!</button>
            </div>
        </form>

        <?php else: ?>
            <?php $url = home_url( '/' ); ?>
            <h3>No teams saved yet. Generate one <a href='<?php echo esc_url( $url ); ?>'>here</a>.</h3>
        <?php endif; ?>
    </div>

<?php get_footer(); ?>