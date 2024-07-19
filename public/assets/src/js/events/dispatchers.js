let $ = window.jQuery;

export const dispatchEvent = {
	/**
	* Dispatch event when the modal is closed.
	*
	* @return {void}
	* @since 1.2.8
	*/
	closed: function () {
		$(document).trigger("addonifyQuickViewModalClosed");

		document.dispatchEvent(new CustomEvent("addonifyQuickViewModalClosed"));
	},

	/**
	* Dispatch event when the modal is opened.
	*
	* @param {string} id - product id.
	* @return {void} void.
	* @since 1.2.8
	*/
	opened: function (id) {
		const eventData = { productId: id }

		$(document).trigger("addonifyQuickViewModalOpened", [eventData]);

		document.dispatchEvent(new CustomEvent("addonifyQuickViewModalOpened", {
			detail: eventData
		}));
	},

	/**
	* Dispatch event when the modal content is loading.
	*
	* @param {string} id - product id.
	* @return {void} void.
	* @since 1.2.8
	*/
	loading: function (id) {
		const eventData = { productId: id }

		$(document).trigger("addonifyQuickViewModalLoading", [eventData]);

		document.dispatchEvent(new CustomEvent("addonifyQuickViewModalLoading", {
			detail: eventData
		}));
	},

	/**
	* Dispatch event when the modal content is loaded.
	*
	* @param {object} data.
	* @return {void} void.
	* @since 1.2.8
	*/
	loaded: function (data) {
		const eventData = { content: data };

		$(document).trigger('addonifyQuickViewModalContentLoaded', [eventData]);

		document.dispatchEvent(new CustomEvent('addonifyQuickViewModalContentLoaded', {
			detail: eventData
		}));
	},

	/**
	* Dispatch error event.
	*
	* @param {string} code.
	* @param {string} message.
	* @return {void} void.
	* @since 1.2.17
	*/
	error: function (message = "Oops! something went wrong.", code = 503) {
		const eventData = { code, message };

		$(document).trigger("addonifyQuickViewError", [eventData]);

		document.dispatchEvent(new CustomEvent("addonifyQuickViewModalError", {
			detail: eventData
		}));
	}
}
