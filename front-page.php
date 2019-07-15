<?php get_header(); ?> 

<!-- TODO: on upload, place config files in private folder -->
<!-- TODO: buttons: create a new team, submit the team to blog (catch errors), save team as image -->

    <section>
        <div id="buttonDiv">
            <div class="flex-container button-container">
                <button class="main-button" onclick="makeTeam()">Create a Random Team!</button>
            </div>
        </div>
        <div id="showTeam"></div>

    </section>
<?php get_footer(); ?>