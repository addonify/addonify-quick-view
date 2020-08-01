(function( $ ) {
	'use strict';

	$(document).ready(function(){

        $('body').on('click', '.addonify-qvm-button', function(){

            // clear old contents
            $('#addonify-quick-view-modal .adfy-quick-view-modal-content').html('');

            let product_id = $(this).data('product_id');
            
            let data = {
                'action': ajax_object.action,
                'id': product_id
            };
    
            jQuery.get(ajax_object.ajax_url, data, function(response) {
                $('.adfy-quick-view-modal-content').html(response);
            }).done(function() {
                $( '.woocommerce-product-gallery' ).each( function() {
                    $( this ).wc_product_gallery();
                } );

                $('#adfy-qvm-spinner').addClass('hide');
            })

        })
	
	})

})( jQuery );
