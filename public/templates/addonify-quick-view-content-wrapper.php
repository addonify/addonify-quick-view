<?php
/**
 * Quick View Modal Box HTML.
 *
 * This template can be overridden by copying it to yourtheme/addonify/addonify-view-content-wrapper.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @package     Addonify_Quick_View\Public\Templates
 * @version     1.0.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="addonify-quick-view-modal">
	<div class="adfy-quick-view-model-inner">
		<div class="adfy-qvm-head">
			<button id="addonify-qvm-close-button" class="adfy-qv-button">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</button><!-- #addonify-qvm-close-button.adfy-qv-button -->
		</div><!-- .adfy-qvm-head -->
		<div id="adfy-qvm-spinner">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
		</div><!-- .adfy-qvm-spinner -->
		<div class="adfy-quick-view-modal-content"></div><!-- .adfy-quick-view-modal-content -->
	</div><!-- .adfy-quick-view-model-inner -->
</div><!-- #addonify-quick-view-modal -->
<aside id="addonify-quick-view-overlay" class="adfy-quick-view-overlay"></aside><!-- #addonify-quick-view-overlay.adfy-quick-view-overlay -->
