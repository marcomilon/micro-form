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
    
    public function testInputUnsuported() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/complex/input-unsupported-tpl.json');
    
        $builder = new \micro\form\Builder();
    
        $this->exception(
            function() use($builder, $microForm) {
                $form = $builder->render($microForm);
            }
        )->hasMessage('Unsupported input tag: cv');
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
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
        $this->string($form)->matches('#new-item__button-[a-z0-9]{13}#')->matches('#repeater-[a-z0-9]{13}#')->contains('script')->contains('username[]');
    }
    
    public function testRepeatBlock() 
    {
        $microForm = file_get_contents(dirname(__FILE__) . '/../../../data/repeater/input-block-repeater-tpl.json');
        $expectedRendering = dirname(__FILE__) . '/../../../data/repeater/input-block-repeater.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
        $this->string($form)->matches('#new-item__button-[a-z0-9]{13}#')->matches('#repeater-[a-z0-9]{13}#')->contains('repeater')->contains('script')->contains('users')->contains('users[]');
    }
    
}