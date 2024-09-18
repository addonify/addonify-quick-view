const { apiFetch } = window.wp;

/**
 * Function that wraps apiFetch function.
 *
 * @param {string} url
 * @param {method} method
 * @param {data} data
 * @param {headers} headers
 * @returns {Promise<any>} response
 *
 * @usage const [error, data] = await useFetch(url, method, data, headers);
 * @since 2.0.0
 */
export const useFetch = async (
	path: string,
	method: string,
	data: any = null,
	headers: Record<string, string> = {}
): Promise<[Error | null, any | null]> => {
	const [e, response] = await apiFetch({
		path,
		method: method,
		headers: { "cache-control": "no-cache", ...headers },
		body: data ? JSON.stringify(data, null, 2) : null,
	})
		.then((result: any) => {
			return [null, result || null];
		})
		.catch((e: Error) => {
			return [e, null];
		});

	return [e, response];
};
