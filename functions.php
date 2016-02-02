<?php

/*----------------------------------------
 # Theme Script and Styles
----------------------------------------*/

function theme_enqueue_styles() {

  // Enqueue the parent theme style
  $parent_style = 'parent-style';
  wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'foundation', get_stylesheet_directory_uri() . '/css/foundation.min.css' );
  wp_enqueue_style( 'chocolatcss', get_stylesheet_directory_uri() . '/css/chocolat.css' );

  wp_register_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr-custom.js', array(), null, false );
  wp_register_script( 'what-input', get_stylesheet_directory_uri() . '/js/vendor/what-input.min.js', array(), null, true );
  wp_register_script( 'jQuery', get_stylesheet_directory_uri() . '/js/vendor/jquery.min.js', array(), null, true );
  wp_register_script( 'foundation-js', get_stylesheet_directory_uri() . '/js/foundation.min.js', array(), null, true );
  wp_register_script( 'chocolat-js', get_stylesheet_directory_uri() . '/js/chocolat.min.js', array('jQuery'), null, true );
  wp_register_script( 'app', get_stylesheet_directory_uri() . '/js/app.js', array('chocolat-js'), null, true );

  wp_enqueue_script( 'modernizr' );

  if ( !is_admin() ) {
    wp_dequeue_script('jquery');
    wp_enqueue_script( 'jQuery' );
  }

  wp_enqueue_script( 'what-input' );
  wp_enqueue_script( 'foundation-js' );
  wp_enqueue_script( 'app' );


}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/*----------------------------------------
 # Editor Style
----------------------------------------*/
function add_editor_styles() {
    add_editor_style( 'misty-editor-style.css' );
}
add_action( 'admin_init', 'add_editor_styles' );

/*----------------------------------------
 # Read more
----------------------------------------*/

function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

/*----------------------------------------
 # Override entry meta function
----------------------------------------*/

if ( ! function_exists( 'twentysixteen_entry_meta' ) ) :

function twentysixteen_entry_meta() {

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		twentysixteen_entry_date();
	}

	$format = get_post_format();
	if ( current_theme_supports( 'post-formats', $format ) ) {
		printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
			sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'twentysixteen' ) ),
			esc_url( get_post_format_link( $format ) ),
			get_post_format_string( $format )
		);
	}

	if ( 'post' === get_post_type() ) {
		twentysixteen_entry_taxonomies();
	}

	if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'twentysixteen' ), get_the_title() ) );
		echo '</span>';
	}
}
endif;

/*----------------------------------------
 # Twitch API
----------------------------------------*/

$twitch_redirect_URI = 'http://localhost:8888/lab/kindel/oauth';
$twitch_client_ID = '4ph12w81hprsm91pater9487mnk66si';
$twitch_client_secret = 'ba2zlz67ntdhpmdh1pfma5tkbsztyay';

/*
	* Check to see if user is online on twitch
	*	returns either true or false
*/

function is_twitch_online() {
	$twitch_stream = get_url_contents("https://api.twitch.tv/kraken/streams?channel=" . get_theme_mod('twitch_profile') . "");
	$result = json_decode($twitch_stream, true);
	if ( $result['streams'] != null ) {
		return true;
	} else {
		return false;
	}
}

/*
	* Useful functions for API Calls
*/

function get_url_contents($url){
    $crl = curl_init();
    $timeout = 5;
    curl_setopt ($crl, CURLOPT_URL,$url);
    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

function post_url_contents($url, $fields) {

    foreach($fields as $key=>$value) { $fields_string .= $key.'='.urlencode($value).'&'; }
    rtrim($fields_string, '&');

    $crl = curl_init();
    $timeout = 5;

    curl_setopt($crl, CURLOPT_URL,$url);
    curl_setopt($crl,CURLOPT_POST, count($fields));
    curl_setopt($crl,CURLOPT_POSTFIELDS, $fields_string);

    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

define('HEADER_IMAGE_WIDTH', 1920);
define('HEADER_IMAGE_HEIGHT', 350);

/*----------------------------------------
 # Additional files
----------------------------------------*/
require_once( 'assets/customize.php' );
require_once( 'assets/social-widget.php' );

function custom_excerpt_length( $length ) {
	return 120;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/*----------------------------------------
 # Short Codes
----------------------------------------*/
function lead_short_code($atts, $content = null){
  return '<p class="lead">' . $content . '</p>';
}

add_shortcode( 'lead', 'lead_short_code' );

function gallery_chocolat_shortcode( $attr, $content = null ) {
  $atts = shortcode_atts( array(
    'images' => '',
    'title' => '',
    'size' => 'medium',
    'columns' => '1'
  ), $attr, 'ligthbox' );

  $images = $atts['images'];

  if ( ! empty( $images ) ) {
    $_attachments = get_posts( array( 'include' => $images, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'post__in' ) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  }

  if ( empty( $attachments ) ) {
    return '';
  }

  $output = '<div class="chocolat-parent gallery-columns-' . $atts['columns'] . '" data-chocolat-title="' . $atts['title'] . '">';
  foreach ( $attachments as $id => $attachment ) {
    $image_link = wp_get_attachment_url($id);
                $image_output = wp_get_attachment_image( $id, $atts['size'], false );
    $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
    $output .= '<a href="' . $image_link . '" class="chocolat-image thumbnail" title="' . $alt . '">' . $image_output . '</a>';
  }
  $output .= '</div>';

  return $output;
}
add_shortcode( 'lightbox', 'gallery_chocolat_shortcode' );

?>
