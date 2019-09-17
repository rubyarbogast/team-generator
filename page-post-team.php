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
            <input id='lw1Id' type='hidden' value='<?php echo $lw_result_array[0][nhlId]; ?>' >
            <input id='c1Id' type='hidden' value='<?php echo $c_result_array[0][nhlId]; ?> ' >
            <input id='rw1Id' type='hidden' value='<?php echo $rw_result_array[0][nhlId]; ?>' >

            <!-- Second line -->
            <input id='lw2Id' type='hidden' value='<?php echo $lw_result_array[1][nhlId]; ?>' >
            <input id='c2Id' type='hidden' value='<?php echo $c_result_array[1][nhlId]; ?>' >
            <input id='rw2Id' type='hidden' value='<?php echo $rw_result_array[1][nhlId]; ?>' >

            <!-- Third line -->
            <input id='lw3Id' type='hidden' value='<?php echo $lw_result_array[2][nhlId]; ?>' >
            <input id='c3Id' type='hidden' value='<?php echo $c_result_array[2][nhlId]; ?>' >
            <input id='rw3Id' type='hidden' value='<?php echo $rw_result_array[2][nhlId]; ?>' >

            <!-- Fourth line --> 
            <input id='lw4Id' type='hidden' value='<?php echo $lw_result_array[3][nhlId]; ?>' >
            <input id='c4Id' type='hidden' value='<?php echo $c_result_array[3][nhlId]; ?>' >
            <input id='rw4Id' type='hidden' value='<?php echo $rw_result_array[3][nhlId]; ?>' >

            <!-- Defense --> 
            <input id='d1Id' type='hidden' value='<?php echo $d_result_array[0][nhlId]; ?>' >
            <input id='d2Id' type='hidden' value='<?php echo $d_result_array[1][nhlId]; ?>' >
            <input id='d3Id' type='hidden' value='<?php echo $d_result_array[2][nhlId]; ?>' >
            <input id='d4Id' type='hidden' value='<?php echo $d_result_array[3][nhlId]; ?>' >
            <input id='d5Id' type='hidden' value='<?php echo $d_result_array[4][nhlId]; ?>' >
            <input id='d6Id' type='hidden' value='<?php echo $d_result_array[5][nhlId]; ?>' >

            <!-- Goalkeepers -->
            <input id='g1Id' type='hidden' value='<?php echo $g_result_array[0][nhlId]; ?>' >
            <input id='g2Id' type='hidden' value='<?php echo $g_result_array[1][nhlId]; ?>' >

            <div class='button-container flex-container'>
                <button id='submitTeamButton' class='submit-team post-from-login-button' type='submit'>Submit Your Team!</button>
            </div>
        </form>

        <?php else: ?>
            <?php $url = home_url( '/' ); ?>
            <h3>No team to post yet. Generate one <a href='<?php echo esc_url( $url ); ?>'>here</a>.</h3>
        <?php endif; ?>
    </div>

<?php get_footer(); ?>