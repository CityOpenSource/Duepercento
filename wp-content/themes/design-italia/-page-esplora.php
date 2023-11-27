<?php
/*
 * Generic Page Template
 *
 * @package Design_Comuni_Italia
 */
// print_r($_GET);
// print_r($_POST);
get_header();
global $post;
global $wpdb;


$query = "SELECT * 
FROM {$wpdb->prefix}luoghi_tipologie AS t ORDER BY t.tipologia_nome_ita";
$tipologie = $wpdb->get_results( $query, OBJECT );
$category = $_POST['tipologia_id'];
if($_GET['category'] && !is_array($_GET['category']) && strlen($_GET['category'])) {
    foreach($tipologie as $tipologia) {
        // print_r($tipologia);
        if($tipologia->tipologia_url === $_GET['category']) {
            $category = $tipologia->tipologia_id;
            break;
        }
    }
}
$query = "SELECT * 
FROM {$wpdb->prefix}luoghi_regioni AS r ORDER BY r.regione_nome";
$regioni = $wpdb->get_results( $query, OBJECT );

$query = "SELECT * 
FROM {$wpdb->prefix}luoghi AS l 
INNER JOIN {$wpdb->prefix}luoghi_tipologie AS t ON l.luogo_tipologia_id = t.tipologia_id 
INNER JOIN {$wpdb->prefix}luoghi_localita AS c ON l.luogo_localita_id = c.localita_id 
INNER JOIN {$wpdb->prefix}luoghi_province AS p ON c.localita_provincia_id = p.provincia_id
INNER JOIN {$wpdb->prefix}luoghi_regioni AS r ON p.provincia_regione_id = r.regione_id 
INNER JOIN {$wpdb->prefix}luoghi_foto AS f ON l.luogo_id = f.foto_luogo_id 
WHERE l.luogo_stato = 1 AND f.foto_tipo = 2 ";
// echo $query;

if(strlen($category)) {
    $query .= 'AND t.tipologia_id = \''.str_replace("'","\'",$category).'\' ';
}
if($_POST['luogo_nome'] && !is_array($_POST['luogo_nome']) && strlen($_POST['luogo_nome'])) {
    $query .= 'AND l.luogo_nome LIKE \'%'.str_replace("'","\'",$_POST['luogo_nome']).'%\' ';
}
if($_POST['luogo_nome'] && !is_array($_POST['luogo_autore']) && strlen($_POST['luogo_autore'])) {
    $query .= 'AND l.luogo_autore LIKE \'%'.str_replace("'","\'",$_POST['luogo_autore']).'%\' ';
}
if($_POST['luogo_da'] && !is_array($_POST['luogo_da']) && strlen($_POST['luogo_da'])) {
    $query .= 'AND l.luogo_realizzazione >= '. intval(str_replace("'","\'",$_POST['luogo_da'])).' ';
}
if($_POST['luogo_a'] && !is_array($_POST['luogo_a']) && strlen($_POST['luogo_a'])) {
    $query .= 'AND l.luogo_realizzazione <= '. intval(str_replace("'","\'",$_POST['luogo_a'])).' ';
}
if($_POST['regione_id'] && !is_array($_POST['regione_id']) && strlen($_POST['regione_id'])) {
    $query .= 'AND r.regione_id = '. str_replace("'","\'",$_POST['regione_id']).' ';
}
if($_POST['provincia_id'] && !is_array($_POST['provincia_id']) && strlen($_POST['provincia_id'])) {
    $query .= 'AND p.provincia_id = '. str_replace("'","\'",$_POST['provincia_id']).' ';
}
if($_POST['comune_id'] && !is_array($_POST['comune_id']) && strlen($_POST['comune_id'])) {
    $query .= 'AND c.localita_id = '. str_replace("'","\'",$_POST['comune_id']).' ';
}
if($_POST['autore'] && !is_array($_POST['autore']) && strlen($_POST['autore'])) {
    $query .= 'AND l.luogo_autore_ita LIKE \'%'. str_replace("'","\'",$_POST['autore']).'%\' ';
}


// echo $query;
$query .= " 
GROUP BY f.foto_luogo_id 
ORDER BY f.foto_ordine

;";
$results = $wpdb->get_results( $query, OBJECT );
// print_r($results);



