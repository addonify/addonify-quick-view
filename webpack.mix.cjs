const mix = require('laravel-mix');

/**
* Notification
*/
mix.disableNotifications();

/**
 * Setup public path to generate assets
 */
mix.setPublicPath('admin/assets/');

/**
 * Auto load jQuery
 */
mix.autoload({
	jquery: ['$', 'window.jQuery', 'jQuery']
});

/**
 * Compile admin assets.
 */
mix.js('admin/src/main.js', 'admin/assets/js/main.js').vue();
mix.sass('admin/assets/scss/index.scss', 'admin/assets/css/admin.css');

/**
* Extract Vendor
* Note: https://laravel-mix.com/docs/6.0/extract
*/
mix.extract();

/**
* Extend Mix
*/
mix.webpackConfig(webpack => {
	return {
		plugins: [
			require('unplugin-element-plus/webpack')({
				// options
			}),
			new webpack.DefinePlugin({
				__VUE_OPTIONS_API__: 'true',
				__VUE_PROD_DEVTOOLS__: 'false',
				__VUE_PROD_HYDRATION_MISMATCH_DETAILS__: 'false'
			})
		]
	};
});
