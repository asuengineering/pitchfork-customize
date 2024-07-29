<?php
/**
 * Pitchfork Customize - Program Carousel
 *
 * @package Pitchfork Customize
 * @author Steve Ryan
 *
 * A block that renders a series of selectable cards in a carousel.
 * Card data drawn from programs custom post type within this theme.
 * Block icon via FA 6: rectangle-vertical-history
 */

$cards  = get_field( 'customize_carousel_includes' );
// do_action('qm/debug', $block);
// do_action('qm/debug', $cards);

/**
 * Create an array of emphasis_icons and their associated FA icons.
 * Better than doing this inside the loop to follow - each icon will be retreived once.
 */
$emphasis_icons = array();
$emphasis_terms = get_terms( array(
	'taxonomy' => 'program_emphasis',
	'hide-empty' => true,
));

foreach ($emphasis_terms as $focus) {
	// do_action('qm/debug', $focus);
	$emph_icon 		= get_field( 'emphasis_icon', $focus );
	$emphasis_icons[$focus->term_id] = '<span class="fa-li ' . $emph_icon . '"></span>';
}

/**
 * Create card deck based on ACF field choices for block.
 */

if( $cards ) {

	$deck = '<div class="deck">';

	foreach( $cards as $card ) {
        $title 			= get_the_title( $card->ID );
		$slug			= $card->post_name;
		$formID 		= $block['anchor'] . '-' . $slug;

        $prog_desc 		= get_field( 'program_description', $card->ID );
		$prog_online 	= get_field( 'program_online', $card->ID );
		$prog_link 		= get_field( 'program_link', $card->ID );
		$prog_image 	= get_field( 'program_image', $card->ID );

		// Build unordered list of card emphases and icons.
		$emphasis_terms = wp_get_post_terms(  $card->ID, 'program_emphasis' );

		if ( !empty( $emphasis_terms ) && !is_wp_error( $emphasis_terms ) ) {

			$emph_list = '<ul class="uds-list fa-ul">';

			// Loop through each term, produce the correct <li> for the list.
			foreach ( $emphasis_terms as $term ) {
				$emph_list .= '<li>' . $emphasis_icons[$term->term_id] . $term->name . '</li>';
			}

			$emph_list .= '</ul>';

		}
		do_action('qm/debug', $emph_list);
		$deck .= '<div class="card">';

		$deck .= wp_get_attachment_image( $prog_image, 'large', false, array( 'class' => 'card-img-top' ) );

		$deck .= '<div class="card-header">';
		$deck .= '<h3 class="card-title">' . $title . '</h3>';
		$deck .= '<form class="card-checkmark" data-year="' . $block['anchor'] . '" data-slug="' . $slug . '">';
		$deck .= '<input class="sr-only sr-only-focusable" type="checkbox" name="' . $formID . '">';
		$deck .= '<label class="unselected" for="' . $formID . '"><span class="fa-regular fa-circle"></span></label>';
		$deck .= '<label class="selected" for="' . $formID . '"><span class="fa-regular fa-circle-check"></span></label>';
		$deck .= '</form></div>';

		$deck .= '<div class="card-body">';
		$deck .= '<p class="card-text">' . $prog_desc . '</p>';
		$deck .= '<p class="card-text"><a class="read-more" href="' . $prog_link['url'] . '" target="_blank">Read more</a>';
		$deck .= '<span class="fas fa-external-link-alt"></span></p>';
		$deck .= '<p class="card-text">' . $emph_list . '</p>';
		$deck .= '</div>';

		$deck .= '</div>';

	}

	$deck .= '</div>';
}


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

$carousel_classes = array( 'program-carousel', 'carousel' );

if ( ! empty( $block['className'] ) ) {

	// Assume that there is more than one class in the "roll your own CSS" field separated by a space.
	$class_setting = explode(' ', $block['className']);

	// Remove the is-style prefix from the block style before adding to array.
	foreach ($class_setting as $setting) {
		$carousel_classes[] = $setting;
	}
}


/**
 * Output the carousel.
 */
echo '<div id="' . $block['anchor'] . '" class="' . implode( ' ', $carousel_classes ) . '" style="' . $spacing . '">';
echo '<p>There are cards here.</p>';
echo $deck;
echo '</div>';



