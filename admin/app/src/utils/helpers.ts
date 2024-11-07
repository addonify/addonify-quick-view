const { isEqual: equal, cloneDeep } = window.lodash;

/**
 * Compare if arguments are equal.
 *
 * @param {unknown} arg1
 * @param {unknown} arg2
 * @returns {boolean}
 * @since 2.0.0
 */
export const isEqual = (arg1: unknown, arg2: unknown): boolean => {
	return equal(arg1, arg2) ? true : false;
};

/**
 * Clone the deeply nested object.
 *
 * @param {unknown} arg
 * @returns {unknown} - cloned object.
 * @since 2.0.0
 */
export const clone = <T>(arg: T): T => {
	return cloneDeep(arg) as T;
};

/**
 * Sleep for a given amount of time.
 *
 * @param {number} ms
 * @returns {Promise<unknown>}
 * @since 2.0.0
 */
export const sleep = (ms: number): Promise<unknown> => {
	return new Promise((resolve) => setTimeout(resolve, ms));
};

/**
 * Slice the string to the given length.
 *
 * @param {string} str.
 * @param {number} chars.
 * @returns {string}
 * @since 2.0.0
 */
export const slice = (str: string, chars: number): string => {
	return str.length > chars ? `${str.slice(0, chars)}...` : str;
};

/**
 * Check if the pro version is active.
 *
 * @returns {boolean}
 * @since 2.0.0
 */
export const isProActive = (): boolean => {
	return window.addonifyQuickViewLocals.isProActive === "1" ? true : false;
};
