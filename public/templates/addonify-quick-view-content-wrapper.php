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

<aside id="addonify-quick-view-modal-wrapper" 
	class="play-opening-animation"
	data-open_animation="<?php echo esc_attr( addonify_quick_view_get_modal_animation('opening') ); ?>" 
	data-close_animation="<?php echo esc_attr( addonify_quick_view_get_modal_animation('closing') ); ?>">
	<div id="addonify-quick-view-modal" data-layout="default">
		<div class="adfy-quick-view-model-inner" >
			<?php if ( !addonify_quick_view_get_settings_fields_values( 'hide_modal_close_button' ) ) { ?>
				<header class="adfy-qvm-header">
					<button id="addonify-qvm-close-button" class="adfy-qv-button">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<line x1="18" y1="6" x2="6" y2="18"></line>
							<line x1="6" y1="6" x2="18" y2="18"></line>
						</svg>
					</button>
				</header>
			<?php } ?>
			<div id="adfy-qvm-spinner">
				<?php echo addonify_quick_view_escape_svg ( addonify_quick_view_get_spinner_icon() ); ?>
			</div>
			<section id="adfy-quick-view-modal-content" class="adfy-quick-view-modal-content"></section>
		</div>
	</div>
</aside>
