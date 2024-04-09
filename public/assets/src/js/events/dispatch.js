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
		$(document).trigger("addonifyQuickViewModalOpened", { data: id });

		document.dispatchEvent(new CustomEvent("addonifyQuickViewModalOpened", { data: id }));
	},

	/**
	* Dispatch event when the modal content is loading.
	*
	* @param {string} id - product id.
	* @return {void} void.
	* @since 1.2.8
	*/
	loading: function (id) {
		$(document).trigger("addonifyQuickViewModalLoading", { data: id });

		document.dispatchEvent(new CustomEvent("addonifyQuickViewModalLoading", { data: id }));
	},

	/**
	* Dispatch event when the modal content is loaded.
	*
	* @param {object} data.
	* @return {void} void.
	* @since 1.2.8
	*/
	loaded: function (data) {
		$(document).trigger("addonifyQuickViewModalLoaded", { data });

		document.dispatchEvent(new CustomEvent("addonifyQuickViewModalLoaded", { data }));
	}
}
