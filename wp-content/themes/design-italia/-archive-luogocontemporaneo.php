<?php
/*
 * Generic Page Template
 *
 * @package Design_Comuni_Italia
 */

 
global $post;
global $wpdb;

$regioni = json_decode(file_get_contents(__DIR__.'/js/localita.json'));
// print_r($regioni);

$taxonomies = get_object_taxonomies( array( 'post_type' => 'luogocontemporaneo' ) );   
$servizi = get_categories('taxonomy=servizio&type=luogocontemporaneo'); 
$tipologie = get_categories('taxonomy=tipologia&type=luogocontemporaneo');  
// print_r($tipologie);

$category = $_GET['tipologia_id'];
if($_GET['category'] && !is_array($_GET['category']) && strlen($_GET['category'])) {
    foreach($tipologie as $tipologia) { 
        if($tipologia->slug ===  $_GET['category']) {
            $category = $tipologia->term_id;
            break;
        }
    }
}
$query = "SELECT * 
FROM {$wpdb->prefix}luoghi_regioni AS r ORDER BY r.regione_nome";
$regioni = $wpdb->get_results( $query, OBJECT );


$query = "SELECT * 
FROM {$wpdb->prefix}luoghi_localita AS c 
INNER JOIN {$wpdb->prefix}luoghi_province AS p ON c.localita_provincia_id = p.provincia_id
INNER JOIN {$wpdb->prefix}luoghi_regioni AS r ON p.provincia_regione_id = r.regione_id 
";
$regioni2 = $wpdb->get_results( $query, OBJECT );
$temp = new stdClass;
foreach($regioni2 as $res) {
    if(!is_object($temp->{$res->regione_id}))$temp->{$res->regione_id} = new stdClass;
    if(!is_object($temp->{$res->regione_id}->items[$res->provincia_id]))$temp->{$res->regione_id}->items[$res->provincia_id] = new stdClass;
    $temp->{$res->regione_id}->items[$res->provincia_id]->items[$res->localita_id] = $res->localita_nome;
    $temp->{$res->regione_id}->items[$res->provincia_id]->nome = $res->provincia_nome;
    $temp->{$res->regione_id}->nome = $res->regione_nome;
}

function get_tipologia($type) { 
    foreach($tipologie as $v) {
        if($v->term_id == $type) return $v;
    }
    return false;
}
function get_localita($loc) {
    foreach($regioni2 as $k=>$v) {
        if($v->localita_id == $loc) return $v;
    }
    return false;
}

