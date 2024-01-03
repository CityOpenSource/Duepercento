    <div class="modal fade search-modal" id="search-modal" tabindex="-1" style="display: none;" data-focus-mouse="false" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content perfect-scrollbar">
          <div class="modal-body">

            <?php get_search_form(); ?>
            
          </div>
        </div>
      </div>
    </div>
    
    
    <footer class="it-footer" id="footer">
      <div class="it-footer-main">
        <div class="container">
          <div class="row">
            <div class="col-12 footer-items-wrapper logo-wrapper">
              <div class="it-brand-wrapper">
                <a href="https://creativitacontemporanea.cultura.gov.it/" title="Vai alla homepage dela DGCC" target="_blank" rel="noopener nofollow">
		<img width="" height="80" src="<?php echo get_template_directory_uri();?>/svg/lm-dgcc-bianco.svg" />
		</a>	
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-9 mt-md-4 footer-items-wrapper">
              <h3 class="footer-heading-title"><?php _e('Contatti','design-italia');?></h3>
              <div class="row">
                <div class="col-md-5">
                  <p class="footer-info"><!--<?php echo get_theme_mod( 'titolo1' );?><br /><?php echo get_theme_mod( 'titolo2' );?><br />-->
                    <?php echo get_theme_mod( 'indirizzo' );?><br />
					  <?php _e('Telefono:','design-italia');?>  <a href="tel:<?php echo get_theme_mod( 'telefono' );?>" class=""><?php echo get_theme_mod( 'telefono' );?></a><br />
                    <?php _e('Codice fiscale / P. IVA:','design-italia');?> <?php echo get_theme_mod( 'codicefiscalepiva' );?><br /><br />
                    <?php _e('PEO:','design-italia');?> <a href="mailto:<?php echo get_theme_mod( 'peo' );?>" target="_blank"><?php echo get_theme_mod( 'peo' );?></a><br />
                    <?php _e('PEC:','design-italia');?> <a href="mailto:<?php echo get_theme_mod( 'pec' );?>" target="_blank"><?php echo get_theme_mod( 'pec' );?></a><br />
                    <?php _e('WEB:','design-italia');?> <a href="<?php echo get_theme_mod( 'web' );?>" target="_blank"><?php echo get_theme_mod( 'web' );?></a><br />

<!-- <HR> <?php _e('Scrivi al progetto:','design-italia');?> <a href="mailto:<?php echo get_theme_mod( 'progetto' );?>" target="_blank"><?php echo get_theme_mod( 'progetto' );?></a><br />
-->
                  </p>
                </div>
                <div class="col-md-3">
                  <?php  
                    $footer1 = array(
                      'theme_location' => 'footer1',
                      'container' => false,
                      'items_wrap' => '<ul class="footer-list">%3$s</ul>'  
                      );
                    wp_nav_menu($footer1);
                  ?>
                </div>
                <div class="col-md-3">
                <?php 
                    $footer2 = array(
                      'theme_location' => 'footer2',
                      'container' => false,
                      'items_wrap' => '<ul class="footer-list">%3$s</ul>'  
                      );
                    wp_nav_menu($footer2);
                  ?>
                </div>
              </div>
            </div>
            <div class="col-md-3 mt-md-4 footer-items-wrapper">
              <h3 class="footer-heading-title"><?php _e('Seguici su','design-italia');?></h3>
              <ul class="list-inline text-start social">
                <?php if(strlen(get_theme_mod( 'twitter' ))):?>
                <li class="list-inline-item">
                  <a class="p-1 text-white" href="<?php echo get_theme_mod( 'twitter' );?>" target="_blank">
                    <svg class="icon icon-sm icon-white align-top">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-twitter"></use>
                    </svg>
                    <span class="visually-hidden">Twitter</span></a>
                </li>
                <?php endif;?>
                <?php if(strlen(get_theme_mod( 'facebook' ))):?>
                <li class="list-inline-item">
                  <a class="p-1 text-white" href="<?php echo get_theme_mod( 'facebook' );?>" target="_blank">
                    <svg class="icon icon-sm icon-white align-top">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-facebook"></use>
                    </svg>
                    <span class="visually-hidden">Facebook</span></a>
                </li>
                <?php endif;?>
                <?php if(strlen(get_theme_mod( 'instagram' ))):?>
                <li class="list-inline-item">
                  <a class="p-1 text-white" href="<?php echo get_theme_mod( 'instagram' );?>" target="_blank">
                    <svg class="icon icon-sm icon-white align-top">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-instagram"></use>
                    </svg>
                    <span class="visually-hidden">Instagram</span></a>
                </li>
                <?php endif;?>
                <?php if(strlen(get_theme_mod( 'youtube' ))):?>
                <li class="list-inline-item">
                  <a class="p-1 text-white" href="<?php echo get_theme_mod( 'youtube' );?>" target="_blank">
                    <svg class="icon icon-sm icon-white align-top">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-youtube"></use>
                    </svg>
                    <span class="visually-hidden">YouTube</span></a>
                </li>
                <?php endif;?>
                <?php if(strlen(get_theme_mod( 'telegram' ))):?>
                <li class="list-inline-item">
                  <a class="p-1 text-white" href="<?php echo get_theme_mod( 'telegram' );?>" target="_blank">
                    <svg class="icon icon-sm icon-white align-top">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-telegram"></use>
                    </svg>
                    <span class="visually-hidden">Telegram</span></a>
                </li>
                <?php endif;?>
                <?php if(strlen(get_theme_mod( 'whatsapp' ))):?>
                <li class="list-inline-item">
                  <a class="p-1 text-white" href="<?php echo get_theme_mod( 'whatsapp' );?>" target="_blank">
                    <svg class="icon icon-sm icon-white align-top">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-whatsapp"></use>
                    </svg>
                    <span class="visually-hidden">Whatsapp</span></a>
                </li>
                <?php endif;?> 
                <li class="list-inline-item">
                  <a class="p-1 text-white" href="/feed/?post_type=operaduepercento" target="_blank">
                    <svg class="icon icon-sm icon-white align-top">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-rss"></use>
                    </svg>
                    <span class="visually-hidden">RSS</span></a>
                </li> 
              </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-12 footer-items-wrapper">
              <?php 
                $bottomwalker = new Bottom_Menu_Walker; 
                $bottom = array(
                  'walker' => $bottomwalker,
                  'theme_location' => 'bottom',
                  'container' => 'div',
                  'container_class' => 'footer-bottom pb-0',
                  'items_wrap' => '%3$s'
                  );
                
                echo strip_tags(wp_nav_menu($bottom), '<nav><a>');
              ?>
            </div>
            <div class="col-12 footer-items-wrapper">
              <div class="footer-bottom row">
                <div class="col-12 col-sm-8">
                  &copy; 2023 <a href="https://creativitacontemporanea.cultura.gov.it/" target="_blank">Direzione generale Creatività contemporanea</a> del <a href="https://cultura.gov.it/" target="_blank" style="margin-left:0">Ministero della cultura</a>
                </div>
                <div class="col-12 text-start col-sm-4 text-sm-end">
                  Repository: <a class="p-1 text-white" href="https://github.com/CityOpenSource/Duepercento" target="_blank"><svg class="icon icon-sm icon-white align-top"><use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-github"></use></svg>
                    <span class="visually-hidden">GitHub</span></a>
                </div> 
              </div>            
            </div>
          </div>
        </div>
      </div>
    <?php wp_footer(); ?>

</body>
</html>
