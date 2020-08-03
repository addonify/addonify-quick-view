<?php
	defined( 'ABSPATH' ) || exit;
?>
	<div class="woocommerce single-product">
		<div id="product-<?php the_ID(); ?>" <?php post_class( 'product' ); ?>>
			<?php do_action( 'addonify_qv_product_image' ); ?>
			<div class="summary entry-summary">
				<div class="summary-content">
					<?php do_action( 'addonify_qv_product_summary' ); ?>
				</div>
				<?php do_action( 'addonify_qv_after_product_summary_content', get_the_ID() ); ?>
			</div>
		</div>
	</div>