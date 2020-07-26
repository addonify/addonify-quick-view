(function( $ ) {
	'use strict';

	$(window).load(function(){

		// ios style switch
		$('input.lc_switch').lc_switch();

		// color picker
		$('.color-picker').spectrum({type: "text" });


		// settings page tabs

		$('#addonify-settings-tabs a').click(function(e){
			e.preventDefault();
			
			// rest
			$('#addonify-settings-tabs a').removeClass('active');
			$('.addonify-content').removeClass('active');

			// select correct tab item
			$(this).addClass('active');
			
			// show proper content
			let target_elem = $(this).attr('href');
			$(target_elem).addClass('active');
		})
	
	})

})( jQuery );
