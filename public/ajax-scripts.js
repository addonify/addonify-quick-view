(function( $ ) {
	'use strict';

	$( document ).ready(function(){

        $('body').on('click', '.addonify-qvm-button', function(){

            let $spinenr = $('#adfy-qvm-spinner').addClass('hide');

            // show spinner
            $spinenr.removeClass('hide');

            // clear old contents
            $('#addonify-quick-view-modal .adfy-quick-view-modal-content').html('');

            let product_id = $(this).data('product_id');
            
            let data = {
                'action': ajax_object.action,
                'id': product_id
            };
    
            jQuery.get(ajax_object.ajax_url, data, function(response) {
                // dump response into modal container
                $('.adfy-quick-view-modal-content').html(response);

            }).done(function() {

                // re initiate wp_product_gallery() for gallery inside modal to work
                $( '#addonify-quick-view-modal .woocommerce-product-gallery' ).each(function() {
                    $( this ).wc_product_gallery();
                });

                // hide spinner
                $spinenr.addClass('hide');
            })

        })
	
	})

})( jQuery );
