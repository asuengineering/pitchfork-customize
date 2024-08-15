<?php
/**
 * Pitchfork child theme functions
 *
 * @package pitchfork-child
 */

 // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require get_stylesheet_directory() . '/inc/enqueue-assets.php';
require get_stylesheet_directory() . '/inc/custom-post-types.php';
require get_stylesheet_directory() . '/inc/acf-register.php';

// add_action( 'gform_pre_submission_1', 'pitchfork_customize_pre_submission_handler' );
// function pitchfork_customize_pre_submission_handler( $form ) {
// 	do_action('qm/debug', $form);
//     $_POST['input_4'] = 'This is the programmatic value for the field.';
// }

// Allows for a merge tag modifier called "decode" to unencode HTML output in a notification.
// See: https://community.gravityforms.com/t/html-in-notification-merge-tag-sanitized-table-lt-table-gt-resolved/15525/7
add_filter( 'gform_merge_tag_filter' , function ( $value , $merge_tag , $modifier , $field , $raw_value , $format ) {

	if ( $merge_tag != 'all_fields' && $modifier == 'decode' ) {
		$value = htmlspecialchars_decode( $value );
	}

	return $value ;

}, 10, 6 );
