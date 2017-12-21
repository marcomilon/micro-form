<?php

namespace micro\form;

class Builder
{
    public function render($microForm) 
    {
        
        if(!is_array($microForm)) {
            throw new \Exception("The form variable is not valid. It need to be an array");
        }
        
        foreach($microForm as $input) {
            if(!is_array($input)) {
                $this->renderInput(dirname(__FILE__) . '/views/input-text.php', [
                    'microForm' => $input
                ]);
            }
        }
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