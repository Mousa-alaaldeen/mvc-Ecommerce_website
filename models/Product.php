<?php

require 'models/Model.php';

class Product extends Model
{
    public function __construct()
    {

        parent::__construct('products');
    }

    public function getProducts()
    {

        $statement = $this->pdo->prepare("
        SELECT *, 
            productimages.image_url, 
            categories.category_name 
        FROM 
            $this->table 
        JOIN 
            productimages ON $this->table.product_id = productimages.product_id 
        JOIN 
            categories ON $this->table.category_id = categories.category_id ");
        $statement->execute();
        return $statement->fetchAll(\pdo::FETCH_ASSOC);
    }
    public function getAllProducts()
    {
        $statement = $this->pdo->prepare("
        SELECT *
        FROM
         $this->table ");

        $statement->execute();
        return $statement->fetchAll(\pdo::FETCH_ASSOC);

    }

 

}
