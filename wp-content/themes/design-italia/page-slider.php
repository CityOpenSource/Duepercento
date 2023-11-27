<?php

global $wpdb;

$query = "SELECT * 
FROM {$wpdb->prefix}luoghi_localita AS c 
INNER JOIN {$wpdb->prefix}luoghi_province AS p ON c.localita_provincia_id = p.provincia_id
INNER JOIN {$wpdb->prefix}luoghi_regioni AS r ON p.provincia_regione_id = r.regione_id 
";
$regioni2 = $wpdb->get_results( $query, OBJECT );
 

$slides = [];
$args = array('post_type' => 'luogocontemporaneo','posts_per_page' => -1); 

$loop = get_posts($args);
foreach($loop as $k=>$row):

    $custom_fields = get_post_meta( $row->ID );
    $images        = unserialize($custom_fields['gallery_data'][0]);
    $loc           = $custom_fields['luogo_localita_id'][0];  
    foreach($regioni2 as $v) {
        if($v->localita_id == $loc) {
            $localita = $v;
            break;
        } 
    } 
    $slides[] = '<div class="carousel-item'.($k==0?' active':'').'"><img src="'.$images['image_url'][0].'" style="object-fit:cover;width:100vw;height:100vh;" alt="'.$images['image_alt'][0].'" /><div class="carousel-caption d-none d-md-block" style="top:1.25rem" ><svg height="86" width="260" aria-hidden="true" style="height:86px!important;width:260px!important;"><image height="86" width="260" xlink:href="https://luoghidelcontemporaneo.mappi-na.it/wp-content/themes/design-italia/svg/logo.svg"></image></svg></div><div style="position:absolute;bottom:0;height:150px;width:100%;background: rgb(0,0,0);background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.6) 50%, rgba(0,0,0,0) 100%);"></div><div class="carousel-caption d-none d-md-block"><h5>'.$row->post_title.'</h5><p>'/* .$custom_fields['luogo_indirizzo'][0].'<br/>' */.$localita->localita_nome.' ('.$localita->provincia_sigla.')</p></div></div>';
endforeach;
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php wp_head(); ?>
    </head>
    <body>
        <div class="modal-body">
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <?php echo implode("\n",$slides);?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>