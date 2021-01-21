<?php

if(!function_exists('_attr') ) {
    function _attr(array $attributes): string {

        $out = '';
        
        foreach($attributes as $key => $value) {
            $out .= $key .'="'. $value . '" ';
        }

        return rtrim($out);  
    }
}