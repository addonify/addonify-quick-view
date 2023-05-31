'use strict';

/**
*
* Function that checks "addonify-quick-view-modal" div.
* If it exists, then it will initiate perfect scrollbar.
* 
* @return {void} void
* @since 1.2.5
*/

addonifyQuickViewPerfectScrollBar = () => {

    const addonifyQvScrollableDivEle = document.getElementById('addonify-quick-view-modal');

    if (addonifyQvScrollableDivEle) {

        new PerfectScrollbar(addonifyQvScrollableDivEle, {

            wheelSpeed: 1,
            wheelPropagation: true,
            minScrollbarLength: 20
        });
    }
}


/**
*
* DOMContentLoaded event.
* 
* @since 1.2.5
*/

document.addEventListener("DOMContentLoaded", addonifyQuickViewPerfectScrollBar());