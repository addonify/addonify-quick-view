=== Addonify WooCommerce Quick View ===

Contributors: addonify
Donate link: https://addonify.com/contact/
Tags:  woocommerce, quick view, woocommerce quick view, products quick view, quickview
Requires at least: 5.9
Requires PHP: 7.4
Tested up to: 6.2.2
Stable tag: 1.2.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Addonify WooCommerce Quick View plugin adds functionality to have a WooCommerce product quick preview on a modal window.

== Description ==

Addonify WooCommerce Quick View plugin adds functionality to have a WooCommerce product quick preview on a modal window.

👉 [Demo one](https://demo.addonify.com/woo/01/) *(Custom quick view button)*
👉 [Demo two](https://demo.addonify.com/woo/01/quick-view-ii/) *(Default Store Front theme)*
👉 [Documentation guide](https://docs.addonify.com/kb/woocommerce-quick-view/) 

If you run an online e-commerce shop you are already familiar with the number of products that your users will see in your store page. This plugin allows your website visitors to quickly view the product summary insisted on going through each products detail page. This could save the time of your visitors & increase your revenue.  

**MAIN FEATURES:**

✅ Easy to use.
✅ Super light-weight & optimized for performance. 
✅ Add a quick view button in product loop to open a modal window with the product summary using ajax.
✅ Display product image or gallery on quick view modal.
✅ Display product title, price, add to cart button, excerpt and view detail button on quick view modal.
✅ Disable quick view on mobile device.
✅ Color option for quick view modal popup & overlay.
✅ Color option for elements inside quick view modal popup box.
✅ Change a label for the “Quick view” button.
✅ Developer friendly & easy to implement according to your need.
✅ Friendly support.

**DEVELOPER DOCUMENTATION:**

If you are a developer or a theme author, below are the two different ways on how Addonify WooCommerce Quick View can be implemented in your project. 

✅ Using Hooks & Filters.
✅ Overwrite Addonify quick view plugin template file. 

Need a getting started guide? Feel free to check [developer documentation](https://docs.addonify.com/docs/woocommerce-quick-view/) in our knowledgebase site.

**SUGGESTION & SUPPORT:**

We are open to discuss on how we can improve our plugin. We would like to welcome you to join the discussion and share your ideas. Please be informed that discussions are not just limited to sharing ideas, feel free to ask questions related to our plugin, submit a bug report and participate in poll.

👉 [Create a new discussion](https://github.com/addonify/addonify-quick-view/discussions)
👉 [Report a bug](https://github.com/addonify/addonify-quick-view/issues)


== Installation ==

1. Download the plugin.
1. Unzip the downloaded zip file.
2. Upload the plugin folder into the `wp-content/plugins/` directory of your WordPress site.
3. Activate `Addonify WooCommerce Quick View` from Dashboard > Plugins.

== Screenshots ==

1. Addonify Quick View setting page at dashboard.
2. Addonify Quick View button & modal box popup on frontend.

== Changelog ==

= 1.2.6 - 07 June, 2023 =

- Enhancement: Console warn if perfect scroll bar couldn't be initialized. #165

= 1.2.5 - 31 May, 2023 =

- Fix: Uncaught ReferenceError: PerfectScrollbar is not defined.
- Tweak: Disabled page scrolling when quick view modal is visible.
- Tweak: How reactive state on plugin setting's page is managed (vue js).
- Enhancement: Better error handelling on plugin setting's page (vue js).

= 1.2.4 - 20 May, 2023 =

- Updated: AJAX JS and AJAX callback handler for displaying quick view content.
- Updated: Mobile_Detect PHP library.
- Updated: Body classname `addonify-quick-view-disabled` to `addonify-quick-view-disabled-on-mobile`.
- Dev: Upgraded mobiledetect/mobiledetectlib to version 2.8.41 => 3.74.0.
- Tested: On WooCommerce version 7.7.0

= 1.2.3 - 07 March, 2023 =

- Update: Static texts in UDP Agents are now translation ready.

= 1.2.2 - 03 March, 2023 =

- Updated: UDP agent to version 1.0.1

= 1.2.1 - 24 January, 2023 =

- Added: Recommended products in quick view setting page. 

= 1.2.0 - 28 December, 2022 =

- Fix: PHP error, `Undefined variable: product_id` on line 22 and 28 in `addonify-quick-view-content.php` file.

= 1.1.9 - 19 December, 2022 =

- Added: UDP Agent. Ref: https://creamcode.org/user-data-processing/

= 1.1.8 - 18 November, 2022 =

- Improvement: ColorPicker in settings page.

= 1.1.7 - 2 November, 2022 =

- Tested: WordPress 6.1
- Tested: WordPress 7.0.1

= 1.1.6 - 18 September, 2022 =

- New: Modal box general text color. #111
- New: Modal box inputs background color. #111
- New: Modal box inputs text color. #111
- New: Modal box spinner icon color. #111
- Added: Admin setting page option visibility conditional logic.
- Fix: Variation form issue in quick view.
- Updated: Frontend templates can be overridden from themes. Overridden path changed to 'addonify/quick-view/'.
- Updated: Hooks and filter name prefix changed from 'addonify_quick_view/' and 'addonify_qv_' to 'addonify_quick_view_'.

= 1.1.5 - 31 August, 2022 =

- Tested: with WordPress version 6.0.2.

= 1.1.4 - 15 July, 2022 =

- Tested: with WordPress version 6.0.1.

= 1.1.3 - 7 July, 2022 =

- Fixed: Text domain string in Invalid Control Component (Vue js).

= 1.1.2 - 29 June, 2022 =

- Changed: Settings fields labels and texts.
- Updated: Settings fields value sanitization functions.

= 1.1.1 - 27 June, 2022 =

- Added: Option to disable quick view on mobile devices.
- Added: Mobile_Detect library added.

= 1.1.0 - 18 June, 2022 = 

- Tweak: Changed default setting values.

= 1.0.9 - 17 June, 2022 =

- Fix: Issue with the display grid layout.

= 1.0.8 - 16 June, 2022 =

- Tweak: Adaptive height for quick view modal box according to the content.
- Added: View detail button label inside quick view modal box.

= 1.0.7 - 16 June, 2022 =

- Updated: New admin dashboard setting page (Build with Vue Js 3).
- Added: Rest API endpoint for setting page.

= 1.0.6 - 29 March, 2022 =

- Tweak: Quick view modal z-index.

= 1.0.5 - 10 March, 2022 =

- Tweak: Changed perfectscroll library to conditional.
- Tweak: Quick view modal design.
- Tested: with WordPress version 5.9.2.
- Updated: Dev tools (NPM & GULP).

= 1.0.4 - 21 July, 2021 =

- Fix: wp-color-picker-alpha js issue.
- Updated: wp-color-picker-alpha.min.js to version 3.0.0.
- Updated: lc_switch to version 2.0.3.
- Removed: lc_switch.css.

= 1.0.3 - 8 January, 2021 =

- Added: Tested up to WordPress version 5.6. 

= 1.0.2 - 26 September, 2021 = 

- Fix: Quick view modal content not being populated while in initial installation.

= 1.0.1 - 23 September, 2020 = 

- Fix: Basic styling.
- Fix: Readme.txt file links.

= 1.0.0 - 11 August, 2020 = 

- Initial release.
