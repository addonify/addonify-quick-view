export const util = {
	/**
	* Check if the quick view modal is opened.
	*
	* @returns {boolean}
	* @since 1.2.17
	*/
	isOpened: function () {
		return $("body").hasClass("addonify-qvm-is-active");
	},
}
