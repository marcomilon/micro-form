<?php

namespace micro;

function expandAttr(array $attributes): string
{

    $out = '';

    foreach ($attributes as $key => $value) {
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