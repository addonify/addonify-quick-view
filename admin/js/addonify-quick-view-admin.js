(function( $ ) {
	'use strict';

	$(window).load(function(){
		$('input.lc_switch').lc_switch();

		$('input.lc_switch').each(function(){
			if( $(this).data('checked') == 1 ){
				$(this).lcs_on();
			}
			else{
				$(this).lcs_off();
			}
		})


		// $('body').delegate('.lc_switch','lcs-statuschange',function() {
		// 	//   var status = ($(this).is(':checked')) ?'checked' :'unchecked';
		// 	  $(this).prop("checked", !$(this).prop("checked") )
		// 	//   console.log('field changed status: '+ status );
		// 	});
	})

})( jQuery );
