const { isEqual: equal, cloneDeep } = window.lodash;

/**
 * Compare if arguments are equal.
 *
 * @param {any} arg1
 * @param {any} arg2
 * @returns {boolean}
 */
export const isEqual = (arg1: any, arg2: any): boolean => {
	return equal(arg1, arg2) ? true : false;
};

/**
 * Clone the deeply nested object.
 *
 * @param {any} arg
 * @returns {any}
 */
export const clone = (arg: any): any => {
	return cloneDeep(arg);
};
