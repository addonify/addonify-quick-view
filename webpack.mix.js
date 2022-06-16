const mix = require('laravel-mix');

/**
* Notification 
*/

mix.disableNotifications();

/**
 * Modules
*/

//module.exports = {
//    plugins: [
//        require('postcss-preset-env')
//    ]
//}

/**
* Alias
*/

//mix.alias({
//    '@': path.join(__dirname, 'admin/src/')
//});

/**
* Browser sync
*/

//mix.browserSync({
//    proxy: 'http://wpvue.local/wp-admin/admin.php?page=addonify_quick_view#/',
//});

/**
 * Setup public path to generate assets
 */

mix.setPublicPath('admin/assets/');

/**
 * Autoload jQuery
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
