<div class="dropdown d-inline my-3">
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
                <li role="none">
                    <a class="list-item" href="#" onclick="navigator.clipboard.writeText('<?php echo (get_permalink());?>');" role="menuitem">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-copy"></use>
                        </svg>
                        <span><?php _e('Copia','design-italia');?></span>
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