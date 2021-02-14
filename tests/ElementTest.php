<?php

namespace micro;

use micro\Element\Element;
use PHPUnit\Framework\TestCase;

class ElementTest extends TestCase
{

    public function testFindTemplate()
    {
        $attribute = [
            "tag" => "input",
            "type" => "text",
            "name" => "username",
            "class" => "myCustomTemplate text-center"
        ];

        $configuration = [
            "button" => "bootstrap/button.php"
        ];

        $element = new Element($attribute, $configuration);

        $template = $this->invokeMethod($element, 'findTemplate', [$attribute, $configuration]);

        $expected = 'templates/input.php';
        $this->assertEquals($expected, $template);
    }

    public function testFindTemplateForCssClass()
    {
        $attribute = [
            "tag" => "input",
            "type" => "text",
            "name" => "username",
            "class" => "mb-5 myCustomTemplate text-center"
        ];

        $configuration = [
            "input.myCustomTemplate" => "bootstrap/myCustomTemplateinput.php",
            "button" => "bootstrap/button.php"
        ];

        $element = new Element($attribute, $configuration);

        $template = $this->invokeMethod($element, 'findTemplate', [$attribute, $configuration]);

        $expected = 'bootstrap/myCustomTemplateinput.php';
        $this->assertEquals($expected, $template);
    }

    public function testFindTemplateForId()
    {
        $attribute = [
            "tag" => "input",
            "type" => "text",
            "name" => "username",
            "id" => "my-username",
            "class" => "myCustomTemplate text-center"
        ];

        $configuration = [
            "input#my-username" => "bootstrap/button-my-username.php"
        ];

        $element = new Element($attribute, $configuration);

        $template = $this->invokeMethod($element, 'findTemplate', [$attribute, $configuration]);

        $expected = 'bootstrap/button-my-username.php';
        $this->assertEquals($expected, $template);
    }

    public function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
}
