<?php

    // direct access is disabled
    defined( 'ABSPATH' ) || exit;

    echo '<div class="notice notice-error is-dismissible"><p>';
    _e( 'Addonify Quick View is enabled but not effective. It requires WooCommerce in order to work.', 'addonify-quick-view' );
    echo '</p></div>';