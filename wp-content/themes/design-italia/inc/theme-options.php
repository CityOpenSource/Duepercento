<?php

add_action( 'customize_register' , 'my_theme_options' );

function my_theme_options( $wp_customize ) {
	$wp_customize->add_section( 
        'mytheme_footer_options', 
        array(
            'title'       => __( 'Footer', 'mytheme' ),
            'priority'    => 100,
            'capability'  => 'edit_theme_options',
            'description' => __('Cambia le impostazioni del footer qui.', 'mytheme'), 
        ) 
    );
    $wp_customize->add_section( 
        'mytheme_maps_options', 
        array(
            'title'       => __( 'Map Tiles', 'mytheme' ),
            'priority'    => 100,
            'capability'  => 'edit_theme_options',
            'description' => __('Inserisci i token qui', 'mytheme'), 
        ) 
    );
    $wp_customize->add_setting( 'titolo1', array());
    $wp_customize->add_setting( 'titolo2', array());
    $wp_customize->add_setting( 'indirizzo', array());
    $wp_customize->add_setting( 'telefono', array());
    $wp_customize->add_setting( 'codicefiscalepiva', array());
    $wp_customize->add_setting( 'peo', array());
    $wp_customize->add_setting( 'pec', array());
    $wp_customize->add_setting( 'web', array());
    $wp_customize->add_setting( 'progetto', array());
    $wp_customize->add_setting( 'twitter', array());
    $wp_customize->add_setting( 'instagram', array());
    $wp_customize->add_setting( 'facebook', array());
    $wp_customize->add_setting( 'youtube', array());
    $wp_customize->add_setting( 'telegram', array());
    $wp_customize->add_setting( 'whatsapp', array());
    $wp_customize->add_setting( 'stadiamaps', array());

    // $wp_customize->add_control( new WP_Customize_Color_Control( 
    //     $wp_customize, 
    //     'footer_bg_color_control',
    //     array(
    //         'label'    => __( 'Footer Background Color', 'mytheme' ), 
    //         'section'  => 'mytheme_footer_options',
    //         'settings' => 'footer_bg_color',
    //         'priority' => 10,
    //     ) 
    // ));
    $wp_customize->add_control('titolo1', 
        array(
            'type'=>'text', 
            'section' => 'mytheme_footer_options',
            'label' => 'Titolo 1', 
            'priority' => 10
        )
    );
    $wp_customize->add_control('titolo2', 
        array(
            'type'=>'text', 
            'section' => 'mytheme_footer_options',
            'label' => 'Titolo 2',
            'priority' => 10
        )
    );
    $wp_customize->add_control('indirizzo', 
        array(
            'type'=>'text', 
            'section' => 'mytheme_footer_options',
            'label' => 'indirizzo',
            'priority' => 10
        )
    );
    $wp_customize->add_control('telefono', 
        array(
            'type'=>'text', 
            'section' => 'mytheme_footer_options',
            'label' => 'telefono',
            'priority' => 10
        )
    );
    $wp_customize->add_control('codicefiscalepiva', 
        array(
            'type'=>'text', 
            'section' => 'mytheme_footer_options',
            'label' => 'Codice Fiscale / Partita IVA',
            'priority' => 10
        )
    );
    $wp_customize->add_control('peo', 
        array(
            'type'=>'email', 
            'section' => 'mytheme_footer_options',
            'label' => 'Posta Elettronica Ordinaria',
            'priority' => 10
        )
    );
    $wp_customize->add_control('pec', 
        array(
            'type'=>'email', 
            'section' => 'mytheme_footer_options',
            'label' => 'Posta Elettronica Certificata',
            'priority' => 10
        )
    );
    $wp_customize->add_control('web', 
        array(
            'type'=>'url', 
            'section' => 'mytheme_footer_options',
            'label' => 'Indirizzo WWW',
            'priority' => 10
        )
    );
    $wp_customize->add_control('progetto', 
        array(
            'type'=>'email', 
            'section' => 'mytheme_footer_options',
            'label' => 'Scrivi al progetto',
            'priority' => 10
        )
    );
    $wp_customize->add_control('twitter', 
        array(
            'type'=>'url', 
            'section' => 'mytheme_footer_options',
            'label' => 'Account Twitter',
            'priority' => 10
        )
    );
    $wp_customize->add_control('facebook', 
        array(
            'type'=>'url', 
            'section' => 'mytheme_footer_options',
            'label' => 'Account Facebook',
            'priority' => 10
        )
    );
    $wp_customize->add_control('youtube', 
        array(
            'type'=>'url', 
            'section' => 'mytheme_footer_options',
            'label' => 'Canale YouTube',
            'priority' => 10
        )
    );
    $wp_customize->add_control('telegram', 
        array(
            'type'=>'url', 
            'section' => 'mytheme_footer_options',
            'label' => 'Canale Telegram',
            'priority' => 10
        )
    );
    $wp_customize->add_control('instagram', 
        array(
            'type'=>'url', 
            'section' => 'mytheme_footer_options',
            'label' => 'Canale Instagram',
            'priority' => 10
        )
    );

    $wp_customize->add_control('whatsapp', 
        array(
            'type'=>'url', 
            'section' => 'mytheme_footer_options',
            'label' => 'Canale WhatsApp',
            'priority' => 10
        )
    );

    $wp_customize->add_control('stadiamaps', 
        array(
            'type'=>'text', 
            'section' => 'mytheme_maps_options',
            'label' => 'Stadia Maps',
            'priority' => 10
        )
    );

}