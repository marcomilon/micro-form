<?php

namespace micro\form;

class Builder
{
    
    private $inputs = [
        'text' => '/views/input-text.php',
        'email' => '/views/input-text.php',
        'textarea' => '/views/textarea.php'
    ];
    
    private $optionalParameters = [
        'label',
        'id',
        'placeholder'
    ];
    
    public function render($microForm, $values = []) 
    {
        
        $output = '';
        
        $microForm = json_decode($microForm, true);                
        
        if(!is_array($microForm)) {
            throw new \Exception("The form variable is not valid.");
        }
        
        foreach($microForm as $input) {
            if(!empty($values)) {
                $value = array_shift($values);
                $inputToRender = $this->sanitazeInput($input, $value);
            } else {
                $inputToRender = $this->sanitazeInput($input);
            }
            
            $output .= $this->renderInput(dirname(__FILE__) . $this->inputs[$inputToRender['input']], $inputToRender);
            $output .= PHP_EOL;
        }
        
        return $output;
    }
    
    private function sanitazeInput($input, $value = '') 
    {
        if(is_array($input)) {
            
            if(!array_key_exists($input['input'], $this->inputs)) {
                throw new \Exception("Unsupported input tag: " . $input['input']);
            }
            
            if(!isset($input['name'])) {
                throw new \Exception("Name parameter is required.");
            }
            
            $inputToRender = [];
            $inputToRender['input'] = $input['input'];
            $inputToRender['name'] = $input['name'];
            
            if(!empty($value)) {
                $inputToRender['value'] = $value;
            }
            
            foreach($this->optionalParameters as $optionalParameter) {
                if(isset($input[$optionalParameter])) {
                    $inputToRender[$optionalParameter] = $input[$optionalParameter];
                }
            }
            
            $inputToRender['label'] = isset($inputToRender['label']) ? ucfirst($inputToRender['label']) : ucfirst($inputToRender['name']);
            
            return $inputToRender;
        } 
        
        $inputToRender = [
            'input' => 'text',
            'label' => ucfirst($input),
            'name' => $input
        ];
        
        if(!empty($value)) {
            $inputToRender['value'] = $value;
        }
        
        return $inputToRender;
    }
    
    private function renderInput($file, $params) 
    {
        if (file_exists($file)) {
            ob_start();
            extract($params);
            require $file;
            $out = ob_get_clean();        
            return $out;
        } else {
            throw new \Exception("The view file does not exist: $file");
        }
    }
}