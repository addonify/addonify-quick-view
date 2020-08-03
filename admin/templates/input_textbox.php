<?php
    
    // direct access is disabled
    defined( 'ABSPATH' ) || exit;

    printf(
        '<input type="text" class="regular-text" name="%1$s" id="%1$s" value="%2$s" />',
        $args['name'],
        $db_value,
    );