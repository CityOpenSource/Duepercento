<?php
/*
 * Generic Page Template
 *
 * @package Design_Comuni_Italia
 */
// print_r($_GET);
// print_r($_POST);
get_header();
$metas = get_post_meta( $post->ID);
$gallery = get_post_meta( $post->ID, 'gallery_data', true );
$citta = get_post_meta( $post->ID, 'luogo_localita_id', true );
$sql = "SELECT * FROM {$wpdb->prefix}luoghi_localita AS l INNER JOIN {$wpdb->prefix}luoghi_province AS p ON l.localita_provincia_id = p.provincia_id INNER JOIN {$wpdb->prefix}luoghi_regioni AS r ON p.provincia_regione_id = r.regione_id WHERE l.localita_id = '".$citta."'";
$indirizzo = $wpdb->get_results($sql)[0];

$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
if(empty($image)) $image = $gallery['image_url'][0];


$tip = get_post_meta( $post->ID, 'luogo_tipologia_id', true );


$tipologia = wp_get_post_terms( $post->ID, 'tipologia' )[0]; 
$colore = get_term_meta( $tipologia->term_id, 'color', true ); 
$servizi = wp_get_post_terms( $post->ID, 'servizio' );  

  $info = [];
  if(strlen($metas['luogo_autore'][0])):$info[] = 'Autore: ' . $metas['luogo_autore'][0] . '</li>'; endif;
  if(strlen($metas['luogo_realizzazione'][0])):$info[] = 'Anno realizzazione: ' . $metas['luogo_realizzazione'][0] . '</li>'; endif;
  if(strlen($metas['luogo_collocazione'][0])):$info[] = 'Anno collocazione: ' . $metas['luogo_collocazione'][0] . '</li>'; endif;
  if(strlen($metas['luogo_dimensioni'][0])):$info[] = 'Dimensioni: ' . $metas['luogo_dimensioni'][0] . '</li>'; endif;
  if(strlen($metas['luogo_promotore'][0])):$info[] = 'Promotore: ' . $metas['luogo_promotore'][0] . '</li>'; endif;
  if(strlen($metas['luogo_curatore'][0])):$info[] = 'Curatore: ' . $metas['luogo_curatore'][0] . '</li>'; endif;
  if(strlen($metas['luogo_proprietario'][0])):$info[] = 'Proprietario: ' . $metas['luogo_proprietario'][0] . '</li>'; endif;
  if(strlen($metas['luogo_gestore'][0])):$info[] = 'Gestore: ' . $metas['luogo_gestore'][0] . '</li>'; endif;
  if(strlen($metas['luogo_opere'][0])):$info[] = 'Opere: ' . $metas['luogo_opere'][0] . '</li>'; endif;
?>

