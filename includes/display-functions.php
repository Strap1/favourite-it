<?php
// sets up the Favourite link and count to post/page content
function fi_display_favourite_link() {
 
	global $user_ID, $post;

	// Return blank by default
	$tinger = '';
 
	// only show the link when user is logged in and on a singular page
	if(is_user_logged_in() && is_singular()) {
 
		ob_start();
 
		// retrieve the total favourite count for this item
		$favourite_count = fi_get_favourite_count($post->ID);

		// our wrapper DIV
		$tinger = '<div class="favourite-it-wrapper">';
 
			// only show the Favourite It link if the user has NOT previously favourited this item
			if(!fi_user_has_favourited_post($user_ID, get_the_ID())) {
				$tinger .= '<a href="#" class="favourite-it" data-post-id="' . get_the_ID() . '" data-user-id="' .  $user_ID . '"><button type="button" class="btn btn-danger">Add to favourites</button></a> <span class="favourite-count">Favourited: ' . $favourite_count . ' people</span>';
			} else {
				// show a message to users who have already loved this item
				$tinger .= '<span class="favourited"><button type="button" class="btn btn-danger disabled">Favourited!</button> (<span class="favourite-count">Favourited by: ' . $favourite_count . ' people</span>)</span>';
			}
 
		// close our wrapper DIV
		$tinger .= '</div>';
 
		// append our "Love It" link to the item content.
		ob_get_clean();
	} else {
		$tinger = '<span class="favourite-it-error">You must be logged in to Favourite this.</span>';
	}
	return $tinger;
}
// create template tag call to prev function
function fi_display_in_template() {
	echo fi_display_favourite_link();
}

// Hook into user-profile call with function

function fi_display_unfavourite_link($user_ID, $post_id ) {

	$unfavourite = '';

	ob_start();

	if(!fi_user_has_favourited_post($user_ID, $post_id)) {
		$unfavourite .= '<span class="unfavourited">Meeh' . $user_ID . '|' . $post_id . '</span>';
	} else {
		$unfavourite .= '<a href="#" class="unfavourite-it" data-post-id="' . $post_id . '" data-user-id="' . $user_ID . '">Unfavourite</a>';
	}
	ob_get_clean();

	return $unfavourite;
}

function fi_display_unfavourite_in_template() {
	echo fi_display_unfavourite_link();
}
?>