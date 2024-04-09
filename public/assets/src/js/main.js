"use strict";

import { action } from "src/js/events/actions";
import { eventListeners } from "src/js/events/listeners";

/**
* Create a object of addonify quick view.
*
* @since 1.2.17
*/
const addonifyQuickView = {
	...action,
};

window.addonifyQuickView = addonifyQuickView;

/**
* Fire the event listeners.
*
* @since 1.2.17
*/
(function ($) {
	/**
	* Document ready event.
	*/
	$(document).ready(function () {
		eventListeners();
	});

	/**
	* Document resize event.
	*/
	$(window).resize(function () {
	});
})(jQuery);

