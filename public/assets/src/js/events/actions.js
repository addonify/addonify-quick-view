import { dispatchEvent } from "src/js/events/dispatch";

export const action = {
	/**
	* Action: open modal.
	*
	* @param {object} event
	* @return {void} void.
	* @since 1.2.8
	*/
	open: function (event) {
		/**
		* Open the modal by adding the class.
		*/
		$("body").addClass("addonify-qvm-is-active");

		/**
		* Dispatch events, jQuery and vanilla.
		*/
		dispatchEvent.opened(event);
	},

	/**
	* Action: close modal.
	*
	* @param {object} event
	* @return {void} void.
	* @since 1.2.8
	*/
	close: function (event) {
		/**
		* Open the modal by adding the class.
		*/
		$("body").removeClass("addonify-qvm-is-active");

		/**
		* Dispatch events, jQuery and vanilla.
		*/
		dispatchEvent.closed(event);
	},
}
