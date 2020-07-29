(function( $ ) {
	'use strict';

	$(document).ready(function(){

        $('body').on('click', '.addonify-qvm-button', function(){
            
            let data = {
                'action': ajax_object.action,
                'id': ajax_object.id
            };
    
            jQuery.get(ajax_object.ajax_url, data, function(response) {
                $('.adfy-quick-view-modal-content').html(response);
            }).done(function() {
                $( '.woocommerce-product-gallery' ).each( function() {
                    $( this ).wc_product_gallery();
                } );

            })

        })
	
	})

})( jQuery );
