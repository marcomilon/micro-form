<?php

namespace micro\Element;

class Textarea extends Element
{

    public function getData(array $attribute): array
    {
        $value = $attribute['value'] ?? '';

        unset($attribute['tag']);
        unset($attribute['value']);

        return [
            'attributes' => $attribute,
            'value' => $value
        ];
    }
    
}