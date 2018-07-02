<?php

namespace micro\form;

use JsonSchema\Validator;

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
    
    public function validateSchema($json) 
    {
        $jsonObj = json_decode($json);
        $validator = new Validator();
        $validator->validate($jsonObj, (object)['$ref' => 'file://' . dirname(__FILE__) . '/schemas/input.json']); 
        
        return $validator;
    }
    
    public function render($microForm, $values = null) 
    {
        $output = '';
        
        $validator = $this->validateSchema($microForm);
        if (!$validator->isValid()) {
            $errorStr = "";
            foreach ($validator->getErrors() as $error) {
                $errorStr .= $error['property'] ." ". $error['message'] . "\n";
            }
            throw new \Exception("The supplied JSON validates against the schema: $errorStr.\n");
        } 
        
        $microForm = json_decode($microForm, true);
        $block = $this->getBlock($microForm);
        
        if(!empty($block)) { 
            
            $output = $this->renderBlock($block, $values);
            
        } else {
            
            $outputBuffer = "";
            
            foreach($microForm['inputs'] as $input) {
                $output = "";
                
                if(is_array($values)) {
                    $output .= $this->renderInputWithValues($input, $values);
                } else {
                    $output .= $this->renderInput($input);
                }
                
                $output .= PHP_EOL;
                
                if($this->isInputRepetable($input)) {
                    ob_start();
                    $repeat = true;
                    require dirname(__FILE__) . $this->repeatTemplate;
                    $output = ob_get_clean();
                }
                
                $outputBuffer .= $output;
            }
            
            $output = $outputBuffer;
        }
        
        return $output;
    }
    
    private function renderInput($input, $values = '') 
    {
        $inputToRender = $this->sanitazeInput($input, $values);
        $file = $this->getTemplateFile($inputToRender);
        
        if (file_exists($file)) {
            
            if($this->isInputRepetable($inputToRender)) {
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
    
    private function sanitazeInput($input, $values) 
    {
        if(isset($input['type'])) {
            if(!array_key_exists($input['type'], $this->config) && !array_key_exists($input['type'], $this->inputs)) {
                throw new \Exception("Unsupported input type: " . $input['type']);
            }
            
            $inputToRender = [];
            $inputToRender['type'] = $input['type'];
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
            'type' => 'text',
            'label' => ucfirst($input['name']),
            'name' => $input['name']
        ];
        
        if(isset($input['repeat']) && $input['repeat']) {
            $inputToRender['repeat'] = true;
        }
        
        if(!empty($values) && array_key_exists($input['name'], $values)) {
            $inputToRender['value'] = $values[$input['name']];
        }
        
        return $inputToRender;
    }
    
    private function getBlock($microForm) 
    {
        $block = [];
        if(isset($microForm['repeat'])) {
            $block['name'] = $microForm['name'];
            $block['repeat'] = $microForm['repeat'];
            $block['inputs'] = $microForm['inputs'];
        }
        
        return $block;
    }
    
    private function renderBlock($block, $values = null) {
        $output = "";
        $blockId = $block['name'];
        $inputs = $block['inputs'];
        
        foreach($inputs as $blockInputs) {
            $blockInputs['blockId'] = $blockId;
            $output .= $this->renderInput($blockInputs, $values);
            $output .= PHP_EOL;
        }
        
        $repeat = true;
        require dirname(__FILE__) . $this->repeatTemplate;
        $output = ob_get_clean();
        
        return $output;
    }
    
    private function renderInputWithValues($input, $values) {
        $output = "";
        $defaultValues = current($values);
        
        if(is_array($defaultValues)) {
            foreach($defaultValues as $value) {
                $output .= $this->renderInput($input, [$input['name'] => $value]);
            }
        } else {
            $output .= $this->renderInput($input, $values);
        }
        
        return $output;
    }
    
    private function isInputRepetable($input) {
        return isset($input['repeat']) && $input['repeat'] == true;
    }
    
    private function getTemplateFile($inputToRender) {
        if(isset($this->config[$inputToRender['type']])){
            $templateFile = $this->config[$inputToRender['type']];
        } else {
            $path = dirname(__FILE__);
            $templateFile = $path . $this->inputs[$inputToRender['type']];
        }
        
        return $templateFile;
    }
    
}