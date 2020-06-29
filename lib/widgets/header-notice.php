<?php

// Creates Notice Widget. Renders on front page.
class notice_widget extends WP_Widget {

// The construct part
  function __construct() {
    parent::__construct(
      'notice_widget',
      
      __('Header Notice', 'west_oakland_health'),
      array('description' => __('Located on the front page, this is a customizable notice.', 'west_oakland_health' ), )
    );
  
  }

// Widget front-end
  public function widget( $args, $instance ) {
    $title = apply_filters('notice_widget',
    $instance['title'] );
    
    echo $args['before_widget'];
    if( !empty($title) )
      echo $args['before_title'] . $title .
        $args['after_title'];
    
    echo __('Hello, World!', 'west_oakland_health');
    echo $args['after_widget'];
  }

// Widget Backend
  public function form( $instance ) {
    if ( isset( $instance['title']) ) {
      $title = $instance['title'];
    } else {
      $title = __('New title', 'west_oakland_health');
    } ?>
  <p>
    <label for = "<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
    <input class="widefat notice-header" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php esc_attr($title); ?>" />
  </p>
<?php
  
  }

// Updating widget replacing old instances with new
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty(
      $new_instance['title'] ) ) ? strip_tags(
        $new_instance['title']
    ) : '';
  return $instance;
  }

// Class notice_widget ends here
}

function notice_fp_widget() {
  register_widget('notice_widget');
}
add_action('widgets_init', 'notice_fp_widget');
