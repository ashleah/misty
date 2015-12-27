<?php

class Follow_Buttons extends WP_Widget {

  /**
   * Sets up the widgets name etc
   */
  public function __construct() {
    // widget actual processes
    parent::__construct(
			'follow_button', // Base ID
			__( 'Follow Buttons', 'text_domain' ), // Name
			array(
        'description' => __( 'Show buttons to your different social accounts', 'misty' ),
      ) // Args
		);
  }

  /**
   * Outputs the content of the widget
   *
   * @param array $args
   * @param array $instance
   */
  public function widget( $args, $instance ) {

    echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
    // outputs the content of the widget
    if ( get_theme_mod('twitch_profile') != '' ) {
      echo '<a href="http://www.twitch.tv/' . get_theme_mod('twitch_profile') . '" target="_blank" class="follow twitch">';
      echo '<img src="' . get_stylesheet_directory_uri() . '/img/twitch-icon.png" alt="twitch icon" class="follow-icon">';
      echo '<span class="follow-name">';
      echo get_theme_mod('twitch_profile');
      echo '</span>';
      echo '</a>';
    }

    if ( get_theme_mod('youtube_profile') != '' ) {
      echo '<a href="https://www.youtube.com/c/' . get_theme_mod('youtube_profile') . '" target="_blank" class="follow youtube">';
      echo '<img src="' . get_stylesheet_directory_uri() . '/img/youtube-icon.png" alt="youtube icon" class="follow-icon">';
      echo '<span class="follow-name">';
      echo get_theme_mod('youtube_profile');
      echo '</span>';
      echo '</a>';
    }

    if ( get_theme_mod('twitter_profile') != '' ) {
      echo '<a href="https://www.twitter.com/' . get_theme_mod('twitter_profile') . '" target="_blank" class="follow twitter">';
      echo '<img src="' . get_stylesheet_directory_uri() . '/img/twitter-icon.png" alt="twitter icon" class="follow-icon">';
      echo '<span class="follow-name">';
      echo get_theme_mod('twitter_profile');
      echo '</span>';
      echo '</a>';
    }

    if ( get_theme_mod('tumblr_profile') != '' ) {
      echo '<a href="https://www.' . get_theme_mod('tumblr_profile') . 'tumblr.com/" target="_blank" class="follow tumblr">';
      echo '<img src="' . get_stylesheet_directory_uri() . '/img/tumblr-icon.png" alt="tumblr icon" class="follow-icon">';
      echo '<span class="follow-name">';
      echo get_theme_mod('tumblr_profile');
      echo '</span>';
      echo '</a>';
    }

		echo $args['after_widget'];
  }

  /**
   * Outputs the options form on admin
   *
   * @param array $instance The widget options
   */
   public function form( $instance ) {
 		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Follow Me', 'misty' );
 		?>
 		<p>
 		   <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
 		    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
 		</p>
    <p><?php _e('You can add social accounts in the cuztomizer.', 'misty'); ?></p>
 		<?php
 	}

  /**
   * Processing widget options on save
   *
   * @param array $new_instance The new options
   * @param array $old_instance The previous options
   */
  public function update( $new_instance, $old_instance ) {
    // processes widget options to be saved
    $instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
  }
}

function misty_register_widgets() {
	register_widget( 'Follow_Buttons' );
}

add_action( 'widgets_init', 'misty_register_widgets' );

?>
