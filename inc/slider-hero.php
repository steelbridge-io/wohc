<?php

/* Adds a slider/video banner to the front page. Uses Bootstrap css/js for the slider. Bootstrap is loaded on the
front page only. See functions php. */

add_action( 'customize_register', 'wohc_customize_register' );
function wohc_customize_register( $wp_customize ) {
  
  // Front Page Slider/Video Section
  $wp_customize->add_section('fp_top_slider', array(
    'title' => __('Front Page Slider/Video'),
    'priority' => 20,
    'active_callback' => 'is_front_page'
  ));
  
  // Video Setting
  $wp_customize->add_setting('fp-video', array(
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage'
  ));
  // Video Control
  $wp_customize->add_control(
    new WP_Customize_Control (
      $wp_customize,
      'fp-video',
      array(
        'label' => __('Hero Video'),
        'description' => __('Adds video banner to the Hero section. Delete this entry to enable slider images.'),
        'section' => 'fp_top_slider',
        'settings' => 'fp-video',
        'type' => 'text',
        'priority' => 10,
        'sanitize_callback' => 'wp_filter_nohtml_kses',
      )
    )
  );
  
  
  // Slider #1 Setting
  $wp_customize->add_setting('fp-topslider-one', array(
      'default' => '',
      'type' => 'theme_mod',
      'transport' => 'postMessage'
    )
  );
  // Slider #1 Control
  $wp_customize->add_control(
    new WP_Customize_Image_Control (
      $wp_customize,
      'fp-topslider-one',
      array(
        'label' 						=> __('Slider &#35;1 Image'),
        'description'       => __('Add an image. Appears in slider/hero banner.'),
        'section' 					=> 'fp_top_slider',
        'settings' 					=> 'fp-topslider-one',
        'priority' 					=> 10,
        'sanitize_callback' => 'esc_url_raw',
      )
    )
  );
  
  // Slider #2 Setting
  $wp_customize->add_setting('fp-topslider-two', array(
      'default' => '',
      'type' => 'theme_mod',
      'transport' => 'postMessage'
    )
  );
  // Slider #2 Control
  $wp_customize->add_control(
    new WP_Customize_Image_Control (
      $wp_customize,
      'fp-topslider-two',
      array(
        'label' 						=> __('Slider &#35;2 Image'),
        'description'       => __('Add an image. Appears in slider/hero banner.'),
        'section' 					=> 'fp_top_slider',
        'settings' 					=> 'fp-topslider-two',
        'priority' 					=> 10,
        'sanitize_callback' => 'esc_url_raw',
      )
    )
  );
  
  // Slider #3 Setting
  $wp_customize->add_setting('fp-topslider-three', array(
      'default' => '',
      'type' => 'theme_mod',
      'transport' => 'postMessage'
    )
  );
  // Slider #3 Control
  $wp_customize->add_control(
    new WP_Customize_Image_Control (
      $wp_customize,
      'fp-topslider-three',
      array(
        'label' 						=> __('Slider &#35;3 Image'),
        'description'       => __('Add an image. Appears in slider/hero banner.'),
        'section' 					=> 'fp_top_slider',
        'settings' 					=> 'fp-topslider-three',
        'priority' 					=> 10,
        'sanitize_callback' => 'esc_url_raw',
      )
    )
  );
}
