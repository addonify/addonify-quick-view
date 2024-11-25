const { apiFetch } = window.wp;

interface FetchArgs {
	data?: any;
	body?: any;
	headers?: Record<string, string>;
}

/**
 * Get the nonce from the wp_localize script.
 *
 * @var $nonce
 * @since 2.0.0
 */
const nonce = window.addonifyQuickViewLocals.nonce;

/**
 * Function that wraps apiFetch function.
 *
 * @param {string} path
 * @param {string} method
 * @param {FetchArgs} arg
 * @returns {Promise<[Error | null, unknown | null]>}
 *
 * @usage const [error, data] = await useFetch(url, method, { data, headers });
 * @since 2.0.0
 */
export const useFetch = async (
	path: string,
	method: string,
	arg: FetchArgs = {}
): Promise<[Error | null, unknown | null]> => {
	const [e, res] = await apiFetch({
		path,
		method,
		data: arg?.data ? arg.data : null,
		body: arg?.body ? arg.body : null,
		headers: {
			"X-WP-ADMIN-NONCE": nonce,
			"cache-control": "no-cache",
			...arg?.headers,
		},
	})
		.then((result: any) => {
			return [null, result || null];
		})
		.catch((e: Error) => {
			return [e, null];
		});

	return [e, res];
};

/**
 * Function that wraps HTTP fetch api.
 *
 * @param {string} url
 * @param {string} method
 * @param {FetchArgs} arg
 * @returns {Promise<[Error | null, any | null]>}
 *
 * @usage const [error, data] = await useExtFetch(url, method, { data, headers });
 * @since 2.0.0
 */
export const useExtFetch = async (
	url: string,
	method: string,
	arg: FetchArgs = {}
): Promise<[Error | null, any | null]> => {
	try {
		const res = await fetch(url, {
			method,
			body: arg?.data ? JSON.stringify(arg.data, null, 2) : null,
			headers: { ...arg?.headers },
		});

		if (!res.ok) {
			throw new Error("Failed to get recommended plugins list.");
		}

		const result = await res.json();

		if (!result) {
			throw new Error("Failed to get recommended plugins list.");
		}

		return [null, result];
	} catch (e) {
		return [e, null];
	}
};
