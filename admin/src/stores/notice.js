import { defineStore } from 'pinia'

export const useNoticeStore = defineStore({

    id: 'Notice',

    state: () => ({

        alerts: {},

        status: {
            isFetching: true,
        }
    }),

    getters: {

        /**
        * Return if we have alerts in memo.
        *
        * @param {Object} state
        * @return {Boolean} true/false
        * @since 1.2.9
        */
        hasNoticeStateInMemory: (state) => {

            if (typeof state.alerts === 'object') {

                return Object.keys(state.alerts).length > 0 ? true : false;
            }

            if (typeof state.alerts === 'array') {

                return state.alerts.length > 0 ? true : false;
            }

            return false;
        },
    },

    actions: {

        /**
        * 
        * Check for notice. 
        *
        * @since 1.2.9
        */
        async checkNotices() {
            try {

                const res = await fetch("https://raw.githubusercontent.com/addonify/addonify-quick-view/development/notice.json");

                const data = await res.json();

                if (res.status == 200) {

                    this.alerts = data;
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