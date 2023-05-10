(function ($) {
    'use strict';

    $(document).ready(function () {

        $('body').on('click', '.addonify-qvm-button', function () {

            let spinenr = $('#adfy-qvm-spinner').addClass('hide');

            // show spinner
            spinenr.removeClass('hide');

            // clear old contents
            $('#addonify-quick-view-modal .adfy-quick-view-modal-content').html('');

            let productID = $(this).data('product_id');

            jQuery.ajax({
                type: 'GET',
                url: addonifyQuickViewPublicScriptObject.ajaxURL,
                data: {
                    'action': addonifyQuickViewPublicScriptObject.quickViewAction,
                    'product_id': productID,
                    'nonce': addonifyQuickViewPublicScriptObject.nonce,
                },
                success: function(response) {

                    if ( response.success ) {
                        $('.adfy-quick-view-modal-content').html(response.data);
                    } else {
                        console.log(response.message);
                    }
                }
            }).done(function(){
                let variationsForm = $('.adfy-quick-view-modal-content').find('.variations_form');
                variationsForm.each(function () {
                    $(this).wc_variation_form();
                });

                variationsForm.trigger('check_variations');
                variationsForm.trigger('reset_image');

                // re initiate wp_product_gallery() for gallery inside modal to work
                $('#addonify-quick-view-modal .woocommerce-product-gallery').each(function () {
                    $(this).wc_product_gallery();
                });

                // hide spinner
                spinenr.addClass('hide');
            });
        });
    });
})(jQuery);
