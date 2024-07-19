import path from 'path';
import { fileURLToPath } from 'url';
import resolve from '@rollup/plugin-node-resolve';
import babel from '@rollup/plugin-babel';
import alias from '@rollup/plugin-alias';
import terser from '@rollup/plugin-terser';
import commonjs from '@rollup/plugin-commonjs';
import scss from 'rollup-plugin-scss';
import postcss from 'postcss';
import cssnano from 'cssnano';
import autoprefixer from 'autoprefixer';
import postcssRTLCSS from 'postcss-rtlcss';
import { Mode, Source } from 'postcss-rtlcss/options';

/**
 * Define extensions to be resolved via alias.
 *
 * @since 1.0.0
 */
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const rootDir = path.resolve(__dirname);

const resolveExtensions = resolve({
	extensions: ['.mjs', '.js', '.jsx', '.json', '.sass', '.scss']
});

const resolveAlias = alias({
	entries: [{
		find: 'src',
		replacement: path.resolve(rootDir, './public/assets/src/')
	}],
	resolveExtensions
});

/**
 * Prepare global options.
 * Holds path & name of source and destination assets.
 *
 * @since 1.0.0
 */
const assets = {
	"js": {
		"src": "./public/assets/src/public.js",
		"build": "./public/assets/build/public.min.js",
	},
	"scss": {
		"src": "./public/assets/src/scss",
		"build": "./public/assets/build/public.min.css",
		"buildName": "public.min.css",
	},
}

export default [
	{
		input: assets['js']['src'],
		output: {
			file: assets['js']['build'],
			name: 'js',
			format: 'umd', // "umd", "iife", "esm", "cjs"
		},
		plugins: [
			resolve(),
			commonjs(),
			babel({ presets: ['@babel/preset-env'], babelHelpers: 'bundled' }),
			terser(),
			scss({
				output: assets['scss']['build'],
				fileName: assets['scss']['buildName'],
				sourceMap: true,
				watch: assets['scss']['src'],
				processor: async () => postcss([
					autoprefixer(),
					postcssRTLCSS({
						mode: Mode.override,
						source: Source.ltr,
					}),
					cssnano()
				])
			}),
			resolveAlias,
		]
	}
];
