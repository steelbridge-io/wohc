<?php

/*

* Custom Front Page

*/
// set full width layout

add_filter ( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );


// remove Genesis default loop

remove_action( 'genesis_loop', 'genesis_do_loop' );
// Kreativ front page init.
add_action( 'genesis_meta', 'kreativ_front_page_init' );
function kreativ_front_page_init() {
  if ( is_active_sidebar( 'masthead-front-page-one' ) || is_active_sidebar( 'masthead-front-page-two' ) || is_active_sidebar( 'masthead-front-page-three' ) || is_active_sidebar( 'topbar' ) || is_active_sidebar( 'masthead-front-page-one' ) || is_active_sidebar( 'masthead-front-page-two' ) || is_active_sidebar( 'masthead-front-page-three' ) || is_active_sidebar( 'message-front-page-image' ) || is_active_sidebar( 'message-front-page-message' ) || is_active_sidebar( 'front-page-grid-one' ) || is_active_sidebar( 'front-page-grid-two' ) || is_active_sidebar( 'front-page-grid-three' ) || is_active_sidebar( 'front-page-grid-four' ) || is_active_sidebar( 'front-page-grid-five' ) || is_active_sidebar( 'front-page-grid-six' ) || is_active_sidebar( 'note-to-community' ) || is_active_sidebar( 'note-to-community-hours' ) || is_active_sidebar(  'testimonial-title' ) || is_active_sidebar( 'testimonial-one' ) || is_active_sidebar( 'testimonial-two' ) || is_active_sidebar( 'testimonial-one' ) ) {
    
    // Enqueue scripts.
    add_action( 'wp_enqueue_scripts', 'kreativ_home_scripts' );
    function kreativ_home_scripts() {
      wp_enqueue_style( 'kreativ-front-css', get_stylesheet_directory_uri() . '/style-front.css', array(), CHILD_THEME_VERSION );
     // wp_enqueue_script( 'kreativ-front-page', get_stylesheet_directory_uri() . '/js/front-page.js', array( 'jquery' ), CHILD_THEME_VERSION );
    }
    
    // Enqueue RTL Styles.
    add_action( 'wp_enqueue_scripts', 'kreativ_home_rtl_styles', 12 );
    function kreativ_home_rtl_styles() {
      // Load RTL stylesheet.
      if ( ! is_rtl() ) {
        return;
      }
      wp_enqueue_style( 'kreativ-front-rtl', get_stylesheet_directory_uri() . '/rtl/style-front-rtl.css', array(), CHILD_THEME_VERSION );
    }
    
    // Add front-page body class.
    add_filter( 'body_class', 'kreativ_body_class' );
    function kreativ_body_class( $classes ) {
      $classes[] = 'front-page';
      return $classes;
    }
    
    add_filter( 'genesis_site_title_wrap', 'kreativ_h1_for_site_title' );
    /**
     * Use h1 for site title.
     */
    function kreativ_h1_for_site_title( $wrap ) {
      return 'h1';
    }
    
    // Force full width content layout.
    add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
    
    // Remove the default Genesis loop.
    remove_action( 'genesis_loop', 'genesis_do_loop' );
    
    // Add homepage widgets.
    add_action( 'genesis_loop', 'kreativ_front_page_widgets' );
  }
}

add_action( 'genesis_after_header', 'front_page_slider', 15 );
function front_page_slider() {
  if(is_front_page()) {
    
    $fp_video         = get_theme_mod('fp-video');
    $fp_slider_one    = get_theme_mod('fp-topslider-one');
    
    $slider_2 = '';
    $fp_slider_two  = get_theme_mod('fp-topslider-two', $slider_2 );
    
    $slider_3 = '';
    $fp_slider_three  = get_theme_mod('fp-topslider-three', $slider_3 );
    
    if(get_theme_mod('fp-video') !== '' ) : ?>
      
      <div id="hero-video">
        <video playsinline="playsinline" controls autoplay="autoplay" muted="muted" loop="loop" aria-label="This is a video with controls appearing on hover">
          <source src="<?php echo $fp_video ?>" type="video/mp4">
        </video>
      </div>
    
    <?php  else:  ?>
      
      <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel" aria-label="This is a three image slider or carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleControls" data-slide-to="1"></li>
          <li data-target="#carouselExampleControls" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="<?php echo $fp_slider_one ?>" alt="First slide">
          </div>
          <?php if ($fp_slider_two !== '') : ?>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo $fp_slider_two ?>" alt="Second slide">
            </div>
          <?php endif; ?>
          <?php if ($fp_slider_three !== '') : ?>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?php echo $fp_slider_three ?>" alt="Third slide">
            </div>
          <?php endif; ?>
        </div>
        <?php if ( $fp_slider_two !== '' || $fp_slider_three !== '' ) : ?>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        <?php endif; ?>
      </div>
    
    <?php endif;
  }
}

