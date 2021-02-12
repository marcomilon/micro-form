<?php

namespace micro\Element;

class Select extends Element
{

    public function getData(array $attribute): array
    {
        $options = [];

        foreach($attribute['value'] as $option) {

            $label = $option['label'];
            unset($option['label']);
            unset($option['tag']);

            $options[] = [
                'attributes' => $option,
                'label' => $label
            ];
        }

        unset($attribute['tag']);
        unset($attribute['value']);
        
        return [
            'attributes' => $attribute,
            'options' => $options
        ];
    }
    
}