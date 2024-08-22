<?php
/**
 * Pitchfork Customize - Program Output
 *
 * @package Pitchfork Customize
 * @author Steve Ryan
 *
 * A block that renders the results of the actively selected carousel items.
 * Displayed on screen near the submission form for feedback.
 * Also contains a visually hidden div that contains the body of the email sent to the student.
 */

// Thus far, no fields to speak of. =)

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

$classes = array('result-list');

if ( ! empty( $block['className'] ) ) {
	// Assume that there is more than one class in the "roll your own CSS" field separated by a space.
	$class_setting = explode(' ', $block['className']);
	foreach ($class_setting as $setting) {
		$classes[] = $setting;
	}
}

// Handle possibly unassigned empty anchor setting.
if ( ! empty ( $block['anchor'] ) ) {
	$anchor = 'id="' . $block['anchor'] . '" ';
} else {
	$anchor = '';
}


/**
 * Output the block.
 */
echo '<dl ' . $anchor . 'class="' . implode( ' ', $classes ) . '" style="' . $spacing . '">';
if ( $is_preview ) {
	echo '<dt><h4>Example selected program</h4></dt>';
	echo '<dd><a href="#">https://engineering.asu.edu/program-1</a></dd>';
	echo '<dt><h4>Example selected program</h4></dt>';
	echo '<dd><a href="#">https://engineering.asu.edu/program-2</a></dd>';
}
echo '</dl>';
echo '<ul class="results visually-hidden"></ul>';



