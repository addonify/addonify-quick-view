<?php

    // direct access is disabled
    defined( 'ABSPATH' ) || exit;

    printf(
        '<button type="button" class="addonify-qvm-button button" data-product_id="%s" rel="nofollow" >%s</button>',
        esc_attr( $args['product_id'] ),
        $args['label']
    );