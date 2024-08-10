<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );
	// Load the stylesheet
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	// Pour bien vérifier que jquery est chargé avant utiliser notre script
	wp_enqueue_script('jquery', array('jquery'), '1.0', true);
	wp_enqueue_script('child-style', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);

}
add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

// Ajout d'un bouton "Nous contacter" dans le menu de navigation en utilisant un hook de navigation
function contact_btn_nav_hook( $items, $args ) {
	$items .= '<li id="menu-item-855" class="menu-item"><a href="/contact" class="contact-btn">Nous contacter</a></li>';
	return $items;
}

add_filter( 'wp_nav_menu_items', 'contact_btn_nav_hook', 10, 2 );