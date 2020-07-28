(function($) {

    'use strict';

    $(document).ready(function() {

        function AddonifyQuickViewModel() {

            // add class to body when quick view button is clicked

            $('body').on('click', '.addonify-qvm-button', function() {

                $('body').addClass('addonify-qvm-is-active');
            });

            // remove class from body when quick view close button is clicked 

            $('body').on('click', '#addonify-qvm-close-button', function() {

                $('body').removeClass('addonify-qvm-is-active');
            });
        }

        AddonifyQuickViewModel();

    });

})(jQuery);