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
use WordPlate\Acf\Fields\Group;
use WordPlate\Acf\Fields\WysiwygEditor;

/**
 * Cache les blocks Gutenberg qu'on utilise pas.
 */
function wpcc_allowed_block_types($allowed_block_types, $post) {
  // if ( $post->post_type === 'post' ) {
  //   return array(
  //     'core/paragraph', // Paragraph Block
  //   );
  // } else {
    return array(
      'acf/banniere',
      'acf/hero',
      'acf/services',
      'acf/produits',
      'core/paragraph',
    );
  // }
}
add_filter( 'allowed_block_types_all', 'wpcc_allowed_block_types', 10, 2 );

if (!function_exists('register_extended_field_group')) {
  return;
}

add_action('acf/init', 'my_acf_init_blocks');

function my_acf_init_blocks() {
  /**
   * Hero Gutenberg Block.
   */
  acf_register_block_type([
    'name' => 'Hero',
    'title' => __('Hero'),
    'description' => __('Le bloc qui apparait juste en dessous du menu.'),
    'render_callback' => 'ice_cream_hero_block_render_callback',
    'category' => 'theme',
    'post_type' => array('page'),
    'mode' => 'auto',
    'align' => 'full',
    'icon' => 'table-row-after', // https://developer.wordpress.org/resource/dashicons/
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
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;
    Timber::render( 'blocks/hero.twig', $context );
  }

  /**
   * Services Gutenberg Block.
   */
  acf_register_block_type([
    'name' => 'Services',
    'title' => __('Services'),
    'description' => __('Le bloc listant 4 services.'),
    'render_callback' => 'ice_cream_services_block_render_callback',
    'category' => 'theme',
    'post_type' => array('page'),
    'mode' => 'auto',
    'align' => 'full',
    'icon' => 'editor-ul', // https://developer.wordpress.org/resource/dashicons/
  ]);

  register_extended_field_group([
    'title' => 'Services bloc',
    'location' => [
      Location::if('block', 'acf/services')
    ],
    'fields' => [
      Group::make('1er Service')
        ->instructions('Ajouter les informations du 1er service')
        ->fields([
          Image::make('Image')
            ->instructions('Ajouter l\'image du service.')
            ->required(),
          Text::make('Titre')
            ->instructions('L\'intitulé du service.')
            ->required(),
          Textarea::make('Description')
            ->instructions('La description du service.')
            ->required(),
        ])
        ->layout('block')
        ->required(),
      Group::make('2eme Service')
        ->instructions('Ajouter les informations du 2eme service')
        ->fields([
          Image::make('Image')
            ->instructions('Ajouter l\'image du service.')
            ->required(),
          Text::make('Titre')
            ->instructions('L\'intitulé du service.')
            ->required(),
          Textarea::make('Description')
            ->instructions('La description du service.')
            ->required(),
        ])
        ->layout('block')
        ->required(),
      Group::make('3eme Service')
        ->instructions('Ajouter les informations du 3eme service')
        ->fields([
          Image::make('Image')
            ->instructions('Ajouter l\'image du service.')
            ->required(),
          Text::make('Titre')
            ->instructions('L\'intitulé du service.')
            ->required(),
          Textarea::make('Description')
            ->instructions('La description du service.')
            ->required(),
        ])
        ->layout('block')
        ->required(),
      Group::make('4eme Service')
        ->instructions('Ajouter les informations du 4eme service')
        ->fields([
          Image::make('Image')
            ->instructions('Ajouter l\'image du service.')
            ->required(),
          Text::make('Titre')
            ->instructions('L\'intitulé du service.')
            ->required(),
          Textarea::make('Description')
            ->instructions('La description du service.')
            ->required(),
        ])
        ->layout('block')
        ->required(),
    ]
  ]);

  function ice_cream_services_block_render_callback( $block, $content = '', $is_preview = false ) {
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;
    Timber::render( 'blocks/services.twig', $context );
  }

  /**
   * Simple Banner Gutenberg Block.
   */
  acf_register_block_type([
    'name' => 'Banniere',
    'title' => __('Banniere simple'),
    'description' => __('Une banniere simple (texte à gauche / Image à droite).'),
    'render_callback' => 'ice_cream_simple_banner_block_render_callback',
    'category' => 'theme',
    'post_type' => array('page'),
    'mode' => 'auto',
    'align' => 'full',
    'icon' => 'slides', // https://developer.wordpress.org/resource/dashicons/
  ]);

  register_extended_field_group([
    'title' => 'Banniere bloc',
    'location' => [
      Location::if('block', 'acf/banniere')
    ],
    'fields' => [
      Text::make('Titre')
        ->instructions('Le titre.')
        ->required(),
      WysiwygEditor::make('Contenu')
        ->instructions('Le contenu ici.')
        ->mediaUpload(false)
        ->toolbar('Basic')
        ->required(),
      Image::make('Image')
        ->instructions('Ajouter l\'image de droite ici.')
        ->required(),
    ]
  ]);

  function ice_cream_simple_banner_block_render_callback( $block, $content = '', $is_preview = false ) {
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;
    Timber::render( 'blocks/banner.twig', $context );
  }

  /**
   * Simple Produits Gutenberg Block.
   */
  acf_register_block_type([
    'name' => 'Produits',
    'title' => __('Produits'),
    'description' => __('Bloc qui liste les produits.'),
    'render_callback' => 'ice_cream_products_block_render_callback',
    'category' => 'theme',
    'post_type' => array('page'),
    'mode' => 'auto',
    'align' => 'full',
    'icon' => 'editor-ol', // https://developer.wordpress.org/resource/dashicons/
  ]);

  register_extended_field_group([
    'title' => 'Produits bloc',
    'location' => [
      Location::if('block', 'acf/produits')
    ],
    'fields' => [
      Text::make('Titre')
        ->instructions('Le titre.')
        ->required()
    ]
  ]);

  function ice_cream_products_block_render_callback( $block, $content = '', $is_preview = false ) {
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;
    Timber::render( 'blocks/products.twig', $context );
  }
}

/**
 * Rajoute le context dans timber
 * Permet d'avoir tous les blocks
 */
add_filter('timber_context', 'bt_timber_add_to_context');
function bt_timber_add_to_context ($context) {
    // add current page content
    $context['page'] = Timber::get_post();

    return $context;
}