<?php
/**
 * Declare custom post types for the theme.
 * Yes, this is "supposed" to be in a plugin. ¯\_(ツ)_/¯
 *
 * @package pitchfork-customize
 */

/**
 * CPT: 'program'
 * TAX: 'program_emphasis'
 */

add_action( 'init', 'pitchfork_customize_create_program_cpt', 0 );
function pitchfork_customize_create_program_cpt() {

	// Icon: binary-circle-check, Font Awesome Pro 6.6.0 by @fontawesome
	$cpticon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="#9ca1a8" d="M320 16c0-5.1-2.5-10-6.6-13s-9.5-3.8-14.4-2.2l-48 16c-8.4 2.8-12.9 11.9-10.1 20.2s11.9 12.9 20.2 10.1l26.9-9L288 192l-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l64 0 64 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0 0-176zM96 304c0-5.1-2.5-10-6.6-13s-9.5-3.8-14.4-2.2l-48 16c-8.4 2.8-12.9 11.9-10.1 20.2s11.9 12.9 20.2 10.1l26.9-9L64 480l-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l64 0 64 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0 0-176zM0 80l0 64c0 44.2 35.8 80 80 80l32 0c44.2 0 80-35.8 80-80l0-64c0-44.2-35.8-80-80-80L80 0C35.8 0 0 35.8 0 80zM80 32l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48l0-64c0-26.5 21.5-48 48-48zM272 288c-44.2 0-80 35.8-80 80l0 64c0 44.2 35.8 80 80 80l32 0c24 0 45.6-10.6 60.2-27.3c-7.4-8.3-14-17.3-19.7-27C336 471.1 321.1 480 304 480l-32 0c-26.5 0-48-21.5-48-48l0-64c0-26.5 21.5-48 48-48l32 0c7.6 0 14.9 1.8 21.3 5c2.6-10.5 6.2-20.7 10.7-30.3c-9.8-4.3-20.6-6.6-32-6.6l-32 0zm224-32a112 112 0 1 1 0 224 112 112 0 1 1 0-224zm0 256a144 144 0 1 0 0-288 144 144 0 1 0 0 288zm67.3-187.3c-6.2-6.2-16.4-6.2-22.6 0L480 385.4l-28.7-28.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l40 40c6.2 6.2 16.4 6.2 22.6 0l72-72c6.2-6.2 6.2-16.4 0-22.6z"/></svg>';

	$labels = array(
		'name'                  => 'Programs',
		'singular_name'         => 'Program',
		'menu_name'             => 'Programs',
		'name_admin_bar'        => 'Program',
		'archives'              => 'Program Archives',
		'attributes'            => 'Program Attributes',
		'parent_item_colon'     => 'Parent Program:',
		'all_items'             => 'All Programs',
		'add_new_item'          => 'Add New Program',
		'add_new'               => 'Add New',
		'new_item'              => 'New Program',
		'edit_item'             => 'Edit Program',
		'update_item'           => 'Update Program',
		'view_item'             => 'View Program',
		'view_items'            => 'View Programs',
		'search_items'          => 'Search Program',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Card Image',
		'set_featured_image'    => 'Set card image',
		'remove_featured_image' => 'Remove card image',
		'use_featured_image'    => 'Use as card image',
		'insert_into_item'      => 'Insert into Program',
		'uploaded_to_this_item' => 'Uploaded to this program',
		'items_list'            => 'Programs list',
		'items_list_navigation' => 'Programs list navigation',
		'filter_items_list'     => 'Filter programs list',
	);
	$args = array(
		'label'                 => 'Program',
		'description'           => 'Programs for students',
		'menu_icon' 			=> 'data:image/svg+xml;base64,' . base64_encode($cpticon),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'revisions', 'page-attributes' ),
		'taxonomies'            => array( 'program_emphasis' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
	);
	register_post_type( 'program', $args );

}


add_action( 'init', 'pitchfork_customize_create_program_emphais_tax', 0 );
function pitchfork_customize_create_program_emphais_tax() {

	$labels = array(
		'name'                       => 'Emphases',
		'singular_name'              => 'Emphasis',
		'menu_name'                  => 'Emphasis',
		'all_items'                  => 'All Emphases',
		'parent_item'                => 'Parent Emphasis',
		'parent_item_colon'          => 'Parent Emphasis:',
		'new_item_name'              => 'New Emphasis Name',
		'add_new_item'               => 'Add New Emphasis',
		'edit_item'                  => 'Edit Emphasis',
		'update_item'                => 'Update Emphasis',
		'view_item'                  => 'View Emphasis',
		'separate_items_with_commas' => 'Separate emphases with commas',
		'add_or_remove_items'        => 'Add or remove emphases',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Emphases',
		'search_items'               => 'Search Emphases',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No emphases',
		'items_list'                 => 'Emphases list',
		'items_list_navigation'      => 'Emphases list navigation',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'program_emphasis', array( 'program' ), $args );

}
