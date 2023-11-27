<?php
/*
 * Generic Page Template
 *
 * @package Design_Comuni_Italia
 */
global $post;
get_header();

?> 
    <main>
        <?php
        while ( have_posts() ) :
            the_post();
            // $description = dci_get_meta('descrizione','_dci_page_',$post->ID);
            ?><div class="it-hero-wrapper">
            <!-- - img-->
            <div class="img-responsive-wrapper">
              <div class="img-responsive">
                <div class="img-wrapper">
                  <img src="https://luoghidelcontemporaneo.beniculturali.it/images/slider/MUSEION_Museo_d%E2%80%99Arte_Moderna_e_Contemporanea_di_Bolzano_-_Bolzano.jpg" title="titolo immagine" alt="descrizione immagine">
                </div>
              </div>
            </div>
            <!-- - texts-->
          </div>
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
                                    <p class="text-black titillium text-paragraph">
                                        <?php echo $description; ?>
                                    </p>
                                </div>
                            </section>
                        </div>
                    </div>
                    
                </div>
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
                    <label for="intestazione">Intestazione</label>
                    <input type="text" class="form-control" id="intestazione" required="">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                    <label for="statogiuridico">Stato giudirico</label>
                    <input type="text" class="form-control" id="statogiuridico" required="">
                    </div>
                </div>
                <div class="col-12 col-md-12 mb-5">
                    <div class="select-wrapper">
                    <label for="tipologia">Tipologia</label>
                        <select id="tipologia" title="Scegli la tipologia" required="">
                            <option selected="" value="">Scegli una opzione</option>
                            <option value="Value 1">Arte negli spazi pubblici</option>
                            <option value="Value 2">Associazioni</option>
                            <option value="Value 3">Collezioni</option>
                            <option value="Value 4">Fondazioni</option>
                            <option value="Value 5">Istituti esteri</option>
                            <option value="Value 6">Musei</option>
                            <option value="Value 7">Musei aziendali e d'impresa</option>
                            <option value="Value 8">Parchi e giardini</option>
                            <option value="Value 9">Spazi espositivi</option>
                            <option value="Value 10">Spazi indipendenti</option>
                        </select>
                    </div>
                </div>

                
                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label for="citta">Città</label>
                    <input type="text" class="form-control" id="citta" required="">
                    </div>
                </div>
                
                <div class="col-12 col-md-8">
                    <div class="form-group">
                    <label for="via">Via</label>
                    <input type="text" class="form-control" id="via" required="">
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                    <label for="cap">Cap</label>
                    <input type="number" data-bs-input="" class="form-control" id="cap" min="5" max="5" step="1" required="">
                    </div>
                </div>
                <div class="col-12 col-md-5 mb-5">
                    <div class="select-wrapper">
                    <label for="provincia">Provincia</label>
                    <select id="provincia" title="Scegli una provincia" required="">
                    <option value="AG">Agrigento</option>
                        <option value="AL">Alessandria</option>
                        <option value="AN">Ancona</option>
                        <option value="AO">Aosta</option>
                        <option value="AR">Arezzo</option>
                        <option value="AP">Ascoli Piceno</option>
                        <option value="AT">Asti</option>
                        <option value="AV">Avellino</option>
                        <option value="BA">Bari</option>
                        <option value="BT">Barletta-Andria-Trani</option>
                        <option value="BL">Belluno</option>
                        <option value="BN">Benevento</option>
                        <option value="BG">Bergamo</option>
                        <option value="BI">Biella</option>
                        <option value="BO">Bologna</option>
                        <option value="BZ">Bolzano</option>
                        <option value="BS">Brescia</option>
                        <option value="BR">Brindisi</option>
                        <option value="CA">Cagliari</option>
                        <option value="CL">Caltanissetta</option>
                        <option value="CB">Campobasso</option>
                        <option value="CI">Carbonia-Iglesias</option>
                        <option value="CE">Caserta</option>
                        <option value="CT">Catania</option>
                        <option value="CZ">Catanzaro</option>
                        <option value="CH">Chieti</option>
                        <option value="CO">Como</option>
                        <option value="CS">Cosenza</option>
                        <option value="CR">Cremona</option>
                        <option value="KR">Crotone</option>
                        <option value="CN">Cuneo</option>
                        <option value="EN">Enna</option>
                        <option value="FM">Fermo</option>
                        <option value="FE">Ferrara</option>
                        <option value="FI">Firenze</option>
                        <option value="FG">Foggia</option>
                        <option value="FC">Forlì-Cesena</option>
                        <option value="FR">Frosinone</option>
                        <option value="GE">Genova</option>
                        <option value="GO">Gorizia</option>
                        <option value="GR">Grosseto</option>
                        <option value="IM">Imperia</option>
                        <option value="IS">Isernia</option>
                        <option value="SP">La Spezia</option>
                        <option value="AQ">L\'Aquila</option>
                        <option value="LT">Latina</option>
                        <option value="LE">Lecce</option>
                        <option value="LC">Lecco</option>
                        <option value="LI">Livorno</option>
                        <option value="LO">Lodi</option>
                        <option value="LU">Lucca</option>
                        <option value="MC">Macerata</option>
                        <option value="MN">Mantova</option>
                        <option value="MS">Massa-Carrara</option>
                        <option value="MT">Matera</option>
                        <option value="ME">Messina</option>
                        <option value="MI">Milano</option>
                        <option value="MO">Modena</option>
                        <option value="MB">Monza e della Brianza</option>
                        <option value="NA">Napoli</option>
                        <option value="NO">Novara</option>
                        <option value="NU">Nuoro</option>
                        <option value="OT">Olbia-Tempio</option>
                        <option value="OR">Oristano</option>
                        <option value="PD">Padova</option>
                        <option value="PA">Palermo</option>
                        <option value="PR">Parma</option>
                        <option value="PV">Pavia</option>
                        <option value="PG">Perugia</option>
                        <option value="PU">Pesaro e Urbino</option>
                        <option value="PE">Pescara</option>
                        <option value="PC">Piacenza</option>
                        <option value="PI">Pisa</option>
                        <option value="PT">Pistoia</option>
                        <option value="PN">Pordenone</option>
                        <option value="PZ">Potenza</option>
                        <option value="PO">Prato</option>
                        <option value="RG">Ragusa</option>
                        <option value="RA">Ravenna</option>
                        <option value="RC">Reggio Calabria</option>
                        <option value="RE">Reggio Emilia</option>
                        <option value="RI">Rieti</option>
                        <option value="RN">Rimini</option>
                        <option value="RM">Roma</option>
                        <option value="RO">Rovigo</option>
                        <option value="SA">Salerno</option>
                        <option value="VS">Medio Campidano</option>
                        <option value="SS">Sassari</option>
                        <option value="SV">Savona</option>
                        <option value="SI">Siena</option>
                        <option value="SR">Siracusa</option>
                        <option value="SO">Sondrio</option>
                        <option value="TA">Taranto</option>
                        <option value="TE">Teramo</option>
                        <option value="TR">Terni</option>
                        <option value="TO">Torino</option>
                        <option value="OG">Ogliastra</option>
                        <option value="TP">Trapani</option>
                        <option value="TN">Trento</option>
                        <option value="TV">Treviso</option>
                        <option value="TS">Trieste</option>
                        <option value="UD">Udine</option>
                        <option value="VA">Varese</option>
                        <option value="VE">Venezia</option>
                        <option value="VB">Verbano-Cusio-Ossola</option>
                        <option value="VC">Vercelli</option>
                        <option value="VR">Verona</option>
                        <option value="VV">Vibo Valentia</option>
                        <option value="VI">Vicenza</option>
                        <option value="VT">Viterbo</option>
                    </select>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group">
                    <label for="regione">Regione</label>
                    <input type="text" class="form-control" id="regione" required="">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label for="Telefono">Telefono</label>
                    <input type="text" class="form-control" id="Telefono" required="">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" required="">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label for="sitoweb">Sito web</label>
                    <input type="url" class="form-control" id="sitoweb" required="">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                    <label for="Orari">Orari</label>
                    <input type="email" class="form-control" id="Orari" required="">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                    <label for="costobiglietti">Costo biglietti</label>
                    <input type="url" class="form-control" id="costobiglietti" required="">
                    </div>
                </div>
                <div class="row">
                <div class="col-12">
                    <div class="form-group">
                    <label for="description">Breve descrizione del Luogo (Max 500 battute)</label>
                    <textarea id="description" rows="3"></textarea>
                    </div>
                </div>
                </div>
                <!-- <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label for="age">Campo numerico (min/max)</label>
                    <input type="number" data-bs-input="" class="form-control" id="age" min="18" max="50" step="1" required="">
                    </div>
                </div> -->
                <!-- <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label for="camponumerico">Campo numerico (5 cifre)</label>
                    <input type="number" data-bs-input="" class="form-control" id="camponumerico" maxlenght="5" required="">
                    </div>
                </div>
                </div> -->
                <!-- <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label for="email">Campo Email</label>
                    <input type="email" class="form-control" id="email" required="">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="select-wrapper">
                    <label for="defaultSelect">Select</label>
                    <select id="defaultSelect" title="Scegli una opzione" required="">
                        <option selected="" value="">Scegli una opzione</option>
                        <option value="Value 1">Opzione 1</option>
                        <option value="Value 2">Opzione 2</option>
                        <option value="Value 3">Opzione 3</option>
                        <option value="Value 4">Opzione 4</option>
                        <option value="Value 5">Opzione 5</option>
                    </select>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label class="active" for="date">Datepicker</label>
                    <input type="date" id="date" name="date" required="">
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <label class="active" for="time">Timepicker</label>
                    <input class="form-control" id="time" type="time" required="">
                    </div>
                </div>
                </div>

                <div class="row">
                <div class="col-12">
                    <div class="form-group">
                    <label for="description">Testo descrizione</label>
                    <textarea id="description" rows="3"></textarea>
                    </div>
                </div>
                </div>

                <div class="row mb-4">
                <div class="col-12">
                    <h2>Autocomplete</h2>
                </div>
                </div>

                <div class="row mb-4">
                <div class="col-12 col-md-4">
                    <div class="select-wrapper">
                    <label for="accessibleAutocomplete">Autocomplete</label>
                    <div><div class="autocomplete__wrapper"><div style="border: 0px; clip: rect(0px, 0px, 0px, 0px); height: 1px; margin-bottom: -1px; margin-right: -1px; overflow: hidden; padding: 0px; position: absolute; white-space: nowrap; width: 1px;"><div id="accessibleAutocomplete__status--A" role="status" aria-atomic="true" aria-live="polite"></div><div id="accessibleAutocomplete__status--B" role="status" aria-atomic="true" aria-live="polite"></div></div><input aria-expanded="false" aria-owns="accessibleAutocomplete__listbox" aria-autocomplete="list" aria-describedby="accessibleAutocomplete__assistiveHint" autocomplete="off" class="autocomplete__input autocomplete__input--show-all-values" id="accessibleAutocomplete" name="" placeholder="" type="text" role="combobox"><div class="autocomplete__dropdown-arrow-down-wrapper"></div><ul class="autocomplete__menu autocomplete__menu--inline autocomplete__menu--hidden" id="accessibleAutocomplete__listbox" role="listbox"></ul><span id="accessibleAutocomplete__assistiveHint" style="display: none;">When autocomplete results are available use up and down arrows to review and enter to select.  Touch device users, explore by touch or with swipe gestures.</span></div></div><select class="form-control" id="accessibleAutocomplete-select" title="Scegli una provincia" required="" style="display: none;">
                        <option selected="" value="">Scegli una opzione</option>
                        <option value="AG">Agrigento</option>
                        <option value="AL">Alessandria</option>
                        <option value="AN">Ancona</option>
                        <option value="AO">Aosta</option>
                        <option value="AR">Arezzo</option>
                        <option value="AP">Ascoli Piceno</option>
                        <option value="AT">Asti</option>
                        <option value="AV">Avellino</option>
                        <option value="BA">Bari</option>
                        <option value="BT">Barletta-Andria-Trani</option>
                        <option value="BL">Belluno</option>
                        <option value="BN">Benevento</option>
                        <option value="BG">Bergamo</option>
                        <option value="BI">Biella</option>
                        <option value="BO">Bologna</option>
                        <option value="BZ">Bolzano</option>
                        <option value="BS">Brescia</option>
                        <option value="BR">Brindisi</option>
                        <option value="CA">Cagliari</option>
                        <option value="CL">Caltanissetta</option>
                        <option value="CB">Campobasso</option>
                        <option value="CI">Carbonia-Iglesias</option>
                        <option value="CE">Caserta</option>
                        <option value="CT">Catania</option>
                        <option value="CZ">Catanzaro</option>
                        <option value="CH">Chieti</option>
                        <option value="CO">Como</option>
                        <option value="CS">Cosenza</option>
                        <option value="CR">Cremona</option>
                        <option value="KR">Crotone</option>
                        <option value="CN">Cuneo</option>
                        <option value="EN">Enna</option>
                        <option value="FM">Fermo</option>
                        <option value="FE">Ferrara</option>
                        <option value="FI">Firenze</option>
                        <option value="FG">Foggia</option>
                        <option value="FC">Forlì-Cesena</option>
                        <option value="FR">Frosinone</option>
                        <option value="GE">Genova</option>
                        <option value="GO">Gorizia</option>
                        <option value="GR">Grosseto</option>
                        <option value="IM">Imperia</option>
                        <option value="IS">Isernia</option>
                        <option value="SP">La Spezia</option>
                        <option value="AQ">L\'Aquila</option>
                        <option value="LT">Latina</option>
                        <option value="LE">Lecce</option>
                        <option value="LC">Lecco</option>
                        <option value="LI">Livorno</option>
                        <option value="LO">Lodi</option>
                        <option value="LU">Lucca</option>
                        <option value="MC">Macerata</option>
                        <option value="MN">Mantova</option>
                        <option value="MS">Massa-Carrara</option>
                        <option value="MT">Matera</option>
                        <option value="ME">Messina</option>
                        <option value="MI">Milano</option>
                        <option value="MO">Modena</option>
                        <option value="MB">Monza e della Brianza</option>
                        <option value="NA">Napoli</option>
                        <option value="NO">Novara</option>
                        <option value="NU">Nuoro</option>
                        <option value="OT">Olbia-Tempio</option>
                        <option value="OR">Oristano</option>
                        <option value="PD">Padova</option>
                        <option value="PA">Palermo</option>
                        <option value="PR">Parma</option>
                        <option value="PV">Pavia</option>
                        <option value="PG">Perugia</option>
                        <option value="PU">Pesaro e Urbino</option>
                        <option value="PE">Pescara</option>
                        <option value="PC">Piacenza</option>
                        <option value="PI">Pisa</option>
                        <option value="PT">Pistoia</option>
                        <option value="PN">Pordenone</option>
                        <option value="PZ">Potenza</option>
                        <option value="PO">Prato</option>
                        <option value="RG">Ragusa</option>
                        <option value="RA">Ravenna</option>
                        <option value="RC">Reggio Calabria</option>
                        <option value="RE">Reggio Emilia</option>
                        <option value="RI">Rieti</option>
                        <option value="RN">Rimini</option>
                        <option value="RM">Roma</option>
                        <option value="RO">Rovigo</option>
                        <option value="SA">Salerno</option>
                        <option value="VS">Medio Campidano</option>
                        <option value="SS">Sassari</option>
                        <option value="SV">Savona</option>
                        <option value="SI">Siena</option>
                        <option value="SR">Siracusa</option>
                        <option value="SO">Sondrio</option>
                        <option value="TA">Taranto</option>
                        <option value="TE">Teramo</option>
                        <option value="TR">Terni</option>
                        <option value="TO">Torino</option>
                        <option value="OG">Ogliastra</option>
                        <option value="TP">Trapani</option>
                        <option value="TN">Trento</option>
                        <option value="TV">Treviso</option>
                        <option value="TS">Trieste</option>
                        <option value="UD">Udine</option>
                        <option value="VA">Varese</option>
                        <option value="VE">Venezia</option>
                        <option value="VB">Verbano-Cusio-Ossola</option>
                        <option value="VC">Vercelli</option>
                        <option value="VR">Verona</option>
                        <option value="VV">Vibo Valentia</option>
                        <option value="VI">Vicenza</option>
                        <option value="VT">Viterbo</option>
                    </select>
                    </div>
                </div>
                </div>
                <div class="row mb-4">
                <div class="col-12">
                    <h2>Checkbox / Radio</h2>
                </div>
                </div>

                <div class="row">
                <div class="col-12 col-md-4">
                    <div class="row">
                    <div class="form-check mb-5">
                        <input id="checkbox1" type="checkbox" required="">
                        <label for="checkbox1">Checkbox isolata</label>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="toggles">
                    <label for="toggleEsempio1a">
                        Toggle isolato
                        <input type="checkbox" id="toggleEsempio1a" required="">
                        <span class="lever"></span>
                    </label>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <fieldset id="radiogroup">
                        <legend>Fieldset radio buttons</legend>
                        <div class="form-check form-check-inline">
                        <input name="gruppo2" type="radio" id="radio1" required="">
                        <label for="radio1">Radio 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input name="gruppo2" type="radio" id="radio2" required="">
                        <label for="radio2">Radio 2</label>
                        </div>
                    </fieldset>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                    <fieldset id="checkgroup">
                        <legend>Fieldset checkbox</legend>
                        <div class="form-check form-check-inline">
                        <input id="checkbox2" type="checkbox" required="">
                        <label for="checkbox2">Checkbox 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input id="checkbox3" type="checkbox" required="">
                        <label for="checkbox3">Checkbox 2</label>
                        </div>
                    </fieldset>
                    </div>
                </div>
                </div> -->

                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Carica 3 immagini</h2>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-12 col-md-4">
                        <div class="form-upload">
                            <label for="upload">Immagine 1</label>
                            <input type="file" name="upload" id="upload" multiple="multiple" required="">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-upload">
                        <label for="upload">Immagine 2</label>
                        <input type="file" name="upload" id="upload" multiple="multiple" required="">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-upload">
                        <label for="upload">Immagine 3</label>
                        <input type="file" name="upload" id="upload" multiple="multiple" required="">
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
                    <button class="btn btn-primary mt-3" type="submit">Invia form</button>
                </div>
                </div>
            </div>

            </div>
            <?php //get_template_part("template-parts/common/valuta-servizio"); ?>
            
        <?php
        endwhile; // End of the loop.
        ?>
    </main>
<?php
get_footer();



