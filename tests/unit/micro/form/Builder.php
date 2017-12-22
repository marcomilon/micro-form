<?php 

namespace micro\test\units\form;

use atoum;

class Builder extends atoum
{
    
    public function testInputSimpleText() 
    {
        include dirname(__FILE__) . '/../../../data/simple/input-text-tpl.php';
        $expectedRendering = dirname(__FILE__) . '/../../../data/simple/input-text.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
    
    public function testInputSimpleTextarea() 
    {
        include dirname(__FILE__) . '/../../../data/textarea/textarea-tpl.php';
        $expectedRendering = dirname(__FILE__) . '/../../../data/textarea/textarea.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
    
    public function testInputComplexText() 
    {
        include dirname(__FILE__) . '/../../../data/complex/input-text-tpl.php';
        $expectedRendering = dirname(__FILE__) . '/../../../data/complex/input-text.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
    
    public function testInputComplexEmail() 
    {
        include dirname(__FILE__) . '/../../../data/complex/input-email-tpl.php';
        $expectedRendering = dirname(__FILE__) . '/../../../data/complex/input-email.html';
    
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
    
    public function testInputUnsuported() 
    {
        include dirname(__FILE__) . '/../../../data/complex/input-unsupported-tpl.php';
    
        $builder = new \micro\form\Builder();
    
        $this->exception(
            function() use($builder, $microForm) {
                $form = $builder->render($microForm);
            }
        )->hasMessage('Unsupported input tag: cv');
    }
}