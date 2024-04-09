export const dispatchEvent = {
	/**
	* Dispatch event when the modal is closed.
	*
	* @param {object} event
	* @return {void} void.
	* @since 1.2.8
	*/
	closed: function (event) {
		$(document).trigger("addonifyQuickViewModalClosed", { data: event });

		document.dispatchEvent(new CustomEvent("addonifyQuickViewModalClosed", { data: event }));
	},

	/**
	* Dispatch event when the modal is opened.
	*
	* @param {object} event
	* @return {void} void.
	* @since 1.2.8
	*/
	opened: function (event) {
		$(document).trigger("addonifyQuickViewModalOpened");

		document.dispatchEvent(new CustomEvent("addonifyQuickViewModalOpened"));
	},

	/**
	* Dispatch event when the modal content is loading.
	*
	* @param {object} event
	* @return {void} void.
	* @since 1.2.8
	*/
	loading: function (event) {
		$(document).trigger("addonifyQuickViewModalLoading");

		document.dispatchEvent(new CustomEvent("addonifyQuickViewModalLoading"));
	},

	/**
	* Dispatch event when the modal content is loaded.
	*
	* @param {object} event
	* @return {void} void.
	* @since 1.2.8
	*/
	loaded: function (data) {
		$(document).trigger("addonifyQuickViewModalLoaded", { data });

		document.dispatchEvent(new CustomEvent("addonifyQuickViewModalLoaded", { data }));
	}
}
