<?php

namespace micro;

function expandAttr(array $attributes, $removeAttr = []): string
{

    $out = '';

    foreach ($attributes as $key => $value) {

        if(!empty($removeAttr) && in_array($key, $removeAttr)) {
            continue;
        }

        $out .= $key . '="' . htmlentities($value) . '" ';
    }

    return rtrim($out);
}

function renderFromJson(string $jsonInput): string
{
    $jsonDs = new JsonDs();
    $form = new Form($jsonDs);
    return $form->render($jsonInput);
}