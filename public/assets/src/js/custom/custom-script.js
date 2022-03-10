(function ($) {

    'use strict';

    $(document).ready(function () {

        function AddonifyQuickViewModel() {

            // add class to body when quick view button is clicked

            $('body').on('click', '.addonify-qvm-button', function (e) {

                e.preventDefault(); // prevent empty links clicks

                $('body').addClass('addonify-qvm-is-active');
            });

            // remove class from body when quick view close button is clicked

            $('body').on('click', '#addonify-qvm-close-button', function () {

                $('body').removeClass('addonify-qvm-is-active');
            });
        }

        // buttons overlay in image
        function prepare_overlay_buttons() {

            var overlay_btn_wrapper_class = 'addonify-overlay-btn-wrapper';
            var overlay_btn_class = 'addonify-overlay-btn';

            var $overlay_btn_wrapper_sel = $('.' + overlay_btn_wrapper_class);
            var $overlay_parent_container = $('.addonify-overlay-buttons');

            if ($overlay_btn_wrapper_sel.length) {

                //  wrapper div already exists
                $overlay_parent_container.each(function () {

                    // clone original button
                    var btn_clone = $('button.' + overlay_btn_class, this).clone();

                    // delete oroginal buttons
                    $('button.' + overlay_btn_class, this).remove();

                    // append to wrapper class
                    $('.' + overlay_btn_wrapper_class, this).append(btn_clone);
                })
            }
            else {
                // wrap all buttons into a single div
                $overlay_parent_container.each(function () {
                    $('button.' + overlay_btn_class, this).wrapAll('<div class=" ' + overlay_btn_wrapper_class + ' " />');
                });

                var img_height = $('img.attachment-woocommerce_thumbnail').height();

                // set height of the button wrapper div
                $('.' + overlay_btn_wrapper_class).css('height', img_height + 'px');


                $('.' + overlay_btn_wrapper_class).hover(function () {
                    $(this).css('opacity', 1);
                }, function () {
                    $(this).css('opacity', 0);
                })
            }
        }

        AddonifyQuickViewModel();
        prepare_overlay_buttons();

    });

})(jQuery);
