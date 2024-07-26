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
do_action('qm/debug', $cards);

/**
 * Create card series for carousel inner
 */

if( $cards ) {

	$deck = '<div class="deck">';

	foreach( $cards as $card ) {
        $title 			= get_the_title( $card->ID );
        $prog_desc 		= get_field( 'program_description', $card->ID );
		$prog_online 	= get_field( 'program_online', $card->ID );
		$prog_link 		= get_field( 'program_link', $card->ID );
		$prog_image 	= get_field( 'program_image', $card->ID );

		// Include the selected emphasis taxonomy terms as card classes.
		$emphasis_terms = wp_get_post_terms(  $card->ID, 'emphasis' );
		$slugs = array('card');
		$tags = array();

		if ( !empty( $emphasis_terms ) && !is_wp_error( $emphasis_terms ) ) {

			// Loop through each term and get the slug.
			// Also produce the tag list at the end of the card.
			foreach ( $emphasis_terms as $term ) {
				$slugs[] = $term->slug;
			}

		}

		$deck .= '<div class="' . implode( ' ', $slugs ) . '">';  // Open card div
		$deck .= wp_get_attachment_image( $prog_image, 'large', false, array( 'class' => 'card-img-top' ) );
		$deck .= '<div class="card-header"><h3 class="card-title">' . $title . '</h3></div>';
		$deck .= '<div class="card-body">';
		$deck .= '<p class="card-text">' . $prog_desc . '</p>';
		$deck .= '<p class="card-text><a href="#">Read more</a></p>';
		$deck .= '</div>';
		$deck .= '<div class="card-footer"></div>';

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
echo '<div id="year1" class="' . implode( ' ', $carousel_classes ) . '" style="' . $spacing . '">';
echo '<p>There are cards here.</p>';
echo $deck;
echo '</div>';



