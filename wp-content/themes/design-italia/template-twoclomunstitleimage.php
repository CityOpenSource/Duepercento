<?php
/**
 * Template Name: Due Colonne titolo su immagine Bootstrap Italia
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
            ?>
            <section class="hero-img mb-20 mb-lg-50">
                <section class="it-hero-wrapper it-hero-small-size cmp-hero-img-small">
                    <div class="img-responsive-wrapper">
                        <div class="img-responsive">
                            <div class="img-wrapper" style="opacity:0.5"><?php echo has_post_thumbnail( ) ? '<img src="'.get_the_post_thumbnail_url(null, array(1920,450)).'" class="figure-img img-fluid" alt="">':'<img src="https://duepercento.cultura.gov.it/wp-content/uploads/evi/evi_accardi_inail_venezia.jpg" class="figure-img img-fluid" alt=".">';?></div>
                            <div class="img-wrapper" style="background-color:#333;opacity:0.2"></div>
                            <div class="img-wrapper position-absolute d-flex justify-content-start align-items-center"> 
                                <div class="container">
                                <h1 class="text-black title-xxxlarge mb-2 text-start" data-element="page-name" style="color:white!important">
                                    <?php the_title()?>
                                </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- <p class="title-xsmall cmp-hero-img-small__description"></p> -->
            </section>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-8 px-lg-4 d-flex flex-row align-items-center">
                        <?php get_template_part("template-parts/common/breadcrumb"); ?>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <?php get_template_part( "template-parts/actions" ); ?>
                    </div>
                </div>
            </div>
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
                                                        <?php _e('INDICE DELLA PAGINA','design-italia');?>
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
?>