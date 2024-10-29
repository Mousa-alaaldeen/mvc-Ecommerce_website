<?php

class Model
{
    protected $pdo;

    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
        $server_name = $_ENV['DB_SERVER'];
        $database_name = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        $dsn = "mysql:host=$server_name;dbname=$database_name";

        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function all()
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table");
        $statement->execute();
        return $statement->fetchAll(\pdo::FETCH_ASSOC);
    }

    public function find($id)
    {
      

        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE id =:id");
        $statement -> bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(\pdo::FETCH_ASSOC);

    }

    public function create($data)
    {
        $keys = implode(',', array_keys($data));
        $tags = ':' . implode(', :', array_keys($data));  // Fixed spacing issue here
        $sql = "INSERT INTO $this->table ($keys) VALUES ($tags)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        return $this->pdo->lastInsertId();
    }
    

        public function update($id, $data)
        {
            //dd($id);
            // $singular = $this->singularize($this->table);
            // $id_field = $singular."_id";

            $fields = '';
            foreach ($data as $key => $value) {
                $fields .= $key . '=:' . $key . ',';
            }
            $data['id'] = $id;

            $fields = rtrim($fields, ',');
            $sql = "UPDATE $this->table SET $fields WHERE id =:id";
           // dd($fields);
            $statement = $this->pdo->prepare($sql);
            $statement->execute($data);
        }

    public function delete($id)
    {
        $statement = $this->pdo->prepare( "DELETE FROM $this->table WHERE id = :id");
        $statement -> bindValue(':id', $id);
        $statement->execute();

    }

    function singularize($word) {
        // Basic check for plural form and conversion to singular
        if (substr($word, -1) === 's') {
            return substr($word, 0, -1);
        }
        return $word;
    }

}