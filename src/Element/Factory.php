<?php

namespace micro\Element;

use Exception;

class Factory
{
    public static function makeElement($attributes, $template = '')
    {

        $tag = $attributes['tag'] ?? '(empty tag)';

        switch ($tag) {
            case 'input':
                return new Input($attributes, $template);
            case 'textarea':
                return new Textarea($attributes, $template);
            case 'select':
                return new Select($attributes, $template);
            case 'button':
                return new Button($attributes, $template);
            default:
                throw new Exception('Element not found for tag: ' . $tag);
        }
    }
}
