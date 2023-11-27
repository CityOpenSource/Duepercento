<?php
 
add_shortcode( 'wpshout_frontend_post', 'wpshout_frontend_post' ); 

function wpshout_frontend_post() {
    
    if ( ! is_admin() ) {
        include ABSPATH . 'wp-admin/includes/template.php';
    }
    if (!function_exists('wp_generate_attachment_metadata')){
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    }
    if(wpshout_save_post_if_submitted()):
        echo 'Saved your post successfully! :)';
    else :

    $regioni = json_decode(file_get_contents(__DIR__.'/../js/localita.json'));
    $reg = array();
    foreach($regioni as $k=>$regione) {
        $reg["$k"] = $regione->nome;
    }
    asort($reg); 
    ?>
<div id="postbox">
    <form id="new_post" name="new_post" method="post" enctype="multipart/form-data">

        <div class="container mb-5 mt-5 pt-5">
            <div class="row">
            <!-- <div class="col-12">
                <h1>Form con validazione</h1>
                <hr>
            </div> -->
            </div>
            <div class="row mt-5 mb-4">
                <!-- <div class="col-12">
                    <h2>Campi input</h2>
                </div> -->
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="intestazione">Intestazione <span class="required">*</span></label>
                        <input type="text" class="form-control" id="intestazione" name="intestazione" required="" tabindex="1">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                    <label for="statogiuridico">Stato giudirico</label>
                    <input type="text" class="form-control" id="statogiuridico" name="statogiuridico" required="" tabindex="2">
                    </div>
                </div>
                <div class="col-12 col-md-12 mb-5">
                    <div class="select-wrapper">
                    <label for="tipologia">Tipologia <span class="required">*</span></label>
                        <?php wp_dropdown_categories( 'show_option_none=Scegli la tipologia&tab_index=3&taxonomy=tipologia&orderby=name&required=true&name=tipologia' ); ?>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12 col-md-4 mb-5">
                    <div class="select-wrapper">
                        <label for="regione_id">Regione <span class="required">*</span></label>
                        <select id="regione_id" name="regione_id" title="Scegli la regione" tabindex="4">
                            <option value="">Scegli una opzione</option>
                            <?php foreach($reg as $k=>$regione):?>
                            <option value="<?php echo $k;?>"><?php echo $regione;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                
                <div class="col-12 col-md-4 mb-5">
                    <div class="select-wrapper">
                        <label for="provincia_id">Provincia <span class="required">*</span></label>
                        <select id="provincia_id" name="provincia_id" title="Scegli la provincia" disabled tabindex="5">
                            <option selected="" value="">Scegli una opzione</option>
                            
                        </select>
                    </div>
                </div>
                
                <div class="col-12 col-md-4 mb-5">
                    <div class="select-wrapper">
                        <label for="comune_id">Comune <span class="required">*</span></label>
                        <select id="comune_id" name="comune_id" title="Scegli il comune" disabled tabindex="6">
                            <option selected="" value="">Scegli una opzione</option>
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="row"> 
                
                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label for="cap">Cap <span class="required">*</span></label>
                    <input type="number" data-bs-input="" class="form-control" id="cap" name="cap" min="0" max="99999" length="5" required="" tabindex="7">
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="form-group">
                    <label for="via">Via <span class="required">*</span></label>
                    <input type="text" class="form-control" id="indirizzo" name="indirizzo" required="" tabindex="8">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label for="telefono">Telefono <span class="required">*</span></label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required="" tabindex="9">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label for="email">E-mail <span class="required">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" required="" tabindex="10">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label for="sitoweb">Sito web <span class="required">*</span></label>
                    <input type="url" class="form-control" id="sitoweb" name="sitoweb" required="" tabindex="11">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                    <label for="orari">Orari <span class="required">*</span></label>
                    <input type="text" class="form-control" id="orari" name="orari" tabindex="12">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                    <label for="costobiglietti">Costo biglietti</label>
                    <input type="text" class="form-control" id="costobiglietti" name="costobiglietti" tabindex="13">
                    </div>
                </div>
                <div class="col-12 col-md-12 mb-5">
                    <div class="select-wrapper">
                        <label for="servizi">Servizi aggiuntivi <span class="required">*</span></label>
                        <?php $servizi = get_categories('taxonomy=servizio&type=operaduepercento'); ?>
                        <select id="servizio_id" name="servizio_id[]" data-placeholder="Scegli i servizi" class="chosen-select" multiple title="Scegli i servizi" tabindex="14">
                            <!-- <option selected="" value="">Scegli una opzione</option> -->
                            <?php foreach($servizi as $servizio):?>
                                <option value="<?php echo $servizio->term_id;?>"><?php echo $servizio->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                    <label for="description">Breve descrizione del Luogo (Max 500 battute) <span class="required">*</span></label>
                    <textarea id="description" name="description" rows="3" tabindex="15"></textarea>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <h2>Carica 3 immagini</h2>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-12 col-md-4">
                    <div class="form-upload">
                        <label for="upload">Immagine 1 <span class="required">*</span></label>
                        <input type="file" name="upload1" id="upload1" multiple="multiple" required="" tabindex="16" accept="image/*">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                        <div class="form-upload">
                        <label for="upload">Immagine 2 <span class="required">*</span></label>
                        <input type="file" name="upload2" id="upload2" multiple="multiple" required="" tabindex="17" accept="image/*">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-upload">
                        <label for="upload">Immagine 3 <span class="required">*</span></label>
                        <input type="file" name="upload3" id="upload3" multiple="multiple" required="" tabindex="18" accept="image/*">
                    </div>
                </div>
                <!-- <div class="col-12 col-md-6">
                    <div class="form-upload">
                    <input type="file" name="upload1" id="upload1" class="upload" multiple="multiple" required="">
                    <label for="upload1">
                        <svg class="icon icon-sm" aria-hidden="true"><use href="/dist/svg/sprites.svg#it-upload"></use></svg>
                        <span>Upload custom (solo jpg/png)</span>
                    </label>
                    </div>
                </div> -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-check">
                        <input id="checkbox1" type="checkbox" name="pubblicazione_dati" required tabindex="19">
                        <label for="checkbox1">Acconsento alla pubblicazione di queste informazioni nel database dei luoghi del contemporaneo sul sito della DGCC <span class="required">*</span></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-check">
                        <input id="checkbox2" type="checkbox" name="trattamento_dati" required tabindex="20">
                        <label for="checkbox2">Acconsento al trattamento dei dati - <a href="https://cultura.gov.it/privacy-policy" target="_blank">Privacy Policy</a> <span class="required">*</span></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php wp_nonce_field( 'wps-frontend-post' ); ?>
                    <button class="btn btn-primary mt-3" type="submit" tabindex="21">Invia form</button>
                </div>
            </div>
        </div>
    
    </form>
</div>
    <?php
    endif;
}



