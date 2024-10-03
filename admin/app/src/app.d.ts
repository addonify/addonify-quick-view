declare module "@vue/runtime-core" {
	export interface GlobalComponents {
		LottieAnimation: typeof import("vue3-lottie")["Vue3Lottie"];
	}
}

declare global {
	interface Window {
		wp: WP;
		lodash: any;
		addonifyQuickViewLocals: {
			[key: string]: string;
		};
	}
}

export interface ISettings {
	settings_value: SettingValue;
	tabs: SettingTab[];
}

interface WP {
	apiFetch: (args: Record<string, any>) => Promise<any>;
}

export interface SettingValue {
	[key: string]: string | number | boolean;
}

export interface Option {
	type: string;
	className: string;
	label: string;
	description: string;
	dependent?: string[];
	value: string | number | boolean;
	isAlphaPicker?: boolean;
	placeholder?: string;
	multiple?: boolean;
	width?: string;
	design?: string;
	min?: number;
	max?: number;
	step?: number;
	precision?: number;
	unit?: string;
	sliderInput?: boolean;
	sliderSteps?: number;
	note?: string;
	caption?: string;
	buttonLabel?: string;
	choices?: {
		[key: string]: any;
	};
}

export interface SettingTab {
	[key: string]: {
		title: string;
		icon: string;
		sections: {
			[key: string]: Option[];
		};
	};
}

export interface InstalledAddon {
	name: string;
	plugin: string;
	status: string;
	author: string;
	author_uri: string;
	plugin_uri: string;
	description: {
		raw: string;
		rendered: string;
	};
	version: string;
	textdomain: string;
	requires_wp: string;
	requires_php: string;
	network_only: boolean;
	_links: {
		self: [
			{
				[key: string]: string;
			}
		];
	};
}

export interface Products {
	name: string;
	description: string;
	thumbnail: string;
	category: string;
	status: string;
}

export interface RecommendationData {
	author: string;
	version: string;
	license: string;
	data: {
		hot: Products[];
	};
}

export interface ProductsViewsCount {
	id: number;
	name: string;
	image: string;
	link: string;
	viewsCount: number;
}

export interface ProductsViewsCountResponse {
	totalItems: number;
	limit: number;
	offset: number;
	productsViews: ProductsViewsCount[];
}

export interface ViewCountChartDataResponse {
	from: string | null;
	to: string | null;
	views: Record<string, number>[] | null;
}
