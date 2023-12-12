<?php
/*
 * Generic Page Template
 *
 * @package Design_Comuni_Italia
 */

  get_header();
  $metas = get_post_meta( $post->ID);
  $gallery = get_post_meta( $post->ID, 'gallery_data', true );
  $citta = get_post_meta( $post->ID, 'luogo_localita_id', true );
  $sql = "SELECT * FROM {$wpdb->prefix}luoghi_localita AS l INNER JOIN {$wpdb->prefix}luoghi_province AS p ON l.localita_provincia_id = p.provincia_id INNER JOIN {$wpdb->prefix}luoghi_regioni AS r ON p.provincia_regione_id = r.regione_id WHERE l.localita_id = '".$citta."'";
  $indirizzo = $wpdb->get_results($sql)[0];

  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
  if(empty($image)) $image = $gallery['image_url'][0];


  $tip = get_post_meta( $post->ID, 'luogo_tipologia_id', true );

  $info = []; 
  
  $bando_id  = (int) get_post_meta( $post->ID, 'bando', true );
  $bando_url = $bando_id ? wp_get_attachment_url( $bando_id ) : '';
  $documentazione_id  = (int) get_post_meta( $post->ID, 'documentazione', true );
  $documentazione_url = $documentazione_id ? wp_get_attachment_url( $documentazione_id ) : '';
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
                                <?php if(count($info)):?>
                                <li class="nav-item">
                                  <a class="nav-link" href="#info">
                                    <span class="title-medium"><?php _e('Info','design-italia');?></span>
                                  </a>
                                </li>
                                <?php endif;?>
                                <?php if(strlen($bando_url)||strlen($documentazione_url)):?>
                                <li class="nav-item">
                                  <a class="nav-link" href="#allegati">
                                    <span class="title-medium"><?php _e('Allegati','design-italia');?></span>
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
              <div class="map-wrapper map-column mt-4"> 
                <div id="mapdettaglio" style="width: 100%; aspect-ratio: 320/180;"></div>
                <script>
                    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap'
                    });

                    var osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
                    });

                    var light = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}.png?api_key=<?php echo get_theme_mod( 'stadiamaps' );?>', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
                    });

                    var dark = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}.png?api_key=<?php echo get_theme_mod( 'stadiamaps' );?>', {
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
                    };
                    var map = L.map('mapdettaglio',{
                        center: [<?php echo $lat;?>, <?php echo $lon;?>],
                        layers: [light],
                        zoom: 13,
                    });
                    L.circleMarker([<?php echo $lat;?>, <?php echo $lon;?>], {weight:0.5,radius:8, opacity: 0.9, color: '<?php echo $colore;?>', fillColor:'#666', fillOpacity: 1}).addTo(map);
                    L.control.layers(baseMaps/* , overlays */).addTo(map);
                </script>
              </div>
              <?php endif;?>
            </article>
            <?php 
            if(strlen($documentazione_url) || strlen($bando_url)):?>
            <article id="allegati" class="it-page-section mb-5">
              <h2 class="mb-3">Allegati</h2>
              <div class="card card-teaser shadow rounded">
                <div class="card-body">
                  <?php if(strlen($bando_url)):?>
                  <h3 class="card-title h5 m-0">
                    <svg class="icon" aria-hidden="true">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-clip"></use>
                    </svg>
                    <a href="<?php echo $bando_url;?>" class="text-decoration-none" title="Scarica il bando" aria-label="Scarica il bando">Bando</a>
                  </h3>
                  <?php endif;?>
                  <?php if(strlen($documentazione_url)):?>
                  <h3 class="card-title h5 m-0">
                    <svg class="icon" aria-hidden="true">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-clip"></use>
                    </svg>
                    <a href="<?php echo $documentazione_url;?>" class="text-decoration-none" title="Scarica la documentazione" aria-label="Scarica la documentazione">Documentazione</a>
                  </h3>
                  <?php endif;?>
                </div>
              </div>
            </article>
            <?php endif;?>
     
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