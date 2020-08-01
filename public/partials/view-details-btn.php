<?php

    // direct access is disabled
    defined( 'ABSPATH' ) || exit;

    $btn_label = $this->get_db_values( 'view_detail_btn_label');
    if( ! $btn_label ){
        $btn_label = __( 'View Details', 'addonify-quick-views' );
    }

    printf(
        '<a href="%s" class="button" >%s</a>',
        get_the_permalink($post_id),
        $btn_label
    );