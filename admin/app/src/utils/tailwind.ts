import { twMerge } from "tailwind-merge";

/**
 * Function that wraps tailwind merge function and,
 * merges the tailwind classes.
 *
 * @param {string} class
 * @returns {string} class
 * @since 2.0.0
 */
export const mc = (str: string): string => twMerge(str);
