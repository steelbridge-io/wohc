<?php

// Soliloquy Slider
include_once get_stylesheet_directory() . '/inc/slider-hero.php';

// Start the engine.
include_once get_template_directory() . '/lib/init.php';

// Kreativ Theme Defaults.
include_once get_stylesheet_directory() . '/lib/theme-defaults.php';

// Kreativ Required Plugins.
include_once get_stylesheet_directory() . '/lib/required-plugins.php';

// Kreativ Demo Import.
include_once get_stylesheet_directory() . '/lib/demo-import.php';

// Kreativ Helper functions.
include_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Custom Functions !!Add all custom funtions here.
include_once get_stylesheet_directory() . '/lib/custom-functions.php';

// Kreativ Customizer Options.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Kreativ Customizer Styles.
include_once get_stylesheet_directory() . '/lib/output.php';

// Add the required WooCommerce functions.
include_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Add the required WooCommerce custom CSS.
include_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Include notice to install Genesis Connect for WooCommerce.
include_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

// Kreativ Portfolio Widget.
include_once get_stylesheet_directory() . '/lib/widgets/featured-portfolio.php';

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'kreativ_localization_setup' );
function kreativ_localization_setup() {
	load_child_theme_textdomain( 'kreativ-pro', get_stylesheet_directory() . '/languages' );
}

// Setup Portfolio Widget.
add_action( 'widgets_init', 'kreativ_portfolio_widget' );
function kreativ_portfolio_widget() {
	register_widget( 'Kreativ_Featured_Portfolio' );
}

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Kreativ Pro' );
define( 'CHILD_THEME_URL', 'http://themesquare.com/themes/kreativ/' );
define( 'CHILD_THEME_VERSION', '1.2.2' );

