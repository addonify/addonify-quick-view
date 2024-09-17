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

interface I18N {
	__(key: string, ...args: string[]): string;
}

interface WP {
	i18n: I18N;
	apiFetch: (url: string) => Promise<any>;
}

export interface SettingValue {
	[key: string]: string | number | boolean;
}

export interface Option {
	[key: string]: {
		type: string;
		className: string;
		label: string;
		description: string;
		dependent?: string[];
		value: string | number | boolean;
		isAlphaPicker?: boolean;
		choices?: {
			[key: string]: string | number | boolean;
		};
	};
}

export interface SettingTab {
	[key: string]: {
		title: string;
		icon: string;
		sections: {
			[key: string]: Option;
		};
	};
}
