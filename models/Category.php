<?php

require 'models/Model.php';

class Category extends Model {

    public function __construct() {
      
        parent::__construct('categories');
    }

    public function getAllCategories()
    {
        $statement = $this->pdo->prepare("
        SELECT *
        FROM
         $this->table ");
        $statement->execute();
        return $statement->fetchAll(\pdo::FETCH_ASSOC);

    }
}
