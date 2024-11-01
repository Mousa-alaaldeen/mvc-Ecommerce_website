<?php

require 'models/Model.php';

class Admin extends Model
{
    public function __construct()
    {
        parent::__construct('admins');

    }
  
    public function findByEmail($email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM admins WHERE email = ?");
        $statement->execute([$email]);
        return $statement->fetch(PDO::FETCH_ASSOC); 
    }
    

}