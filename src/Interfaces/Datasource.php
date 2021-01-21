<?php 

namespace micro\interfaces;

interface Datasource {
    public function transformer(string $input) : array;
}