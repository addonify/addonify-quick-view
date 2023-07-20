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
            $('body').on('click', '#addonify-qvm-close-button', function (e) {

                e.preventDefault(); // prevent empty links clicks

                let animationOpeningTask = null;
                let animationClosingTask = null;
                let quickViewModelWrapperEle = $('#addonify-quick-view-modal-wrapper');

                // If closing animation is enabled.
                quickViewModelWrapperEle.removeClass('play-opening-animation');
                quickViewModelWrapperEle.addClass('play-closing-animation');

                clearTimeout(animationOpeningTask);
                animationOpeningTask = setTimeout(() => {

                    $('body').removeClass('addonify-qvm-is-active');
                    quickViewModelWrapperEle.removeClass('play-closing-animation');

                    clearTimeout(animationOpeningTask);
                }, 800);

                clearTimeout(animationClosingTask);
                animationClosingTask = setTimeout(() => {

                    quickViewModelWrapperEle.addClass('play-opening-animation');
                    clearTimeout(animationClosingTask);
                }, 1000);
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
