<?php 

namespace micro;

class FormFactory
{

    public static function jsonForm() : Form
    {
        $jsonDs = new JsonDs();
        return new Form($jsonDs);
    }

}