function wpshout_save_post_if_submitted() {



    // Stop running function if form wasn't submitted 
    if ( !isset($_POST['intestazione']) ) {
        return false;
    }

    // Check that the nonce was set and valid
    if( !wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-post') ) {
        echo 'Did not save because your form seemed to be invalid. Sorry';
        return false;
    }

    // Do some minor form validation to make sure there is content
    if (strlen($_POST['intestazione']) < 3) {
        echo 'Please enter a title. Titles must be at least three characters long.';
        return false;
    }

    if (strlen($_POST['description']) > 500) {
        echo 'Please enter description less than 500 characters in length';
        return false;
    }

    // Add the content of the form to $post as an array
    $post = array(
        'post_title'    => $_POST['intestazione'],
        'post_content'  => $_POST['description'], 
        'post_status'   => 'draft',   // Could be: publish
        'post_type' 	=> 'operaduepercento'
    );

    $new_post = wp_insert_post($post);

    $tipologia = array_map('convertToIntArray', array($_POST['tipologia']));
    $servizi = array_map('convertToIntArray', $_POST['servizio_id']);
    wp_set_post_terms( $new_post, $tipologia, 'tipologia' );
    wp_set_post_terms( $new_post, $servizi, 'servizio' );
    add_post_meta($new_post, 'luogo_indirizzo', $_POST['indirizzo']); 
    add_post_meta($new_post, 'luogo_cap', $_POST['cap']); 
    add_post_meta($new_post, 'luogo_localita_id', $_POST['comune_id']); 
    add_post_meta($new_post, 'luogo_email', $_POST['email']);  
    add_post_meta($new_post, 'luogo_telefono', $_POST['telefono']); 
    add_post_meta($new_post, 'luogo_web', $_POST['sitoweb']); 
    add_post_meta($new_post, 'luogo_note', (strlen($_POST['orari'])>0 ? $_POST['orari']."\n" : '').$_POST['costobiglietti']); 


    $regioni = json_decode(file_get_contents(__DIR__.'/../js/localita.json'));
    $loc = '';
    foreach($regioni as $k1=>$reg) {
        foreach($reg->items as $k2=>$pro) {
            foreach($pro->items as $k3=>$com) {
                if($k3 == $_POST['comune_id']) {
                    $loc = "$com ({$pro->nome}) - {$reg->nome}";
                    break(3);
                };
            }
        }
    }

    try {
        $url = 'https://nominatim.openstreetmap.org/search?format=json&limit=1&addressdetails=1&q='.urlencode($_POST['indirizzo'].' '.$loc);
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, $url);
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curlSession, CURLOPT_USERAGENT, "luoghidelcontemporaneo");
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    
        $content = curl_exec($curlSession);
        $jsonData = json_decode($content, true);
        curl_close($curlSession);
    
        if(count($jsonData)>0) {
            add_post_meta($new_post, 'luogo_lat', $jsonData[0]['lat']); 
            add_post_meta($new_post, 'luogo_lon', $jsonData[0]['lon']); 
        }
    } catch (Exception $e) {

    }


    if ($_FILES) {
        $gallery_data = array();
        $old = 0;
        foreach ($_FILES as $file => $array) {
            if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                return "upload error : " . $_FILES[$file]['error'];
            }
            $attach_id = media_handle_upload( $file, $new_post );  
            add_post_meta($new_post, 'meta_key_to_attach_image_to', $attach_id, false);
            $gallery_data['image_id'][]  = $attach_id;
            $gallery_data['image_url'][]  = wp_get_attachment_image_url($attach_id);
            $gallery_data['image_alt'][]  = '';
            $gallery_data['image_title'][]  = '';
            $gallery_data['image_caption'][]  = '';
            // continue;

            if (($old == 0) && ($attach_id > 0)){
                //and if you want to set that image as Post  then use:
                update_post_meta($new_post,'_thumbnail_id',$attach_id);
                $old = $attach_id;
            }

        } 
        update_post_meta($new_post, 'gallery_data', $gallery_data);
    }

    return true;
}

function convertToIntArray($v) {
    return intval($v);
}