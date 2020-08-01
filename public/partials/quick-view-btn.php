<?php

    // direct access is disabled
    defined( 'ABSPATH' ) || exit;

    printf(
        '<button type="button" class="%s" data-product_id="%s" rel="nofollow" >%s</button>',
        'addonify-qvm-button button',
        esc_attr( $product_id ),
        $this->get_db_values('quick_view_btn_label', __( 'Quick View', 'addonify-quick-view' )  )
    );