$query = "SELECT * 
FROM {$wpdb->prefix}luoghi_localita AS c 
INNER JOIN {$wpdb->prefix}luoghi_province AS p ON c.localita_provincia_id = p.provincia_id
INNER JOIN {$wpdb->prefix}luoghi_regioni AS r ON p.provincia_regione_id = r.regione_id 
";
$regioni2 = $wpdb->get_results( $query, OBJECT );
$temp = new stdClass;
foreach($regioni2 as $res) {
    $temp->{$res->regione_id}->items[$res->provincia_id]->items[$res->localita_id] = $res->localita_nome;
    $temp->{$res->regione_id}->items[$res->provincia_id]->nome = $res->provincia_nome;
    $temp->{$res->regione_id}->nome = $res->regione_nome;
}
// echo json_encode($temp);



$groups = [];
foreach($tipologie as $k=>$tipologia) {
    $groups[str_replace('-','',$tipologia->tipologia_url)] = 'groups[\''.str_replace('-','',$tipologia->tipologia_url).'\'] = L.layerGroup();';
} 
?>
    <main>
        <?php
        while ( have_posts() ) :
            the_post();
            $description = dci_get_meta('descrizione','_dci_page_',$post->ID);
            ?>

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
var light = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
});

var dark = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
});

var satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    maxZoom: 19,
    attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
});

 
var baseMaps = {
    "Mappa Light": light,
    "Mappa Dark": dark,
    "Mappa Satellitare": satellite,
    "Mappa Standard": osm,
    // "OpenStreetMap.HOT": osmHOT
};
                                    var map = L.map('map',{
                                        center: [41.893056, 12.482778],
                                        layers: [light],
                                        zoom: 13,
                                    });
                                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        maxZoom: 19,
                                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                                    }).addTo(map);
                                    var group = new L.featureGroup();
                                    var groups = [];
                                    <?php echo implode("\n",$groups);?>


                                    <?php foreach($results as $k=>$row):?>
                                    var marker<?php echo $k;?> = L.circleMarker([<?php echo $row->luogo_lat;?>, <?php echo $row->luogo_lon
                                    ;?>], {weight:0.5,radius:8, opacity: 0.9, color: '#000000', fillColor:'<?php echo $row->tipologia_colore;?>', fillOpacity: 1}).bindPopup("<h3><?php echo str_replace('"', '\"', $row->luogo_nome);?></h3><?php echo str_replace(array('"',"\n","\r"), array('\"','',''), $row->luogo_descrizione_ita);?>").addTo(map);
                                    marker<?php echo $k;?>.addTo(group);
                                    marker<?php echo $k;?>.addTo(groups['<?php echo str_replace('-','',$row->tipologia_url);?>']);
                                    <?php endforeach;?>
                                    var overlays = { <?php foreach($groups as $slug=>$el): echo str_replace('-','',$slug).': groups[\''.str_replace('-','',$slug).'\'], ';endforeach;?> }; 
                                    L.control.layers(baseMaps, overlays).addTo(map);
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
                                        <?php the_title()?>
                                    </h1>
                                    <p class="text-black titillium text-paragraph">
                                        <?php echo $description; ?>
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


                <form class="container" method="post" action="/esplora/">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="luogo_nome" class="<?php echo ($_POST['luogo_nome'] && !is_array($_POST['luogo_nome']) && strlen($_POST['luogo_nome'])) ? 'active' : '';?>">Luogo</label>
                                <input type="text" class="form-control" id="luogo_nome" name="luogo_nome" value="<?php echo ($_POST['luogo_nome'] && !is_array($_POST['luogo_nome']) && strlen($_POST['luogo_nome'])) ? $_POST['luogo_nome'] : '';?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="luogo_autore" class="<?php echo ($_POST['luogo_autore'] && !is_array($_POST['luogo_autore']) && strlen($_POST['luogo_autore'])) ? 'active' : '';?>">Autore</label>
                                <input type="text" class="form-control" id="luogo_autore" name="luogo_autore" value="<?php echo ($_POST['luogo_autore'] && !is_array($_POST['luogo_autore']) && strlen($_POST['luogo_autore'])) ? $_POST['luogo_autore'] : '';?>">
                            </div>
                        </div>


                        <div class="col-12 col-md-4">
                            <div class="select-wrapper">
                                <label for="tipologia_id">Tipologia</label>
                                <select id="tipologia_id" name="tipologia_id" title="Scegli la tipologia" value="<?php echo $category;?>">
                                    <option selected="" value="">Scegli una opzione</option>
                                    <?php foreach($tipologie as $k=>$tipologia):?>
                                    <option<?php echo $tipologia->tipologia_id == $category ? ' selected' : '';?> value="<?php echo $tipologia->tipologia_id;?>"><?php echo $tipologia->tipologia_nome_ita;?></option>
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
                                    <option<?php echo $regione->regione_id == $_POST['regione_id'] ? ' selected' : '';?> value="<?php echo $regione->regione_id;?>"><?php echo $regione->regione_nome;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4">
                            <div class="select-wrapper">
                                <label for="provincia_id">Provincia</label>
                                <select id="provincia_id" name="provincia_id" title="Scegli la provincia"<?php $_POST['regione_id']!='' ? '' : 'disabled'?>>
                                    <option selected="" value="">Scegli una opzione</option>
                                    <?php if($_POST['regione_id']!='') :?>
                                    <?php foreach($temp->{$_POST['regione_id']}->items as $k=>$provincia):?>
                                    <option<?php echo $k == $_POST['provincia_id'] ? ' selected' : '';?> value="<?php echo $k;?>" ><?php echo $provincia->nome;?></option>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4">
                            <div class="select-wrapper">
                                <label for="comune_id">Comune</label>
                                <select id="comune_id" name="comune_id" title="Scegli il comune"<?php $_POST['regione_id']!='' || $_POST['provincia_id']!='' ? '' : 'disabled'?>>
                                    <option selected="" value="">Scegli una opzione</option>
                                    <?php if($_POST['provincia_id']!='') :?>
                                    <?php foreach($temp->{$_POST['regione_id']}->items[$_POST['provincia_id']]->items as $k=>$provincia):?>
                                    <option<?php echo $k == $_POST['comune_id'] ? ' selected' : '';?> value="<?php echo $k;?>" ><?php echo $provincia;?></option>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row mt-5">

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                            <label for="luogo_da" class="<?php echo ($_POST['luogo_da'] && !is_array($_POST['luogo_da']) && strlen($_POST['luogo_da'])) ? 'active' : '';?>">Da</label>
                            <input type="number" class="form-control" id="luogo_da" name="luogo_da" data-bs-input min="1900" max="<?php echo date('Y');?>" value="<?php echo ($_POST['luogo_da'] && !is_array($_POST['luogo_da']) && strlen($_POST['luogo_da'])) ? $_POST['luogo_da'] : '';?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                            <label for="luogo_a" class="<?php echo ($_POST['luogo_a'] && !is_array($_POST['luogo_a']) && strlen($_POST['luogo_a'])) ? 'active' : '';?>">A</label>
                            <input type="number" class="form-control" id="luogo_a" name="luogo_a" data-bs-input min="1900" max="<?php echo date('Y');?>" value="<?php echo ($_POST['luogo_a'] && !is_array($_POST['luogo_a']) && strlen($_POST['luogo_a'])) ? $_POST['luogo_a'] : '';?>">
                            </div>
                        </div>


                        <div class="col-12 col-md-4">
                            <div class="select-wrapper">
                                <label for="servizi_id">Servizi</label>
                                <select id="servizi_id" name="servizi_id" title="Scegli i servizi" multiple size="4">
                                    <option selected="" value="">Scegli una opzione</option>
                                    <?php foreach($tipologie as $k=>$tipologia):?>
                                    <option value="<?php echo $tipologia->tipologia_id;?>"><?php echo $tipologia->tipologia_nome_ita;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <!-- <script>
  document.addEventListener('DOMContentLoaded', function () {
    var selectElement = document.querySelector('#servizi_id');
    var selectAutocomplete = new bootstrap.SelectAutocomplete(selectElement, {
      showAllValues: true,
      defaultValue: '',
      autoselect: false,
      showNoOptionsFound: false,
      dropdownArrow: () => '',
    });
  })
