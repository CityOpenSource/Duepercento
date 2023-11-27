<?php
/**
 * Nav Menu API: Main_Menu_Walker class
 *
 * @package WordPress
 * @subpackage Nav_Menus
 * @since 4.6.0
 */

/**
 * Custom class used to implement an HTML list of nav menu items.
 *
 * @since 3.0.0
 *
 * @see Walker
 */


class Main_Menu_Walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
		$output .= "<li class='nav-item'>"; 
		$active_class = '';  
		if ($item->current || ((home_url('/')!==$item->url) && (strpos(get_permalink(), $item->url)===0))) {
			$active_class = 'active';
		}
 
		$data_element = ''; 
 
		if ($item->url && $item->url != '#') {
			$output .= '<a class="nav-link '.$active_class.'" href="' . $item->url . '" data-element="'.$data_element.'"><span>';
		} else {
			$output .= '<span>';
		}
 
		$output .= $item->title;
 
		if ($item->url && $item->url != '#') {
			$output .= '</span></a>';
		} else {
			$output .= '</span>';
		}
	}
}


class Bottom_Menu_Walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
		$output .= ''; 
		$active_class = '';  
		if ($item->current || ((home_url('/')!==$item->url) && (strpos(get_permalink(), $item->url)===0))) {
			$active_class = 'active';
		}
 
		$data_element = ''; 
 
		if ($item->url/*  && $item->url != '#' */) {
			$output .= '<a class="'.$active_class.'" href="' . $item->url . '" data-element="'.$data_element.'">';
		} else {
			$output .= '<span>';
		}
 
		$output .= $item->title;
 
		if ($item->url/*  && $item->url != '#' */) {
			$output .= '</a>';
		} else {
			$output .= '</span>';
		}
	}
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= '';
	}
} 
class Lang_Menu_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$active_class = '';  
		if ($item->current || ((home_url('/')!==$item->url) && (strpos(get_permalink(), $item->url)===0))) {
			$active_class = 'active';
		}

		$data_element = ''; 
			
		if ( 0 == $depth ) {
			$output .= '<button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="languages" aria-haspopup="true">';
			$output .= '<span class="visually-hidden">Lingua attiva:</span>';
			$output .= '<span>'.substr(strtoupper($item->title),0,3).'</span>'; 
			$output .= '<svg class="icon">';
			$output .= '<use href="'.get_template_directory_uri().'/svg/sprites.svg#it-expand"></use>';
			$output .= '</svg>';
			$output .= '</button>';
			$output .= '<div class="dropdown-menu"><div class="row"><div class="col-12"><div class="link-list-wrapper"><ul class="link-list">';
		} else {
			$output .= '<li><a class="dropdown-item list-item '.$active_class.'" href="' . $item->url . '" data-element="'.$data_element.'"><span>';
			if($active_class == 'active') $output .= '<span class="visually-hidden">Lingua attiva:</span>';
			$output .= substr(strtoupper($item->title),0,3);
			$output .= '</a></span></li>';
		}
	} 

	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		// Close the wrapper div, if applicable.
		if ( 0 == $depth ) {
			$output .= '</ul></div></div></div></div><!-- .sub-menu-wrapper -->';
		}
		$output .= "\n";
	} 
}