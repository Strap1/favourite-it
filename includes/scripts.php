<?php
function fi_front_end_js() {
	$cpts = array( 'hhie_producers', 'hhie_albums', 'hhie_artists', 'hhie_lyrics');
	if(is_user_logged_in() && is_singular($cpts)) {
		wp_enqueue_script('favourite-it', FI_BASE_URL . '/includes/js/favourite-it.js', array( 'jquery' ) );
		wp_localize_script( 'favourite-it', 'favourite_it_vars', 
			array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce('favourite-it-nonce'),
				'already_favourited_message' => __('You have already favourited this item.', 'favourite_it'),
				'error_message' => __('Sorry, there was a problem processing your request.', 'favourite_it')
			) 
		);	
	}
}
add_action('wp_enqueue_scripts', 'fi_front_end_js');

function fi_front_end_js_2() {
	if(is_user_logged_in() && is_page_template( 'user-profile.php' )) {
		wp_enqueue_script('unfavourite-it', FI_BASE_URL . '/includes/js/unfavourite-it.js', array( 'jquery' ) );
		wp_localize_script( 'unfavourite-it', 'unfavourite_it_vars', 
			array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce('unfavourite-it-nonce'),
				'not_favourited_message' => __('This item isnt favourited!', 'unfavourite_it'),
				'error_message' => __('Sorry, twat.', 'unfavourite_it')
			) 
		);	
	}
}
add_action('wp_enqueue_scripts', 'fi_front_end_js_2');
?>