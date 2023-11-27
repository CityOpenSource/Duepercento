<?php



function my_awesome_func( $data ) {
    global $wpdb;
    $query = "SELECT * 
    FROM {$wpdb->prefix}luoghi AS l ";

    $posts = $wpdb->get_results( $query, OBJECT );

    foreach($posts as $post) {
        $obj = get_object_vars($post);
        foreach($obj as $k=>$item) {
            if(strpos($k,'luogo_id')!==false) continue;
            if(strpos($k,'luogo_nome')!==false) continue;
            if(strpos($k,'descrizione')!==false) continue;
            if(strpos($k,'eng')!==false) continue;
            $myk = str_replace('_ita', '', $k);
            $query = "INSERT INTO luoghicontemporaneo_postmeta (post_id, meta_key, meta_value) VALUES (" . ($post->luogo_id+1000) . ", '{$myk}','" . (str_replace("'", "\'" , $obj[$k] )) . "');\n";
            // $wpdb->get_results($query);
            echo $query;
        };
        // die();
    }
 
  
    if ( empty( $posts ) ) {
      return new WP_Error( 'no_author', 'Invalid author', array( 'status' => 404 ) );
    }
  
    return $posts;
  }
 
// add_action( 'rest_api_init', function () {
//   register_rest_route( 'luoghi/v1', '/page/(?P<id>\d+)', array(
//     'methods' => 'GET',
//     'callback' => 'my_awesome_func',
//     'args' => array(
//       'id' => array(
//         'validate_callback' => function($param, $request, $key) {
//           return is_numeric( $param );
//         }
//       ),
//     ),
//   ) );
// } );




