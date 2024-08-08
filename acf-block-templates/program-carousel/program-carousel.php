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
	$emph_icon 		= get_field( 'emphasis_icon', $focus );
	$emphasis_icons[$focus->term_id] = '<span class="fa-li ' . $emph_icon . '"></span>';
}

/**
 * Create card deck based on ACF field choices for block.
 * Build carousel_inner + carousel_indicators
 */

if( $cards ) {

	$wrap_count = 0;
	$indicator = '';

	$inner = '<div class="carousel-inner">';

	foreach( $cards as $card ) {

		// Open a new wrapper every third card beginning with the first one.
		if ($wrap_count % 3 == 0) {

			// Close the previous wrapper if it's not the first card
			if ($wrap_count > 0) {
				$inner .= '</div></div>';
			}

			// Add an active class to the first wrapper, otherwise, just the wrap.
			// Also add carousel pager element to the eventual controls for carousel.
			if ($wrap_count == 0 ) {
				$inner .= '<div class="carousel-item active"><div class="card-wrapper">';

				$indicator .= '<button type="button" data-bs-target="#' . $block['anchor'] . '" data-bs-slide-to="0" class="active btn btn-circle btn-small" aria-current="true" aria-label="Slide 1"></button>';
			} else {
				$pagenumber = ($wrap_count / 3 );
				$slidenumber = $pagenumber + 1;
				$inner .= '<div class="carousel-item"><div class="card-wrapper">';
				$indicator .= '<button type="button" data-bs-target="#' . $block['anchor'] . '" data-bs-slide-to="' . $pagenumber . '" class="btn btn-circle btn-small" aria-label="Slide ' . $slidenumber . '"></button>';
			}
		}

        $title 			= get_the_title( $card->ID );
		$slug			= $card->post_name;
		$formID 		= $block['anchor'] . '-' . $slug;

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
		$inner .= '<div class="card">';

		$inner .= wp_get_attachment_image( $prog_image, 'large', false, array( 'class' => 'card-img-top' ) );

		$inner .= '<div class="card-header">';
		$inner .= '<h3 class="card-title">' . $title . '</h3>';
		$inner .= '<form class="card-checkmark" data-year="' . $block['anchor'] . '" data-slug="' . $slug . '">';
		$inner .= '<input class="sr-only sr-only-focusable" type="checkbox" name="' . $formID . '">';
		$inner .= '<label class="unselected" for="' . $formID . '"><span class="fa-regular fa-circle"></span></label>';
		$inner .= '<label class="selected" for="' . $formID . '"><span class="fa-regular fa-circle-check"></span></label>';
		$inner .= '</form></div>';

		$inner .= '<div class="card-body">';
		$inner .= '<p class="card-text program-description">' . $prog_desc . '</p>';
		$inner .= '<p class="card-text"><a class="read-more" href="' . $prog_link['url'] . '" target="_blank">Read more</a>';
		$inner .= '<span class="fas fa-external-link-alt"></span></p>';
		$inner .= '</div>';

		$inner .= $emph_list;

		$inner .= '</div>';

		$wrap_count++;

	}
	// Close the current wrapper, close carousel-item, close carousel-inner
	$inner .= '</div></div></div>';

	$indicator = '<div role="group" class="carousel-indicators">' . $indicator . '</div>';

	// Previous and next buttons
	$prev_btn = '<button type="button" data-bs-slide="prev" data-bs-target="#' . $block['anchor'] . '" id="carousel-prev" class="btn btn-circle btn-circle-alt-white btn-circle-large">';
	$prev_btn .= '<span class="fa-solid fa-chevron-left"></span><span class="visually-hidden">Previous</span></button>';

	$next_btn = '<button type="button" data-bs-slide="next" data-bs-target="#' . $block['anchor'] . '" id="carousel-next" class="btn btn-circle btn-circle-alt-white btn-circle-large">';
	$next_btn .= '<span class="fa-solid fa-chevron-right"></span><span class="visually-hidden">Next</span></button>';

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

$carousel_classes = array( 'program-carousel', 'carousel', 'slide' );

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
echo $inner . $indicator . $prev_btn . $next_btn;
echo '</div>';



