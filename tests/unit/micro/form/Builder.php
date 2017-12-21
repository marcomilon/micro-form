<?php 

namespace micro\test\units\form;

use atoum;

class Builder extends atoum
{
    public function testInputText() {
        include dirname(__FILE__) . '/../../../data/input-text-tpl.php';
        $expectedRendering = dirname(__FILE__) . '/../../../data/input-text.html';
        
        $builder = new \micro\form\Builder();
        $form = $builder->render($microForm);
        $this->string($form)->isEqualToContentsOfFile($expectedRendering);
    }
}