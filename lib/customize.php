<?php
/**
 * Kreativ Pro.
 *
 * This file adds the Customizer additions to the Kreativ Pro Theme.
 *
 * @package Kreativ
 * @author  ThemeSquare
 * @license GPL-2.0+
 * @link    http://themesquare.com/themes/kreativ/
 */

add_action( 'customize_register', 'kreativ_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function kreativ_customizer_register() {
  
  global $wp_customize;
  
  // Background image sections
  $bgimages = apply_filters( 'kreativ_images', array( '1' ) ); // Section IDs
  
  // Adds Text if Custom Logo isn't used
  $wp_customize->add_setting(
    'wohc_cta_nav',
    array(
      'default' => '',
      'type' => 'theme_mod', // you can also use 'theme_mod'
      'capability' => 'edit_theme_options'
    ),
    );
  
  $wp_customize->add_control( new WP_Customize_Control(
    $wp_customize,
    'wohc_cta_nav',
    array(
      'label'      => __( 'CTA Text', 'kreativ-pro' ),
      'description' => __( 'Appears if logo is not used.', 'kreativ-pro' ),
      'settings'   => 'wohc_cta_nav',
      'priority'   => 11,
      'section'    => 'title_tagline',
      'type'       => 'text',
    )
  ) );
  
  // Front Page Images section
  $wp_customize->add_section( 'kreativ-settings', array(
    'description' => __( 'Upload image or use the default image.<br />Default image size: <strong>1600 x 1050 px</strong>.', 'kreativ-pro' ),
    'title'    => __( 'Front Page Images', 'kreativ-pro' ),
    'priority' => 35
  ) );
  
  // Background image settings
  foreach( $bgimages as $bgimage ){
    
    $wp_customize->add_setting( 'kreativ-image-'. $bgimage, array(
      'default'  => sprintf( '%s/images/bg-%s.jpg', get_stylesheet_directory_uri(), $bgimage ),
      'type'     => 'option',
      'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control(
      new WP_Customize_Image_Control( $wp_customize, 'kreativ-image-'. $bgimage,
        array(
          'label'    => sprintf( __( 'Section %s Image:', 'kreativ-pro' ), $bgimage ),
          'section'  => 'kreativ-settings',
          'settings' => 'kreativ-image-'. $bgimage,
          'priority' => $bgimage + 1
        )
      )
    );
    
  }
  
  // Accent color settings
  $wp_customize->add_setting( 'kreativ_accent_color',	array(
    'default' => kreativ_customizer_default_accent_color(),
    'sanitize_callback' => 'sanitize_hex_color'
  ) );
  
  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'kreativ_accent_color',
      array(
        'description' => __( 'Change theme accent color', 'kreativ-pro' ),
        'label'     => __( 'Accent Color', 'kreativ-pro' ),
        'section'   => 'colors',
        'settings'  => 'kreativ_accent_color'
      )
    )
  );
  
  // Notice Bar Colors
  $wp_customize->add_section( 'notice_bar_section' , array(
    'title'      => __( 'Notice Bar', 'kreativ-pro' ),
    'priority'   => 10,
  ) );
  
  $wp_customize->add_setting( 'notice_bar_bg_color',	array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ) );
  
  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'notice_bar_bg_color',
      array(
        'description' => __( 'Change background color', 'kreativ-pro' ),
        'label'     => __( 'Notice Bar Background Color', 'kreativ-pro' ),
        'section'   => 'notice_bar_section',
        'settings'  => 'notice_bar_bg_color'
      )
    )
  );
  
  $wp_customize->selective_refresh->add_partial( 'notice_bar_bg_color', array(
      'selector' => '.notice-bar .wrap',
      'settings' => 'notice_bar_bg_color',
      'render_callback' => function() {
        return get_theme_mod('notice_bar_bg_color');
      },
    )
  );
  
  // Notice Bar Font Colors
  $wp_customize->add_setting( 'notice_bar_font_color',	array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
  ));
  
  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'notice_bar_font_color',
      array(
        'description' => __( 'Change font color', 'kreativ-pro' ),
        'label'     => __( 'Notice Bar Font Color', 'kreativ-pro' ),
        'section'   => 'notice_bar_section',
        'settings'  => 'notice_bar_font_color'
      )
    )
  );
  
  $wp_customize->selective_refresh->add_partial( 'notice_bar_font_color', array(
      'selector' => '.notice-content',
      'settings' => 'notice_bar_font_color',
      'render_callback' => function() {
        return get_theme_mod('notice_bar_font_color');
      },
    )
  );
  
  $wp_customize->add_setting( 'notice_bar_scroll_check', array(
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'themeslug_sanitize_checkbox',
  ));
  
  $wp_customize->add_control( 'notice_bar_scroll_check', array(
      'type' => 'checkbox',
      'section' => 'notice_bar_section', // Add a default or your own section
      'label' => __( 'Activate Text Scroll In Notice Bar' ),
      'settings'  => 'notice_bar_scroll_check',
      'description' => __( 'Add content in Widget area.' ),
    )
  );
  
  function themeslug_sanitize_checkbox( $checked ) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
  }
  
  // Add theme layout setting to the Customizer
  $wp_customize->add_section( 'kreativ_sticky_header_section', array(
    'title'				=> __( 'Sticky Header', 'kreativ-pro' ),
    'description'	=> __( 'Choose if you would like to display sticky header fixed to the top of page.', 'kreativ-pro' ),
    'priority'		=> 80.01,
  ));
  
  // Add theme layout setting to the Customizer
  $wp_customize->add_setting( 'kreativ_sticky_header', array(
    'capability'	=> 'edit_theme_options',
    'type'				=> 'option',
    'default'			=> '',
  ));
  
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize, 'kreativ_sticky_header', array(
      'label'				=> __( 'Sticky Header', 'kreativ-pro' ),
      'section'			=> 'kreativ_sticky_header_section',
      'settings'		=> 'kreativ_sticky_header',
      'type'        => 'radio',
      'choices'     => array(
        ''   	  => __( 'Enable', 'kreativ-pro' ),
        'disable'  => __( 'Disable', 'kreativ-pro'),
      ),
    ))
  );
}
