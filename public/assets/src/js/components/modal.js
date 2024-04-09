import { action } from "src/js/events/action";
import { dispatchEvent } from "src/js/events/dispatch";

export const modal = {
	/**
	* Calculate modal height.
	*
	* @return {void} void.
	* @since 1.2.9
	*/
	calcHeight: function () {
		const height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

		const addonifyQuickViewModalEle = document.getElementById("addonify-quick-view-modal");

		if (addonifyQuickViewModalEle) {
			// Deduct '40px' from the height of the window.
			const processHeight = height - 40;
			addonifyQuickViewModalEle.style.maxHeight = processHeight + "px";
		}
	},

	/**
	* Load perfect scrollbar in modal.
	*
	* @return {void} void.
	* @since 1.2.8
	*/
	scrollbar: function () {
		if (typeof PerfectScrollbar === 'undefined') {
			console.log("AQV: perfect scrollbar is not defined.");
			return;
		}

		// Use vanilla to query the DOM. jQuery is not working here.
		const scrollEle = document.getElementById("adfy-quick-view-model-inner");

		if (scrollEle) {
			new PerfectScrollbar(scrollEle, {
				wheelSpeed: 0.25,
				wheelPropagation: true,
				minScrollbarLength: 20
			});
		}
	},

	/**
	* Hide/show spinner.
	*
	* @param {boolean}
	* @return {void} void.
	* @since 1.2.9
	*/
	spinner: function (show = true) {
		const spinner = $('#adfy-qvm-spinner');

		if (spinner) {
			if (show) {
				spinner.removeClass('hide');
			} else {
				spinner.hideClass('hide');
			}
		}
	},

	/**
	* Load modal image gallery.
	*
	* @return {void} void.
	* @since 1.2.8
	*/
	wcGallery: function () {
		const gallery = $('#addonify-quick-view-modal .woocommerce-product-gallery');

		if (gallery && gallery.length > 0) {
			gallery.each(function () {
				$(this).wc_product_gallery();
			})
		}
	},

	/**
	* Render modal gallery icon.
	*
	* @return {void} void.
	* @since 1.2.8
	*/
	wcGalleryIcon: function () {
		const icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M24,8V2a2,2,0,0,0-2-2H16V2h4.586L12,10.586,3.414,2H8V0H2A2,2,0,0,0,0,2V8H2V3.414L10.586,12,2,20.586V16H0v6a2,2,0,0,0,2,2H8V22H3.414L12,13.414,20.586,22H16v2h6a2,2,0,0,0,2-2V16H22v4.586L13.414,12,22,3.414V8Z"/></svg>';

		const trigger = $('#addonify-quick-view-modal .woocommerce-product-gallery__trigger');

		if (trigger && trigger.length > 0) {
			trigger.html(" ");
			trigger.html(icon);
		}
	},

	/**
	* Scroll to the modal view.
	*
	* @return {void}
	* @since 1.2.10
	*/
	scrollToView: function () {
		const modalEle = $("#adfy-quick-view-model-inner");

		if (modalEle && modalEle.length > 0) {
			modalEle.animate({ scrollTop: 0 }, "slow");
		}
	},

	/**
	* Animate the modal.
	*
	* @return {void}
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
			action.close();
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
	* Get modal content.
	*
	* @param {string} id.
	* @return {Promise<void>}
	* @since 1.2.10
	*/
	getContent: async function (id) {
		if (!id) {
			throw new Error("AQV: Product ID is required.");
		}

		/**
		* Set spinner.
		*/
		this.spinner(true);

		/**
		* Dispatch loading event.
		*/
		dispatchEvent.loading();

		const { ajaxURL, quickViewAction, nonce } = addonifyQuickViewPublicScriptObject;

		/**
		* Fetch the content.
		*/
		$.ajax({
			type: "GET",
			url: ajaxURL,
			contentType: "application/json; charset=utf-8",
			data: {
				"action": quickViewAction,
				"product_id": id,
				"nonce": nonce,
			},
			success: function (res) {
				if (res.success) {
					dispatchEvent.loaded(res.data);
				}
			},
			error: function (jqXHR, textStatus) {
				console.error(textStatus);
			}
		});
	}
}
