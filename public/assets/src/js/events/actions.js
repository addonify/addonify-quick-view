import { helper } from "../utils/helpers";
import { dispatchEvent } from "./dispatchers";

export const action = {
	/**
	* Action: open modal.
	*
	* @param {string} id
	* @param {object} args.
	* @returns {Promise<HTML>}
	* @since 1.2.8
	*/
	open: async function (id, args = {}) {
		if (!id) {
			throw new Error("AQV: product ID is required.");
		}

		/**
		* Remove class.
		*/
		document.body.classList.add("addonify-qvm-is-active");

		/**
		* Dispatch event.
		*/
		dispatchEvent.opened(id);

		/**
		* Get the content.
		*/
		helper.getContent(id, args);
	},

	/**
	* Action: close modal.
	*
	* @param {object} event
	* @returns {void} void.
	* @since 1.2.8
	*/
	close: function (event) {
		/**
		* Open the modal by adding the class.
		*/
		document.body.classList.remove("addonify-qvm-is-active");

		/**
		* Clear the content.
		*/
		helper.clearContent();

		/**
		* Dispatch event.
		*/
		dispatchEvent.closed(event);
	},
}
