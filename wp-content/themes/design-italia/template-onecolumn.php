<?php
/**
 * Template Name: Una Colonna Bootstrap Italia
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
                            <div class="img-wrapper" style="opacity:0.5"><?php echo has_post_thumbnail( ) ? '<img src="'.get_the_post_thumbnail_url(null, array(1920,450)).'" class="figure-img img-fluid" alt="Un\'immagine generica segnaposto con angoli arrotondati in una figura.">':'<img src="https://picsum.photos/800/450" class="figure-img img-fluid" alt="Un\'immagine generica segnaposto con angoli arrotondati in una figura.">';?></div>
                            <div class="img-wrapper" style="background-color:#666;opacity:0.3"></div>
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
                <div class="row">
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
            <div class="container">
                <div class="row">

                    <section class="col-lg-12 it-page-sections-container border-light">
                        <article id="descrizione" class="it-page-section anchor-offset" data-audio="">
                        <?php echo $presenter;?>
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
  
        <?php
        endwhile; // End of the loop.
        ?>
    </main>
<?php
get_footer();