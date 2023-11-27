<?php

function register_navwalker(){
	require_once get_template_directory() . '/class-wp-custom-navwalker.php';
	require_once get_template_directory() . '/BreadcrumbTrail.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

// Register your menus
function my_custom_menus() {
    $locations = array(
        'mainmenu'   => __( 'Main menu', 'text_domain' ),
        'langmenu'   => __( 'Lang menu', 'text_domain' ),
        'footer1'  => __( 'Footer menu 1', 'text_domain' ),
        'footer2'  => __( 'Footer menu 2', 'text_domain' ),
        'bottom'  => __( 'Bottom menu', 'text_domain' ),
    );
    register_nav_menus( $locations );
 }

// Hook them into the theme-'init' action
add_action( 'init', 'my_custom_menus' );