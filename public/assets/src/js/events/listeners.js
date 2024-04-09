import { action } from "src/js/events/action";

/**
* Event listener class.
* Listen to the all the events in the quick view modal.
*
* @returns {void}
* @since 1.2.17
*/
export function eventListeners() {
	/**
	* Event: open modal.
	*
	* @since 1.2.17
	*/
	const quickViewBtnEle = $(".addonify-qvm-button");

	quickViewBtnEle.on("click", function (e) {
		e.preventDefault();

		const id = $(this).data("product_id");

		return id ? action.open(id) : null;
	});

	/**
	* Event: close modal.
	*
	* @since 1.2.17
	*/
	const closeBtnEle = $("#addonify-quick-view-modal-close");

	const { animateModelOnClose, closeModalOnEscClicked, closeModelOnOutsideClicked } = addonifyQuickViewPublicScriptObject;

	closeBtnEle.on("click", function (e) {
		e.preventDefault();
		return animateModelOnClose ? action.animate() : action.close();
	});

	/**
	* Close the modal on ESC key pressed.
	*/
	if (closeModalOnEscClicked) {
		$(document).keyup(function (e) {
			if (e.keyCode === 27) {
				return animateModelOnClose ? action.animate() : action.close();
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

		wrapperEle.on("click", function (e) {
			if (e.target.id === "addonify-quick-view-modal-wrapper") {
				return animateModelOnClose ? action.animate() : action.close();
			}
		});
	}

	/**
	* Custom event: modal opened.
	*
	* @since 1.2.17
	*/
	document.addEventListener("addonifyQuickViewModalOpened", function (event, id) {
		// Do something here.
	});
}
