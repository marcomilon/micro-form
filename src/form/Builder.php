<?php

namespace micro\form;

class Builder
{
    private $inputs = [
        'text'
    ];
    
    public function render($microForm) 
    {
        
        $output = '';
        
        if(!is_array($microForm)) {
            throw new \Exception("The form variable is not valid. It need to be an array");
        }
        
        foreach($microForm as $input) {
            $input = $this->sanitazeInput($input);
            
            $output .= $this->renderInput(dirname(__FILE__) . '/views/input-text.php', $input);
            $output .= PHP_EOL;
        }
        
        return $output;
    }
    
    private function sanitazeInput($input) 
    {
        if(is_array($input)) {
            $inputType = key($input);
            
            if(!in_array($inputType, $this->inputs)) {
                throw new \Exception("Unsupported input tag.");
            }
            
            foreach($input as $k => $v) {
                
            }
            
            return $input;
        } 
        
        $input = [
            'label' => ucfirst($input),
            'for' => $input,
            "name" => $input                    
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