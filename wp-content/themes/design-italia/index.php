<?php
/*
 * Generic Page Template
 *
 * @package Design_Comuni_Italia
 */
global $post;
get_header();

$s = get_search_query();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
  'posts_per_page' => 10,
  'paged' => $paged,
  's' => $s
); 
$the_query = new WP_Query( $args );

?>
<main>
    <div class="container">
        <form method="get" class="form-group cmp-input-search-button mt-2 mb-4 mb-lg-50" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <svg class="icon icon-md">
                        <use href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-search"></use>
                        </svg>
                    </div>
                </div>
                <label for="input-group-1" class="active">Con Etichetta</label>
                <input type="search" class="form-control" id="input-group-1" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" data-focus-mouse="false">
            </div>
            <button type="submit" data-bs-toggle="modal" data-bs-target="#" class="btn btn-primary">
                <span class=""><? _e('Cerca','design-italia');?></span>
            </button>
        </form>
    </div>
    <div class="container">
          <div class="row justify-content-center">

            <div class="col-lg-12">
              <div class="d-flex justify-content-between align-items-center border-bottom border-light pb-3 mb-2">
                <h2 class="visually-hidden" id="search-result"><?php _e('Risultati di ricerca','design-italia');?></h2>
                <span class="search-results u-grey-light"><span class="numResult"><?php echo $the_query->found_posts;?></span> <?php _e('Risultati','design-italia');?></span>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-categories" class="btn p-0 pe-2 d-lg-none">
                
                  <span class="rounded-icon">
                    <svg class="icon icon-primary icon-xs" aria-hidden="true">
                      <use href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-funnel"></use>
                    </svg>
                  </span>
                
                
                 <span class="t-primary title-xsmall-semi-bold ms-1">Filtra</span>
                </button>
    
                <!-- <button type="button" class="btn d-none d-lg-block btn-result" disabled="disabled">Rimuovi tutti i filtri</button> -->
              </div>
    
              <div class="container p-0">
                <div class="row flex-column-reverse flex-lg-row">
                  <div class="col-12 pt-3">
                    <?php


if ( $the_query->have_posts() ) {
    ?>

                    <?php

// _e("<h2 style='font-weight:bold;color:#000'>Search Results for: ".get_query_var('s')."</h2>");
while ( $the_query->have_posts() ) {
   $the_query->the_post();
         ?>

                    <div class="cmp-card-latest-messages mb-3 mb-30" data-bs-toggle="modal" data-bs-target="#">
                      <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
                        <!-- <span class="visually-hidden">Categoria:</span>
                        <div class="card-header border-0 p-0">
                            <a class="text-decoration-none title-xsmall-bold mb-2 category text-uppercase" href="#">Servizi</a>
                        </div> -->
                        <div class="card-body p-0 my-2">
                          <h3 class="green-title-big t-primary mb-8"><a href="<?php the_permalink(); ?>" class="text-decoration-none" data-element="service-link"><?php the_title(); ?></a></h3>
                          <p class="text-paragraph"><?php the_excerpt(); ?></p>
                        </div>
                      </div>
                    </div>

         <?php
}
}else{
?>
<h2 style='font-weight:bold;color:#000'>Non ho trovato niente</h2>
<div class="alert alert-info">
  <p>Scusa, non ho trovato niente secondo i tuoi criteri di ricerca. Prova qualche altra parola chiave.</p>
</div>
<?php } ?>
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
                    
                  </div>
                </div>
              </div>
    
              <!-- <div class="container p-0">
                <div class="d-flex justify-content-center">
                  <button type="button" class="btn btn-outline-primary pt-15 pb-15 pl-90 pr-90 mb-30 mb-lg-50 full-mb text-button">
                  
                  
                  
                   <span class="">Carica altri risultati</span>
                  </button>
                </div>
              </div> -->
            </div>
          </div>
        </div>
    </main>
<?php
get_footer();