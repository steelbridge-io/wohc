<?php

add_action( 'genesis_site_title', 'kreativ_custom_logo', 0 );
/**
 * Display the custom logo.
 *
 * @since 1.1.0
 */
function kreativ_custom_logo() {
  //if ( function_exists( 'the_custom_logo' ) ) {
  if (has_custom_logo()) {
    the_custom_logo();
  } else{
    echo '<h2>' . get_theme_mod('wohc_cta_nav') . '</h2>';
  }
}
