<?php

require_once('db/DB.php');

class Model
{
    private $connection;

    public function __construct()
    {
        $this->connection = DB::getConnection();
    }

    public function getAll(array $atributos = null)
    {
        $sql = "SELECT * FROM {$this->table}";
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stm = $this->connection->prepare($sql);
        $stm->bindParam(":id", $id);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($values)
    {
        $sql = "INSERT 
                INTO {$this->table} ( username, password, first_name, last_name, email ) 
                VALUES ( :username, :password, :first_name, :last_name, :email )";
        $stm = $this->connection->prepare($sql);
        $stm->bindParam(":id", $id);
        $res = $stm->execute();
        return $res;
    }
}