function get_args() { 
    // get meta query
    $args = [ 'post_type' => 'luogocontemporaneo', 'posts_per_page' => -1  ];
    $meta_query = $args['meta_query'];
    // if(!is_array($meta_query)) $meta_query = [];

    // loop over filters
    foreach( ['luogo_indirizzo',
    'luogo_localita_id',
    'luogo_cap',
    'luogo_telefono',
    'luogo_email',
    'luogo_web',
    'luogo_facebook',
    'luogo_twitter',
    'luogo_instagram',
    'luogo_youtube',
    'luogo_lat',
    'luogo_lon', 
    'luogo_data_inserimento',
    'luogo_note',
    // 'luogo_url',
    'luogo_localita_id',
    'luogo_collezione',
    
    'luogo_autore',
    'luogo_realizzazione',
    'luogo_collocazione',
    'luogo_dimensioni',
    'luogo_promotore',
    'luogo_curatore', 
    // 'luogo_collocazione',
    'luogo_dimensioni',
    'luogo_promotore',
    'luogo_curatore', 
    'luogo_proprietario',
    'luogo_gestore',
    'luogo_tipologia',
    'luogo_opere', ] as $name ) {

        // continue if not found in url
        if( empty($_GET[ $name ]) ) {
            continue;
        }
        $value = sanitize_text_field($_GET[ $name ]);

        // append meta query
        $meta_query[] = array(
            'key'       => $name,
            'value'     => $value,
            'compare'   => 'LIKE',
        );

    } 
    if( !empty($_GET[ 'luogo_da' ]) ) {
        $value = sanitize_text_field($_GET[ 'luogo_da' ]);
        $meta_query[] = array(
            'key'       => 'luogo_da',
            'value'     => $value,
            'compare'   => '>=',
        );
    }
    if( !empty($_GET[ 'luogo_a' ]) ) {
        $value = sanitize_text_field($_GET[ 'luogo_a' ]);
        $meta_query[] = array(
            'key'       => 'luogo_a',
            'value'     => $value,
            'compare'   => '<=',
        );
    }
    // if( !empty($_GET[ 'tipologia_id' ]) ) {
    //     $value = sanitize_text_field($_GET[ 'tipologia_id' ]);
    //     $meta_query[] = array(
    //         'key'       => 'luogo_tipologia_id',
    //         'value'     => $value,
    //         'compare'   => '=',
    //     );
    // }

    if( !empty($_GET[ 'comune_id' ]) ) {
        $value = sanitize_text_field($_GET[ 'comune_id' ]);
        $meta_query[] = array(
            'key'       => 'luogo_localita_id',
            'value'     => $value,
            'compare'   => '=',
        );
    }

    
    global $wpdb;
    if( empty($_GET[ 'comune_id' ])  && !empty($_GET[ 'provincia_id' ]) ) {
        $value = sanitize_text_field($_GET[ 'provincia_id' ]);
        $mypostids = $wpdb->get_col("SELECT localita_id FROM {$wpdb->prefix}luoghi_localita WHERE localita_provincia_id = '{$value}'"); 
        $meta_query[] = array(
            'key'       => 'luogo_localita_id',
            'value'     => $mypostids,
            'compare'   => 'IN',
        );
    } 

    if( empty($_GET[ 'comune_id' ])  && empty($_GET[ 'provincia_id' ]) && !empty($_GET[ 'regione_id' ]) ) {
        $value = sanitize_text_field($_GET[ 'regione_id' ]);
        $mypostids = $wpdb->get_col("SELECT localita_id FROM {$wpdb->prefix}luoghi_localita AS c INNER JOIN {$wpdb->prefix}luoghi_province AS p ON c.localita_provincia_id = p.provincia_id WHERE provincia_regione_id = '{$value}'"); 
        $meta_query[] = array(
            'key'       => 'luogo_localita_id',
            'value'     => $mypostids,
            'compare'   => 'IN',
        );
    } 

    // update meta query
    $args['meta_query'] = $meta_query;


    if( !empty($_GET[ 'luogo_nome' ]) ) {
        $post__in = $args['post_in'];
        $value = sanitize_text_field($_GET[ 'luogo_nome' ]);
        $mypostids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%".$value."%' AND post_type='luogocontemporaneo'"); 

        if(is_array($post__in)) {
            $mynew = array_intersect((count($mypostids) ? $mypostids : [-1]),$post__in);
            $args['post__in'] = $mynew;
        } else {
            $args['post__in'] = count($mypostids) ? $mypostids : [-1];
        }
    }
    if( !empty($_GET[ 'tipologia_id' ]) ) {
        $args['tax_query'] = array( // NOTE: array of arrays!
            array(
                'taxonomy' => 'tipologia',
                'field'    => 'term_id',
                'terms'    => array($_GET['tipologia_id']),
                'operator'    => 'IN'
            ),
        );
    }
    if( !empty($_GET[ 'servizio_id' ]) ) {
        // print_r($_GET[ 'servizio_id' ]);
        $tax_query = $args['tax_query'];
        $tax = array(
                'taxonomy' => 'servizio',
                'field'    => 'term_id',
                'terms'    => $_GET['servizio_id'],
                'operator'    => 'AND'
        );
        if(is_array($tax_query)) {
            $tax_query[]=$tax; 
            $tax_query['relation'] = 'AND';
            $args['tax_query'] = $tax_query;
        } else {
            $args['tax_query'] = array($tax, 'relation' => 'AND');
        } 
    }  
    if(is_array($args['meta_query']) && count($args['meta_query'])) $args['meta_query']['relation'] = 'AND';

return $args;
}

