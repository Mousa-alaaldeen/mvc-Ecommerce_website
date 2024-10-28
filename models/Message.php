<?php

require 'models/Model.php';

class Message extends Model {

    public function __construct()
    {
        parent::__construct('messages');

    }

}