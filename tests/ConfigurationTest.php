<?php

namespace micro;

use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{

    public function testConfiguration()
    {

        $jsonDs = new JsonDs();
        $jsonForm = new Form($jsonDs);

        $jsonConfig = '{
            "input": "bootstrap/input.php",
            "button": "bootstrap/button.php"
        }';

        $expected = [
            'input' => 'bootstrap/input.php',
            'button' => 'bootstrap/button.php'
        ];

        $configuration = $this->invokeMethod($jsonForm, 'loadConfig', [$jsonConfig]);

        $this->assertEquals($expected, $configuration);
    }

    public function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
}
