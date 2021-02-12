<?php 

namespace micro;

use micro\Interfaces\Datasource;
use micro\Element\Factory;

class Form
{

    private $datasource;

    public function __construct(Datasource $datasource)
    {
        $this->datasource = $datasource;
    }

    public function render(string $input): string
    {
        $elements = $this->datasource->transformer($input);

        $out = '';

        foreach($elements as $attrbutes) {
            $element = Factory::makeElement($attrbutes);
            $out .= $element->render() . PHP_EOL;
        }



        return trim($out);
    }

}