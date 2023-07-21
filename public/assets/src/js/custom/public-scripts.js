(function ($) {

    'use strict';

    const animateModelOnClose = true; // NEW
    const closeModalOnEscClicked = true; // NEW
    const closeModelOnOutsideClicked = true; // NEW

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
            this.handleQuickViewButtonEvents();
            this.handleCloseButtonEvents();
            this.initPerfectScrollbar();
        },

        loadOnScroll: function () {

            // Fire all these methods on document scroll.
        },

        loadOnResize: function () {

            // Fire all these methods on document resize.
        },

        /**
         * Method: handleQuickViewButtonEvents
         * Handles events addonify quick view buttons.
         * 
         * @param {null} null
         * @return void
         * @since 1.2.8
         */
        handleQuickViewButtonEvents: function () {

            // open quick view modal when quick view button is clicked.
            $('body').on('click', '.addonify-qvm-button', function (e) {

                e.preventDefault();

                // hydrate modal content by passing ID.
                addonifyQuickView.hydrateModalContent(parseInt($(this).data('product_id')));

                // dispatch event to open quick view modal.
                dispatchAddonifyQuickViewEvent.open();
            });
        },

        /**
         * Method: handleCloseButtonEvents
         * Handles modal close button events.
         * 
         * @param {null} null
         * @return void
         * @since 1.2.8
         */
        handleCloseButtonEvents: function () {

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

            // close quick view modal when escape key is pressed.
            if (closeModalOnEscClicked) {

                $(document).keyup(function (e) {

                    if (e.keyCode === 27) {

                        if (animateModelOnClose) {

                            // close quick view modal with animation.
                            dispatchAddonifyQuickViewEvent.animate();
                        } else {

                            // close quick view modal without animation.
                            dispatchAddonifyQuickViewEvent.close();
                        }
                    }
                });
            }

            // close quick view modal when outside modal is clicked.
            if (closeModalOnEscClicked) {

                // set cursor to pointer.
                $('#addonify-quick-view-modal-wrapper').css('cursor', 'pointer');

                // listen to click event.
                $('body').on('click', '#addonify-quick-view-modal-wrapper', function (e) {

                    if (e.target.id === 'addonify-quick-view-modal-wrapper') {

                        if (animateModelOnClose) {

                            // close quick view modal with animation.
                            dispatchAddonifyQuickViewEvent.animate();
                        } else {

                            // close quick view modal without animation.
                            dispatchAddonifyQuickViewEvent.close();
                        }
                    }
                });
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

            // clear the modal content.
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
                    success: function (response) {

                        if (!response.success) {

                            console.warn(response.message);
                            return;
                        }

                        if (response.success) {

                            // we expect response.data to be html content.
                            $(modalContentContainer).html(response.data);

                            // dispatch DOM event.
                            dispatchAddonifyQuickViewEvent.modalContentLoaded(response.data);

                            let variationsForm = $(modalContentContainer).find('.variations_form');

                            if (variationsForm.length > 0) {

                                variationsForm.each(function () {

                                    $(this).wc_variation_form();
                                });

                                variationsForm.trigger('check_variations');
                                variationsForm.trigger('reset_image');
                            }

                            // Re-initiate wp_product_gallery() for gallery inside modal to work.
                            let wcGallery = $('#addonify-quick-view-modal .woocommerce-product-gallery');

                            if (wcGallery.length > 0) {

                                wcGallery.each(function () {

                                    $(this).wc_product_gallery();
                                })
                            }
                        }
                    },
                    error: function (event) {

                        console.error('Addonify Quick View - error loading modal content!');
                        console.log(event);
                    },
                    complete: function () {

                        // render trigger icon for WooCommerce gallery.
                        addonifyQuickView.renderWooCommerceGalleryTriggerIcon();

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

                // use vanilla to query the DOM. jQuery is not working here.
                let scrollEle = document.getElementById('addonify-quick-view-modal');

                if (scrollEle) {

                    new PerfectScrollbar(scrollEle, {

                        wheelSpeed: 1,
                        wheelPropagation: true,
                        minScrollbarLength: 20
                    });
                }
            } else {

                console.warn("Addonify Quick View: PerfectScrollbar is not defined. Perfect scroll bar won't be initialized.");
            }
        },

        /**
        *
        * Method: renderWooCommerceGalleryTriggerIcon
        * Renders trigger icon for WooCommerce gallery.
        *
        * @param {null} null
        * @return {void} void.
        * @since 1.2.8
        */
        renderWooCommerceGalleryTriggerIcon: function () {

            let icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19,24H17a1,1,0,0,1,0-2h2a3,3,0,0,0,3-3V17a1,1,0,0,1,2,0v2A5.006,5.006,0,0,1,19,24Z"/><path d="M1,8A1,1,0,0,1,0,7V5A5.006,5.006,0,0,1,5,0H7A1,1,0,0,1,7,2H5A3,3,0,0,0,2,5V7A1,1,0,0,1,1,8Z"/><path d="M7,24H5a5.006,5.006,0,0,1-5-5V17a1,1,0,0,1,2,0v2a3,3,0,0,0,3,3H7a1,1,0,0,1,0,2Z"/><path d="M23,8a1,1,0,0,1-1-1V5a3,3,0,0,0-3-3H17a1,1,0,0,1,0-2h2a5.006,5.006,0,0,1,5,5V7A1,1,0,0,1,23,8Z"/></svg>';

            let triggerEle = $('#addonify-quick-view-modal .woocommerce-product-gallery__trigger');

            console.log('renderWooCommerceGalleryTriggerIcon fn invoked!');

            if (triggerEle.length > 0) {

                console.log('Found WooCommerce gallery trigger icon!');

                triggerEle.html(" ");
                triggerEle.html(icon);
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
            $(document).trigger('addonifyQuickViewModalOpened');
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
            $(document).trigger('addonifyQuickViewModalClosed');
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
        },

        /**
        * Modal content loded event.
        *
        * @param {string} data. HTML content.
        * @since 1.2.8
        */
        modalContentLoaded: function (data) {

            // create event data.
            let eventData = { content: data };

            // dispatch event: jQuery
            $(document).trigger('addonifyQuickViewModalContentLoded', [eventData]);
            // dispatch event: vanilla
            document.dispatchEvent(new CustomEvent('addonifyQuickViewModalContentLoded', {
                detail: eventData
            }));
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

    //$(document).on('addonifyQuickViewModalContentLoded', function (e, data) {

    //    console.log('addonifyQuickViewModalContentLoded event fired!');
    //    console.log(data);
    //});

})(jQuery);

//document.addEventListener('addonifyQuickViewModalContentLoded', function (e) {

//    console.log('addonifyQuickViewModalContentLoded event fired!');
//    console.log(e.detail);
//});