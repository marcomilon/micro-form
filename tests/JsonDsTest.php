<?php

namespace micro;

use PHPUnit\Framework\TestCase;
use Exception;

class JsonDsTest extends TestCase
{

    public function testEmptyJson()
    {
        $this->expectException(Exception::class);
        $jsonDs = new JsonDs();
        $jsonDs->transformer("");
    }

    public function testTransformer()
    {
        $jsonString = <<<EOS
        [
            {
                "tag": "input",
                "type": "text",
                "name": "username",
                "class": "form-control"
            }
        ]
EOS;


        $expected = [
            [
                'tag' => 'input',
                'type' => 'text',
                'name' => 'username',
                'class' => 'form-control'
            ]
        ];

        $jsonDs = new JsonDs();
        $jsonArr = $jsonDs->transformer($jsonString);

        $this->assertEquals($expected, $jsonArr);
    }
}
