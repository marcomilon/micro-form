<?php

namespace micro\Element;

abstract class Element
{

    private $template;
    private $attribute;

    public function __construct(array $attribute, string $template)
    {
        $this->attribute = $attribute;
        $this->template = $template;

        $tag = $attribute['tag'];
        if(empty($this->template)) {
            $this->template = 'templates/'.$tag.'.php';
        }
    }

    abstract public function getData(array $attribute) : array;

    public function render(): string
    {
        $data = $this->getData($this->attribute);
        return $this->renderFile($data);
    }

    protected function renderFile($data) : string {
        ob_start();
        extract ($data);
        require $this->template;
        $out = ob_get_clean();        
        return $out;
    }

}