$map_posts = get_posts(get_args());  


$task = $_GET['task'];

if($task=='download'):

    $type = $_GET['type'];

    switch ($type) {
        case 'csv':
            $list = $map_posts;

            $fields = ['ID'=>'Id', 'post_date'=>'Data', 'post_title'=>'Titolo', 'post_content'=>'Descrizione'];
            $fields2 = ['luogo_indirizzo' => 'Indirizzo', 'luogo_localita_id' => 'Località', 'luogo_cap' => 'CAP', 'luogo_telefono' => 'Telefono', 'luogo_email' => 'Email', 'luogo_web' => 'Web', 'luogo_facebook' => 'Facebook', 'luogo_twitter' => 'Telefono', 'luogo_instagram' => 'Instagram', 'luogo_youtube' => 'Youtube', 'luogo_lat' => 'Latitudine', 'luogo_lon' => 'Longitudine', 'luogo_note' => 'Note', 'luogo_collezione' => 'Collezione', 'luogo_autore' => 'Autore', 'luogo_realizzazione' => 'Realizzazione', 'luogo_collocazione' => 'Collocazione', 'luogo_dimensioni' => 'Dimensioni', 'luogo_promotore' => 'Promotore', 'luogo_curatore' => 'Curatore', 'luogo_proprietario' => 'Proprietario', 'luogo_gestore' => 'Gestore', 'luogo_tipologia_id' => 'Tipologia', 'luogo_opere' => 'Opere', 'gallery_data' => 'Gallery'];
            $header = array_values(array_merge($fields, $fields2));
            $custom_fields = get_post_meta( $list[0]->ID );
            
            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename=luoghi-del-contemporaneo.csv");
            $fp = fopen('php://output', 'w');
            fputcsv($fp, $header);
            
            foreach ($list as $row) {
                $el = []; 
                $t = (array)$row;
                foreach($fields as $k=>$v) {
                    $el[] = $t[$k];
                }

                $custom_fields = get_post_meta( $row->ID );
                foreach($fields2 as $k=>$v) {
                    
                    switch ($k) {
                        case 'gallery_data':
                            $el[] = join(';', unserialize($custom_fields[$k][0])['image_url']);
                            break;
                        case 'luogo_localita_id':
                            $temp = '';
                            foreach($regioni2 as $k1=>$v1) {
                                if($v1->localita_id == $custom_fields[$k][0]) {
                                    $luogo = $v1;
                                    $temp = $luogo->localita_nome.' (' . $luogo->provincia_sigla.')';
                                    break;
                                } 
                            }  
                            $el[] = $temp;
                            break;
                        case 'luogo_tipologia_id': 
                            $tipologia     = wp_get_post_terms( $row->ID, 'tipologia' )[0];
                            $el[] = $tipologia->name;
                            break;
                        default:
                            $el[] = str_replace(array("\n","\r"),array('\n',''), $custom_fields[$k][0]);
                            break;
                    }
                } 
                fputcsv($fp, $el);  
            }
            
            fclose($fp);
            die();
            break;
        case 'json':
        case 'geojson':

            $list = $map_posts;

            $fields = ['ID'=>'Id', 'post_date'=>'Data', 'post_title'=>'Titolo', 'post_content'=>'Descrizione'];
            $fields2 = ['luogo_indirizzo' => 'Indirizzo', 'luogo_localita_id' => 'Autore', 'luogo_cap' => 'CAP', 'luogo_telefono' => 'Telefono', 'luogo_email' => 'Email', 'luogo_web' => 'Web', 'luogo_facebook' => 'Facebook', 'luogo_twitter' => 'Telefono', 'luogo_instagram' => 'Instagram', 'luogo_youtube' => 'Youtube', 'luogo_note' => 'Note', 'luogo_collezione' => 'Collezione', 'luogo_autore' => 'Autore', 'luogo_realizzazione' => 'Realizzazione', 'luogo_collocazione' => 'Collocazione', 'luogo_dimensioni' => 'Dimensioni', 'luogo_promotore' => 'Promotore', 'luogo_curatore' => 'Curatore', 'luogo_proprietario' => 'Proprietario', 'luogo_gestore' => 'Gestore', 'luogo_tipologia' => 'Tipologia', 'luogo_opere' => 'Opere', 'gallery_data' => 'Gallery'];

            $collection = ["type" => "FeatureCollection", 'features'=>[]];


            foreach ($list as $row) {
                $item = [];
                $item['type'] = 'Feature';

                $t = (array)$row;
                $properties = [];
                foreach($fields as $k=>$v) {
                    $properties[$v] = $t[$k];
                }
                $custom_fields = get_post_meta( $row->ID );
                $item['geometry'] = ['type'=>'Point', 'coordinates'=>[doubleval(str_replace(',','.',$custom_fields['luogo_lon'][0])),doubleval(str_replace(',','.',$custom_fields['luogo_lat'][0]))]];
                foreach($fields2 as $k=>$v) {
                    
                    switch ($k) {
                        case 'gallery_data':
                            $properties['Galleria'] = unserialize($custom_fields[$k][0])['image_url'];
                            break;
                        case 'luogo_localita_id':
                            $temp = '';
                            foreach($regioni2 as $k1=>$v1) {
                                if($v1->localita_id == $custom_fields[$k][0]) {
                                    $luogo = $v1;
                                    $temp = $luogo->localita_nome.' (' . $luogo->provincia_sigla.')';
                                    break;
                                } 
                            }  
                            $properties['Localita'] = $temp;
                            break;
                        case 'luogo_tipologia_id': 
                            $tipologia     = wp_get_post_terms( $row->ID, 'tipologia' )[0];
                            $properties['Tipologia']  = $tipologia->name;
                            break;
                        default:
                            $properties[$v] = $custom_fields[$k][0];
                            break;
                    }
                } 
                $item['properties'] = $properties; 
                $collection['features'][] = $item;
            }

            header("Content-Type: application/geo+json");
            header("Content-Disposition: attachment; filename=luoghi-del-contemporaneo.geojson");

            echo(json_encode($collection));
            die();
            break;
        
        default:
            # code...
            break;
    }

    
