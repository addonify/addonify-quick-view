<?php
	defined( 'ABSPATH' ) || exit;

	while ( have_posts() ) :
		the_post();
?>

<?php woocommerce_show_product_images();  ?>
	<div class="woocommerce single-product">
		<div id="product-<?php the_ID(); ?>" <?php post_class( 'product' ); ?>>
			<?php do_action( 'addonify_qv_product_image' ); ?>
			<div class="summary entry-summary">
				<div class="summary-content">
					<?php do_action( 'addonify_qv_product_summary' ); ?>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>