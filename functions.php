<!--TODO: enqueue styles and scripts -->
<?php
// Enqueue scripts
function rma_enqueue_scripts() {
    wp_enqueue_script( 'makeTeam', get_template_directory_uri() . '/js/site-scripts/site-scripts.js', array(), true );
}
add_action( 'wp_enqueue_scripts', 'rma_enqueue_scripts' );
