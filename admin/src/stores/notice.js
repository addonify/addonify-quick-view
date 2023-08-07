import { defineStore } from 'pinia'

export const useNoticeStore = defineStore({

    id: 'Notice',

    state: () => ({

        notices: [],
        status: {
            isFetching: true,
        }
    }),

    getters: {

        /**
        * Return if we have notice in memo.
        *
        * @param {Object} state
        * @return {Boolean} true/false
        * @since 1.2.9
        */
        hasNoticeStateInMemory: (state) => {

            if (typeof state.notices === 'object') {

                return Object.keys(state.notices).length > 0 ? true : false;
            }

            if (typeof state.notice === 'array') {

                return state.notices.length > 0 ? true : false;
            }

            return false;
        },

        /**
        * Return if the notice is live or not.
        *
        * @param {Object} state
        * @return {Boolean} true/false
        * @since 1.2.9
        */
        isNoticeLive: (state) => {

            if (state.notice.hasOwn(state.notices, 'live')) {

                return state.notices.live ? true : false;

            } else {

                return false;
            }
        },
    },

    actions: {

        /**
        * 
        * Check for notice. 
        *
        * @since 1.2.9
        */
        async getNotices() {
            try {

                const res = await fetch("https://raw.githubusercontent.com/addonify/addonify-quick-view/main/notice.json");
                const data = await res.json();

                if (res.status == 200) {

                    this.notices = data.notice;
                    this.status.isFetching = false;
                } else {

                    console.log("Addonify quick view: Couldn't fetch notice!");
                    this.status.isFetching = false;
                }

            } catch (error) {

                console.error(error);
                this.status.isFetching = false;
            }
        },
    },
});