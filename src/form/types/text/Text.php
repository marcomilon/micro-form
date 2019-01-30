<?php 

namespace micro\form\types\text;

class Text 
{

    const $type = 'text';
    public $id;
    public $for;
    public $value;
    public $placeholder;
    public $repeat;
    
    public $attributes = [];
    
    public __construct(array $input)
    {
        $this->attributes = $this->sanitize($input);
    }
    
    final public function render($input) 
    {
        ob_start();
        extract($inputToRender);
        require 
        ;
        $out = ob_get_clean();        
        return $out;
    }
    
    private function sanitize(array $input) : array
    {
        // if(isset($input['type'])) {
        //     if(!array_key_exists($input['type'], $this->config) && !array_key_exists($input['type'], $this->inputs)) {
        //         throw new \Exception("Unsupported input type: " . $input['type']);
        //     }
        // 
        //     $inputToRender = [];
        //     $inputToRender['type'] = $input['type'];
        //     $inputToRender['name'] = $input['name'];
        // 
        //     if(!empty($values) && array_key_exists($input['name'], $values)) {
        //         $inputToRender['value'] = $values[$input['name']];
        //     }
        // 
        //     foreach($this->optionalParameters as $optionalParameter) {
        //         if(isset($input[$optionalParameter])) {
        //             $inputToRender[$optionalParameter] = $input[$optionalParameter];
        //         }
        //     }
        // 
        //     $inputToRender['label'] = isset($inputToRender['label']) ? ucfirst($inputToRender['label']) : ucfirst($inputToRender['name']);
        // 
        //     return $inputToRender;
        // } 
        
        $for = isset($id) ? " for=\"$id\"" : "";
        $id = isset($id) ? " id=\"$id\"" : "";
        $value = isset($value) ? " value=\"$value\"" : "";
        $placeholder = isset($placeholder) ? " placeholder=\"$placeholder\"" : "";
        
        $attributes = [];
        $attributes['id']     = $input['id'] ?? '';
        $attributes['for']    = $input['for'] ?? '';
        $attributes['label']  = $input['label'] ?? $input['name'];
        $attributes['name']   = $input['name'];
        $attributes['repeat'] = $input['repeat'] ?? false;
        $attributes['value']  = $input['value'] ?? '';
                
        return $attributes;
    }
}