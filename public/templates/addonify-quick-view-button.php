<?php
/**
 * Template for addonify quick view button.
 * This template can be overridden by copying it to yourtheme/addonify/addonify-quick-view-button.php.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/public/templates
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<button 
	type="button"
	class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" 
	data-product_id="<?php echo esc_attr( $product_id ); ?>"
	<?php echo $icon_position ? 'data-icon_position="' . esc_attr( $icon_position ) . '"' : ''; ?>
>
	<?php
	if ( $label ) {
		echo '<span class="label">' . esc_html( $label ) . '</span>';
	}

	if ( $icon ) {
		echo '<span class="icon">' . addonify_quick_view_escape_svg( $icon ) . '</span>'; // phpcs:ignore
	}
	?>
</button>

