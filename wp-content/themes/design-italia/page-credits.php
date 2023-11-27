<?php
/*
 * Generic Page Template
 *
 * @package Design_Comuni_Italia
 */
global $post;
get_header();

$content = str_replace(array("\n","\r"),array('',''), get_the_content( ));
// echo $content;

$ereg = "|<article.*id=\"(.*)\".*>.*<h2.*>(.*)</h2>|Ui";
$ereg = "|<article.*id=\"([^\"]*)\"[^>]*>.*<h2[^>]*>([^<]*)</h2>|Umi";
preg_match_all($ereg, $content, $matches, PREG_PATTERN_ORDER);
 
?>
    <main>
        <?php
        while ( have_posts() ) :
            the_post();
            // $description = dci_get_meta('descrizione','_dci_page_',$post->ID);
            ?>
            <!-- <div class="it-hero-wrapper">
            
            <div class="img-responsive-wrapper">
                <div class="img-responsive">
                <div class="img-wrapper">
                    <img src="https://luoghidelcontemporaneo.beniculturali.it/images/slider/Fondazione_Merz_-_Torino.jpg" title="titolo immagine" alt="descrizione immagine">
                </div>
                </div>
            </div>
            
            </div> -->
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
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>

            <section class="hero-img mb-20 mb-lg-50">
                <section class="it-hero-wrapper it-hero-small-size cmp-hero-img-small">
                    <div class="img-responsive-wrapper">
                        <div class="img-responsive">
                            <div class="img-wrapper"><?php echo has_post_thumbnail( ) ? '<img src="'.get_the_post_thumbnail_url(null, array(1920,450)).'" class="figure-img img-fluid" alt="Un\'immagine generica segnaposto con angoli arrotondati in una figura.">':'<img src="https://picsum.photos/800/450" class="figure-img img-fluid" alt="Un\'immagine generica segnaposto con angoli arrotondati in una figura.">';?></div>
                        </div>
                    </div>
                </section>
                
                <p class="title-xsmall cmp-hero-img-small__description">.</p>
            </section>
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
                                                            <use href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
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