<?php get_header(); ?> 

<section>
        <div id="buttonDiv">
            <div class="flex-container button-container">
                <button class="main-button" onclick="makeTeam()">Create a Random Team!</button>
            </div>
        </div>
        <div id="showTeam"></div>
        <div class="flex-container" id="optionButtons">
            <button class="secondary-button" onclick="makeTeam()">New Team</button>
            <button class="secondary-button">Post Team to Blog</button>
            <button class="secondary-button">Save Team as Image</button>
        </div>
</section>
  
<?php get_footer(); ?>