// Enqueue Scripts & Styles.
add_action( 'wp_enqueue_scripts', 'kreativ_scripts_styles' );
function kreativ_scripts_styles() {
  
  wp_enqueue_style( 'mobile-nav', get_stylesheet_directory_uri() . '/mobile-nav.css', array(), '1.0' );
  wp_enqueue_style( 'nav-css', get_stylesheet_directory_uri() . '/nav.css', array(), '1.0' );
  wp_enqueue_style( 'custom-css', get_stylesheet_directory_uri() . '/custom.css', array(), '1.0');
	wp_enqueue_style( 'kreativ-font-lato', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'kreativ-font-ss', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'kreativ-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0' );
	wp_enqueue_style( 'kreativ-line-awesome', '//maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css', array(), '1.1' );
  wp_register_style( 'font-awesome' , get_stylesheet_directory_uri() . '/assets/fontawesome/css/all.min.css', array(), '5.13.1' );
	wp_enqueue_style( 'font-awesome' );
 
	//wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array(), 'NULL', true );
  wp_enqueue_script( 'kreativ-match-height', get_stylesheet_directory_uri() . '/js/match-height.js', array( 'jquery' ), '0.5.2', true );
  wp_enqueue_script( 'kreativ-js', get_stylesheet_directory_uri() . '/js/kreativ.js', array( 'jquery', 'kreativ-match-height' ), CHILD_THEME_VERSION, true );
  // Responsive Nav Menu.
  wp_enqueue_script( 'kreativ-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menus.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
  wp_localize_script(
    'kreativ-responsive-menu',
    'genesis_responsive_menu',
    kreativ_responsive_menu_settings()
  );
	
	if(is_front_page() ) {
	  
    if ( is_active_sidebar( 'notice-bar' ) ) {
      $scroll_check = 1;
      $scroll_text = get_theme_mod('notice_bar_scroll_check', $scroll_check);
      if ($scroll_text == 1) {
        wp_enqueue_style('text-scroll-notice', get_stylesheet_directory_uri() . '/assets/css/text-scroll.css', array(), '1.0');
      }
    }
    
    // Add bootstrap CSS
    wp_register_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', false, NULL, 'all');
    wp_enqueue_style('bootstrap-css');
    
    // Add popper js
    wp_register_script('popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', ['jquery'], NULL, true);
    wp_enqueue_script('popper-js');
    
    // Add bootstrap js
    wp_register_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', ['jquery'], NULL, true);
    wp_enqueue_script('bootstrap-js');
    
    wp_deregister_script('jquery');
    wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js", false, null);
    wp_enqueue_script('jquery');
    
    // Add integrity and cross origin attributes to the bootstrap css.
    function add_bootstrap_css_attributes($html, $handle)
    {
      if ($handle === 'bootstrap-css') {
        return str_replace('/>', 'integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />', $html);
      }
      return $html;
    }
    
    add_filter('style_loader_tag', 'add_bootstrap_css_attributes', 10, 2);

// Add integrity and cross origin attributes to the bootstrap script.
    function add_bootstrap_script_attributes($html, $handle)
    {
      if ($handle === 'bootstrap-js') {
        return str_replace('></script>', ' integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>', $html);
      }
      return $html;
    }
    
    add_filter('script_loader_tag', 'add_bootstrap_script_attributes', 10, 2);

// Add integrity and cross origin attributes to the popper script.
    function add_popper_script_attributes($html, $handle)
    {
      if ($handle === 'popper-js') {
        return str_replace('></script>', ' integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>', $html);
      }
      return $html;
    }
    add_filter('script_loader_tag', 'add_popper_script_attributes', 10, 2);
  }
}

// Define our responsive menu settings.
function kreativ_responsive_menu_settings() {

	$settings = array(
		'mainMenu'    => __( 'Menu', 'kreativ-pro' ),
		'subMenu'     => __( 'Menu', 'kreativ-pro' ),
		'menuClasses' => array(
			'others' => array(
				'.nav-primary',
				'.nav-secondary',
			),
		),
	);

	return $settings;

}

// Enqueue RTL Styles.
add_action( 'wp_enqueue_scripts', 'kreativ_rtl_styles', 12 );
function kreativ_rtl_styles() {
	// Load RTL stylesheet.
	if ( ! is_rtl() ) {
		return;
	}

	wp_enqueue_style( 'kreativ-rtl', get_stylesheet_directory_uri() . '/rtl/style-rtl.css', array(), CHILD_THEME_VERSION );

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Remove post meta.
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

// Remove the header right widget area.
unregister_sidebar( 'header-right' );

// Add support for footer menu.
add_theme_support( 'genesis-menus', array( 'primary' => 'Primary Navigation Menu', 'secondary' => 'Secondary Navigation Menu', 'footer' => 'Footer Navigation Menu' ) );

// Reposition the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Move image above post title.
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 8 );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 1600,
	'height'          => 1200,
	'flex-height'     => true,
	'flex-width'      => true,
	'header-selector' => '.site-header',
	'header-text'     => false,
) );

// Add support for custom logo.
add_theme_support( 'custom-logo', array(
	'width'       => 200,
	'height'      => 46,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( '.site-title', '.site-description' ),
) );

// Add image sizes.
add_image_size( 'blog', '800', '400', true );
add_image_size( 'portfolio', '570', '390', true );

// Remove default gallery styles.
add_filter( 'use_default_gallery_style', '__return_false' );

// Add Genesis Layouts to Portfolio.
add_post_type_support( 'portfolio', 'genesis-layouts' );

