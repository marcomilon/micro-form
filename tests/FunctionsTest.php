<?php 

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{

    public function testFuncAttributes() 
    {
        $actualOut = _attr([
            'id' => 'username',
            'type' => 'text',
            'name' => 'username',
            'class' => 'form-control'
        ]);

        $expectedOut = 'id="username" type="text" name="username" class="form-control"';

        $this->assertEquals($actualOut, $expectedOut);
    }

}