// Add markup for front page widgets.
function kreativ_front_page_widgets() {
  
  echo '<section>';
  genesis_widget_area( 'topbar', array(
    'before'  =>  '<div id="topbar" class="container"><div class="wrap">',
    'after'   =>  '</div></div>'
  ));
  echo '</section>';
  
  // Masthead Row
  echo '<section id="masthead-front-page" class=""><div class="container-plus"><div class="row">';
  
  genesis_widget_area( 'masthead-front-page-one', array(
    'before' => '<div class="masthead-content col-md-4"><div class="wrap">',
    'after' => '</div></div>',
  ));
  genesis_widget_area( 'masthead-front-page-two', array(
    'before' => '<div class="masthead-content mhc-two col-md-4"><div class="wrap">',
    'after' => '</div></div>',
  ));
  genesis_widget_area( 'masthead-front-page-three', array(
    'before' => '<div class="masthead-content mhc-three col-md-4"><div class="wrap">',
    'after' => '</div></div>',
  ));
  
  echo '</div></div></section>';
  
  // Message Section
  echo '<section id="message" class="front-page-message"><div class="container-fluid mt-lg-5"><div class="row justify-content-end">';
  echo '<div class="col-md-3">';
  genesis_widget_area('message-front-page-image', array(
    'before'  => '<div class="image-content widget-content"><div class="wrap">',
    'after'   => '</div></div>'
  ));
  echo '</div>';
  echo '<div id="message-wrapper" class="col-md-8">';
  genesis_widget_area( 'message-front-page-message', array(
    'before'  => '<div class="message-content widget-content"><div class="wrap">',
    'after'   => '</div></div>'
  ));
  echo '</div></div></div></section>';
  
  // Medical Message Section
  echo '<section id="medical-message" class="front-page-medical-message"><div class="container-fluid mt-lg-5"><div class="row">';
  echo '<div id="medical-message-wrapper" class="col-md-8">';
  genesis_widget_area('medical-message-front-page', array(
    'before'  => '<div class="medical-message-content medical-widget-content message-content"><div class="wrap">',
    'after'   => '</div></div>'
  ));
  echo '</div>';
  echo '<div class="col-md-3">';
  genesis_widget_area( 'medical-message-image', array(
    'before'  => '<div class="medical-image-content medical-widget-content"><div class="wrap">',
    'after'   => '</div></div>'
  ));
  echo '</div></div></div></section>';
  
  
  
  // Grid Section
  echo '<section id="front-page-grid" class="front-page-grid"><div class="container-fluid mt-lg-5"><div class="row justify-content-center">';
  
  genesis_widget_area( 'front-page-grid-one', array(
    'before'  => '<div class="grid-content grid-content-one col-md-4">',
    'after'   => '</div>'
  ));
  genesis_widget_area( 'front-page-grid-two', array(
    'before'  => '<div class="grid-content grid-content-two col-md-4">',
    'after'   => '</div>'
  ));
  genesis_widget_area( 'front-page-grid-three', array(
    'before'  => '<div class="grid-content grid-content-three col-md-4">',
    'after'   => '</div>'
  ));
  genesis_widget_area( 'front-page-grid-four', array(
    'before'  => '<div class="grid-content grid-content-four col-md-4">',
    'after'   => '</div>'
  ));
  genesis_widget_area( 'front-page-grid-five', array(
    'before'  => '<div class="grid-content grid-content-five col-md-4">',
    'after'   => '</div>'
  ));
  genesis_widget_area( 'front-page-grid-six', array(
    'before'  => '<div class="grid-content grid-content-six col-md-4">',
    'after'   => '</div>'
  ));
  
  echo '</div></div></section>';
  
  // A Note To Our Community - hours
  echo '<section id="note-section" class="front-page-note"><div class="note-and-hours container-fluid mt-lg-5"><div class="row"><div id="note-wrapper" class="col-md-6">';
  genesis_widget_area('note-to-community', array(
    'before'  => '<div id="note-community" class="note-content widget-content"><div class="wrap">',
    'after'   => '</div></div>'
  ));
  echo '</div><div id="hours-wrapper" class="col-md-6">';
  genesis_widget_area( 'note-to-community-hours', array(
    'before'  => '<div id="hours" class="widget-content hours-content"><div class="wrap">',
    'after'   => '</div></div>'
  ));
  echo '</div></div></div></section>';


// Patient Testimonials
  echo '<section id="testimonials" class="front-page-testimonials"><div class="container">';
  genesis_widget_area('testimonial-title', array(
    'before'  => '<div id="testimonial-title" class="testimonial-title widget-content"><div class="wrap">',
    'after'   => '</div></div>'
  ));
  echo  '</div>';
  
  echo '<div class="container-fluid mt-lg-5"><div id="testimonial-row" class="row"><div class="col-lg-4"><div class="wrap">';
  
  genesis_widget_area('testimonial-one', array(
    'before'  => '<div id="testimonial-one" class="testimonial-content widget-content"><div class="wrap">',
    'after'   => '</div></div>'
  ));
  echo '</div></div><div class="col-lg-4"><div class="wrap">';
  genesis_widget_area('testimonial-two', array(
    'before'  => '<div id="testimonial-two" class="testimonial-content widget-content"><div class="wrap">',
    'after'   => '</div></div>'
  ));
  echo '</div></div><div class="col-lg-4"><div class="wrap">';
  genesis_widget_area('testimonial-three', array(
    'before'  => '<div id="testimonial-three" class="testimonial-content widget-content"><div class="wrap">',
    'after'   => '</div></div>'
  ));
  echo '</div></div></div></div></section>';
  
}

genesis(); ?>
