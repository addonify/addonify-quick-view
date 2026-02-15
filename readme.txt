=== Addonify - Quick View For WooCommerce ===

Contributors: addonify
Donate link: https://addonify.com/contact/
Tags:  woocommerce, quick view, woocommerce quick view, products quick view, quickview
Requires at least: 6.4
Requires PHP: 7.4
Tested up to: 6.9.1
Stable tag: 2.0.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Addonify WooCommerce Quick View plugin adds functionality to have a quick preview of WooCommerce product on a popup modal.

== Description ==

Addonify WooCommerce Quick View plugin adds functionality to have a quick preview of WooCommerce product on a popup modal.

🌍 Official Demo: [Link 1](https://demo.addonify.com/woo/01/)
🌍 Official Demo: [Link 2](https://demo.addonify.com/woo/01/quick-view-ii/)
📜 Documentation: [Doc Link](https://docs.addonify.com/kb/quick-view/)

If you run an online e-commerce shop, then you must be familiar with the number of products that your users will see in your store page. This plugin allows your website visitors to quickly view the product summary instead of going through each product's detail page. This could save the time of your visitors & increase your revenue.


**🦄 MAIN FEATURES:**

✅ Easy to use.
✅ Super light-weight & optimized for performance.
✅ Add a quick view button in product loop to open a modal window with the product summary using AJAX.
✅ Display product image or gallery on quick view modal.
✅ Display product title, price, add to cart button, excerpt and view detail button on quick view modal.
✅ Disable quick view on mobile device.
✅ Modal box opening & closing animations.
✅ Modal content row direction layout.
✅ Change a label for the “Quick view” button.
✅ Display icon on “Quick view” button.
✅ Choose spinner icon.
✅ Customize what you would like to display inside the modal box.
✅ Display product detail page link in modal.
✅ Close modal on ESC key pressed.
✅ Close modal when clicked outside.
✅ Display/Hide modal close button.
✅ JavaScript API for developers.
✅ Developer friendly & easy to implement according to your need.
✅ Add custom CSS if required from admin setting page.
✅ Clean setting page design.
✅ Friendly support.


**🌈 DESIGN OPTIONS:**

✅ Customize quick view button text color.
✅ Customize quick view button background color.
✅ Customize quick view border color.
✅ Customize quick view button border radius.
✅ Customize modal box background color.
✅ Customize modal overlay mask background color.
✅ Customize modal box border color.
✅ Customize modal text colors.
✅ Customize modal box border radius.
✅ Customize modal CSS z-index.
✅ Customize spinner icon color.
✅ Customize spinner icon size.
✅ Customize WC Gallery border color.
✅ Customize WC Gallery icon color.
✅ Customize WC Gallery icon background color.
✅ Customize WC Gallery icon size.
✅ Customize WC product image border.
✅ Customize WC Gallery thumbnails gap.
✅ Customize WC Gallery thumbnails number in row.
✅ Customize product title color.
✅ Customize product title font size.
✅ Customize product title font weight.
✅ Customize price color.
✅ Customize price font size.
✅ Customize rating stars color.
✅ Customize misc buttons inside modal box color.
✅ More customization options, give it a try.

**💎 PRO**

[Addonify Quick View Pro](https://addonify.com/product/addonify-quick-view-for-woocommerce/) version comes with more advanced features and customization options. Some of the features are:

✅ Track the viewed products with analytics.
✅ Add the related products in quick view modal.
✅ Add product navigation.
✅ Enable social sharing from quick view modal.
✅ Enable AJAX add to cart in quick view modal.
✅ Unlock additional color options.
✅ Unlock additional options to customize the modal.


**📄 SHORTCODE**

The shortcode below can used to display quick view button.

**[addonify_quick_view_button id="1" label="Quick View" classes="btn" icon="icon_one" icon_position="left"]**

The shortcode attributes used are as follows:

- **id**: Product id.
- **label**: Button label.
- **classes**: CSS classes.
- **icon**: Button icon. Use any one attribute value from `icon_one`, `icon_two`, `icon_three`, ..., `icon_six`.
- **icon_position**: Button icon position if `icon` attribute is set. Use either `left` or `right`.


**👨‍💻 DEVELOPER:**

Developers, we got you. Follow the links below to easily customize Addonify Quick View as you like.

✅ Custom quick view button [Check Doc](https://docs.addonify.com/kb/quick-view/developer/)
✅ Using Hooks & Filters [Check Doc](https://docs.addonify.com/kb/quick-view/developer/)
✅ Overwrite plugin template file [Check Doc](https://docs.addonify.com/kb/quick-view/developer/)
✅ JavaScript API [Check Doc](https://docs.addonify.com/kb/quick-view/developer/javascript-events/)

Still not sure how to start? Create [a new discussion](https://github.com/addonify/addonify-quick-view/discussions) and we will help you out.


**🤎 FEEDBACK & SUPPORT:**

Let's make Addonify Quick View better together. We are open to discuss how we can improve our plugin. You're always welcome to join the discussion and share your ideas with us.

🌍 Feedback - [Have feedback](https://github.com/addonify/addonify-quick-view/discussions) or [I would love to rate](https://wordpress.org/support/plugin/addonify-quick-view/reviews/).
🪲 Report BUG - [Option - 1](https://github.com/addonify/addonify-quick-view/issues) or [Option - 2](https://wordpress.org/support/plugin/addonify-quick-view/).


**📦 UPCOMING FEATURES:**

- Modal width with responsive control.
- Modal padding with responsive control.
- Modal content gap with responsive control.
- Quick view for Gutenberg WooCommerce products blocks.
- More customization options.
- Do you have any requests to make? [Let's discuss](https://github.com/addonify/addonify-quick-view/discussions) on what you would like to see in the next version.


== Installation ==

1. Download the plugin.
1. Unzip the downloaded zip file.
2. Upload the plugin folder into the `wp-content/plugins/` directory of your WordPress site.
3. Activate `Addonify WooCommerce Quick View` from Dashboard > Plugins.

== Screenshots ==

1. Addonify Quick View in action.
2. Addonify Quick View admin setting 1.
3. Addonify Quick View admin setting 2.
4. Addonify Quick View admin setting 3.
5. Addonify Quick View admin setting 4.


== Changelog ==

= 2.0.5 - 15 February, 2026 =

- Fix: Broken Access Control in UDP Agent (CVSS 5.3). Credits to Legion Hunter. Unauthenticated attacker can update option value for "udp_agent_allow_tracking" via "init" hook due to missing authorization and nonce check in it's callback function "on_init".

= 2.0.4 - 25 March, 2025 =

- Tested:  WordPress version 6.8
- Tested:  WooCommerce version 9.7.1

= 2.0.3 - 29 November, 2024 =

- Fix: readme.

= 2.0.2 - 29 November, 2024 =

- Fix: readme.

= 2.0.1 - 29 November, 2024 =

- Fix: Documentation link.
- Updated: Readme.

= 2.0.0 - 25 November, 2024 =

- Added:   Nonce verification for REST API.
- Added:   `addonify_quick_view_add_setting_fields` hook to add setting fields from pro version.
- Added:   `is_pro_active` boolean variable is localized.
- Added:   `is_pro_active` static method is added on admin.php file.
- Added:   Default color for `quick_view_button_bg_color_hover` and `wc_gallery_trigger_icon_bg_color`.
- Fix:     Design issues [#344](https://github.com/addonify/addonify-quick-view/issues/344)
- Fix:     Container height issue inside the quick view modal when the content changes.
- Tweak:   Complete revamp of plugins's admin dashboard setting page.
- Tweak:   Settings page REST API structure (v2).
- Removed: Option to enable dynamic style.
- Tested:  WordPress version 6.7.1.
- Tested:  WooCommerce version 9.4.2.

= 1.2.17 - 19 July, 2024 =

- Added:   New quick view button position - Over Product Image.
- Updated: MobileDetect library. Fixed issue [#263](https://github.com/addonify/addonify-quick-view/issues/263).
- Added:   Label in range slider control (setting page).
- Added:   Shortcode for rendering quick view button.
- Added:   `Delete plugin data on plugin deactivation` option.
- Added:   Hooks, `addonify_quick_view_before_modal` and `addonify_quick_view_after_modal` in `addonify-quick-view-content-wrapper.php` template file.
- Added:   Filter hook, `addonify_quick_view_render_button`.
- Tested:  WordPress version 6.6.
- Tested:  WooCommerce version 9.1.2.

= 1.2.16 - 3 April, 2024 =

- Renamed: Function `addonify_quick_view_get_setting_field_value` to `addonify_quick_view_get_option`.
- Added:   JS event, `addonifyQuickViewModalContentLoading`, while content is being loaded.
- Added:   Action hooks and filter hooks.
- Updated: Quick view templates.
- Tested:  WordPress version 6.5.
- Tested:  WooCommerce version 8.7.0.

= 1.2.15 - 26 January, 2024 =

- Tested: WordPress version 6.4.2.
- Tested: WooCommerce version 8.5.2.

= 1.2.14 - 09 November, 2023 =

- Tested: WordPress v6.4.0
- Tested: WooCommerce v8.2.2

= 1.2.13 - 28 September, 2023 =

- Added: Compatibility with All Products for WooCommerce Subscriptions plugin.
- Added: Documentation link, GitHub link, and support link to the plugin row in plugins list table.
- Fix: Issue of color options, `General border color` and `Input fields text color`, not getting rendered.
- Updated: Plugin setting page link moved before the 'Deactivate' link in plugins list page.
- Tested: WooCommerce 8.1.1.

= 1.2.12 - 15 September, 2023 =

- Fix: Issue of redirection to product single page when the product is added into the cart from quick view modal.
- Tested: WooCommerce 8.1.0

= 1.2.11 - 25 August, 2023 =

- Fix: Quick view modal overflow issue in mobile devices.
- Tested: WooCommerce 8.0.2

= 1.2.10 - 09 August, 2023 =

- Added: Implemented scroll to top every time when the modal is opened.
- Tested: WordPress version 6.3
- Tested: WooCommerce version 8.0.0

= 1.2.9 - 08 August, 2023 =

- Added: Dedicated close button for mobile devices.
- Added: Dynamic notice in quick view admin setting page.
- Tweak: The way modal box height is being calculated.
- Improvement: Admin setting page UI.
- Refactor: Admin setting page code (Vue JS).

= 1.2.8 - 04 August, 2023 =

- Added: Option, Quick view button text color.
- Added: Option, Quick view button text color hover.
- Added: Option, Quick view button background color.
- Added: Option, Quick view button background color hover.
- Added: Option, Quick view button border color.
- Added: Option, Quick view button border color hover.
- Added: Option, Quick view button border style.
- Added: Option, Quick view button border radius.
- Added: Option, Misc button font size.
- Added: Option, Misc button font weight.
- Added: Option, Misc button line height.
- Added: Option, Misc button border radius.
- Added: Option, Misc button letter spacing.
- Added: Option, Misc button text transform.
- Added: Option, Gallery thumb gap.
- Added: Option, Gallery number of thumb in row.
- Added: Option, Product title font size.
- Added: Option, Product title font weight.
- Added: Option, Product title line height.
- Added: Option, Price font size.
- Added: Option, Price font weight.
- Added: Option. WC gallery icon font size.
- Added: Option, WC gallery image border radius.
- Added: Option, WC gallery image border color.
- Added: Option, WC gallery icon trigger color.
- Added: Option, WC gallery icon trigger background color.
- Added: Option, Modal box general text font size.
- Added: Option to display icon in quick view button. #175
- Added: Option to control the position of icon in quick view button. #175
- Added: Option to control content column direction layout inside modal.
- Added: Option to control content column gap.
- Added: Option to hide modal close button.
- Added: Option to close modal when ESC key is pressed.
- Added: Option to close modal when clicked outside. #176
- Added: Option, modal opening & exit animations. #176
- Added: Option, modal z-index.
- Added: Option, modal border radius.
- Added: Option, spinner icons. #177
- Added: Option, spinner icon font size. #177
- Added: Control, range slider (Vue JS).
- Added: JavaScript API, `addonifyQuickViewModalOpened`, `addonifyQuickViewModalClosed`, `addonifyQuickViewModalContentLoded`.
- Refactored: Public facing JavaScript code.
- Updated: Admin setting page UI SCSS code.
- Tweak: Select v-model val changed to string (Vue JS)
- Tweak: Refactor design tab UI (Vue JS)
- Tweak: Addonify Quick View is enabled but not effective notice is now non-dismissible.
- Improvement: Number input control (Vue JS)
- Improvement: Admin setting page design tab user interface.

= 1.2.7 - 19 July, 2023 =

- Fixed: Vue JS components [color-picker] fix incorrect cursor position.
- Updated: Logo in plugin setting page.

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