<main>
      <div class="container" id="main-container">
        <div class="row">
          <div class="col px-lg-4">
            <div class="cmp-breadcrumbs" role="navigation">
            <?php get_template_part("template-parts/common/breadcrumb"); ?>
            </div>      
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 px-lg-4 py-lg-2">
            <h1 data-audio="Titolo: <?php the_title();?>"><?php the_title();?></h1>
            <h2 class="h4 py-2" data-audio="Tipologia: <?php echo $tipologia->name;?>"><?php echo $tipologia->name;?></h2>
           <!--  <p data-audio="">
              Il 1° maggio 2019 Cagliari e tutta la Sardegna festeggiano la 363ª Festa di Sant'Efisio. Un intenso momento di
              devozione, fede, cultura e tradizioni centenarie che si fondono in una processione che non ha eguali.
            </p> -->
          </div>
          <div class="col-lg-3 offset-lg-1">
            <div class="dropdown d-inline">
              <button aria-label="condividi sui social" class="btn btn-dropdown dropdown-toggle text-decoration-underline d-inline-flex align-items-center fs-0" type="button" id="shareActions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="icon" aria-hidden="true">
                  <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-share"></use>
                </svg>
                <small><?php _e('Condividi','design-italia');?></small>
              </button>
              <div class="dropdown-menu shadow-lg" aria-labelledby="shareActions">
                <div class="link-list-wrapper">
                  <ul class="link-list" role="menu">
                    <li role="none">
                      <a class="list-item" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink());?>" role="menuitem" target="_blank" rel="noopener">
                        <svg class="icon" aria-hidden="true">
                          <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-facebook"></use>
                        </svg>
                        <span>Facebook</span>
                      </a>
                    </li>
                    <li role="none">
                      <a class="list-item" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink());?>" role="menuitem" target="_blank" rel="noopener">
                        <svg class="icon" aria-hidden="true">
                          <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-twitter"></use>
                        </svg>
                        <span>Twitter</span>
                      </a>
                    </li>
                    <li role="none">
                      <a class="list-item" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink());?>" role="menuitem" target="_blank" rel="noopener">
                        <svg class="icon" aria-hidden="true">
                          <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-linkedin"></use>
                        </svg>
                        <span>Linkedin</span>
                      </a>
                    </li>
                    <li role="none">
                      <a class="list-item" href="whatsapp://send?text=<?php echo urlencode(get_permalink());?>" role="menuitem" target="_blank" rel="noopener">
                        <svg class="icon" aria-hidden="true">
                          <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-whatsapp"></use>
                        </svg>
                        <span>Whatsapp</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="dropdown d-inline">
              <button aria-label="vedi azioni da compiere sulla pagina" class="btn btn-dropdown dropdown-toggle text-decoration-underline d-inline-flex align-items-center fs-0" type="button" id="viewActions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-focus-mouse="false">
                <svg class="icon" aria-hidden="true">
                  <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-more-items"></use>
                </svg>
                <small><?php _e('Vedi azioni','design-italia');?></small>
              </button>
              <div class="dropdown-menu shadow-lg" aria-labelledby="viewActions" style="">
                <div class="link-list-wrapper">
                  <ul class="link-list" role="menu">
                    <li role="none">
                      <a class="list-item" href="javascript:window.print()" role="menuitem">
                        <svg class="icon" aria-hidden="true">
                          <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-print"></use>
                        </svg>
                        <span><?php _e('Stampa','design-italia');?></span>
                      </a>
                    </li>
                    <li role="none">
                      <a class="list-item" role="menuitem" onclick="listenElements(this, '[data-audio]')">
                        <svg class="icon" aria-hidden="true">
                          <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-hearing"></use>
                        </svg>
                        <span><?php _e('Ascolta','design-italia');?></span>
                      </a>
                    </li>
                    <li role="none">
                      <a class="list-item" href="#" role="menuitem">
                        <svg class="icon" aria-hidden="true">
                          <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-mail"></use>
                        </svg>
                        <span><?php _e('Invia','design-italia');?></span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
    
            <?php /*<div class="mt-4 mb-4">
              <h6 class="text-secondary"><?php _e('Servizi','design-italia');?></h6>
              <ul class="d-flex flex-wrap gap-1 mt-2">
                <?php foreach($servizi as $servizio):?>
                <li>
                  <a class="chip chip-simple" href="#">
                    <span class="chip-label"><?php echo $servizio->name;?></span>
                  </a>
                </li>
                <?php endforeach;?>
              </ul>
            </div>*/?>
          </div>
        </div>
      </div>
    
      <div class="container-fluid my-3">
        <div class="row">
          <figure class="figure px-0 img-full">
            <img src="<?php echo $image;?>" class="figure-img img-fluid" alt="Un'immagine generica segnaposto con angoli arrotondati in una figura.">
            <figcaption class="figure-caption text-center pt-3"><?php echo wp_get_attachment_caption($post->ID);?></figcaption>
          </figure>
        </div>
      </div>
    
      <div class="container">
        <div class="row border-top border-light row-column-border row-column-menu-left">
          <aside class="col-lg-4">
            <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
              <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="INDICE DELLA PAGINA" data-bs-navscroll="">
                <div class="navbar-custom" id="navbarNavProgress">
                  <div class="menu-wrapper">
                    <div class="link-list-wrapper">
                      <div class="accordion">
                        <div class="accordion-item">
                          <span class="accordion-header" id="accordion-title-one">
                            <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                            <?php _e('INDICE DELLA PAGINA','design-italia');?>
                              <svg class="icon icon-xs right">
                                <use href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-expand"></use>
                              </svg>
                            </button>
                          </span>
                          <div class="progress">
                            <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                          </div>
                          <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                            <div class="accordion-body">
                              <ul class="link-list" data-element="page-index">
                                <li class="nav-item">
                                  <a class="nav-link active" href="#cos-e">
                                    <span class="title-medium"><?php _e("Cos'è?",'design-italia');?></span>
                                  </a>
                                </li> 
                                <li class="nav-item">
                                  <a class="nav-link" href="#luogo">
                                    <span class="title-medium"><?php _e('Luogo','design-italia');?></span>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#contatti">
                                    <span class="title-medium"><?php _e('Contatti','design-italia');?></span>
                                  </a>
                                </li>
                                <!-- <?php if(strlen($metas['luogo_note'][0])):?>
                                <li class="nav-item">
                                  <a class="nav-link" href="#note">
                                    <span class="title-medium"><?php _e('Note','design-italia');?></span>
                                  </a>
                                </li> -->
                                <?php endif;?>
                                <?php if(count($info)):?>
                                <li class="nav-item">
                                  <a class="nav-link" href="#info">
                                    <span class="title-medium"><?php _e('Info','design-italia');?></span>
                                  </a>
                                </li>
                                <?php endif;?>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </nav>
            </div>      
          </aside>
          <section class="col-lg-8 it-page-sections-container border-light">
            <article id="cos-e" class="it-page-section mb-5" data-audio="">
              <h2 class="mb-3"><?php _e("Cos'è?",'design-italia');?></h2>
              <?php the_content();?>
              <div class="it-carousel-wrapper it-carousel-landscape-abstract-three-cols splide splide--slide splide--ltr splide--draggable is-active is-initialized" data-bs-carousel-splide="" id="splide01">
                <div class="it-header-block">
                  <div class="it-header-block-title">
                    <h3 class="h4"><?php _e('Galleria di immagini','design-italia');?></h3>
                  </div>
                </div>
                <div class="splide__track" id="splide01-track" style="padding-left: 0px; padding-right: 0px;">
                  <ul class="splide__list it-carousel-all" id="splide01-list" style="transform: translateX(0px);">
                    <?php foreach($gallery['image_url'] as $k => $item):?>
                      <li class="splide__slide is-active is-visible" id="splide01-slide<?php echo $k+1;?>" style="margin-right: 24px; width: calc(((100% + 24px) / 3) - 24px);" tabindex="<?php echo $k;?>" data-focus-mouse="false">
                      <div class="it-single-slide-wrapper">
                        <figure>
                          <a href="<?php echo $item;?>" data-lightbox="roadtrip" data-title="<?php $gallery['image_title'][$k];?>"><img src="<?php echo $item;?>" alt="Festa di Sant'Efisio" class="img-fluid"></a>
                          <figcaption class="figure-caption mt-2"><?php $gallery['caption'][$k];?></figcaption>
                        </figure>
                      </div>
                    </li>
                    <?php endforeach;?>
                  </ul>
                </div>
            </article> 
            <article id="luogo" class="it-page-section mb-5">
              <h2 class="mb-3"><?php _e('Luogo','design-italia');?></h2>
              <div class="card-wrapper card-teaser-wrapper">
                <div class="card card-teaser shadow mt-3 rounded">
                  <svg class="icon icon-success" aria-hidden="true">
                    <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-pin"></use>
                  </svg>
                  <div class="card-body">
                    <h3 class="card-title h5">
                      <a href="#" class="text-decoration-none">
                      <?php echo get_post_meta( $post->ID, 'luogo', true );?>
                      </a>
                    </h3>
                    <div class="card-text">
                      <p><?php echo get_post_meta( $post->ID, 'indirizzo', true );?></p> 
                    </div>
                  </div>
                </div>
              </div>
              <?php 
              $lat = get_post_meta( $post->ID, 'lat', true );
              $lon = get_post_meta( $post->ID, 'lon', true );
              if(strlen($lat) && strlen($lon)):?>
              ?>
              <div class="map-wrapper map-column mt-4"> 
                <div id="mapdettaglio" style="width: 100%; aspect-ratio: 320/180;"></div>
                <script>
                  var light = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}.png?api_key=<?php echo get_theme_mod( 'stadiamaps' );?>', {
                      maxZoom: 19,
                      attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
                  });
                    var map = L.map('mapdettaglio',{
                        center: [<?php echo $lat;?>, <?php echo $lon;?>],
                        layers: [light],
                        zoom: 13,
                    });
                    L.circleMarker([<?php echo $lat;?>, <?php echo $lon;?>], {weight:0.5,radius:8, opacity: 0.9, color: '<?php echo $colore;?>', fillColor:'#666', fillOpacity: 1}).addTo(map);
                </script>
              </div>
              <?php endif;?>
            </article>
    
            <!-- <article id="date-e-orari" class="it-page-section mb-5">
              <h2 class="mb-3">Date e orari</h2>
              <div class="point-list-wrapper my-4">
                <div class="point-list">
                  <h3 class="point-list-aside point-list-primary fw-normal">
                    <span class="point-date font-monospace">01</span>
                    <span class="point-month font-monospace">mag</span>
                  </h3>
                  <div class="point-list-content">
                    <div class="card card-teaser shadow rounded">
                      <div class="card-body">
                        <h3 class="card-title h5 m-0">
                          09:00 - Inizio evento
                        </h3>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="point-list">
                  <h3 class="point-list-aside point-list-primary fw-normal">
                    <div class="point-date font-monospace">04</div>
                    <div class="point-month font-monospace">mag</div>
                  </h3>
                  <div class="point-list-content">
                    <div class="card card-teaser shadow rounded">
                      <div class="card-body">
                        <h3 class="card-title h5 m-0">
                          18:00 - Fine evento
                        </h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <p class="font-serif">
                Per informazioni sul programma dettagliato degli appuntamenti religiosi e civili, consultare il programma
                nella sezione documenti.
              </p>
            </article> -->
    
            <!-- <article id="costi" class="it-page-section mb-5">
              <h2 class="mb-3">Costi</h2>
              <div class="card no-after border-start">
                <div class="card-body">
                  <h5>
                    <span>
                      Tribuna 1 e 4
                    </span>
                    <p class="card-title big-heading">€ 30</p>
                  </h5>
                  <p class="mt-4">Tribune coperte site nella via Roma lato Palazzo Vivanet (tribuna n. 1) e nella via Roma
                    fronte palazzo Civico (tribuna n. 4), per circa 770 posti a sedere.</p>
                </div>
              </div>
              <div class="card no-after border-start mt-3">
                <div class="card-body">
                  <h5>
                    <span>
                      Tribuna 3
                    </span>
                    <p class="card-title big-heading">€ 30</p>
                  </h5>
                  <p class="mt-4">Tribuna coperta con la pedana riservata alle persone con disabilità motorie sita nella via
                    Roma fronte Palazzo Vivanet, per circa 190 posti a sedere, di cui circa 30 posti nella pedana anzi
                    detta. L’accesso sarà consentito con unico biglietto alla persona con disabilità motoria e al proprio
                    accompagnatore. Saranno pertanto venduti circa 30 titoli di ingresso per i soggetti con disabilità
                    motorie, con i quali potranno accedere altrettanti accompagnatori e circa 130 biglietti ordinari.</p>
                </div>
              </div>
              <div class="card no-after border-start mt-3">
                <div class="card-body">
                  <h5>
                    <span>
                      Tribuna 5
                    </span>
                    <p class="card-title big-heading">€ 25</p>
                  </h5>
                  <p class="mt-4">Tribuna coperta fronte largo Carlo Felice, dislocata nell'incrocio, nello spazio compreso
                    tra i due semafori della via Roma, per circa 400 posti a sedere.</p>
                </div>
              </div>
              <div class="card no-after border-start mt-3">
                <div class="card-body">
                  <h5>
                    <span>
                      Tribuna 2
                    </span>
                    <p class="card-title big-heading">€ 15</p>
                  </h5>
                  <p class="mt-4">Tribuna coperta dislocata nella piazza Matteotti, antistante la Stazione Ferroviaria, per
                    circa 370 posti a sedere.</p>
                </div>
              </div>
            </article> -->
            
            <!-- <article id="allegati" class="it-page-section mb-5">
              <h2 class="mb-3">Allegati</h2>
              <div class="card card-teaser shadow rounded">
                <div class="card-body">
                  <h3 class="card-title h5 m-0">
                    <svg class="icon" aria-hidden="true">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-clip"></use>
                    </svg>
                    <a href="#" class="text-decoration-none" title="Scarica la locandina sant'efisio 2019" aria-label="Scarica la locandina sant'efisio 2019">Locandina Sant'Efisio 2019 (PDF - 1MB)</a>
                  </h3>
                </div>
              </div>
            </article> -->
    
            <!-- <article id="appuntamenti" class="it-page-section mb-5">
              <h2 class="mb-3">Appuntamenti</h2>
              <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                <div class="card-wrapper card-teaser">
                  <div class="card card-img no-after">
                    <div class="img-responsive-wrapper">
                      <div class="img-responsive">
                        <figure class="img-wrapper">
                          <img src="https://picsum.photos/400/200" title="titolo immagine" alt="descrizione immagine">
                        </figure>
                        <div class="card-calendar d-flex flex-column justify-content-center">
                          <span class="card-date">31</span>
                          <span class="card-day">dicembre</span>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">
                        <a href="#" class="text-decoration-none">
                          Il ballo dell'isola in festa</a>
                      </h5>
                      <p class="card-text"></p>
                      <a class="read-more" href="#" aria-label="Leggi di più - Il ballo dell'isola in festa">
                        <span class="text">Leggi di più</span>
                        <span class="visually-hidden">su Lorem ipsum dolor sit amet, consectetur adipiscing elit…</span>
                        <svg class="icon">
                          <use href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-arrow-right"></use>
                        </svg></a>
                    </div>
                  </div>
                </div>
                <div class="card-wrapper card-teaser">
                  <div class="card card-img no-after">
                    <div class="img-responsive-wrapper">
                      <div class="img-responsive">
                        <figure class="img-wrapper">
                          <img src="https://picsum.photos/400/200" title="titolo immagine" alt="descrizione immagine">
                        </figure>
                        <div class="card-calendar d-flex flex-column justify-content-center">
                          <span class="card-date">31</span>
                          <span class="card-day">dicembre</span>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title"> <a href="#" class="text-decoration-none">La coralità sarda per Sant'Efisio</a>
                      </h5>
                      <p class="card-text"></p>
                      <a class="read-more" href="#" aria-label="leggi di più - la coralità sarda per Sant'Efisio">
                        <span class="text">Leggi di più</span>
                        <span class="visually-hidden">su Lorem ipsum dolor sit amet, consectetur adipiscing elit…</span>
                        <svg class="icon">
                          <use href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-arrow-right"></use>
                        </svg></a>
                    </div>
                  </div>
                </div>
                <div class="card-wrapper card-teaser">
                  <div class="card card-img no-after">
                    <div class="img-responsive-wrapper">
                      <div class="img-responsive">
                        <figure class="img-wrapper">
                          <img src="https://picsum.photos/400/200" title="titolo immagine" alt="descrizione immagine">
                        </figure>
                        <div class="card-calendar d-flex flex-column justify-content-center">
                          <span class="card-date">31</span>
                          <span class="card-day">dicembre</span>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title"> <a href="#" class="text-decoration-none">Il ballo dell'isola in festa</a></h5>
                      <p class="card-text"></p>
                      <a class="read-more" href="#" aria-label="leggi di più - il ballo dell'isola in festa">
                        <span class="text">Leggi di più</span>
                        <span class="visually-hidden">su Lorem ipsum dolor sit amet, consectetur adipiscing elit…</span>
                        <svg class="icon">
                          <use href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-arrow-right"></use>
                        </svg></a>
                    </div>
                  </div>
                </div>
              </div>
            </article> -->
    
            <article id="contatti" class="it-page-section mb-5">
              <h2 class="mb-3"><?php _e('Contatti','design-italia');?></h2>
              <div class="mb-4">
                <div class="card card-teaser shadow rounded">
                  <svg class="icon" aria-hidden="true">
                    <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-telephone"></use>
                  </svg>
                  <div class="card-body">
                    <h3 class="card-title h5">
                      <a href="#" class="text-decoration-none">
                        <?php the_title();?>
                      </a>
                    </h3>
                    <div class="card-text">
                      <p><?php echo get_post_meta( $post->ID, 'luogo_indirizzo', true );?> - <?php echo get_post_meta( $post->ID, 'luogo_cap', true );?> <?php echo $indirizzo->localita_nome;?> (<?php echo $indirizzo->provincia_sigla;?>)</p>
                      <div class="mt-3">
                        <?php if(!empty(get_post_meta( $post->ID, 'luogo_telefono', true ))):?><p>T <?php echo get_post_meta( $post->ID, 'luogo_telefono', true );?></p><?php endif;?>
                        <?php if(!empty(get_post_meta( $post->ID, 'luogo_web', true ))):?><p><a aria-label="scopri di più su <?php get_post_meta( $post->ID, 'luogo_web', true );?> - link esterno - apertura nuova scheda" target="_blank" title="vai sul sito di <?php the_title();?>" href="<?php get_post_meta( $post->ID, 'luogo_web', true );?>">Web</a></p><?php endif;?>
                        <?php if(!empty(get_post_meta( $post->ID, 'luogo_email', true ))):?><p><a aria-label="invia un'email a <?php get_post_meta( $post->ID, 'luogo_email', true );?>< - apertura casella postale" title="invia un'email a <?php get_post_meta( $post->ID, 'luogo_email', true );?>< - apertura casella postale" href="mailto:<?php echo get_post_meta( $post->ID, 'luogo_email', true );?>">Email</a></p><?php endif;?>
                        <?php if(!empty(get_post_meta( $post->ID, 'luogo_facebook', true ))):?><p><a aria-label="scopri di più su <?php echo get_post_meta( $post->ID, 'luogo_facebook', true );?> - link esterno - apertura nuova scheda" target="_blank" title="vai sulla pagina Facebook di <?php the_title();?>" href="<?php echo get_post_meta( $post->ID, 'luogo_facebook', true );?>">Facebook</a></p><?php endif;?>
                        <?php if(!empty(get_post_meta( $post->ID, 'luogo_twitter', true ))):?><p><a aria-label="scopri di più su <?php echo et_post_meta( $post->ID, 'luogo_twitter', true );?> - link esterno - apertura nuova scheda" target="_blank" title="vai sulla pagina X di <?php the_title();?>" href="<?php echo get_post_meta( $post->ID, 'luogo_twitter', true );?>">X</a></p><?php endif;?>
                        <?php if(!empty(get_post_meta( $post->ID, 'luogo_instagram', true ))):?><p><a aria-label="scopri di più su <?php echo get_post_meta( $post->ID, 'luogo_instagram', true );?> - link esterno - apertura nuova scheda" target="_blank" title="vai sulla pagina Instagram di <?php the_title();?>" href="<?php echo get_post_meta( $post->ID, 'luogo_instagram', true );?>">Instagram</a></p><?php endif;?>
                        <?php if(!empty(get_post_meta( $post->ID, 'luogo_youtube', true ))):?><p><a aria-label="scopri di più su <?php echo get_post_meta( $post->ID, 'luogo_youtube', true );?> - link esterno - apertura nuova scheda" target="_blank" title="vai sulla pagina YouTube di <?php the_title();?>" href="<?php echo get_post_meta( $post->ID, 'luogo_youtube', true );?>">YouTube</a></p></div><?php endif;?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <h4 class="h5">Con il supporto di:</h4>
              <div class="card card-teaser shadow mt-3 rounded">
                <svg class="icon" aria-hidden="true">
                  <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-pa"></use>
                </svg>
                <div class="card-body">
                  <h3 class="card-title h5">
                    <a href="#" class="text-decoration-none">
                      Ufficio delle Attività Produttive
                    </a>
                  </h3>
                  <div class="card-text">
                    <p>Piazza Alcide De Gasperi, 2</p>
                    <p class="mt-3">T +39 070 6776430</p>
                    <p><a href="mailto:produttive@comune.cagliari.it" aria-label="invia un'email a produttive@comune.cagliari.it - apertura casella portale" title="invia un'email a produttive@comune.cagliari.it - apertura casella portale">produttive@comune.cagliari.it</a>
                    </p>
                  </div>
                </div>
              </div> -->
            </article>
    
            <?php if(strlen($metas['luogo_note'][0])):?>
            <article id="note" class="it-page-section mb-5">
            <h2 class="mb-3"><?php _e('Note','design-italia');?></h2>
              <div class="link-list-wrapper mb-3">
                <?php echo $metas['luogo_note'][0];?>
              </div>
            </article>
            <?php endif;?>

            <?php if(count($info)>0):?>
            <article id="info" class="it-page-section mb-5">
            <h2 class="mb-3"><?php _e('Informazioni varie','design-italia');?></h2>
            <div class="link-list-wrapper">
              <ul class="link-list">
                <?php echo implode("\n", $info);?>
                <!-- <li><a class="list-item px-0" href="#"><span>Sogaer - Aeroporto di Cagliari</span></a></li>
                <li><a class="list-item px-0" href="#"><span>Autorità Portuale di Cagliari</span></a></li>
                <li><a class="list-item px-0" href="#"><span>ARST</span></a></li>
                <li><a class="list-item px-0" href="#"><span>CTM Cagliari</span></a></li>
                <li><a class="list-item px-0" href="#"><span>Trenitalia</span></a></li>
                <li><a class="list-item px-0" href="#"><span>Camera di Commercio di Cagliari</span></a></li>-->
              </ul>
            </div>
            </article>
            <?php endif;?>

            <!-- <article id="patrocinio" class="it-page-section mb-5">
              <h2 class="mb-3">Patrocinato da</h2>
              <div class="link-list-wrapper mb-3">
                <ul class="link-list">
                  <li><a class="list-item px-0" href="#"><span>Regione Autonome della Sardegna</span></a></li>
                </ul>
              </div>
            </article> -->
    
            <!-- <article id="sponsor" class="it-page-section mb-5">
              <h2 class="mb-3">Sponsor</h2>
              <div class="link-list-wrapper">
                <ul class="link-list">
                  <li><a class="list-item px-0" href="#"><span>Provincia di Cagliari</span></a></li>
                  <li><a class="list-item px-0" href="#"><span>Sogaer - Aeroporto di Cagliari</span></a></li>
                  <li><a class="list-item px-0" href="#"><span>Autorità Portuale di Cagliari</span></a></li>
                  <li><a class="list-item px-0" href="#"><span>ARST</span></a></li>
                  <li><a class="list-item px-0" href="#"><span>CTM Cagliari</span></a></li>
                  <li><a class="list-item px-0" href="#"><span>Trenitalia</span></a></li>
                  <li><a class="list-item px-0" href="#"><span>Camera di Commercio di Cagliari</span></a></li>
                </ul>
              </div>
            </article> -->
    
            <article id="ultimo-aggiornamento" class="it-page-section mt-5">
            <?php get_template_part( "template-parts/single/bottom" ); ?>
            </article>
          </section>
        </div>
      </div>
    </main>
<?php
get_footer();