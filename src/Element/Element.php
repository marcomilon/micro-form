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
        $this->template = $this->findTemplate($attribute, $configuration);
    }

    public function render() : string {
        ob_start();
        extract (['attributes' => $this->attribute]);
        require $this->template;
        $out = ob_get_clean();        
        return $out;
    }

    private function findTemplate(array $attribute, array $configuration) : string
    {
        $tag = $attribute['tag'];
        $id =  $attribute['id'] ?? '';
        if(array_key_exists($tag.'#'.$id, $configuration)) {
            return $configuration[$tag.'#'.$id];
        }

        $cssClasses = $attribute['class'] ?? '';
        $cssClasses = preg_split('/ +/', $cssClasses);
        foreach($cssClasses as $cssClass) {
            if(array_key_exists($tag.'.'.$cssClass, $configuration)) {
                return $configuration[$tag.'.'.$cssClass];
            }
        }

        return $configuration[$tag] ?? 'templates/'.$tag.'.php';;
    }

}
