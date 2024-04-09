/**
	* Load perfect scrollbar in modal.
	*
	* @returns {void} void.
	* @since 1.2.8
	*/
export function loadScrollbar() {
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
}
