<?php
// check whether a user has favourited an item
function fi_user_has_favourited_post($user_id, $post_id) {
 
	// get all item IDs the user has favourited
	$favourited = get_user_option('fi_user_favourites', $user_id);
	if(is_array($favourited) && in_array($post_id, $favourited)) {
		return true; // user has favourited post
	}
	return false; // user has not favourited post
}

// adds the favourited ID to the users meta so they can't favourite it again
function fi_store_favourited_id_for_user($user_id, $post_id) {
	$favourited = get_user_option('fi_user_favourites', $user_id);
	if(is_array($favourited)) {
		$favourited[] = $post_id;
	} else {
		$favourited = array($post_id);
	}
	update_user_option($user_id, 'fi_user_favourites', $favourited);
}

// increments a favourite count
function fi_mark_post_as_favourited($post_id, $user_id) {
 
	// retrieve the favourite count for $post_id	
	$favourite_count = get_post_meta($post_id, '_fi_favourite_count', true);
	if($favourite_count)
		$favourite_count = $favourite_count + 1;
	else
		$favourite_count = 1;
 
	if(update_post_meta($post_id, '_fi_favourite_count', $favourite_count)) {	
		// store this post as favourited for $user_id	
		fi_store_favourited_id_for_user($user_id, $post_id);
		return true;
	}
	return false;
}

// returns a favourite count for a post
function fi_get_favourite_count($post_id) {
	$favourite_count = get_post_meta($post_id, '_fi_favourite_count', true);
	if($favourite_count)
		return $favourite_count;
	return 0;
}

// processes the ajax request for updating count
function fi_process_favourite() {
	if ( isset( $_POST['item_id'] ) && wp_verify_nonce($_POST['favourite_it_nonce'], 'favourite-it-nonce') ) {
		if(fi_mark_post_as_favourited($_POST['item_id'], $_POST['user_id'])) {
			echo 'favourited';
		} else {
			echo 'failed';
		}
	}
	die();
}
add_action('wp_ajax_favourite_it', 'fi_process_favourite');
?>