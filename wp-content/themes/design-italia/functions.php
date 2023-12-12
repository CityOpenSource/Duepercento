<?php


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



include __DIR__.'/inc/api.php';
include __DIR__.'/inc/cpt-and-taxonomies.php';
include __DIR__.'/inc/form.php';
include __DIR__.'/inc/gallery.php';
include __DIR__.'/inc/menus-and-walkers.php';
include __DIR__.'/inc/styles-and-scripts.php';
include __DIR__.'/inc/theme-options.php';
include __DIR__.'/inc/treemap.php';


function theme_init(){
    load_theme_textdomain('design-italia', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');


function twentytwelve_setup() {
    add_theme_support('post-thumbnails');
}
add_action( 'after_setup_theme', 'twentytwelve_setup' );


function custom_type_archive_display($query) {
    if (is_post_type_archive('operaduepercento') && $query->is_main_query()) {
         $query->set('posts_per_page', 12);
         $query->set('orderby', 'date' );
         $query->set('order', 'DESC' );
    }     
}
add_action('pre_get_posts', 'custom_type_archive_display');

function justread_filter_archive( $query ) {
    if ( is_admin() ) {
            return;
    }
    if ( is_post_type_archive('operaduepercento') && is_archive() && $query->is_main_query() ) {
        $regioni = json_decode(file_get_contents(__DIR__.'/js/localita.json'));
        // get meta query
        $meta_query = $query->get('meta_query');
        if(!is_array($meta_query)) $meta_query = ['relation' => 'AND'];

        // loop over filters
        foreach( [
        'cap', 
        'lat',
        'lon',  
        'autore', 
        'tipologia',
        'luogo_opere', ] as $name ) {

            // continue if not found in url
            if( empty($_GET[ $name ]) ) {
                continue;
            }
            $value = sanitize_text_field($_GET[ $name ]);

            // append meta query
            $meta_query[] = array(
                'key'       => $name,
                'value'     => $value,
                'compare'   => 'LIKE',
            );

        } 
        if( !empty($_GET[ 'luogo_da' ]) ) {
            $value = sanitize_text_field($_GET[ 'luogo_da' ]);
            $meta_query[] = array(
                'key'       => 'anno',
                'value'     => $value,
                'compare'   => '>=',
            );
        }
        if( !empty($_GET[ 'luogo_a' ]) ) {
            $value = sanitize_text_field($_GET[ 'luogo_a' ]);
            $meta_query[] = array(
                'key'       => 'anno',
                'value'     => $value,
                'compare'   => '<=',
            );
        }
        if( !empty($_GET[ 'comune_id' ]) ) {
            $value = $regioni->{$_GET['regione_id']}->items->{$_GET['provincia_id']}->items->{$_GET['comune_id']};
            $meta_query[] = array(
                'key'       => 'luogo',
                'value'     => $value,
                'compare'   => '=',
            );
        }

        if( empty($_GET[ 'comune_id' ])  && empty($_GET[ 'provincia_id' ]) && !empty($_GET[ 'regione_id' ]) ) {
            $value = sanitize_text_field($regioni->{$_GET[ 'regione_id' ]}->nome);

            $meta_query[] = array(
                'key'       => 'regione',
                'value'     => $value,
                'compare'   => 'IN',
            );
        } 

        // update meta query
        $query->set('meta_query', $meta_query);


        if( !empty($_GET[ 'luogo_nome' ]) ) {
            $post__in = $query->get('post_in');
            $value = sanitize_text_field($_GET[ 'luogo_nome' ]);
            $mypostids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%".$value."%' AND post_type='operaduepercento'"); 

            if(is_array($post__in)) {
                $mynew = array_intersect((count($mypostids) ? $mypostids : [-1]),$post__in);
                $query->set('post__in', $mynew);
            } else {
                $query->set('post__in', count($mypostids) ? $mypostids : [-1]);
            }
        }

        switch($_GET['orderby']) {
            case 'localita': 
                $query->set('meta_key','luogo');
                $query->set('orderby','luogo');
            break;
            case 'autore': 
                $query->set('meta_key','autore');
                $query->set('orderby','autore');
            break;
            case 'data':  
                $query->set('meta_key','anno');
                $query->set('orderby','anno');
            break;
            case 'opera_pubblica':  
                $query->set('meta_key','opera_pubblica');
                $query->set('orderby','opera_pubblica');
            break;
            case 'tipologia':  
                $query->set('meta_key','tipologia');
                $query->set('orderby','tipologia');
            break;
            default:
                $query->set('orderby','title');
            break;
        }

        switch($_GET['orderdir']) {
            case 'desc':
                $query->set('order','desc');
                break;
            default:
                $query->set('order','asc');
            break;
        } 
    } 
}
add_action( 'pre_get_posts', 'justread_filter_archive');




//INSERT INTO `luoghicontemporaneo_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) SELECT luogo_id + 1000, '1', luogo_data_inserimento, '0000-00-00 00:00:00', luogo_descrizione_ita, luogo_nome, '', 'publish', 'closed', 'closed', '', '', '', '', luogo_data_inserimento, '0000-00-00 00:00:00', '', '0', CONCAT('https://luoghidelcontemporaneo.mappi-na.it/?post_type=operaduepercento&#038;p=', luogo_id + 1000), '0', 'operaduepercento', '', '0' FROM `luoghicontemporaneo_luoghi`  

/* UPDATE `luoghicontemporaneo_posts` SET post_name = lower(post_title),
post_name = replace(post_name, '.', ' '),
post_name = replace(post_name, '\'', '-'),
post_name = replace(post_name,'š','s'),
post_name = replace(post_name,'Ð','Dj'),
post_name = replace(post_name,'ž','z'),
post_name = replace(post_name,'Þ','B'),
post_name = replace(post_name,'ß','Ss'),
post_name = replace(post_name,'à','a'),
post_name = replace(post_name,'á','a'),
post_name = replace(post_name,'â','a'),
post_name = replace(post_name,'ã','a'),
post_name = replace(post_name,'ä','a'),
post_name = replace(post_name,'å','a'),
post_name = replace(post_name,'æ','a'),
post_name = replace(post_name,'ç','c'),
post_name = replace(post_name,'è','e'),
post_name = replace(post_name,'é','e'),
post_name = replace(post_name,'ê','e'),
post_name = replace(post_name,'ë','e'),
post_name = replace(post_name,'ì','i'),
post_name = replace(post_name,'í','i'),
post_name = replace(post_name,'î','i'),
post_name = replace(post_name,'ï','i'),
post_name = replace(post_name,'ð','o'),
post_name = replace(post_name,'ñ','n'),
post_name = replace(post_name,'ò','o'),
post_name = replace(post_name,'ó','o'),
post_name = replace(post_name,'ô','o'),
post_name = replace(post_name,'õ','o'),
post_name = replace(post_name,'ö','o'),
post_name = replace(post_name,'ø','o'),
post_name = replace(post_name,'ù','u'),
post_name = replace(post_name,'ú','u'),
post_name = replace(post_name,'û','u'),
post_name = replace(post_name,'ý','y'),
post_name = replace(post_name,'ý','y'),
post_name = replace(post_name,'þ','b'),
post_name = replace(post_name,'ÿ','y'),
post_name = replace(post_name,'ƒ','f'),
post_name = replace(post_name, 'œ', 'oe'),
post_name = replace(post_name, '€', 'euro'),
post_name = replace(post_name, '$', 'dollars'),
post_name = replace(post_name, '£', ''),
post_name = trim(post_name),
post_name = replace(post_name, ' ', '-'),
post_name = replace(post_name, '--', '-'),
post_name = replace(post_name, '--', '-'),
post_name = replace(post_name, '--', '-'),
post_name = replace(post_name, '--', '-') WHERE ID > 1000;



UPDATE `luoghicontemporaneo_luoghi` SET luogo_url = lower(luogo_nome),
luogo_url = replace(luogo_url, '.', ' '),
luogo_url = replace(luogo_url, '\'', '-'),
luogo_url = replace(luogo_url,'š','s'),
luogo_url = replace(luogo_url,'Ð','Dj'),
luogo_url = replace(luogo_url,'ž','z'),
luogo_url = replace(luogo_url,'Þ','B'),
luogo_url = replace(luogo_url,'ß','Ss'),
luogo_url = replace(luogo_url,'à','a'),
luogo_url = replace(luogo_url,'á','a'),
luogo_url = replace(luogo_url,'â','a'),
luogo_url = replace(luogo_url,'ã','a'),
luogo_url = replace(luogo_url,'ä','a'),
luogo_url = replace(luogo_url,'å','a'),
luogo_url = replace(luogo_url,'æ','a'),
luogo_url = replace(luogo_url,'ç','c'),
luogo_url = replace(luogo_url,'è','e'),
luogo_url = replace(luogo_url,'é','e'),
luogo_url = replace(luogo_url,'ê','e'),
luogo_url = replace(luogo_url,'ë','e'),
luogo_url = replace(luogo_url,'ì','i'),
luogo_url = replace(luogo_url,'í','i'),
luogo_url = replace(luogo_url,'î','i'),
luogo_url = replace(luogo_url,'ï','i'),
luogo_url = replace(luogo_url,'ð','o'),
luogo_url = replace(luogo_url,'ñ','n'),
luogo_url = replace(luogo_url,'ò','o'),
luogo_url = replace(luogo_url,'ó','o'),
luogo_url = replace(luogo_url,'ô','o'),
luogo_url = replace(luogo_url,'õ','o'),
luogo_url = replace(luogo_url,'ö','o'),
luogo_url = replace(luogo_url,'ø','o'),
luogo_url = replace(luogo_url,'ù','u'),
luogo_url = replace(luogo_url,'ú','u'),
luogo_url = replace(luogo_url,'û','u'),
luogo_url = replace(luogo_url,'ý','y'),
luogo_url = replace(luogo_url,'ý','y'),
luogo_url = replace(luogo_url,'þ','b'),
luogo_url = replace(luogo_url,'ÿ','y'),
luogo_url = replace(luogo_url,'ƒ','f'),
luogo_url = replace(luogo_url, 'œ', 'oe'),
luogo_url = replace(luogo_url, '€', 'euro'),
luogo_url = replace(luogo_url, '$', 'dollars'),
luogo_url = replace(luogo_url, '£', ''),
luogo_url = trim(luogo_url),
luogo_url = replace(luogo_url, ' ', '-'),
luogo_url = replace(luogo_url, '--', '-'),
luogo_url = replace(luogo_url, '--', '-'),
luogo_url = replace(luogo_url, '--', '-'),
luogo_url = replace(luogo_url, '--', '-') WHERE ID > 1000; */



// $query = "SELECT * FROM {$wpdb->prefix}posts WHERE post_type='attachment' AND ID < 15000 ORDER BY post_parent, ID";

// $obj = $wpdb->get_results( $query, OBJECT );

// $el = [];
// foreach($obj as $k=>$item) {
//     $el[$item->post_parent]['image_url'][] = $item->guid;
//     $el[$item->post_parent]['image_title'][] = '';
//     $el[$item->post_parent]['image_alt'][] = '';
//     $el[$item->post_parent]['image_caption'][] = '';
// }
// foreach($el as $k=>$item) {
//     $query = "INSERT INTO {$wpdb->prefix}postmeta(meta_id, post_id, meta_key, meta_value) VALUES (18000 + $k, $k, 'gallery_data', '".serialize($item)."');";
//     echo $query;
//     $wpdb->get_results( $query, OBJECT );
// }
// // echo serialize($el);