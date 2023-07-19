<?php

function codechallenge_theme_support(){
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'codechallenge_theme_support');

function codechallenge_register_styles(){
  $version = wp_get_theme()->get('Version');
  wp_enqueue_style('codechallenge-style', get_template_directory_uri() . "/style.css", $version, 'all' );
}

add_action('wp_enqueue_scripts', 'codechallenge_register_styles');

function codechallenge_register_scripts(){
	wp_enqueue_script('codechallenge-scripts', get_template_directory_uri() . "/assets/scripts/main.js", array(), '1.0' , true);
}
add_action('wp_enqueue_scripts', 'codechallenge_register_scripts');

function products_post_type(){
	$args = array(
		'labels' => array(
			'name' => 'Products',
			'singular_name' => 'Product',
		),
		'public' => true,
		'has_archive' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
		'menu_icon' => 'dashicons-cart',
	);
	register_post_type('products', $args);
}

add_action('init', 'products_post_type');

function products_taxonomy() {
	$labels = array(
			'name'                       => 'Product Categories',
			'singular_name'              => 'Product Category',
			'menu_name'                  => 'Product Categories',
			'all_items'                  => 'All Categories',
			'new_item_name'              => 'New Category Name',
			'add_new_item'               => 'Add New Category',
			'edit_item'                  => 'Edit Category',
			'update_item'                => 'Update Category',
			'separate_items_with_commas' => 'Separate categories with commas',
			'search_items'               => 'Search Categories',
			'add_or_remove_items'        => 'Add or remove categories',
			'choose_from_most_used'      => 'Choose from the most used categories',
	);

	$args = array(
			'labels'            => $labels,
			'hierarchical'      => true, 
			'public'            => true,
			'rewrite'           => array( 'slug' => 'product-category' ), 
			'show_admin_column' => true,
			'query_var'         => true,
	);

	register_taxonomy( 'product_category', 'products', $args );
}
add_action( 'init', 'products_taxonomy' );

// This forces the custom post type archive page to appear as the front page
add_action("pre_get_posts", "custom_front_page");
function custom_front_page($wp_query){
    if(is_admin()) {
        return;
    }

    if($wp_query->get('page_id') == get_option('page_on_front')):

        $wp_query->set('post_type', 'products');
        $wp_query->set('page_id', '');
        $wp_query->is_page = 0;
        $wp_query->is_singular = 0;
        $wp_query->is_post_type_archive = 1;
        $wp_query->is_archive = 1;
    endif;
}