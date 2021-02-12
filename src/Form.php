<?php

namespace micro;

use micro\Interfaces\Datasource;
use micro\Element\Element;

class Form
{

    private $datasource;
    private $configuration = [];
    private $defaultConfigurationPath = '/../../../../micro-form.config.json';

    public function __construct(Datasource $datasource, $configurationPath = '')
    {        
        $this->datasource = $datasource;

        if(empty($configurationPath)) {
            $configurationPath = dirname(__FILE__) . $this->defaultConfigurationPath;
        }

        if(is_file($configurationPath)) {
            $configurationStr = file_get_contents($configurationPath);
            $this->configuration = $this->loadConfig($configurationStr);
        }
    }

    public function render(string $input): string
    {
        $elements = $this->datasource->transformer($input);

        $out = '';

        foreach ($elements as $attributes) {
            $element = new Element($attributes, $this->configuration);
            $out .= $element->render() . PHP_EOL;
        }

        return trim($out);
    }

    private function loadConfig(string $configuration) : array
    {
        $configArr = json_decode($configuration, true);
        if($configArr === false) {
            $configArr = [];
        }
        
        return $configArr;
    }
}