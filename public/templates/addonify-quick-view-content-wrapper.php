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

<aside
	id="addonify-quick-view-modal-wrapper" 
	class="play-opening-animation"
	data-open_animation="<?php echo esc_attr( addonify_quick_view_get_modal_animation( 'opening' ) ); ?>" 
	data-close_animation="<?php echo esc_attr( addonify_quick_view_get_modal_animation( 'closing' ) ); ?>"
>
	<?php do_action( 'addonify_quick_view_before_modal' ); ?>
	<div id="addonify-quick-view-modal" data-layout="default">
		<button 
		id="addonify-quick-view-modal-close"
		class="adfy-qv-button"
		data_hide-desktop="<?php echo esc_attr( addonify_quick_view_get_option( 'hide_modal_close_button' ) === '1' ? 'true' : 'false' ); ?>">
			<span class="button-icon">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path></svg>
			</span>
			<span class="button-label mobile">
				<?php echo esc_html( addonify_quick_view_get_option( 'mobile_close_button_label' ) ); ?>
			</span>
		</button>
		<div class="adfy-quick-view-model-inner" id="adfy-quick-view-model-inner">
			<div id="adfy-qvm-spinner">
				<?php echo addonify_quick_view_escape_svg( addonify_quick_view_get_spinner_icon( addonify_quick_view_get_option( 'spinner_icons' ) ) ); // phpcs:ignore ?>
			</div>
			<?php do_action( 'addonify_quick_view_before_modal_content' ); ?>
			<section
				id="adfy-quick-view-modal-content" 
				class="adfy-quick-view-modal-content" 
				data-content_layout="<?php echo esc_attr( addonify_quick_view_get_option( 'modal_content_column_layout' ) ); ?>">
			</section>
			<?php do_action( 'addonify_quick_view_after_modal_content' ); ?>
		</div>
		<?php do_action( 'addonify_quick_view_after_modal' ); ?>
	</div>
</aside>
