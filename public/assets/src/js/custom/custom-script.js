(function ($) {

    'use strict';

    const animateModelOnClose = true;

    /**
     * Main object for addonify quick view modal.
     * Define all necessary actions/methods here.
     * Below defined methods can be called on document ready, scroll and resize.
     *
     * @since 1.2.8
     */
    const addonifyQuickView = {

        loadOnReady: function () {

            // Fire all these methods on document ready.
            this.handleOpenCloseActions();
            this.prepareOverlayButtons();
            this.initPerfectScrollbar();
        },

        loadOnScroll: function () {

            // Fire all these methods on document scroll.
        },

        loadOnResize: function () {

            // Fire all these methods on document resize.
        },

        /**
         * Method: handleOpenCloseActions
         * Handles all open and close actions.
         * 
         * @return void
         */
        handleOpenCloseActions: function () {

            // open quick view modal when quick view button is clicked.
            $('body').on('click', '.addonify-qvm-button', function (e) {

                e.preventDefault();
                dispatchAddonifyQuickViewEvent.open();
            });

            // close quick view modal when close button is clicked.
            $('body').on('click', '#addonify-qvm-close-button', function (e) {

                e.preventDefault();

                if (animateModelOnClose) {

                    // close quick view modal with animation.
                    dispatchAddonifyQuickViewEvent.animate();
                } else {

                    // close quick view modal without animation.
                    dispatchAddonifyQuickViewEvent.close();
                }

            });
        },

        /**
         * Method: prepareOverlayButtons
         * Prepare overlay buttons.
         * 
         * @return void
         */
        prepareOverlayButtons: function () {

            let overlay_btn_wrapper_class = 'addonify-overlay-btn-wrapper';
            let overlay_btn_class = 'addonify-overlay-btn';

            let $overlay_btn_wrapper_sel = $('.' + overlay_btn_wrapper_class);
            let $overlay_parent_container = $('.addonify-overlay-buttons');

            if ($overlay_btn_wrapper_sel.length) {

                //  wrapper div already exists
                $overlay_parent_container.each(function () {

                    // clone original button
                    let btn_clone = $('button.' + overlay_btn_class, this).clone();

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

                let img_height = $('img.attachment-woocommerce_thumbnail').height();

                // set height of the button wrapper div
                $('.' + overlay_btn_wrapper_class).css('height', img_height + 'px');


                $('.' + overlay_btn_wrapper_class).hover(function () {
                    $(this).css('opacity', 1);
                }, function () {
                    $(this).css('opacity', 0);
                })
            }
        },

        /**
        * Method: setSpinner
        * Show or hide spinner.
        * 
        * @param {string} action. show | hide
        * @return void
        */
        setSpinner: function (action) {

            let spinner = $('#adfy-qvm-spinner');

            if (action === 'show') {

                spinner.removeClass('hide');
            } else {

                spinner.addClass('hide');
            }
        },

        /**
        * Method: hydrateModalContent
        * Fn hat does Ajax call to get modal content.
        * 
        * @param {int} productID. ID of the product.
        * @return void
        * @since 1.2.8
        */
        hydrateModalContent: function (productID) {

            let modalContentContainer = $('#addonify-quick-view-modal #adfy-quick-view-modal-content');

            // show loading state.
            addonifyQuickView.setSpinner('show');

            // clear old contents
            $(modalContentContainer).html(" ");

            // check if we have product id before doing call.
            if (productID) {

                $.ajax({
                    type: 'GET',
                    url: addonifyQuickViewPublicScriptObject.ajaxURL,
                    contentType: "application/json; charset=utf-8",
                    data: {
                        'action': addonifyQuickViewPublicScriptObject.quickViewAction,
                        'product_id': productID,
                        'nonce': addonifyQuickViewPublicScriptObject.nonce,
                    },
                    'success': function (response) {

                        response.success ? $(modalContentEle).html(response.data) : console.log(response.message);
                    },
                    'error': function (event) {

                        console.error('Addonify Quick View - error loading modal content!');
                        console.log(event);
                    },
                    'complete': function () {

                        // hide loading state.
                        addonifyQuickView.setSpinner('hide');
                    }
                });

            } else {

                throw new Error('Addonify Quick View: Product id is not supplied!');
            }
        },

        /**
         * Method: intPerfectScrollbar
         * Initialize perfect scrollbar.
         * 
         * @param {null} null
         * @return void
         * @since 1.2.8
         */
        initPerfectScrollbar: function () {

            if (typeof PerfectScrollbar === 'function') {

                let scrollEle = $('#addonify-quick-view-modal');

                if (scrollEle.length > 0) {

                    new PerfectScrollbar(modalEle, {

                        wheelSpeed: 1,
                        wheelPropagation: true,
                        minScrollbarLength: 20
                    });
                }
            } else {

                console.warn("Addonify Quick View: PerfectScrollbar is not defined. Perfect scroll bar won't be initialized.");
            }
        }
    }


    /**
     * Define events.
     * Also acts as API for dispatching DOM events.
     *
     * @since 1.2.8
     */
    const dispatchAddonifyQuickViewEvent = {

        /**
        * Dispatch event when quick view modal is opened.
        *
        * @since 1.2.8
        */
        open: function () {

            $('body').addClass('addonify-qvm-is-active');

            // dispatch event when quick view modal is opened in DOM.
            document.trigger('addonifyQuickViewModalOpened');
            document.dispatchEvent(new CustomEvent('addonifyQuickViewModalOpened'));
        },

        /**
        * Dispatch event when quick view modal is closed.
        *
        * @since 1.2.8
        */
        close: function () {

            $('body').removeClass('addonify-qvm-is-active');

            // dispatch event when quick view modal is closed in DOM.
            document.trigger('addonifyQuickViewModalClosed');
            document.dispatchEvent(new CustomEvent('addonifyQuickViewModalClosed'));
        },

        /**
        * Handles quick view modal animation task.
        *
        * @since 1.2.8
        */
        animate: function () {

            let openingTask = null;
            let closingTask = null;
            let quickViewModelWrapperEle = $('#addonify-quick-view-modal-wrapper');

            quickViewModelWrapperEle.removeClass('play-opening-animation');
            quickViewModelWrapperEle.addClass('play-closing-animation');

            // Remove closing animation class after 800ms
            clearTimeout(closingTask);
            closingTask = setTimeout(() => {

                this.close();
                quickViewModelWrapperEle.removeClass('play-closing-animation');
                clearTimeout(closingTask);
            }, 800);

            // Reset opening animation class after 1000ms
            clearTimeout(openingTask);
            openingTask = setTimeout(() => {

                quickViewModelWrapperEle.addClass('play-opening-animation');
                clearTimeout(openingTask);
            }, 1200);
        }
    }


    /**
    * Mount the methods on jQuery events.
    * Types: ready, scroll, resize
    *
    * @since 1.2.8
    */

    $(document).ready(function () {

        addonifyQuickView.loadOnReady();
    });

    $(window).on('scroll', function () {

        addonifyQuickView.loadOnScroll();
    });

    $(window).on('resize', function () {

        addonifyQuickView.loadOnResize();
    });
})(jQuery);
