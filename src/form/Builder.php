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
  
  public function render($microForm, $values = []) 
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
      
    } else {
      
      $buffer = "";
      
      foreach($microForm['inputs'] as $input) {
        $output = "";
        $output .= $this->renderInput($input, $values);
        $output .= PHP_EOL;
        
        if(isset($input['repeat']) && $input['repeat'] == true) {
          ob_start();
          $repeat = true;
          require dirname(__FILE__) . $this->repeatTemplate;
          $output = ob_get_clean();
        }
        
        $buffer .= $output;
        $output = "";
      }
      
      $output = $buffer;
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
    
    if (file_exists($file)) {
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
    if(isset($input['input'])) {
      
      if(!array_key_exists($input['input'], $this->config) && !array_key_exists($input['input'], $this->inputs)) {
        throw new \Exception("Unsupported input tag: " . $input['input']);
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
}