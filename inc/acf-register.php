<?php
/**
 * Additional functions for Advanced Custom Fields.
 *
 * Contents:
 *   - Load path for ACF groups from the parent.
 *   - Register custom blocks for the theme.
 *
 * @package pitchfork-child
 */

/**
 * Add additional loading point for the parent theme's ACF groups.
 *
 * @return $paths
 */
function pitchfork_customize_load_parent_theme_field_groups( $paths ) {
	$path = get_template_directory() . '/acf-json';
	$paths[] = $path;
	return $paths;
}
add_filter( 'acf/settings/load_json', 'pitchfork_customize_load_parent_theme_field_groups' );

/**
 * Create save point for the child theme's ACF groups.
 *
 * @return $path
 */
function pitchfork_customize_field_groups( $path ) {
	$path = get_stylesheet_directory() . '/acf-json';
	return $path;
}
add_filter( 'acf/settings/save_json', 'pitchfork_customize_field_groups' );


/**
 * Register additional custom blocks for the theme.
 */
function pitchfork_customize_acf_init_block_types() {

	// Array of block folders to use. Each contains a block.json file.
	$block_includes = array(
		// '/program-carousel',        // Card carousel, powered by program CPT
		'/program-output',        	// Output of user selections, captures email body text
		'/program-card', 			// Individual program cards. Checkboxes included.
	);

	// Loop through array items and register each block.
	foreach ( $block_includes as $folder ) {
		register_block_type( get_stylesheet_directory() . '/acf-block-templates' . $folder );
	}

}
add_action( 'acf/init', 'pitchfork_customize_acf_init_block_types' );

