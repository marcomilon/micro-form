<?php

namespace micro\form;

class Builder
{
    private $repeatTemplate = '/views/repeat.php';
    
    private $inputs = [
        'text' => '/views/input-text.php',
        'email' => '/views/input-text.php',
        'password' => '/views/input-text.php',
        'textarea' => '/views/textarea.php'
    ];
    
    private $optionalParameters = [
        'label',
        'id',
        'placeholder',
        'repeat',
        'blockId'
    ];
    
    private $config = [];
    
    public function __construct($config = []) 
    {
        $this->config = $config;
    }
    
    public function render($microForm, $values = []) 
    {
        $output = '';
        
        $microForm = json_decode($microForm, true);                
        
        if(!is_array($microForm)) {
            throw new \Exception("The form variable is not valid.");
        }
        
        foreach($microForm as $input) {
            
            $block = $this->isBlock($input);
            
            if($block) { 
                
                $blockId = key($input);
                $inputs = current($input);
                
                foreach($inputs as $blockInputs) {
                    $blockInputs['blockId'] = $blockId;
                    $output .= $this->renderInput($blockInputs, $values);
                    $output .= PHP_EOL;
                }
                
                ob_start();
                $repeat = true;
                require dirname(__FILE__) . $this->repeatTemplate;
                $output = ob_get_clean();
                
            } else {
                
                $output .= $this->renderInput($input, $values);
                $output .= PHP_EOL;
                
                if(isset($input['repeat']) && $input['repeat'] == true) {
                    ob_start();
                    $repeat = true;
                    require dirname(__FILE__) . $this->repeatTemplate;
                    $output = ob_get_clean();
                }
                
            }
        }
        
        return $output;
    }
    
    private function renderInput($input, $values) 
    {
        $inputToRender = $this->sanitazeInput($input, $values);
        
        if(isset($this->config[$inputToRender['input']])){
            $templateFile = $this->config[$inputToRender['input']];
        } else {
            $path = dirname(__FILE__);
            $templateFile = $path . $this->inputs[$inputToRender['input']];
        }
        
        $file = $templateFile;
        
        if ($file != $path && file_exists($file)) {
            
            if(isset($inputToRender['repeat']) && $inputToRender['repeat'] == true) {
                $inputToRender['name'] = $inputToRender['name'] .'[]';    
            }
            
            if(isset($inputToRender['blockId'])) {
                $inputToRender['name'] = $inputToRender['blockId'].'[0]['.$inputToRender['name'] .']';
            }
            
            ob_start();
            extract($inputToRender);
            require $file;
            $out = ob_get_clean();        
            return $out;
            
        } else {
            
            throw new \Exception("The view file does not exist: $file");
            
        }
    }
    
    private function sanitazeInput($input, $values = '') 
    {
        if(is_array($input)) {
            
            if(!array_key_exists($input['input'], $this->config) && !array_key_exists($input['input'], $this->inputs)) {
                throw new \Exception("Unsupported input tag: " . $input['input']);
            }
            
            if(!isset($input['name'])) {
                throw new \Exception("Name parameter is required.");
            }
            
            $inputToRender = [];
            $inputToRender['input'] = $input['input'];
            $inputToRender['name'] = $input['name'];
            
            if(!empty($values) && array_key_exists($input['name'], $values)) {
                $inputToRender['value'] = $values[$input['name']];
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
        
        if(!empty($values) && array_key_exists($input, $values)) {
            $inputToRender['value'] = $values[$input];
        }
        
        return $inputToRender;
    }
    
    private function isBlock($input) 
    {
        $firstInput = is_array($input) ? current($input) : '';
        return is_array($firstInput);
    }
}