else:









$groups = [];
foreach($tipologie as $k=>$tipologia) {
    $groups[str_replace('-','',$tipologia->slug)] = 'groups[\''.str_replace('-','',$tipologia->slug).'\'] = L.layerGroup();';
} 

get_header();
?> 
    <main> 

        <div id="map"></div>
        <script>
            var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            });

            var osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
            });
            // var light = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}.png', {
            //     maxZoom: 19,
            //     attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
            // });

            // var dark = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}.png', {
            //     maxZoom: 19,
            //     attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
            // });

            var satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
            });

            
            var baseMaps = {
                // "Mappa Light": light,
                // "Mappa Dark": dark,
                "Mappa Satellitare": satellite,
                "Mappa Standard": osm,
                // "OpenStreetMap.HOT": osmHOT
            };
            var map = L.map('map',{
                center: [41.893056, 12.482778],
                layers: [osm],
                zoom: 13,
            });
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Create all groups layers
            var groups = []; <?php echo implode(" ",$groups);?>


            var group = new L.featureGroup();
            <?php foreach($map_posts as $k=>$row):
                $custom_fields = get_post_meta( $row->ID );
                $images        = unserialize($custom_fields['gallery_data'][0]); 
                $lat           = $custom_fields['luogo_lat'][0]; 
                $lon           = $custom_fields['luogo_lon'][0]; 
                $postslug      = $row -> post_name;
                $postname      = $row -> post_title;  
                $tipologia     = wp_get_post_terms( $row->ID, 'tipologia' )[0];
                $tipologiaslug = $tipologia->slug;
                $colore        = get_term_meta( $tipologia->term_id, 'color', true );
            ?>var marker<?php echo $k;?> = L.circleMarker([<?php echo $lat;?>, <?php echo $lon;?>], {weight:0.5,radius:8, opacity: 0.9, color: '#000000', fillColor:'<?php echo $colore;?>', fillOpacity: 1}).bindPopup("<strong><a href=\"/esplora/<?php echo $postslug;?>\"><img style=\"width:100%;height:auto;margin-bottom:20px;\" src=\"<?php echo $images['image_url'][0];?>\" /><?php echo str_replace('"', '\"', $postname);?></a></strong>");marker<?php echo $k;?>.addTo(map); marker<?php echo $k;?>.addTo(group); marker<?php echo $k;?>.addTo(groups['<?php echo str_replace('-','',$tipologiaslug);?>']);
            <?php endforeach;?>var overlays = { <?php foreach($groups as $slug=>$el): echo str_replace('-','',$slug).': groups[\''.str_replace('-','',$slug).'\'], ';endforeach;?> }; 
            // L.control.layers(baseMaps, overlays).addTo(map);
            var overlays2 = { }; 
            // L.control.layers(null, overlays2, {position: 'topleft'}).addTo(map);
            map.fitBounds(group.getBounds());
        </script>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <?php get_template_part("template-parts/common/breadcrumb"); ?>
                    <div class="cmp-hero">
                        <section class="it-hero-wrapper bg-white align-items-start">
                            <div class="it-hero-text-wrapper pt-0 ps-0 pb-4 pb-lg-60">
                                <h1 class="text-black title-xxxlarge mb-2" data-element="page-name">
                                    Esplora
                                </h1>
                                <p class="text-black titillium text-paragraph">
                                    <?php //echo $description; ?>
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0">
            <!-- <article class="article-wrapper"> -->

                <!-- <div class="row variable-gutters"> -->
                    <!-- <div class="col-lg-12"> -->
                        

                    <!-- </div> -->
                <!-- </div> -->
            <!-- </article> -->
        </div>


        <form class="container" method="get" action="/esplora/">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="luogo_nome" class="<?php echo ($_GET['luogo_nome'] && !is_array($_GET['luogo_nome']) && strlen($_GET['luogo_nome'])) ? 'active' : '';?>">Luogo</label>
                        <input type="text" class="form-control" id="luogo_nome" name="luogo_nome" value="<?php echo ($_GET['luogo_nome'] && !is_array($_GET['luogo_nome']) && strlen($_GET['luogo_nome'])) ? $_GET['luogo_nome'] : '';?>">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="luogo_autore" class="<?php echo ($_GET['luogo_autore'] && !is_array($_GET['luogo_autore']) && strlen($_GET['luogo_autore'])) ? 'active' : '';?>">Autore</label>
                        <input type="text" class="form-control" id="luogo_autore" name="luogo_autore" value="<?php echo ($_GET['luogo_autore'] && !is_array($_GET['luogo_autore']) && strlen($_GET['luogo_autore'])) ? $_GET['luogo_autore'] : '';?>">
                    </div>
                </div>


                <div class="col-12 col-md-4">
                    <div class="select-wrapper">
                        <label for="tipologia_id">Tipologia</label>
                        <select id="tipologia_id" name="tipologia_id" title="Scegli la tipologia" value="<?php echo $category;?>">
                            <option selected="" value="">Scegli una opzione</option>
                            <?php foreach($tipologie as $k=>$tipologia):?>
                            <option<?php echo $tipologia->term_id == $category ? ' selected' : '';?> value="<?php echo $tipologia->term_id;?>"><?php echo $tipologia->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="select-wrapper">
                        <label for="regione_id">Regione</label>
                        <select id="regione_id" name="regione_id" title="Scegli la regione">
                            <option value="">Scegli una opzione</option>
                            <?php foreach($regioni as $regione):?>
                            <option<?php echo $regione->regione_id == $_GET['regione_id'] ? ' selected' : '';?> value="<?php echo $regione->regione_id;?>"><?php echo $regione->regione_nome;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="select-wrapper">
                        <label for="provincia_id">Provincia</label>
                        <select id="provincia_id" name="provincia_id" title="Scegli la provincia"<?php $_GET['regione_id']!='' ? '' : 'disabled'?>>
                            <option selected="" value="">Scegli una opzione</option>
                            <?php if($_GET['regione_id']!='') :?>
                            <?php foreach($temp->{$_GET['regione_id']}->items as $k=>$provincia):?>
                            <option<?php echo $k == $_GET['provincia_id'] ? ' selected' : '';?> value="<?php echo $k;?>" ><?php echo $provincia->nome;?></option>
                            <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="select-wrapper">
                        <label for="comune_id">Comune</label>
                        <select id="comune_id" name="comune_id" title="Scegli il comune"<?php $_GET['regione_id']!='' || $_GET['provincia_id']!='' ? '' : 'disabled'?>>
                            <option selected="" value="">Scegli una opzione</option>
                            <?php if($_GET['provincia_id']!='') :?>
                            <?php foreach($temp->{$_GET['regione_id']}->items[$_GET['provincia_id']]->items as $k=>$provincia):?>
                            <option<?php echo $k == $_GET['comune_id'] ? ' selected' : '';?> value="<?php echo $k;?>" ><?php echo $provincia;?></option>
                            <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="row mt-5">

                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label for="luogo_da" class="<?php echo ($_GET['luogo_da'] && !is_array($_GET['luogo_da']) && strlen($_GET['luogo_da'])) ? 'active' : '';?>">Da anno</label>
                    <input type="number" class="form-control" id="luogo_da" name="luogo_da" data-bs-input min="1900" max="<?php echo date('Y');?>" value="<?php echo ($_GET['luogo_da'] && !is_array($_GET['luogo_da']) && strlen($_GET['luogo_da'])) ? $_GET['luogo_da'] : '';?>">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label for="luogo_a" class="<?php echo ($_GET['luogo_a'] && !is_array($_GET['luogo_a']) && strlen($_GET['luogo_a'])) ? 'active' : '';?>">A anno</label>
                    <input type="number" class="form-control" id="luogo_a" name="luogo_a" data-bs-input min="1900" max="<?php echo date('Y');?>" value="<?php echo ($_GET['luogo_a'] && !is_array($_GET['luogo_a']) && strlen($_GET['luogo_a'])) ? $_GET['luogo_a'] : '';?>">
                    </div>
                </div>


                <div class="col-12 col-md-4">
                    <div class="select-wrapper">
                        <label for="servizio_id">Servizi</label>
                        <select id="servizio_id" name="servizio_id[]" data-placeholder="Scegli i servizi" class="chosen-select" multiple title="Scegli i servizi">
                            <!-- <option selected="" value="">Scegli una opzione</option> -->
                            <?php foreach($servizi as $servizio):?>
                                <option value="<?php echo $servizio->term_id;?>"<?php if($_GET['servizio_id']):echo in_array($servizio->term_id,$_GET['servizio_id']) ? ' selected' : '';endif;?>><?php echo $servizio->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    
                </div>
            </div>
            <div class="row mt-4">
                <div id="luogo-search" class="form-group col text-center">
                    <button type="reset" class="btn btn-outline-primary">Annulla</button>
                    <button type="submit" class="btn btn-primary">Cerca</button>
                </div>
            </div>
        </form>
        <div class="bg-grey-card py-5">
            <div class="container">
                <h2 class="text-secondary mb-4">Esplora i luoghi</h2> 

                <ul class="nav nav-tabs nav-tabs-cards" id="card-simple" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="card-simple2-tab" data-bs-toggle="tab" href="#card-tab2" role="tab" aria-controls="card-tab2" aria-selected="false">Tabella</a></li>
                    <li class="nav-item"><a class="nav-link" id="card-simple1-tab" data-bs-toggle="tab" href="#card-tab1" role="tab" aria-controls="card-tab1" aria-selected="true">Schede</a></li>
                    
                    <li class="nav-item-filler"></li>
                </ul> 
                <div class="tab-content" id="card-simpleContent">
                    <div class="tab-pane p-4 fade show active" id="card-tab2" role="tabpanel" aria-labelledby="card-simple2-tab">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="row"></th>
                                    <!-- <th>Provincia</th> -->
                                    <th>Località</th>
                                    <th>Denominazione</th>
                                    <th>Data</th>
                                    <th>Tipologia</th>
                                    <th>Autore</th>
                                    <!-- <th>Visualizza</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ( have_posts() ) :
                                    while ( have_posts() ) : 
                                        the_post(); 

                                        $custom_fields = get_post_meta( $post->ID );
                                        $images        = unserialize($custom_fields['gallery_data'][0]);
                                        $tipologia     = wp_get_post_terms( $post->ID, 'tipologia' )[0];

                                        $loc = $custom_fields['luogo_localita_id'][0]; 
                                        foreach($regioni2 as $k=>$v) {
                                            if($v->localita_id == $loc) {
                                                $localita = $v;
                                                break;
                                            } 
                                        } 
                                ?>
                                <tr>
                                    <td><a href="<?php echo get_permalink( );?>"><img src="<?php echo $images['image_url'][0];?>" style="object-fit:cover;width:100px;height:100px;" alt="<?php echo $images['image_alt'][0];?>" /></a></td>
                                    <!-- <td><?php echo $localita->provincia_nome;?></td> -->
                                    <td><?php echo $localita->localita_nome;?> (<?php echo $localita->provincia_sigla;?>)</td>
                                    <td><?php echo the_title();?></td>
                                    <td><?php echo $custom_fields['luogo_realizzazione'][0];?></td>
                                    <td><?php echo $tipologia->name;?></td>
                                    <td><?php echo $custom_fields['luogo_autore'][0];?></td>
                                    <!-- <td><a href="<?php echo get_permalink( );?>">Apri</a></td> -->
                                </tr>
                                    <?php
                                    endwhile;
                                endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane p-4 fade" id="card-tab1" role="tabpanel" aria-labelledby="card-simple1-tab">
                        <div id="results" class="page row my-4 g-4" style="background-color:white">
                        <?php
                        if ( have_posts() ) :
                            while ( have_posts() ) : 
                                the_post();
                                
                                $custom_fields = get_post_meta( $post->ID );
                                $images        = unserialize($custom_fields['gallery_data'][0]);  

                                $tipologia = wp_get_post_terms( $post->ID, 'tipologia' )[0];
                                $colore = get_term_meta( $tipologia->term_id, 'color', true );
                                $loc = get_post_meta( $post->ID, 'luogo_localita_id', true );
                                foreach($regioni2 as $k=>$v) {
                                    if($v->localita_id == $loc) {
                                        $localita = $v;
                                        break;
                                    } 
                                } 
                                // $query = "SELECT * FROM {$wpdb->prefix}luoghi_foto AS f WHERE f.foto_luogo_id = " . ($post->ID-1000)." AND f.foto_tipo = 2 LIMIT 0, 1";
                                // $foto = $wpdb->get_results( $query, OBJECT )[0];
                                ?>
                                <div class="col-md-6 col-xl-4">
                                    <div class="card-wrapper border border-light rounded shadow-sm" style="border-top:6px <?php echo $colore;?> solid !important">
                                        <div class="card no-after rounded">
                                            <div class="img-responsive-wrapper">
                                                <div class="img-responsive img-responsive-panoramic">
                                                    <figure class="img-wrapper">
                                                        <img class="" src="<?php echo $images['image_url'][0];?>" title="titolo immagine" alt="descrizione immagine">
                                                    </figure>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="category-top">
                                                    <a class="category text-decoration-none" href="/esplora?category="><?php echo $tipologia->slug;?></a>
                                                    <!-- <span class="data">28 FEB 2023</span> -->
                                                </div>
                                                <a href="<?php the_permalink( );?>" class="text-decoration-none" data-element="news-category-link">
                                                    <h3 class="card-title"><?php the_title();?></h3>
                                                </a>
                                                <p class="card-text text-secondary"><?php echo $localita->localita_nome;?> (<?php echo $localita->provincia_sigla;?>)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            <?php
                            endwhile;
                        else :
                            _e( 'Sorry, no posts were found.', 'textdomain' );
                        endif;
                        ?>
                        </div><!-- div#results -->
                    </div>
                </div>
                <div class="text-center my-5">
                    <?php
                        $args = [];
                        if(!empty($_GET['luogo_nome']))    $args['luogo_nome']   = $_GET['luogo_nome'];
                        if(!empty($_GET['luogo_autore']))  $args['luogo_autore'] = $_GET['luogo_autore'];
                        if(!empty($_GET['tipologia_id']))  $args['tipologia_id'] = $_GET['tipologia_id'];
                        if(!empty($_GET['regione_id']))    $args['regione_id']   = $_GET['regione_id'];
                        if(!empty($_GET['provincia_id']))  $args['provincia_id'] = $_GET['provincia_id'];
                        if(!empty($_GET['citta_id']))      $args['citta_id']     = $_GET['citta_id'];
                        if(!empty($_GET['luogo_da']))      $args['luogo_da']     = $_GET['luogo_da'];
                        if(!empty($_GET['luogo_a']))       $args['luogo_a']      = $_GET['luogo_a'];
                    ?>
                    <a class="btn btn-primary mx-1" href="?task=download&type=csv<?php foreach($args as $k=>$v): echo "&$k=>$v";endforeach;?>" target="_blank">Download CSV</a> <a class="btn btn-primary mx-1" href="?task=download&type=json<?php foreach($args as $k=>$v): echo "&$k=>$v";endforeach;?>" target="_blank">Download JSON</a>
                </div>
                <div class="row sr-only">
                    <div class="col-12 text-center pagination">
                        <?php 
                            $args = [];
                            if(!empty($_GET['luogo_nome']))    $args['luogo_nome']   = $_GET['luogo_nome'];
                            if(!empty($_GET['luogo_autore']))  $args['luogo_autore'] = $_GET['luogo_autore'];
                            if(!empty($_GET['tipologia_id']))  $args['tipologia_id'] = $_GET['tipologia_id'];
                            if(!empty($_GET['regione_id']))    $args['regione_id']   = $_GET['regione_id'];
                            if(!empty($_GET['provincia_id']))  $args['provincia_id'] = $_GET['provincia_id'];
                            if(!empty($_GET['citta_id']))      $args['citta_id']     = $_GET['citta_id'];
                            if(!empty($_GET['luogo_da']))      $args['luogo_da']     = $_GET['luogo_da'];
                            if(!empty($_GET['luogo_a']))       $args['luogo_a']      = $_GET['luogo_a'];
                            the_posts_pagination(['type'    =>  'list', 'add_args'    =>  $args]);
                        ?>
                    </div>
                </div><!-- div pagination -->
            </div><!-- div container -->
        </div><!-- div card -->
                
        <div class="container">
            <article class="article-wrapper">
                <div class="row variable-gutters">
                    <div class="col-lg-12">
                        <?php
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>
                    </div>
                </div>
                <div class="row variable-gutters">
                    <div class="col-lg-12">
                        <?php get_template_part( "template-parts/single/bottom" ); ?>
                    </div> 
                </div> 
            </article>
        </div>
        <?php //x\x\x\get_template_part("template-parts/common/valuta-servizio"); ?>
    </main>
<?php
get_footer();

endif;