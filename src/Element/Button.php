<?php

namespace micro\Element;

class Button extends Element
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