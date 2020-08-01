<?php

	defined( 'ABSPATH' ) || exit;
	global $post, $product;

	$pid = $_GET['id'];
	$raw_post = get_post( $pid );

	$factory = new WC_Product_Factory();
	$product = $factory->get_product( $pid );
	$post    = $raw_post;
	$product = $product;

?>

	<div class="woocommerce single-product quick-view-product">
		<div class="product">
		<?php woocommerce_show_product_images();?>
			<?php // do_action( 'woocommerce_before_single_product_summary' ); ?>

			<div class="summary entry-summary">
				<?php do_action( 'woocommerce_single_product_summary' ); ?>
			</div><!-- .summary -->
		</div>
	</div>