// Register widget areas.
genesis_register_sidebar( array(
  'id'          => 'notice-bar',
  'name'        => __( 'Notice Bar', 'kreativ-pro' ),
  'description' => __( 'Notice Bar. Front Page.', 'kreative-pro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'topbar',
	'name'        => __( 'Topbar', 'kreativ-pro' ),
	'description' => __( 'This is the topbar section.', 'kreativ-pro' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'masthead-front-page-one',
  'name'		=> __( 'Masthead Container One', 'west_oakland_health' ),
  'description'	=> __( 'Masthead One', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'masthead-front-page-two',
  'name'		=> __( 'Masthead Container Two', 'west_oakland_health' ),
  'description'	=> __( 'Masthead Two', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'masthead-front-page-three',
  'name'		=> __( 'Masthead Container Three', 'west_oakland_health' ),
  'description'	=> __( 'Masthead Three', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'message-front-page-image',
  'name'		=> __( 'Message Image', 'west_oakland_health' ),
  'description'	=> __( 'Adds an image to the left of the front page message.', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'message-front-page-message',
  'name'		=> __( 'Front Page Message', 'west_oakland_health' ),
  'description'	=> __( 'Adds a message to the right of the message image.', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'front-page-grid-one',
  'name'		=> __( 'Front Page Grid: Item One', 'west_oakland_health' ),
  'description'	=> __( 'Adds content to grid item one on the front page.', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'front-page-grid-two',
  'name'		=> __( 'Front Page Grid: Item Two', 'west_oakland_health' ),
  'description'	=> __( 'Adds content to grid item two on the front page.', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'front-page-grid-three',
  'name'		=> __( 'Front Page Grid: Item Three', 'west_oakland_health' ),
  'description'	=> __( 'Adds content to grid item three on the front page.', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'front-page-grid-four',
  'name'		=> __( 'Front Page Grid: Item Four', 'west_oakland_health' ),
  'description'	=> __( 'Adds content to grid item four on the front page.', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'front-page-grid-five',
  'name'		=> __( 'Front Page Grid: Item Five', 'west_oakland_health' ),
  'description'	=> __( 'Adds content to grid item five on the front page.', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'front-page-grid-six',
  'name'		=> __( 'Front Page Grid: Item Six', 'west_oakland_health' ),
  'description'	=> __( 'Adds content to grid item six on the front page.', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'note-to-community',
  'name'		=> __( 'Front Page Note', 'west_oakland_health' ),
  'description'	=> __( 'Adds note or comment below grid.', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'note-to-community-hours',
  'name'		=> __( 'Front Page Hours', 'west_oakland_health' ),
  'description'	=> __( 'Adds hours next to note section.', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'testimonial-title',
  'name'		=> __( 'Testimonial Title', 'west_oakland_health' ),
  'description'	=> __( 'Adds testimonial title.', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'testimonial-one',
  'name'		=> __( 'Testimonial One', 'west_oakland_health' ),
  'description'	=> __( 'Adds testimonial.', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'testimonial-two',
  'name'		=> __( 'Testimonial Two', 'west_oakland_health' ),
  'description'	=> __( 'Adds testimonial.', 'west_oakland_health' ),
) );
genesis_register_sidebar( array(
  'id'		=> 'testimonial-three',
  'name'		=> __( 'Testimonial Three', 'west_oakland_health' ),
  'description'	=> __( 'Adds testimonial.', 'west_oakland_health' ),
) );

/*genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Front Page 1', 'kreativ-pro' ),
	'description' => __( 'This is the front page 1 section.', 'kreativ-pro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'kreativ-pro' ),
	'description' => __( 'This is the front page 2 section.', 'kreativ-pro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'kreativ-pro' ),
	'description' => __( 'This is the front page 3 section.', 'kreativ-pro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'front-page-4',
	'name'        => __( 'Front Page 4', 'kreativ-pro' ),
	'description' => __( 'This is the front page 4 section.', 'kreativ-pro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'front-page-5',
	'name'        => __( 'Front Page 5', 'kreativ-pro' ),
	'description' => __( 'This is the front page 5 section.', 'kreativ-pro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'front-page-6',
	'name'        => __( 'Front Page 6', 'kreativ-pro' ),
	'description' => __( 'This is the front page 6 section.', 'kreativ-pro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'front-page-7',
	'name'        => __( 'Front Page 7', 'kreativ-pro' ),
	'description' => __( 'This is the front page 7 section.', 'kreativ-pro' ),
) );*/

// Notice Bar
if ( is_active_sidebar( 'notice-bar') ) {
  add_action('genesis_before_header', 'notice_bar_fp');
  function notice_bar_fp() {
    genesis_widget_area( 'notice-bar', array(
      'before' => '<div class="expandable"><div class="notice-bar top-notice-bar" id="topnotice"><div class="wrap"><div class="notice-content" id="noticecontent">',
      'after'  => '</div></div></div></div>',
    ) );
  }
} else {
  return '';
}


// Topbar with contact info and social links.
add_action( 'genesis_before_header', 'kreativ_topbar' );
function kreativ_topbar() {
	genesis_widget_area( 'topbar', array(
		'before' => '<div class="site-topbar"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

// Sticky Header.
add_filter( 'body_class', 'kreativ_sticky_header_class' );
function kreativ_sticky_header_class( $classes ) {
	$sticky_header = get_option( 'kreativ_sticky_header' );
	$classes[]     = ( $sticky_header !== 'disable' ) ? 'sticky-header-active' : '';
	return $classes;
}

// Hook menu in footer.
add_action( 'genesis_footer', 'kreativ_footer_menu', 12 );
function kreativ_footer_menu() {
	printf( '<nav %s>', genesis_attr( 'nav-footer' ) );
	wp_nav_menu( array(
		'theme_location' => 'footer',
		'container'      => false,
		'depth'          => 1,
		'fallback_cb'    => false,
		'menu_class'     => 'genesis-nav-menu',
	) );
	echo '</nav>';
}

// Nav footer attributes.
add_filter( 'genesis_attr_nav-footer', 'kreativ_footer_nav_attr' );
function kreativ_footer_nav_attr( $attributes ) {
	$attributes['itemscope'] = true;
	$attributes['itemtype']  = 'http://schema.org/SiteNavigationElement';
	return $attributes;
}

// Add skip link needs to footer nav.
add_filter( 'genesis_attr_nav-footer', 'kreativ_nav_footer_id' );
function kreativ_nav_footer_id( $attributes ) {
	$attributes['id'] = 'genesis-nav-footer';
	return $attributes;
}

// Add skip link needs to footer nav.
add_filter( 'genesis_skip_links_output', 'kreativ_nav_footer_skip_link' );
function kreativ_nav_footer_skip_link( $links ) {
	if ( has_nav_menu( 'footer' ) ) {
		$links['genesis-nav-footer'] = __( 'Skip to footer navigation', 'kreativ-pro' );
	}
	return $links;
}

// Scroll to top link.
add_action( 'genesis_footer', 'kreativ_scrollup', 12 );
function kreativ_scrollup() {
	echo '<div class="scroll-up">';
	echo '<a href="#" class="scrollup"><span class="screen-reader-text">Press to scroll back to top</span></a>';
	echo '</div>';
}

//* Remove the entry title
//remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Remove the entry meta in the entry header
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

// Enqueue Ionicons.
add_action( 'wp_enqueue_scripts', 'sp_enqueue_ionicons' );
function sp_enqueue_ionicons() {
    wp_enqueue_style( 'ionicons', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), CHILD_THEME_VERSION );
}


function mytheme_setup() {
  add_theme_support( 'align-wide' );
  add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'mytheme_setup' );



// Remove Genesis SEO settings from post/page editor
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );

// Remove Genesis SEO settings option page
remove_theme_support( 'genesis-seo-settings-menu' );

// Remove Genesis SEO settings from taxonomy editor
remove_action( 'admin_init', 'genesis_add_taxonomy_seo_options' );


add_action( 'genesis_before_header', 'genesis_seo_site_title', 15 );
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );


add_action( 'genesis_before_footer', 'add_wc_WCAG2A');
function add_wc_WCAG2A() {
  echo '<div class="content-sidebar-wrap above-footer"><div class="wrap">';
  echo '<a class="wcag" href="https://www.w3.org/WAI/WCAG2A-Conformance"
   title="Explanation of WCAG 2.0 Level A Conformance">
  <img height="32" width="88"
       src="https://www.w3.org/WAI/wcag2A"
       alt="Level A conformance,
            W3C WAI Web Content Accessibility Guidelines 2.0">
</a>';
  echo '</div></div>';
}
