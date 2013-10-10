<?php

/*==================================================================== */
/* CONTENT WIDTH
/*==================================================================== */

	if ( ! isset( $content_width )){
		$content_width = 620; //GLOBAL CONTENT WIDTH (px)
	}


/*==================================================================== */
/* CBG THEME SETUP
/*==================================================================== */


	add_action( 'after_setup_theme', 'flexbones_setup' );
	
	function flexbones_setup() {
	
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style('editor-style.css?' . time());
	
		// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
		add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
	
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
	
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
	
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => 'Primary Navigation',
		) );
		
		//register sidebars
		register_sidebar();
	}

/*==================================================================== */
/* SET THE EXCERPT LENGTH
/*==================================================================== */

	function cbg_excerpt_length( $length ) {
		return 55;
	}
	
	add_filter( 'excerpt_length', 'cbg_excerpt_length' );
	

/*==================================================================== */
/* SET THE READ MORE TEXT
/*==================================================================== */

	/* Replaces the excerpt "more" text by a link */

	function new_excerpt_more($more) {
	    global $post;
	    return '... <a href="'. get_permalink($post->ID) . '" class="read-more">' . 'View more.' . '</a>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');


/*==================================================================== */
/* Remove inline styles printed when the gallery shortcode is used
/*==================================================================== */

	add_filter( 'use_default_gallery_style', '__return_false' );
	
/*==================================================================== */
/* ADD GALLERY THUMBNAIL CUSTOM SIZE 
/*==================================================================== */

//add_image_size( 'gallery-thumb', 300, 195, true );

/*==================================================================== */
/* STOP TINY MCE Editing BRS
/*==================================================================== */

function cbnet_tinymce_config( $init ) {

    // Don't remove line breaks
    $init['remove_linebreaks'] = false; 

    // Pass $init back to WordPress
    return $init;
}
add_filter('tiny_mce_before_init', 'cbnet_tinymce_config');

/*==================================================================== */
/* REMOVE Paragraphs round IMAGES 
/*==================================================================== */

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

/*==================================================================== */
/* REMOVE IMAGE DIMENSIONS (for responsive imgs)
/*==================================================================== */

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); 
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 ); 
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) { 
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html ); return $html; 
}

/*==================================================================== */
/* REMOVE ADMIN BAR 
/*==================================================================== */

add_filter('show_admin_bar', '__return_false');

/*==================================================================== */
/* SUB MENU
/*==================================================================== */	
	
function sub_menu(){
	
	global $post;
	
	if($post){
		
		if($post->post_parent){
			$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
		} else {
			$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
		} 
		
		if ($children) {
			echo '<ul>' . $children . '</ul>';
		}
	}
}

/*==================================================================== */
/* Add parent class to Wp list pages! great for recursive menus!
/*==================================================================== */	

function add_parent_class( $css_class, $page, $depth, $args ){
    if ( ! empty( $args['has_children'] ) )
        $css_class[] = 'parent slide_down';
    return $css_class;
}
add_filter( 'page_css_class', 'add_parent_class', 10, 4 );

/*==================================================================== */
/* Add parent class to wp_nav_menu
/*==================================================================== */       

add_filter('wp_nav_menu_objects', function ($items) {

    $hasSub = function ($menu_item_id, $items) {
        foreach ($items as $item) {
            if ($item->menu_item_parent && $item->menu_item_parent == $menu_item_id) {
                return true;
            }
        }
        return false;
    };

    foreach ($items as $item) {
        if ($hasSub($item->ID, $items)) {
            $item->classes[] = 'parent';
        }
    }
    return $items;    

});

/*==================================================================== */
/* Wrap Li's in spans from the content to allow for greater styling control
/*==================================================================== */	

function span_li($content){
	
	$content = str_replace( '<li>','<li><span>',$content );
	$content = str_replace( '</li>','</span></li>',$content );
	return $content;
	
}

add_filter( 'the_content', 'span_li' );

/*==================================================================== */
/* Dequeue Wordpress JS Files 
/*==================================================================== */

//remove wordpress jquery

function remove_wp_jquery() {
	wp_deregister_script('jquery');
	wp_deregister_script('jquery-ui');
}

add_action('init', 'remove_wp_jquery'); // will deregister from head

/*==================================================================== */
/* Enque JS Files 
/*==================================================================== */


function barebones_load_js() {

 	/* NAME / LOCATION / DEPENDENCIES (accepts array) / VERSION / IN FOOTER (true | false) */
  	
	// Jquery

  	wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', array(), '1.10.2', true );
  	wp_enqueue_script( 'jquery' );
  	
  	// Jquery UI

  	// wp_register_script('jquery-ui','//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', array(), '1.10.3', true);
  	// wp_enqueue_script( 'jquery-ui' );

  	// Modernizr

  	wp_register_script( 'modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2', false );
  	wp_enqueue_script( 'modernizr' );
  	
  	// Sitewide Scripts

  	wp_register_script( 'sitewide-scripts', get_template_directory_uri( ) . '/js/scripts.js', array( 'jquery' ), '1', true );
  	wp_enqueue_script( 'sitewide-scripts' );
  	
  	// Gridtacular

  	wp_register_script( 'gridtacular', get_template_directory_uri( ) . '/js/gridtacular.js', array( 'jquery' ), '1', true );
  	wp_enqueue_script( 'gridtacular' );   

  	// set the stylesheet directory uri to var 'stylesheet_root' and pass the var to documents that require it

  	$stylesheet_root = array( 'dir' => get_stylesheet_directory_uri() );
    wp_localize_script( 'sitewide-scripts', 'stylesheet_root', $stylesheet_root );
    wp_localize_script( 'gridtacular', 'stylesheet_root', $stylesheet_root );

	/* if ( is_front_page() ) {
		wp_enqueue_script('home-page-main-flex-slider');
	}*/
 
}
 
add_action('wp_enqueue_scripts', 'barebones_load_js'); // For use on the Front end (ie. Theme)

/*==================================================================== */
/* Enque Stylesheet
/*==================================================================== */

function stylesheet_loader() {
	wp_register_style( 
		'page-style', 
    	get_template_directory_uri() . '/style.css', 
    	array(), 
    	'4.0', 
    	'all' 
    );

  // enqueing:
  wp_enqueue_style( 'page-style' );
}

add_action( 'wp_enqueue_scripts', 'stylesheet_loader' );


/*==================================================================== */
/* Override Default WordPress Search behaviour to surpress 404 redirect
/*==================================================================== */

function SearchFilter($query) {
    // If 's' request variable is set but empty
    if (isset($_GET['s']) && empty($_GET['s']) && $query->is_main_query()){
        $query->is_search = true;
        $query->is_home = false;
    }
    return $query;
}

add_filter('pre_get_posts','SearchFilter');

/*==================================================================== */
/* Wrap images in div
/*==================================================================== */

if( is_admin() ) {
 
    add_filter( 'image_send_to_editor', 'wp_image_wrap_init', 10, 8 );    
    function wp_image_wrap_init( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
        return '<div class="content-image">'. $html .'</div>';
    }
 
}
