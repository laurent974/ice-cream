<?php

/**
 * Plugin Name:       Custom BO
 * Description:       Plugin permettant de customiser le BO.
 * Version:           1.0
 * Author:            Laurent
 * Author URI:        https://github.com/laurent974
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path:       languages/
*/

use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;

if (!function_exists('register_extended_field_group')) {
  return;
}

add_action('acf/init', 'my_acf_init_blocks');

function my_acf_init_blocks() {

acf_register_block_type([
  'name' => 'Hero',
  'title' => __('Hero'),
  'description' => __('Le bloc qui apparait juste en dessous du menu.'),
  // 'render_template' => get_theme_file_path('blocks/hero.php'),
  'render_callback' => 'ice_cream_hero_block_render_callback',
  'category' => 'theme',
  'post_type' => array('page'),
  'mode' => 'auto',
  'align' => 'full',
  'icon' => 'admin-users', // https://developer.wordpress.org/resource/dashicons/
]);

register_extended_field_group([
  'title' => 'Hero bloc',
  'location' => [
    Location::if('block', 'acf/hero')
  ],
  'fields' => [
    Text::make('Slogan')
      ->instructions('Le slogan au dessus du titre.')
      ->required(),
    Text::make('Titre')
      ->instructions('Le titre.')
      ->required(),
    Textarea::make('Contenu')
      ->instructions('Le contenu ici.')
      ->required(),
    Image::make('Image')
      ->instructions('Ajouter l\'image de droite ici.')
      ->required(),
  ]
]);

function ice_cream_hero_block_render_callback( $block, $content = '', $is_preview = false ) {
  $context = Timber::context();

  // Store block values.
  $context['block'] = $block;

  // Store field values.
  $context['fields'] = get_fields();

  // Store $is_preview value.
  $context['is_preview'] = $is_preview;

  // Render the block.
  Timber::render( 'blocks/hero.twig', $context );
}
}