<?php
/*
Plugin Name: Total Users Registered
Plugin URI: http://www.ilwebmaster21.it/wordpress-total-user-registered-widget/
Version: 1.0
Description: Show total Users Registered on Widget
Author: Vittorio Li Mandri
Author URI: http://ilwebmaster21.it/
*/
 
class User_Registered extends WP_Widget
{
  function User_Registered()
  {
    $widget_ops = array('classname' => 'User_Registered', 'description' => 'Show total Users Registered on Widget');
    $this->WP_Widget('User_Registered', 'Total Users Registered', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args((array) $instance, array( 'title' => '' ));
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Titolo: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;
    
    //Get user Registered
    
    global $wpdb;
    $user_count = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
    echo "<div style=text-align:center;width:200px;><h2>$user_count</h2></div>";     
    
    echo $after_widget;    
    }    
}
add_action( 'widgets_init', create_function('', 'return register_widget("User_Registered");') );    
?>
