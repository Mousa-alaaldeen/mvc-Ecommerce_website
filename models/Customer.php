<?php

require 'models/Model.php';

class Customer extends Model
{
    public function __construct()
    {
        parent::__construct('customers');

    }
    public function isEmailTaken($email)
{
    $sql = "SELECT COUNT(*) FROM $this->table WHERE email = :email";
    $statement = $this->pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    return $statement->fetchColumn() > 0;
}


}