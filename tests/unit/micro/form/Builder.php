<?php 

namespace micro\test\units\form;

use atoum;

class Builder extends atoum
{
    
    public function testInputSimpleText() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/simple/input-text-tpl.json');
        $expectedRendering = dirname(__FILE__) . '/../../../data/simple/input-text.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
    
    public function testInputSimpleTextarea() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/textarea/textarea-tpl.json');
        $expectedRendering = dirname(__FILE__) . '/../../../data/textarea/textarea.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
    
    public function testInputComplexText() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/complex/input-text-tpl.json');
        $expectedRendering = dirname(__FILE__) . '/../../../data/complex/input-text.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
    
    public function testInputComplexEmail() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/complex/input-email-tpl.json');
        $expectedRendering = dirname(__FILE__) . '/../../../data/complex/input-email.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
    
    public function testInputComplexPassword() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/complex/input-password-tpl.json');
        $expectedRendering = dirname(__FILE__) . '/../../../data/complex/input-password.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
    
    public function testInputUnsuported() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/complex/input-unsupported-tpl.json');
    
        $builder = new \micro\form\Builder();
    
        $this->exception(
            function() use($builder, $microForm) {
                $form = $builder->render($microForm);
            }
        )->hasMessage('Unsupported input type: cv');
    }
    
    public function testInputSimpleTextValue() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/simple/input-text-tpl.json');
        $expectedRendering = dirname(__FILE__) . '/../../../data/simple/input-text-value.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm, ['name' => 'marco', 'lastname' => 'milon']);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
    
    public function testInputSimpleTextareaValue() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/textarea/textarea-tpl.json');
        $expectedRendering = dirname(__FILE__) . '/../../../data/textarea/textarea-value.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm, ['description' => 'Esta es el contenido']);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
    
    public function testRepeatInputSimpleText() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/repeater/input-text-repeater-tpl.json');
        $expectedRendering = file_get_contents(dirname(__FILE__) . '/../../../data/repeater/input-text-repeater.html');
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
    
        $form = $this->flatString($form);
        $expectedRendering = $this->flatString($expectedRendering);
    
        $this->string($form)->isEqualTo($expectedRendering);
    }
    
    public function testRepeatInputSimpleTextNoInput() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/repeater/input-simple-text-repeater-tpl.json');
        $expectedRendering = file_get_contents(dirname(__FILE__) . '/../../../data/repeater/input-simple-text-repeater.html');
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
    
        $form = $this->flatString($form);
        $expectedRendering = $this->flatString($expectedRendering);
    
        $this->string($form)->isEqualTo($expectedRendering);
    }
    
    public function testRepeatInputSimpleTextValue() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/repeater/input-simple-text-repeater-tpl.json');
        $expectedRendering = file_get_contents(dirname(__FILE__) . '/../../../data/repeater/input-simple-text-repeater-value.html');
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm, ['username' => ['n1', 'n2', 'n3']]);
    
        $form = $this->flatString($form);
        $expectedRendering = $this->flatString($expectedRendering);
    
        $this->string($form)->isEqualTo($expectedRendering);
    }
    
    public function testRepeatInputTwoText() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/repeater/input-two-text-repeater-tpl.json');
        $expectedRendering = file_get_contents(dirname(__FILE__) . '/../../../data/repeater/input-two-text-repeater.html');
        $actualRender = dirname(__FILE__) . '/../../../data/repeater/input-two-text-repeater-actual.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
    
        $form = $this->flatString($form);
        $expectedRendering = $this->flatString($expectedRendering);
    
        $this->string($form)->isEqualTo($expectedRendering);
    }
    
    public function testRepeatBlock() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/repeater/input-block-repeater-tpl.json');
        $expectedRendering = file_get_contents(dirname(__FILE__) . '/../../../data/repeater/input-block-repeater.html');
        $actualRender = dirname(__FILE__) . '/../../../data/repeater/input-block-repeater-actual.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
    
        $form = $this->flatString($form);
        $expectedRendering = $this->flatString($expectedRendering);
    
        $this->string($form)->isEqualTo($expectedRendering);
    }
    
    public function testCustomTextInput() {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/simple/input-text-tpl.json');
        $expectedRendering = dirname(__FILE__) . '/../../../data/simple/input-text-horizontal.html';
    
        $templates = [
            'text' => dirname(__FILE__) . '/../../../templates/horizontal/input-text.php'
        ];
    
        $builder = new \micro\form\Builder($templates);
        $form = $builder->render($microForm);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
    
    public function testCustomTextarea() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/textarea/textarea-tpl.json');
        $expectedRendering = dirname(__FILE__) . '/../../../data/textarea/textarea-horizontal.html';
    
        $templates = [
            'textarea' => dirname(__FILE__) . '/../../../templates/horizontal/textarea.php'
        ];
    
        $builder = new \micro\form\Builder($templates);
        $form = $builder->render($microForm);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
    
    private function flatString($str) {
      return preg_replace('/\s*/m', '', $str);
    }
    
    public function testInputSimpleDropDown() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/simple/dropdown-menu-tpl.json');
        $expectedRendering = dirname(__FILE__) . '/../../../data/simple/dropdown-menu.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
}