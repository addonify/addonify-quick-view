'use strict';

/**
*
* Function that checks "adfy-qvm-scrollbar" div.
* If it exists, then it will initiate perfect scrollbar.
* 
* @return {void} void
* @since 1.2.5
*/

addonifyQuickViewPerfectScrollBar = () => {

    if (typeof PerfectScrollbar === 'function') {

        const addonifyQvScrollableDivEle = document.getElementById('addonify-quick-view-modal');

        if (addonifyQvScrollableDivEle) {

            new PerfectScrollbar(addonifyQvScrollableDivEle, {

                wheelSpeed: 1,
                wheelPropagation: true,
                minScrollbarLength: 20
            });
        }
    } else {

        console.warn("Info: Addonify Quick View, PerfectScrollbar is not defined. Perfect scroll bar won't be initialized.");
    }
}


/**
*
* DOMContentLoaded event.
* 
* @since 1.2.5
*/

document.addEventListener("DOMContentLoaded", addonifyQuickViewPerfectScrollBar());