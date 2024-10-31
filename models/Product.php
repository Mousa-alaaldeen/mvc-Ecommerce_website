<?php

require_once 'models/Model.php';

class Product extends Model
{
    public function __construct()
    {
        parent::__construct('products');
    }

    public function getProducts()
    {
        $statement = $this->pdo->prepare("
            SELECT p.*, 
                   (SELECT pi.image_url 
                    FROM productimages pi 
                    WHERE pi.product_id = p.id 
                    LIMIT 1) AS image_url, 
                   c.category_name 
            FROM $this->table p 
            JOIN categories c ON p.category_id = c.id
        ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductWithImage($id)
    {
        $statement = $this->pdo->prepare("
            SELECT p.*, pi.image_url 
            FROM $this->table p 
            LEFT JOIN productimages pi ON p.id = pi.product_id 
            WHERE p.id = :id
        ");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllProducts()
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
