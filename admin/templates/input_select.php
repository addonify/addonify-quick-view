<?php
    
    // direct access is disabled
    defined( 'ABSPATH' ) || exit;

    echo '<select  name="'. $args['name'] .'" id="'. $args['name'] .'" >';

    foreach($options as $value => $label){
        echo '<option value="'. $value .'" ';
        if( $db_value == $value ) {
            echo 'selected';
        } 
        echo ' >' . $label . '</option>';
    }
    
    echo '</select>';