"use strict";

import { util } from "./utils/utils";
import { helper } from "./utils/helpers";
import { action } from "./events/actions";
import { dispatchEvent } from "./events/dispatchers";
import { initEventListeners } from "./events/listeners";

/**
* Create a global object of addonify quick view.
* This object is accessible from the global scope.
*
* Examples:
* addonifyQuickView.action.open(100);
*	addonifyQuickView.action.close();
*
* Check doc: https://docs.addonify.com/kb/woocommerce-quick-view/
*
* @since 1.2.17
*/
const addonifyQuickView = {
	action: action,
	dispatchEvent: dispatchEvent,
	util: util,
};

window.addonifyQuickView = addonifyQuickView;

/**
* Fire the events.
*
* @since 1.2.17
*/
(function ($) {
	/**
	* Document ready event.
	*/
	$(document).ready(function () {
		initEventListeners();
	});

	/**
	* Document resize event.
	*/
	$(window).resize(function () {
		helper.calcHeight();
	});
})(jQuery);

