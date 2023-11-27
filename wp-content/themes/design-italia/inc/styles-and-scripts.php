<?php



add_action( 'wp_enqueue_scripts', 'design_comuni_italia_custom_enqueue_styles' );
function design_comuni_italia_custom_enqueue_styles() {

    // STYLES
    wp_enqueue_style( 'custom', get_stylesheet_directory_uri() . '/css/custom.css');
    wp_enqueue_style( 'dci-boostrap-italia-min', get_stylesheet_directory_uri() . '/css/bootstrap-italia-custom.min.css' );
    wp_enqueue_style( 'dci-boostrap-italia-style', get_stylesheet_directory_uri() . '/css/style.css' );
    wp_enqueue_style( 'fonts', get_stylesheet_directory_uri() . '/css/fonts.css' );
    wp_enqueue_style( 'lightbox', get_stylesheet_directory_uri() . '/css/lightbox.min.css' );
    wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css' );
    wp_enqueue_style( 'custom', get_stylesheet_directory_uri() . '/css/custom.css');
    wp_enqueue_style( 'leaflet-style', get_stylesheet_directory_uri() . '/css/leaflet.css' );
    wp_enqueue_style( 'treemap', get_stylesheet_directory_uri(  ).'/libs/codeagent-treemap/src/assets/treemap.css');
    wp_enqueue_style( 'chosen_styles', 'https://harvesthq.github.io/chosen/chosen.css', false ); 
    // wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' );
    // wp_enqueue_style( 'modal', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css' );
    wp_enqueue_style( 'print', get_stylesheet_directory_uri(  ).'/css/print.css', null, null, 'print');
    // wp_enqueue_style( 'print', 'https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css', null, null, 'print' );
    
    
    // SCRIPTS HEAD
    wp_enqueue_script( 'leaflet-script', get_stylesheet_directory_uri() . '/js/leaflet.js' );
    // wp_enqueue_scripts( 'anychart-core', get_stylesheet_directory_uri() . '/js/anychart-core.min.js', null, null, true );
    // wp_enqueue_scripts( 'll1', 'https://cdn.anychart.com/releases/8.11.0/js/anychart-treemap.min.js' );



    // SCRIPTS FOOT
    wp_enqueue_script( 'dci-boostrap-italia-min', get_stylesheet_directory_uri() . '/js/bootstrap-italia.bundle.min.js', null, null, true );
    wp_add_inline_script('dci-boostrap-italia-min','bootstrap.loadFonts("'.get_stylesheet_directory_uri().'/fonts")');
    // wp_enqueue_script( 'dci-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', null, null, true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'chosen_js', 'https://harvesthq.github.io/chosen/chosen.jquery.js', array('jquery'), null, true );
    wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), null, true);
    wp_enqueue_script( 'custom2', get_stylesheet_directory_uri() . '/js/custom2.js', array('jquery'), null, true);
    wp_enqueue_script( 'lightbox', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array('jquery'), null, true ); 
}



function my_styles_method() {
    global $wpdb;
    $tipologie = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}luoghi_tipologie AS t ", OBJECT );
    $custom_css = "";
    foreach($tipologie as $k=>$tipologia) {
        $custom_css.=".{$tipologia->tipologia_url}{border-top:6px solid {$tipologia->tipologia_colore} !important;border-top-right-radius:0 !important;border-top-left:radius:0 !important;}\n";
    } 
    wp_add_inline_style( 'custom', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'my_styles_method' );