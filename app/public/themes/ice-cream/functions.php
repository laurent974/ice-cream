<?php
  /*
   * Initalize Timber.
  */

  $timber = new \Timber\Timber();
  // \Timber\Timber::$autoescape = true;

  function allowed_blocks( $allowed_block_types, $post ) {
    // Test du type de publication (facultatif)
    if ( $post->post_type !== 'post' ) {
      return $allowed_block_types;
    }

    // Ici on n'autorise que le paragraphe et l'image
    return [ 'core/paragraph', 'core/image' ];
  }

  add_filter('timber_context', 'bt_timber_add_to_context');
  function bt_timber_add_to_context ($context) {
      // add current page content
      $context['page'] = Timber::get_post();

      return $context;
  }

  add_filter( 'allowed_block_types', 'allowed_blocks', 10, 2 );

  add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

    register_nav_menus([
      'navigation' => __('Navigation'),
    ]);
  });
