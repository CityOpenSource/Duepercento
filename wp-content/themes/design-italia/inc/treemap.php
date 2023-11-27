<?php

include __DIR__ . '/../libs/codeagent-treemap/src/Gradient.php';
include __DIR__ . '/../libs/codeagent-treemap/src/helpers.php';
include __DIR__ . '/../libs/codeagent-treemap/src/IPresenter.php';
include __DIR__ . '/../libs/codeagent-treemap/src/Layout.php';
include __DIR__ . '/../libs/codeagent-treemap/src/Rectangle.php';
include __DIR__ . '/../libs/codeagent-treemap/src/Map.php';

include __DIR__ . '/../libs/codeagent-treemap/src/presenter/Presenter.php';
include __DIR__ . '/../libs/codeagent-treemap/src/presenter/CanvasPresenter.php';
include __DIR__ . '/../libs/codeagent-treemap/src/presenter/HtmlPresenter.php';
include __DIR__ . '/../libs/codeagent-treemap/src/presenter/ImagePresenter.php';
include __DIR__ . '/../libs/codeagent-treemap/src/presenter/NestedHtmlPresenter.php';
include __DIR__ . '/../libs/codeagent-treemap/src/presenter/NodeContent.php';
include __DIR__ . '/../libs/codeagent-treemap/src/presenter/NodeInfo.php';
include __DIR__ . '/../libs/codeagent-treemap/src/Treemap.php';

use codeagent\treemap\Treemap;
use codeagent\treemap\presenter\NodeInfo;
use codeagent\treemap\Gradient;

function wpbo_treemap_shortcode() { 
    global $wpdb;

    $gradient = new Gradient(['0.0' => '#f75557', '0.5' => '#646a82', '1.0' => '#5ad87b']);
    $custom_terms = get_terms('tipologia');
    $dati = [];
    
    foreach($custom_terms as $custom_term) {
        wp_reset_query();
        $args = array('post_type' => 'luogocontemporaneo','posts_per_page'=>-1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'tipologia',
                    'field' => 'slug',
                    'terms' => $custom_term->slug,
                ),
            ),
        );
        $colore = get_term_meta( $custom_term->term_id, 'color', true ); 

        $loop = new WP_Query($args);
        $dati[] = ["value"=>$loop->found_posts,"name"=>$custom_term->name,"color"=>$colore];
    }
    
    $presenter = Treemap::canvas($dati, 950, 450) -> render(function (NodeInfo $node) use ($gradient) {
       $data   = $node->data();
       $color  = $data["color"];
       $node->background($color);
       $node->content()->color('#FFFFFF'); 
       $node->content()->text($data['name']."\n(".$data['value'].")", 10, 20);
    });
    $message = $presenter;

    return $message;
}
function wpbo_tipologie_shortcode() { 
    global $wpdb;
    wp_reset_query();

    $custom_terms = get_terms('tipologia'); 

    $message = '<div class="row mt-5">';
    foreach($custom_terms as $custom_term) {
        wp_reset_query();
        $args = array('post_type' => 'luogocontemporaneo','posts_per_page' => -1,'orderby'=>'title',
            'tax_query' => array(
                array(
                    'taxonomy' => 'tipologia',
                    'field' => 'slug',
                    'terms' => $custom_term->slug,
                ),
            ),
        );
        $colore = get_term_meta( $custom_term->term_id, 'color', true ); 
        $desc = get_term_meta( $custom_term->term_id, 'description', true );  
        $message.= "<div class=\"col-md-4 col-xl-4 pb-5\">
        <div class=\"card-wrapper border border-light rounded shadow-sm\" style=\"border-top:6px solid {$colore}!important;border-top-left-radius:0!important;border-top-right-radius:0!important;\">
        <div class=\"card no-after rounded \" style=\"border-top-left-radius:0!important;border-top-right-radius:0!important;\">
        <div class=\"card-body\">
        <h3 class=\"card-title title-xlarge\"><a class=\"text-decoration-none t-primary\" href=\"/esplora?category={$custom_term->slug}\">{$custom_term->name}</a></h3>
        <p class=\"card-text text-secondary\">{$desc}</p>
        </div>
        </div>
        </div>
        </div>";  
    }
    $message.='</div>'; 
    // Output needs to be return
    return $message;
}
// register shortcode
add_shortcode('treemap',    'wpbo_treemap_shortcode');
add_shortcode('tipologie',  'wpbo_tipologie_shortcode');
    