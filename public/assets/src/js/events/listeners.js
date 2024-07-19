import { action } from "./actions";
import { helper } from "../utils/helpers";

let $ = window.jQuery;

export function initEventListeners() {
	for (const method in listeners) {
		listeners[method]();
	}
}

/**
* Collection of event listeners.
* Listen to the all the events in the quick view modal.
*
* @since 1.2.17
*/
const listeners = {
	/**
	* Listen event: modal open.
	* Open the modal when button is clicked.
	*
	* @returns {void}
	* @since 1.2.17
	*/
	open: function () {

		const { ajaxQuickViewAction } = addonifyQuickViewPublicScriptObject;

		if (typeof ajaxQuickViewAction !== 'undefined') {
			const quickViewBtnEle = $(".addonify-qvm-button");

			quickViewBtnEle.on("click", function (e) {
				e.preventDefault();
				const id = $(this).data("product_id");
				return id ? action.open(id) : null;
			});
		}
	},

	/**
	* Listen event: modal close.
	*
	* @since 1.2.17
	*/
	close: function () {
		const closeBtnEle = $("#addonify-quick-view-modal-close");

		const { animateModelOnClose, closeModalOnEscClicked, closeModelOnOutsideClicked } = addonifyQuickViewPublicScriptObject;

		/**
		* Close when close button is clicked.
		*/
		closeBtnEle.on("click", function (e) {
			e.preventDefault();
			return animateModelOnClose ? helper.animate() : action.close();
		});

		/**
		* Close the modal on ESC key pressed.
		*/
		if (closeModalOnEscClicked) {
			$(document).keyup(function (e) {
				if (e.keyCode === 27) {
					return animateModelOnClose ? helper.animate() : action.close();
				}
			});
		}

		/**
		* Close the modal when clicked outside the modal.
		*/
		if (closeModelOnOutsideClicked) {
			const wrapperEle = $("#addonify-quick-view-modal-wrapper");
			// Set cursor to pointer.
			wrapperEle.css("cursor", "pointer");
			// Listen to the click event.
			wrapperEle.on("click", function (e) {
				if (e.target.id === "addonify-quick-view-modal-wrapper") {
					return animateModelOnClose ? helper.animate() : action.close();
				}
			});
		}
	},

	/**
	* Listen event: modal content loading.
	*
	* @since 1.2.17
	*/
	contentLoading: function () {
		$(document).on("addonifyQuickViewModalLoading", function (e, data) {
			helper.setSpinner(true);
		});
	},

	/**
	* Listen event: modal content loaded.
	*
	* @since 1.2.17
	*/
	contentLoaded: function () {
		$(document).on("addonifyQuickViewModalContentLoaded", function (e, data) {
			helper.setSpinner(false);
		});
	},
}
