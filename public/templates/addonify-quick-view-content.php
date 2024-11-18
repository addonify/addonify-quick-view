<?php
/**
 * Display quick view content.
 *
 * This template can be overridden by copying it to yourtheme/addonify/addonify-quick-view-content.php.
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

global $product;
$modal_post_class  = 'product';
$modal_box_content = unserialize( addonify_quick_view_get_option( 'modal_box_content' ) ); // phpcs:ignore

if ( is_array( $modal_box_content ) && ! in_array( 'image', $modal_box_content, true ) ) {
	$modal_post_class .= ' aqv-no-product-image';
}

do_action( 'addoify_quick_view_before_single_content', $product );
?>
<div class="woocommerce single-product">
	<div id="product-<?php echo esc_attr( $product->get_id() ); ?>" <?php post_class( $modal_post_class ); ?>>
		<?php do_action( 'addonify_quick_view_product_image' ); ?>
		<div class="summary entry-summary">
			<?php do_action( 'addonify_quick_view_before_product_summary_content', $product ); ?>
			<div class="summary-content">
				<?php do_action( 'addonify_quick_view_product_summary', $product ); ?>
			</div>
			<?php do_action( 'addonify_quick_view_after_product_summary_content', $product ); ?>
		</div>
	</div>
</div>
<?php
do_action( 'addonify_quick_view_after_single_content', $product );
