import { action } from "src/js/events/action";

/**
* Event listener class.
* Listen to the all the events in the quick view modal.
* Use vanilla JS to listen to the events. No jQuery here.
*
* @since 1.2.17
*/
export class EventListener {
	constructor() {
		/**
		* Init when the class is instantiated.
		*/
		this.open();
		this.close();
	}

	/**
	* Listen to the open modal event.
	*
	* @return {void} void.
	* @since 1.2.8
	*/
	open() {
		const closeEle = document.getElementById("addonify-quick-view-modal-close");

		if (closeEle && closeEle.length > 0) {
			closeEle.on("click", (e) => {
				e.preventDefault();
				action.open();
			})
		}
	}

	/**
	* Listen to the close modal event.
	*
	* @return {void} void.
	* @since 1.2.8
	*/
	close() {
		const { animateModelOnClose, closeModalOnEscClicked, closeModelOnOutsideClicked } = addonifyQuickViewPublicScriptObject;

		/**
		* Animate the modal.
		*/
		if (animateModelOnClose) {

		}

		/**
		* Close the modal on ESC key pressed.
		*/
		if (closeModalOnEscClicked) {

		}

		/**
		* Close the modal on outside clicked.
		*/
		if (closeModelOnOutsideClicked) {

		}
	}
}

/**
* Event listener for jQuery.
*
* @since 1.2.17
*/
export function eventListenerJQuery() {

	/**
	* Listen to the modal opened event.
	*
	* @since 1.2.17
	*/
	$(document).on("addonifyQuickViewModalOpened", function () {
		// Do something here.
	});
}
