<?php
    
    // direct access is disabled
    defined( 'ABSPATH' ) || exit;

    echo '<div class="colorpicker-group">';
    
    if( isset($arg['label']) ) {
        echo '<p>'. $arg['label'].'</p>';
    }

    printf(
        '<input type="text" value="%2$s" name="%1$s" id="%1$s" class="color-picker" data-alpha="true" />',
        $arg['name'],
        $db_value
    );

    echo '</div>';