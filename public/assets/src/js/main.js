"use strict";

import { EventListener, eventListenerJQuery } from "src/js/events/listeners";

/**
* Create a object of addonify quick view.
*
* @since 1.2.17
*/
export const addonifyQuickView = new Object();

window.addonifyQuickView = addonifyQuickView;

/**
* Event listener: "DOMContentLoaded".
*
* @since 1.2.17
*/
document.addEventListener("DOMContentLoaded", function () {
	/**
	* Init event listeners.
	*/
	new EventListener();
});

/**
* Event listener: "resize".
*
* @since 1.2.17
*/
window.addEventListener("resize", function () {
});

/**
* Event listener: jQuery "ready".
*
* @since 1.2.17
*/
(function ($) {
	$(document).ready(function () {
		/**
		* Init event listeners.
		*/
		eventListenerJQuery();
	});
})(jQuery);

