<?php

namespace micro\Element;

class Input extends Element
{

    public function getData(array $attribute): array
    {
        unset($attribute['tag']);

        return [
            'attributes' => $attribute
        ];
    }
    
}
