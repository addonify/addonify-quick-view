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
	width?: string;
	design?: string;
	min?: number;
	max?: number;
	step?: number;
	precision?: number;
	sliderTipText?: string;
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
