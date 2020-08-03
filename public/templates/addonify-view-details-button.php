<?php

    // direct access is disabled
    defined( 'ABSPATH' ) || exit;

    printf(
        '<a href="%s" class="button" >%s</a>',
        get_the_permalink($args['post_id']),
        $args['btn_label']
    );