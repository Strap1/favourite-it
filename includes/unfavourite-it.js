jQuery(document).ready( function($) {	
	$('.unfavourite-it').on('click', function() {	
		if($(this).hasClass('unfavourited')) {
			alert(unfavourite_it_vars.not_favourited_message);
			return false;
		}	
		var post_id = $(this).data('post-id');
		var user_id = $(this).data('user-id');
		var post_data = {
			action: 'unfavourite_it',
			item_id: post_id,
			user_id: user_id,
			unfavourite_it_nonce: unfavourite_it_vars.nonce
		};
		$.post(unfavourite_it_vars.ajaxurl, post_data, function(response) {
			if(response == 'unfavourited') {
				$('.unfavourite-it').addClass('unfavourited');	
			} else {
				alert(unfavourite_it_vars.error_message);
			}
		});
		return false;
	});	
});