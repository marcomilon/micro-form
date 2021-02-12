<?php

namespace micro;

function expantAttr(array $attributes): string
{

    $out = '';

    foreach ($attributes as $key => $value) {
        $out .= $key . '="' . htmlentities($value) . '" ';
    }

    return rtrim($out);
}

function renderFromJson(string $jsonInput): string
{
    $jsonDs = new \micro\JsonDs();
    $form = new \micro\Form($jsonDs);
    return $form->render($jsonInput);
}