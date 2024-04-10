import { util } from "./utils";
import { action } from "../events/actions";
import { dispatchEvent } from "../events/dispatchers";

let $ = window.jQuery;

export const helper = {
	/**
	* Calculate modal height.
	*
	* @returns {void} void.
	* @since 1.2.9
	*/
	calcHeight: function () {
		if (util.isOpened()) {
			const height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

			const addonifyQuickViewModalEle = document.getElementById("addonify-quick-view-modal");

			if (addonifyQuickViewModalEle) {
				// Deduct '40px' from the height of the window.
				const processHeight = height - 40;
				addonifyQuickViewModalEle.style.maxHeight = processHeight + "px";
			}
		}
	},

	/**
	* Hide/show spinner.
	*
	* @param {boolean} val.
	* @returns {void} void.
	* @since 1.2.9
	*/
	setSpinner: function (val) {
		const targetEle = document.getElementById("adfy-qvm-spinner");

		if (targetEle) {
			return val ? targetEle.classList.remove("hide") : targetEle.classList.add("hide");
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
			/**
			* Close the modal.
			*/
			action.close();

			/**
			* Remove class.
			*/
			wrapperEle.removeClass("play-closing-animation");
			clearTimeout(closingTask);
		}, 800);

		/**
		* Reset opening animation class after 1000ms
		*/
		clearTimeout(openingTask);
		openingTask = setTimeout(() => {
			/**
			* Add class.
			*/
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

	/**
	* Load modal image gallery.
	*
	* @returns {void} void.
	* @since 1.2.8
	*/
	wcGallery: function () {
		const gallery = $("#addonify-quick-view-modal .woocommerce-product-gallery");

		if (gallery && gallery.length > 0) {
			gallery.each(function () {
				$(this).wc_product_gallery();
			})
		}
	},

	/**
	* Render modal gallery icon.
	*
	* @returns {void} void.
	* @since 1.2.8
	*/
	wcGalleryIcon: function () {
		const icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M24,8V2a2,2,0,0,0-2-2H16V2h4.586L12,10.586,3.414,2H8V0H2A2,2,0,0,0,0,2V8H2V3.414L10.586,12,2,20.586V16H0v6a2,2,0,0,0,2,2H8V22H3.414L12,13.414,20.586,22H16v2h6a2,2,0,0,0,2-2V16H22v4.586L13.414,12,22,3.414V8Z"/></svg>';

		const trigger = $('#addonify-quick-view-modal .woocommerce-product-gallery__trigger');

		if (trigger && trigger.length > 0) {
			trigger.html(" ").html(icon);
		}
	},

	/**
	* Load perfect scrollbar in modal.
	*
	* @returns {void} void.
	* @since 1.2.8
	*/
	loadScrollbar: function () {
		if (typeof PerfectScrollbar !== "undefined") {
			// Use vanilla to query the DOM. jQuery won't work.
			const scrollEle = document.getElementById("adfy-quick-view-model-inner");

			if (scrollEle) {
				new PerfectScrollbar(scrollEle, {
					wheelSpeed: 0.25,
					wheelPropagation: true,
					minScrollbarLength: 20
				});
			}
		}
	},

	/**
	* Remove cart form action attribute.
	*
	* @returns {void} void.
	* @since 1.2.8
	*/
	removeCartFormAction: function () {
		const modalCartFormEle = $("#addonify-quick-view-modal #adfy-quick-view-modal-content form.cart");

		if (modalCartFormEle.length > 0) {
			modalCartFormEle.removeAttr("action");
		}
	},

	/**
	* Reload variation form.
	*
	* @returns {void} void.
	* @since 1.2.8
	*/
	reloadVariationForm: function () {
		const modalEle = $("#addonify-quick-view-modal #adfy-quick-view-modal-content");

		if (modalEle.length > 0) {
			const varForm = modalEle.find(".variations_form");

			if (varForm.length > 0) {

				varForm.each(function () {
					$(this).wc_variation_form();
				});

				varForm.trigger("check_variations");
				varForm.trigger("reset_image");
			}
		}
	},

	/**
	* Clear modal content.
	*
	* @returns {void}
	* @since 1.2.17
	*/
	clearContent: function () {
		const modalEle = $("#addonify-quick-view-modal #adfy-quick-view-modal-content");

		if (modalEle.length > 0) {
			modalEle.html(" ");
		}
	},

	/**
	* Get modal content.
	*
	* @param {string} id.
	* @param {object} args.
	* @returns {Promise<void>}
	* @since 1.2.10
	*/
	getContent: async function (id, args = {}) {
		try {
			if (!id) {
				throw new Error("AQV: product ID is required.");
			}

			/**
			* Dispatch event to clear the modal window.
			*/
			helper.clearContent();

			/**
			* Set spinner and dispatch loading event.
			*/
			helper.setSpinner(true);

			/**
			* Dispatch loading event.
			*/
			dispatchEvent.loading(id);

			const { ajaxURL, quickViewAction, nonce } = addonifyQuickViewPublicScriptObject;

			let url = ajaxURL;
			let query = `action=${quickViewAction}&productId=${id}&nonce=${nonce}`;

			/**
			* Modify the URL and query if args are passed.
			* Also adds support for the pro version.
			*
			* @since 1.2.17
			*/
			if (args && Object.keys(args).length > 0) {
				if (args.url && args.url.length > 0) {
					url = args.url;
				}

				const newQuery = {
					"productId": id,
				};

				// Build new query from args.
				Object.keys(args).forEach((key) => {
					if (key !== "url") {
						newQuery[key] = args[key];
					}
				});

				// Convert object to query string.
				query = new URLSearchParams(newQuery).toString();
			}

			const res = await fetch(`${url}?${query}`);

			if (!res.ok) {
				throw new Error("AQV: error loading content.");
			}

			const content = await res.json();

			if (!content.success || !content.data) {
				throw new Error(content.message || "AQV: error loading content.");
			}

			/**
			* Stop the spinner.
			*/
			helper.setSpinner(false);

			/**
			* Render the HTML content.
			*/
			helper.renderContent(content.data);

			/**
			* Dispatch loaded event.
			*/
			dispatchEvent.loaded(content.data);
		} catch (err) {
			throw new Error(err.message || "AQV: error loading content.");
		}
	},

	/**
	* Render content to the modal.
	*
	* @param {HTML} data.
	* @returns {void}
	* @since 1.2.10
	*/
	renderContent: function (data) {
		const modalEle = $("#addonify-quick-view-modal #adfy-quick-view-modal-content");

		const { enableWcGalleryLightBox, wcsattEnabled } = addonifyQuickViewPublicScriptObject;

		if (modalEle && modalEle.length > 0) {
			/**
			* Clear the modal HTML and load the new content.
			*/
			modalEle.html(" ").html(data);

			/**
			* Load wc gallery images.
			*/
			helper.wcGallery();

			/**
			* Render gallery icon.
			*/
			if (enableWcGalleryLightBox) {
				helper.wcGalleryIcon();
			}

			/**
			* Load scrollbar.
			*/
			helper.loadScrollbar();

			/**
			* Remove action form attribute.
			*/
			helper.removeCartFormAction();

			/**
			* Reload variation form.
			*/
			helper.reloadVariationForm();

			/**
			* If all products for WooCommerce Subscriptions is active,
			* trigger JS event `wcsatt-initialize` to enable the subscription selection.
			*/
			if (wcsattEnabled && wcsattEnabled === "1") {
				$(document.body).trigger("wcsatt-initialize");
			}
		}
	},
}

