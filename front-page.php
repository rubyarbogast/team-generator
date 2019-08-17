<?php get_header(); ?> 

    <section>
        <div id="main">

            <div id="buttonDiv">
                <div class="flex-container button-container">
                    <button class="get-team-button" id="mainButton">Create a Random Team!</button>
                </div>
            </div>
            
            <div id="content">
                <div class="flex-container row" id="key">
                    <div class='player forward col-4'>Forward</div>
                    <div class='player dman col-4'>Defenseman</div>
                    <div class='player goalie col-4'>Goalie</div>
                </div>
                <div id="showTeam">
                </div>
                <div class="flex-container" id="optionButtons">
<!--                     <button id='submitTeamButton' class='submit-team' type='submit' value='submit'>Post Team to Blog</button>
                    <button class="get-team-button" id="secondaryButton">New Team</button> -->
                </div>
            </div>

        </div>
    </section>

<?php get_footer(); ?>