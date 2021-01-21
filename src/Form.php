<?php 

namespace micro;

use Exception;
use micro\interfaces\Datasource;

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
        $template = '';

        foreach($elements as $element) {

            $params = [];
            $tag = $element['tag'];
            $value = $element['value'] ?? '';

            $attribute = $element;
            unset($attribute['tag']);
            
            switch($tag) {
                case 'input':
                    $template = 'templates/input.php';
                    $params = [
                        'attributes' => $attribute
                    ];
                break;
                case 'textarea':
                    unset($attribute['value']);
                    $template = 'templates/textarea.php';
                    $params = [
                        'attributes' => $attribute,
                        'value' => $value
                    ];
                break;
                case 'select':

                    $options = [];
                    foreach($attribute['value'] as $option) {

                        $label = $option['label'];
                        unset($option['label']);
                        unset($option['tag']);

                        $options[] = [
                            'attributes' => $option,
                            'label' => $label
                        ];
                    }


                    
                    unset($attribute['value']);
                    
                    $template = 'templates/select.php';
                    $params = [
                        'attributes' => $attribute,
                        'options' => $options
                    ];
                break;
                case 'button':
                    unset($attribute['value']);
                    $template = 'templates/button.php';
                    $params = [
                        'attributes' => $attribute,
                        'value' => $value
                    ];
                break;
                default:
                    throw new Exception('Template not found for tag: ' . $tag);
            }

            $out .= $this->renderFile($template, $params) . "\n";
        }



        return trim($out);
    }

    private function renderFile($file, $params) {
        ob_start();
        extract ($params);
        require $file;
        $out = ob_get_clean();        
        return $out;
    }

}