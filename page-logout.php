<?php get_header() ?>

<h2>Log Out of the Site</h2>
<div class="flex-container">
    <h3><a href="<?php echo wp_logout_url( home_url() ); ?>" class="logout">Log Out</a></h3>
</div>

<?php get_footer() ?>