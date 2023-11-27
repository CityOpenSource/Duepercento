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
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <div class="cmp-hero">
                            <section class="it-hero-wrapper bg-white align-items-start">
                                <div class="it-hero-text-wrapper pt-0 ps-0 pb-4 pb-lg-60">
                                    <h1 class="text-black title-xxxlarge mb-2 mt-5" data-element="page-name"><?php the_title()?></h1>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
 
            </section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10">
                        <!-- <?php get_template_part("template-parts/common/breadcrumb"); ?> -->
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
            <div class="container-fluid">
                <div class="row">

                    <section class="col-lg-12 it-page-sections-container border-light">
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
  
        <?php
        endwhile; // End of the loop.
        ?>
    </main>
<?php
get_footer();