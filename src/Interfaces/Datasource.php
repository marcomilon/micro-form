<?php 

namespace micro\Interfaces;

interface Datasource {
    public function transformer(string $input) : array;
}