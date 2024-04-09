import { dispatchEvent } from "src/js/events/dispatch";

export const action = {
	/**
	* Action: open modal.
	*
	* @param {string} id
	* @returns {Promise<HTML>}
	* @since 1.2.8
	*/
	open: async function (id) {
		// Add class.
		$("body").addClass("addonify-qvm-is-active");

		// Dispatch event.
		dispatchEvent.opened(id);

		// Fetch the product.

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
		$("body").removeClass("addonify-qvm-is-active");

		/**
		* Dispatch events, jQuery and vanilla.
		*/
		dispatchEvent.closed(event);
	},

	/**
	* Hide/show spinner.
	*
	* @param {boolean} val.
	* @returns {void} void.
	* @since 1.2.9
	*/
	setSpinner: function (val = true) {
		const spinner = document.getElementById("adfy-qvm-spinner");

		if (spinner) {
			if (val) {
				spinner.classList.remove("hide");
			} else {
				spinner.classList.add("hide");
			}
		}
	},

	/**
	* Animate the modal.
	*
	* @returns {void}
	* @since 1.2.10
	*/
	animate: function () {
		let openingTask = null;
		let closingTask = null;
		const wrapperEle = $("#addonify-quick-view-modal-wrapper");

		wrapperEle.removeClass("play-opening-animation");
		wrapperEle.addClass("play-closing-animation");

		/**
		* Remove closing animation class after 800ms
		*/
		clearTimeout(closingTask);
		closingTask = setTimeout(() => {
			// Close the modal.
			action.close();
			// Remove the class.
			wrapperEle.removeClass("play-closing-animation");
			clearTimeout(closingTask);
		}, 800);

		/**
		* Reset opening animation class after 1000ms
		*/
		clearTimeout(openingTask);
		openingTask = setTimeout(() => {
			wrapperEle.addClass("play-opening-animation");
			clearTimeout(openingTask);
		}, 1200);
	},

	/**
	* Scroll to the modal view.
	*
	* @returns {void}
	* @since 1.2.10
	*/
	scrollToView: function () {
		const modalEle = $("#adfy-quick-view-model-inner");

		if (modalEle && modalEle.length > 0) {
			modalEle.animate({ scrollTop: 0 }, "slow");
		}
	},
}
