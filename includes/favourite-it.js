jQuery(document).ready( function($) {	
	$('.favourite-it').on('click', function() {	
		if($(this).hasClass('favourited')) {
			alert(favourite_it_vars.already_favourited_message);
			return false;
		}	
		var post_id = $(this).data('post-id');
		var user_id = $(this).data('user-id');
		var post_data = {
			action: 'favourite_it',
			item_id: post_id,
			user_id: user_id,
			favourite_it_nonce: favourite_it_vars.nonce
		};
		$.post(favourite_it_vars.ajaxurl, post_data, function(response) {
			if(response == 'favourited') {
				$('.favourite-it').addClass('favourited');
				var count_wrap = $('.favourite-count');
				var count = count_wrap.text();
				count_wrap.text(parseInt(count) + 1);		
			} else {
				alert(favourite_it_vars.error_message);
			}
		});
		return false;
	});	
});