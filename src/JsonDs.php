<?php 

namespace micro;

use Exception;
use micro\Interfaces\Datasource;

class JsonDs implements Datasource
{
    public function transformer(string $input) : array
    {
        $jsonArr = json_decode($input, true);

        if(empty($jsonArr )) {
            throw new Exception("Json string is not valid");
        }

        return $jsonArr;
    }
}