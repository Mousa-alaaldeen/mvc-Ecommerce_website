<?php

require 'models/Model.php';

class Customer extends Model
{
    public function __construct()
    {
        parent::__construct('customers');

    }

}