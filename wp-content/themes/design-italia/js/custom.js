jQuery(document).ready(function() {
    var localita = {}
    fetch('/wp-content/themes/design-italia/js/localita.json').then(res=>res.json()).then(res=>localita = res);
    $('#regione_id').change(function() {
        var regione_id = this.value;
        $('#provincia_id').prop("disabled", this.value==='');
        if(regione_id!=='') {
            $('#provincia_id')
                .find('option')
                .remove()
                .end()
            $('<option/>').val('').text('Scegli').appendTo('#provincia_id')
            Object.keys(localita[regione_id].items).forEach(key=>$('<option/>').val(key).text(localita[regione_id].items[key].nome).appendTo('#provincia_id'))
        }
    })
    $('#provincia_id').change(function() {
        $('#comune_id').prop("disabled", this.value==='');
        var provincia_id = this.value;
        var regione_id = $('#regione_id').val(); 
        console.log(localita[regione_id].items[provincia_id].items);
        if(provincia_id!=='') {
            $('#comune_id')
                .find('option')
                .remove()
                .end()
            $('<option/>').val('').text('Scegli').appendTo('#comune_id')
            Object.keys(localita[regione_id].items[provincia_id].items).forEach(key=>$('<option/>').val(key).text(localita[regione_id].items[provincia_id].items[key]).appendTo('#comune_id'))
        }
    })

    $('#regione_id2').change(function() {
        var regione_id = this.value;
        $('#provincia_id2').prop("disabled", this.value==='');
        if(regione_id!=='') {
            $('#provincia_id2')
                .find('option')
                .remove()
                .end()
            $('<option/>').val('').text('Scegli').appendTo('#provincia_id2')
            Object.keys(localita[regione_id].items).forEach(key=>$('<option/>').val(key).text(localita[regione_id].items[key].nome).appendTo('#provincia_id2'))
        }
    })
    $('#provincia_id2').change(function() {
        $('#comune_id2').prop("disabled", this.value==='');
        var provincia_id = this.value;
        var regione_id = $('#regione_id2').val(); 
        console.log(localita[regione_id].items[provincia_id].items);
        if(provincia_id!=='') {
            $('#comune_id2')
                .find('option')
                .remove()
                .end()
            $('<option/>').val('').text('Scegli').appendTo('#comune_id2')
            Object.keys(localita[regione_id].items[provincia_id].items).forEach(key=>$('<option/>').val(key).text(localita[regione_id].items[provincia_id].items[key]).appendTo('#comune_id2'))
        }
    })

    jQuery(".chosen-select").chosen({
        search_contains: true,
        no_results_text: "Nothing found for: ",
        width: "100%",
    });

    jQuery('#luogo-search button[type=reset]').click(function() { 
        $('#nome').val('').attr('value','');
        $('#nome').siblings().removeClass('active');
        
        $('#autore').val('').attr('value','');
        $('#autore').siblings().removeClass('active');

        // $('#tipologia_id option').attr('selected',false); 
        $('#regione_id option').attr('selected',false); 
        $('#provincia_id option').attr('selected',false); 
        $('#comune_id option').attr('selected',false); 

        $('#luogo_da').val('');
        $('#luogo_da').siblings().removeClass('active');

        $('#luogo_a').val('');
        $('#luogo_a').siblings().removeClass('active');

        $('#servizio_id').val(null); 
        $('#servizio_id option').attr('selected',false); 
        $('#servizio_id').siblings().find('.search-choice').remove(); 
        $('#servizio_id').siblings().find('.chosen-drop .li').removeClass('result-selected').addClass('active-result'); 


        $('#nome2').val('').attr('value','');
        $('#nome2').siblings().removeClass('active');
        
        $('#autore2').val('').attr('value','');
        $('#autore2').siblings().removeClass('active');

        // $('#tipologia_id2 option').attr('selected',false); 
        $('#regione_id2 option').attr('selected',false); 
        $('#provincia_id2 option').attr('selected',false); 
        $('#comune_id2 option').attr('selected',false); 

        $('#luogo_da2').val('');
        $('#luogo_da2').siblings().removeClass('active');

        $('#luogo_a2').val('');
        $('#luogo_a2').siblings().removeClass('active');

        $('#servizio_id2').val(null); 
        $('#servizio_id2 option').attr('selected',false); 
        $('#servizio_id2').siblings().find('.search-choice').remove(); 
        $('#servizio_id2').siblings().find('.chosen-drop .li').removeClass('result-selected').addClass('active-result'); 
    });
    

    $("#full").click(function() {
        var el = document.getElementById("fullscreen")
        if (el.requestFullScreen) {
            el.requestFullScreen();
        } else if (el.mozRequestFullScreen) {
            el.mozRequestFullScreen();
        } else if (el.webkitRequestFullScreen) {
            el.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    });
    $('a[data-modal]').click(function(event) {
        $(this).modal();console.log('pippo')
        return false;
      });

    // $( "#dialog-modal" ).dialog({
    //     height: 150,
    //     appendTo: "#fullscreen",
    //     modal: true
    // });

});