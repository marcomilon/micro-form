<?php

namespace micro;

use PHPUnit\Framework\TestCase;

class FormTest extends TestCase
{

    public function testInput()
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


        $expected = <<<EOS
<input type="text" name="username" class="form-control">
EOS;

        $jsonDs = new JsonDs();
        $jsonForm = new Form($jsonDs);
        $form = $jsonForm->render($jsonString);

        $this->assertEquals($expected, $form);
    }

    public function testInputs()
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

        $jsonDs = new JsonDs();
        $jsonForm = new Form($jsonDs);
        $form = $jsonForm->render($jsonString);

        $this->assertEquals($expected, $form);
    }

    public function testTextarea()
    {
        $jsonString = <<<EOS
        [
            {
                "tag": "textarea",
                "id": "story",
                "name": "story",
                "rows": "5",
                "cols": "33",
                "value": "It was a dark and stormy night..."
            }
        ]
EOS;


        $expected = <<<EOS
<textarea id="story" name="story" rows="5" cols="33">
It was a dark and stormy night...</textarea>
EOS;

        $jsonDs = new JsonDs();
        $jsonForm = new Form($jsonDs);
        $form = $jsonForm->render($jsonString);

        $this->assertEquals($expected, $form);
    }

    public function testSelect()
    {
        $jsonString = <<<EOS
        [
            {
                "tag": "select",
                "name": "pets",
                "id": "pet-select",
                "value": [
                    {
                        "tag": "option",
                        "label": "--Please choose an option--",
                        "value": ""
                    },
                    {
                        "tag": "option",
                        "label": "Dog",
                        "value": "dog"
                    },
                    {
                        "tag": "option",
                        "label": "Cat",
                        "value": "cat"
                    }
                ]
            }
        ]
EOS;


        $expected = <<<EOS
<select name="pets" id="pet-select">
    <option value="">--Please choose an option--</option>
    <option value="dog">Dog</option>
    <option value="cat">Cat</option>
</select>
EOS;

        $jsonDs = new JsonDs();
        $jsonForm = new Form($jsonDs);
        $form = $jsonForm->render($jsonString);

        $this->assertEquals($expected, $form);
    }

    public function testButton()
    {
        $jsonString = <<<EOS
        [
            {
                "tag": "button",
                "class": "favorite styled",
                "value": "Add to favorites",
                "type": "button"
            }
        ]
EOS;


        $expected = <<<EOS
<button class="favorite styled" type="button">
Add to favorites</button>
EOS;

        $jsonDs = new JsonDs();
        $jsonForm = new Form($jsonDs);
        $form = $jsonForm->render($jsonString);

        $this->assertEquals($expected, $form);
    }
}
