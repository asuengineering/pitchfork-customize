<?php
/**
 * Pitchfork Customize - Program Card
 *
 * @package Pitchfork Customize
 * @author Steve Ryan
 *
 * Render a selected program as a checkbox card.
 * Card data drawn from programs custom post type within this theme.
 */

$card  = get_field( 'customize_program' );

if (! empty ($block['anchor'])) {
	$anchor = $block['anchor'];
} else {
	$anchor = '';
}

do_action('qm/debug', $card);

/**
 * Additional margin/padding settings
 * Returns a string for inclusion with style=""
 */
if (function_exists('pitchfork_blocks_acf_calculate_spacing')) {
	$spacing = pitchfork_blocks_acf_calculate_spacing( $block );
} else {
	$spacing = '';
}

/**
 * Get additional class names from block advanced panel.
 * Don't forget to support HTML named anchor!
 */

$card_classes = array( 'card', 'card-checkbox-stacked' );

if ( ! empty( $block['className'] ) ) {

	// Assume that there is more than one class in the "roll your own CSS" field separated by a space.
	$class_setting = explode(' ', $block['className']);

	// Remove the is-style prefix from the block style before adding to array.
	foreach ($class_setting as $setting) {
		$card_classes[] = $setting;
	}
}


/**
 * Create card based on ACF field selection.
 */

$inner = '';

if( $card ) {

	$title 			= get_the_title( $card->ID );
	$slug			= $card->post_name;

	$formID 		= 'card-' . $slug;
	if ($anchor) {
		$formID = 'card-' . $anchor;
	}

	$prog_desc 		= get_field( 'program_description', $card->ID );
	$prog_online 	= get_field( 'program_online', $card->ID );
	$prog_link 		= get_field( 'program_link', $card->ID );
	$prog_image 	= get_field( 'program_image', $card->ID );

	// Build unordered list of card emphases terms as card tags/badges.
	$emphasis_terms = wp_get_post_terms(  $card->ID, 'program_emphasis' );
	if ( !empty( $emphasis_terms ) && !is_wp_error( $emphasis_terms ) ) {

		$emph_list = '<div class="card-tags">';
		// Loop through each term, produce the correct <li> for the list.
		foreach ( $emphasis_terms as $term ) {
			$emph_list .= '<span class="badge text-bg-gray-2">' . $term->name . '</span>';
		}

		$emph_list .= '</div>';

	}

	// Assemble individual card.
	$inner .= '<div class="card-image-content">';
	$inner .= '<div class="card-image-gradient checkbox-card">';
	$inner .= wp_get_attachment_image( $prog_image, 'large', false, array( 'class' => 'card-img-top' ) );
	$inner .= '</div>';

	// Include data-year and data-slug attributes on each form element?
	$inner .= '<form class="uds-form card-image-overlay-content ms-4" data-slug="' . $slug . '"><fieldset class="card-image-fieldset">';
	$inner .= '<div class="form-check"><input class="form-check-input" type="checkbox" id="' . $formID . '" value="added">';
	$inner .= '<label class="form-check-label" for="' . $formID . '">Add to my plan</label></div>';
	$inner .= '</fieldset></form>';
	$inner .= '</div>';

	$inner .= '<div class="card-header"><h3 class="card-title">' . $title . '</h3></div>';

	$inner .= '<div class="card-body"><p class="card-text program-description">' . $prog_desc . '</p></div>';

	$inner .= '<div class="card-link"><a class="read-more" href="' . $prog_link['url'] . '" target="_blank">Read more</a>';
	$inner .= '<span class="fas fa-external-link-alt"></span></div>';

	$inner .= $emph_list;

} else {
	$inner = '<div class="card-body"><p class="card-text">Please select a program.</p></div>';
}


/**
 * Output the card
 */

echo '<div id="' . $anchor . '" class="' . implode( ' ', $card_classes ) . '" style="' . $spacing . '">';
echo $inner;
echo '</div>';
