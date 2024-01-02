<form role="search" method="get" id="search-form" action="<?php echo esc_url( home_url( 'risultati-ricerca' ) ); ?>">
    <div class="container">
        <div class="row variable-gutters">
            <div class="col">
                <div class="modal-title">
                    <button class="search-link d-md-none" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="Chiudi e torna alla pagina precedente">
                        <svg class="icon icon-md">
                            <use href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-arrow-left"></use>
                        </svg>
                    </button>
                    <h2><?php _e('Cerca','design-italia');?></h2>
                    <button class="search-link d-none d-md-block" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="Chiudi e torna alla pagina precedente" data-focus-mouse="false">
                        <svg class="icon icon-md">
                            <use href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-close-big"></use>
                        </svg>
                    </button>
                </div>
                <div class="form-group autocomplete-wrapper">
                    <label for="autocomplete-two" class="visually-hidden"><?php _e('Cerca nel sito','design-italia');?></label>
                    <input type="search" class="autocomplete ps-5" placeholder="<?php _e('Cerca nel sito','design-italia');?>" id="autocomplete-two" name="s" data-bs-autocomplete="[]" value="<?php echo esc_attr( get_search_query() ); ?>">
                    <span class="autocomplete-icon" aria-hidden="true">
                        <svg class="icon"><use href="<?php echo get_template_directory_uri();?>/svg/sprites.svg#it-search"></use></svg>
                    </span>
                    <button type="submit" class="btn btn-primary">
                        <span class=""><?php _e('Cerca','design-italia');?></span>
                    </button>
                </div>
            </div>
        </div> 
    </div>
</form>