<?php 

namespace micro;

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{

    public function testFuncAttributes() 
    {
        $actualOut = expandAttr([
            'id' => 'username',
            'type' => 'text',
            'name' => 'username',
            'class' => 'form-control'
        ]);

        $expectedOut = 'id="username" type="text" name="username" class="form-control"';

        $this->assertEquals($actualOut, $expectedOut);
    }

    public function testFuncAttributesRemoveAttr() 
    {
        $actualOut = expandAttr([
            'id' => 'username',
            'type' => 'text',
            'name' => 'username',
            'class' => 'form-control'
        ], ['class', 'name']);

        $expectedOut = 'id="username" type="text"';

        $this->assertEquals($actualOut, $expectedOut);
    }

    public function testFuncRenderFromJson()
    {
        $jsonString = <<<EOS
        [
            {
                "tag": "input",
                "type": "text",
                "name": "username",
                "class": "form-control"
            },
            {
                "tag": "input",
                "type": "password",
                "name": "password",
                "class": "form-control"
            },
            {
                "tag": "input",
                "type": "color",
                "id": "head",
                "name": "head",
                "value": "#e66465"
            }
        ]
EOS;


        $expected = <<<EOS
<input type="text" name="username" class="form-control">
<input type="password" name="password" class="form-control">
<input type="color" id="head" name="head" value="#e66465">
EOS;

        $actualOut = renderFromJson($jsonString);

        $this->assertEquals($actualOut, $expected);
    }
}