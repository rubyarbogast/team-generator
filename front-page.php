<?php get_header(); ?> 

<!-- TODO: research security for config file -->
<!-- TODO: button to create team -->
<!-- TODO: on click, create and display team -->
<!-- TODO: buttons: create a new team, submit the team to blog (catch errors), save team as image -->

    <section>
        <?php 
        $ini = parse_ini_file('config.ini');
        $mysqli = new mysqli($ini['db_host'], $ini['db_user'], $ini['db_password'], $ini['db_name']);
        if($mysqli->connect_error) {
            exit('Could not connect');
          }
        ?>


    </section>
<?php get_footer(); ?>