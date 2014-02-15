jQuery(document).ready( function($) {	
	$('.unfavourite-it').on('click', function() {	
		var post_id = $(this).data('post-id');
		var user_id = $(this).data('user-id');
		var post_data = {
			action: 'favourite_it',
			item_id: post_id,
			user_id: user_id,
			unfavourite_it_nonce: unfavourite_it_vars.nonce
		};
		$.post(unfavourite_it_vars.ajaxurl, post_data, function(response) {
			if(response == 'unfavourited') {
				alert("Unfavourited! Please reload the page.");		
			} else {
				alert(favourite_it_vars.error_message);
			}
		});
		return false;
	});	
});