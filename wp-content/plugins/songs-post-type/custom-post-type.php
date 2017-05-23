<?php

/**
 * @package Hello_Dolly
 * @version 1.6
 */
/*
Plugin Name: Songs Post Type
Plugin URI: http://github.com/brojask
Description: Creates the Songs Post Type - Supports Rest API Helpers.
Author: Bryan Rojas
Version: 1.0
Author URI: http://github.com/brojask
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// ADDING CUSTOM POST TYPE
add_action('init', 'init_custom_post_types');

function init_custom_post_types()
{
    
    $types = array(
        
        // Portfolio
        array(
            'the_type' => 'songs',
            'single' => 'Song',
            'plural' => 'Songs',
            'icon'  => 'dashicons-playlist-audio'
        ),
        
        /* #Add New Post Type
        array(
            'the_type' => 'careers',
            'single' => 'Career',
            'plural' => 'Careers',
            'icon'  => 'dashicons-media-text'
        ),*/
    );
    
    foreach ($types as $type) {
        
        $the_type = $type['the_type'];
        $single   = $type['single'];
        $plural   = $type['plural'];
        $icon   = $type['icon'];
        
        $labels = array(
            'name' => _x($plural, 'post type general name'),
            'singular_name' => _x($single, 'post type singular name'),
            'add_new' => _x('Add New', $single),
            'add_new_item' => __('Add New ' . $single),
            'edit_item' => __('Edit ' . $single),
            'new_item' => __('New ' . $single),
            'view_item' => __('View ' . $single),
            'search_items' => __('Search ' . $plural),
            'not_found' => __('No ' . $plural . ' found'),
            'not_found_in_trash' => __('No ' . $plural . ' found in Trash'),
            'parent_item_colon' => ''
        );
        
        $args = array(
            'labels' => $labels,
            'public' => true,
            'show_in_rest' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 5,
            'menu_icon' => $icon,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'page-attributes',
                'custom-fields'
            )
        );
        
        register_post_type($the_type, $args);
    }
}

#register_activation_hook( __FILE__, 'init_custom_post_types' );

add_action( 'init', 'create_tag_taxonomies', 0 );

function create_tag_taxonomies() 
{
  // Add new taxonomy, NOT hierarchical (like tags)

    $tags = array(
        
        // Portfolio
        array(
            'post_type' => 'songs',
            'category' => 'artist',
            'single' => 'Artist',
            'plural' => 'Artists'

        ),        
        array(
            'post_type' => 'songs',
            'category' => 'album',
            'single' => 'Album',
            'plural' => 'Albums'
        ),        
        // Services
        // array(
        //     'post_type' => 'services',
        //     'single' => 'Service',
        //     'plural' => 'Services',
        //     'icon'  => 'dashicons-feedback'
        // )
    );

    foreach ($tags as $tag) {
        
        $post_type = $tag['post_type'];
        $category   = $tag['category'];
        $single   = $tag['single'];
        $plural   = $tag['plural'];
        #$icon   = $type['icon'];
        $labels = array(
            'name' => _x( $plural, 'taxonomy general name' ),
            'singular_name' => _x( $single, 'taxonomy singular name' ),
            'search_items' =>  __( 'Search '.$plural ),
            'popular_items' => __( 'Popular '.$plural ),
            'all_items' => __( 'All '.$plural ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Edit '.$single ), 
            'update_item' => __( 'Update '.$single ),
            'add_new_item' => __( 'Add New '.$single ),
            'new_item_name' => __( 'New '.$single.' Name' ),
            'separate_items_with_commas' => __( 'Separate '.$plural.' with commas' ),
            'add_or_remove_items' => __( 'Add or remove '.$plural ),
            'choose_from_most_used' => __( 'Choose from the most used '.$plural ),
            'menu_name' => __( $plural ),
        ); 

        register_taxonomy($category, $post_type ,array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_rest' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => true,
        ));
    }
}

