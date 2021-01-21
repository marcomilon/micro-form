<?php

namespace micro;

use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{

    public function testCreateJsonForm()
    {

        $jsonForm = FormFactory::jsonForm();
        $this->assertInstanceOf(Form::class, $jsonForm);

    }

}