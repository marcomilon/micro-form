<?php

if(!function_exists('_attr') ) {
    function _attr(array $attributes): string {

        $out = '';
        
        foreach($attributes as $key => $value) {
            $out .= $key .'="'. htmlentities($value) . '" ';
        }

        return rtrim($out);  
    }
}

if(!function_exists('renderFromJson') ) {
    function renderFromJson(string $jsonInput): string {
        $jsonDs = new \micro\JsonDs();
        $form = new \micro\Form($jsonDs);
        return $form->render($jsonInput);
    }
}