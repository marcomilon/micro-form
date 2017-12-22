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
    
    public function render($microForm) 
    {
        
        $output = '';
        
        if(!is_array($microForm)) {
            throw new \Exception("The form variable is not valid. It need to be an array");
        }
        
        foreach($microForm as $inputType => $parameters) {
            $input = $this->sanitazeInput($inputType, $parameters);
            
            $inputType = !is_array($parameters) ? 'text' : $inputType;
            $output .= $this->renderInput(dirname(__FILE__) . $this->inputs[$inputType], $input);
            $output .= PHP_EOL;
        }
        
        return $output;
    }
    
    private function sanitazeInput($inputType, $parameters) 
    {
        if(is_array($parameters)) {
            
            if(!array_key_exists($inputType, $this->inputs)) {
                throw new \Exception("Unsupported input tag: $inputType");
            }
            
            if(!isset($parameters['name'])) {
                throw new \Exception("Name parameter is required.");
            }
            
            $input = [];
            $input['inputType'] = $inputType;
            $input['name'] = $parameters['name'];
            
            foreach($parameters as $name => $value) {
                
                foreach($this->optionalParameters as $optionalParameter) {
                    if(isset($parameters[$optionalParameter])) {
                        $input[$optionalParameter] = $parameters[$optionalParameter];
                    }
                }
                
                $input['label'] = isset($input['label']) ? ucfirst($input['label']) : ucfirst($input['name']);
            }
            
            return $input;
        } 
        
        $input = [
            'inputType' => 'text',
            'label' => ucfirst($parameters),
            "name" => $parameters
        ];
        
        return $input;
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