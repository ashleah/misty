<?php function misty_customize_register($wp_customize) {

  $wp_customize->add_section( 'misty_options', array(
    'title' => __( 'Misty Options' ),
    'description' => __( '' ),
    'priority' => 160,
  ) );

  $wp_customize->add_setting( 'twitch_profile');
  $wp_customize->add_control( 'twitch_profile', array(
    'type' => 'text',
    'priority' => 10, // Within the section.
    'section' => 'misty_options', // Required, core or custom.
    'label' => __( 'Twitch Profile' ),
    'description' => __( 'Add your twitch profile to show the stream and follow button for your readers.' ),
  ) );

  $wp_customize->add_setting( 'youtube_profile');
  $wp_customize->add_control( 'youtube_profile', array(
    'type' => 'text',
    'priority' => 20, // Within the section.
    'section' => 'misty_options', // Required, core or custom.
    'label' => __( 'YouTube Profile' ),
    'description' => __( 'Add your youtube profile to show the follow button for your readers.' ),
  ) );

  $wp_customize->add_setting( 'twitter_profile');
  $wp_customize->add_control( 'twitter_profile', array(
    'type' => 'text',
    'priority' => 30, // Within the section.
    'section' => 'misty_options', // Required, core or custom.
    'label' => __( 'Twitter Profile' ),
    'description' => __( 'Add your twitter profile to show the follow button for your readers.' ),
  ) );

  $wp_customize->add_setting( 'tumblr_profile');
  $wp_customize->add_control( 'tumblr_profile', array(
    'type' => 'text',
    'priority' => 40, // Within the section.
    'section' => 'misty_options', // Required, core or custom.
    'label' => __( 'Tumblr Profile' ),
    'description' => __( 'Add your tumblr profile to show the follow button for your readers.' ),
  ) );


} add_action('customize_register', 'misty_customize_register'); ?>
