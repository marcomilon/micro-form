<?php

namespace micro\Element;

class Element
{

    private $template;
    private $attribute;

    public function __construct(array $attribute, array $configuration)
    {
        $this->attribute = $attribute;
        $tag = $attribute['tag'];
        $this->template = $configuration[$tag] ?? '';
        
        if(empty($this->template)) {
            $this->template = 'templates/'.$tag.'.php';
        }
    }

    public function render() : string {
        ob_start();
        extract (['attributes' => $this->attribute]);
        require $this->template;
        $out = ob_get_clean();        
        return $out;
    }

}
