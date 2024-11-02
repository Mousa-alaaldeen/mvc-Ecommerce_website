<?php

require 'models/Model.php';

class Testimonial extends Model {

    public function __construct()
    {
        parent::__construct('testimonials');

    }
 
    // public function getTestimonialsCount()
    // {
    //     $statement = $this->pdo->prepare("SELECT * FROM $this->table");
    //     $statement->execute();
    //     $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //     return $result['count'] ?? 0;
    // }
    public function getTestimonialsCount() {
        $statement = $this->pdo->prepare("SELECT COUNT(*) as count FROM $this->table");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['count'] ?? 0; // إرجاع العدد أو 0 إذا لم يكن موجودًا
    }
}