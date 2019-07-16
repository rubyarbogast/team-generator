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
        <div class="flex-container" id="optionButtons">
            <button>New Team</button>
            <button>Post Team to Blog</button>
            <button>Save Team as Image</button>
        </div>
    </section>
<?php get_footer(); ?>