</script> -->
                    </div>
                    <div class="row mt-4">
                        <div class="form-group col text-center">
                        <button type="button" class="btn btn-outline-primary">Annulla</button>
                        <button type="submit" class="btn btn-primary">Cerca</button>
                        </div>
                    </div>
                </form>
                <div class="bg-grey-card py-5">
                    <div class="container">
                        <h2 class="text-secondary mb-4">Esplora tutti i luoghi</h2>
                        <!-- <div class="cmp-input-search">
                        <div class="form-group autocomplete-wrapper">
                            <div class="input-group">
                            <label for="autocomplete-autocomplete-three" class="visually-hidden">cerca</label>
                            <input type="search" class="autocomplete form-control" placeholder="Cerca per parola chiave" id="autocomplete-autocomplete-three" name="autocomplete-three" data-bs-autocomplete="[]">
                        
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" id="button-3">Invio</button>
                            </div>
                            
                            <span class="autocomplete-icon" aria-hidden="true">
                                <svg class="icon icon-sm icon-primary">
                                <use href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-search"></use>
                                </svg>
                            </span>
                            </div>
                        </div>
                        </div>         -->
                        
                        <?php
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                                // Your loop code
                            endwhile;
                        else :
                            _e( 'Sorry, no posts were found.', 'textdomain' );
                        endif;
                        ?>
                        <?php foreach($results as $k=>$row):?>
                            <?php if($k%6==0):?>
                            <div id="results" class="page row g-4<?php echo $k==0 ? ' d-flex':' d-none';?>">
                            <?php endif;?>
                                <div class="col-md-6 col-xl-4">
                                    <div class="card-wrapper border border-light rounded shadow-sm <?php echo $row->tipologia_url;?>">
                                        <div class="card no-after rounded">
                                            <div class="img-responsive-wrapper">
                                                <div class="img-responsive img-responsive-panoramic">
                                                    <figure class="img-wrapper">
                                                    <img class="" src="https://luoghidelcontemporaneo.beniculturali.it/reserved/foto/<?php echo $row->foto_id;?>.<?php echo $row->foto_estensione;?>" title="titolo immagine" alt="descrizione immagine">
                                                    </figure>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="category-top">
                                                    <a class="category text-decoration-none" href="#"><?php echo $row->tipologia_nome_ita;?></a>
                                                    <!-- <span class="data">28 FEB 2023</span> -->
                                                </div>
                                                <a href="novita-dettaglio.html" class="text-decoration-none" data-element="news-category-link">
                                                    <h3 class="card-title"><?php echo $row->luogo_nome;?></h3>
                                                </a>
                                                <p class="card-text text-secondary"><!--<?php echo $row->luogo_indirizzo_ita;?>, --><?php echo $row->localita_nome;?> (<?php echo $row->provincia_sigla;?>)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php if(($k%6==5)||($k==count($results)-1)):?>
                            </div>
                            <?php endif;?>
                        <?php endforeach;?>
                        
                        <!--end card-->
                        
                        </div>
                
                        <div class="row my-4">
                        <nav class="pagination-wrapper justify-content-center" aria-label="Navigazione centrata">
                            <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-hidden="true">
                                <svg class="icon icon-primary">
                                    <use href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-chevron-left"></use>
                                </svg>
                                <span class="visually-hidden">Pagina precedente</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-current="page">
                                <span class="d-inline-block d-sm-none">Pagina </span>1
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                <span class="visually-hidden">Pagina successiva</span>
                                <svg class="icon icon-primary">
                                    <use href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-chevron-right"></use>
                                </svg>
                                </a>
                            </li>
                            </ul>
                        </nav>
                        </div>
                
                    </div>
                </div>
                
                <div class="container ">
                    <article class="article-wrapper">

                        <div class="row variable-gutters">
                            <div class="col-lg-12">
                                <?php

                                // the_content();
                                ?>
                                <!-- <div class="callout note">
                                    <div class="callout-inner">
                                        <div class="callout-title">
                                            <svg class="icon"><use href="#it-info-circle"></use></svg>
                                            <span class="visually-hidden">Attenzione</span> 
                                            <span class="text">Attenzione</span>
                                        </div>
                                        <p><strong>Il template di questa pagina non è ancora disponibile.</strong></p>
                                        <p>Nel frattempo, puoi controllare se è disponibile la <a href="https://italia.github.io/design-comuni-pagine-statiche/">versione statica</a> oppure il <a href="https://www.figma.com/file/FHlE0r9lhfvDR0SgkDRmVi/%5BComuni%5D-Modello-sito-e-servizi?type=design&node-id=1%3A1310&t=T24nHc1gRJzlJ7GH-1">layout hi-fi</a> su Figma.</p>
                                        <p><a href="https://designers.italia.it/files/resources/modelli/comuni/adotta-il-modello-di-sito-comunale/definisci-architettura-e-contenuti/Architettura-informazione-sito-Comuni.ods">Consulta il documento di architettura dell'informazione</a> per costruire il template in autonomia.</p>
                                    </div>
                                </div> -->
                            </div>
                        </div>
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

            </div>
            <?php //x\x\x\get_template_part("template-parts/common/valuta-servizio"); ?>
            
        <?php
        endwhile; // End of the loop.
        ?>
    </main>
<?php
get_footer();



