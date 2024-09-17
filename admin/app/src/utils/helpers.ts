const { isEqual: equal, cloneDeep } = window.lodash;

/**
 * Compare if arguments are equal.
 *
 * @param {unknown} arg1
 * @param {unknown} arg2
 * @returns {boolean}
 */
export const isEqual = (arg1: unknown, arg2: unknown): boolean => {
	return equal(arg1, arg2) ? true : false;
};

/**
 * Clone the deeply nested object.
 *
 * @param {unknown} arg
 * @returns {unknown} - cloned object.
 */
export const clone = <T>(arg: T): T => {
	return cloneDeep(arg) as T;
};
