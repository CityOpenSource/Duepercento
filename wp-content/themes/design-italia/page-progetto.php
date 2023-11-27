<?php
/*
 * Generic Page Template
 *
 * @package Design_Comuni_Italia
 */
global $post, $wpdb;
get_header();

$content = str_replace(array("\n","\r"),array('',''), get_the_content( ));
// echo $content;

$ereg = "|<article.*id=\"(.*)\".*>.*<h2.*>(.*)</h2>|Ui";
$ereg = "|<article.*id=\"([^\"]*)\"[^>]*>.*<h2[^>]*>([^<]*)</h2>|Umi";
preg_match_all($ereg, $content, $matches, PREG_PATTERN_ORDER);





?>
<!-- Full screen modal -->
    <div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <h1 class="modal-title fs-4" id="exampleModalFullscreenLabel">Full screen modal</h1>
                    
                </div> -->
                <iframe src="https://luoghidelcontemporaneo.mappi-na.it/slider/" style="height:100vh;width:100vw;"></iframe>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="z-index:1100;position:absolute;right:24px;top:24px;"></button>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <main>
        <?php
        while ( have_posts() ) :
            the_post();
            // $description = dci_get_meta('descrizione','_dci_page_',$post->ID);
            ?>
            <!-- <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10"> 
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
            </div> --> 
            <div class="it-hero-wrapper">
                <div class="img-responsive-wrapper">
                    <div class="img-responsive">
                        <div class="img-wrapper">
                            <img src="https://luoghidelcontemporaneo.beniculturali.it/images/slider/Fondazione_Merz_-_Torino.jpg" title="Fondazione Merz - Torino" alt="Fondazione Merz - Torino">
                        </div>
                    </div>
                    <div class="position-absolute d-flex flex-row justify-content-center align-items-end pb-3" style="top:0;left:0;right:0;bottom:0">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen"><img src="<?php echo get_stylesheet_directory_uri();?>/svg/slideshow.svg" alt="Apre lo slideshow delle immagini" /></button> 
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <?php get_template_part("template-parts/common/breadcrumb"); ?>
                        <!-- <div class="cmp-hero">
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
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- <div class="container-fluid my-3">
                <div class="row">
                <figure class="figure px-0 img-full">
                    <img src="https://picsum.photos/800/400" class="figure-img img-fluid" alt="Un'immagine generica segnaposto con angoli arrotondati in una figura.">
                    <figcaption class="figure-caption text-center pt-3">Una didascalia per l'immagine sopra.</figcaption>
                </figure>
                </div>
            </div> -->
            <div class="container">
                <div class="row border-top border-light row-column-border row-column-menu-left">
                    <aside class="col-lg-3">
                        <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                            <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="INDICE DELLA PAGINA" data-bs-navscroll="">
                                <div class="navbar-custom" id="navbarNavProgress">
                                    <div class="menu-wrapper">
                                        <div class="link-list-wrapper">
                                            <div class="accordion">
                                                <div class="accordion-item">
                                                    <span class="accordion-header" id="accordion-title-one">
                                                        <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                                        <?php _e('INDICE DELLA PAGINA');?>
                                                        <svg class="icon icon-xs right">
                                                            <use href="<?php echo get_stylesheet_directory_uri();?>/svg/sprites.svg#it-expand"></use>
                                                        </svg>
                                                        </button>
                                                    </span>
                                                    <div class="progress">
                                                        <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                    </div>
                                                    <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                                                        <div class="accordion-body">
                                                            <ul class="link-list" data-element="page-index">
                                                                <?php foreach($matches[1] as $k=>$v):?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#<?php echo $v;?>">
                                                                        <span class="title-medium"><?php echo $matches[2][$k];?></span>
                                                                    </a>
                                                                </li>
                                                                <?php endforeach;?>
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
                    <section class="col-lg-9 it-page-sections-container border-light">
                        <article id="descrizione" class="it-page-section anchor-offset" data-audio="">
                        <?php the_content();?>
                        </article>
                        
                    </section>
                </div>
            </div>
            <div class="container ">
                <article class="article-wrapper">

                    <div class="row variable-gutters">
                        <div class="col-lg-12">
                            <?php get_template_part( "template-parts/single/bottom" ); ?>
                        </div><!-- /col-lg-9 -->
                    </div><!-- /row -->

                </article>
            </div>
            <?php // get_template_part("template-parts/common/valuta-servizio"); ?>
            
        <?php
        endwhile; // End of the loop.
        ?>
    </main>
<?php
get_footer();



