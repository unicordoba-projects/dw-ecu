<?php

// require_once('../db/DB.php');

namespace App\Models;

use App\Models\DB;

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
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
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
        $columns = implode(',', array_keys($values));
        $placeHolders = ':'.implode(', :', array_keys($values));

        $sql = "INSERT INTO {$this->table} ( $columns ) VALUES ( $placeHolders )";
        $stm = $this->connection->prepare($sql);

        $binds = [];
        foreach ($values as $key => $value) {
            $binds[":$key"] = $value;
        }
        
        return $stm->execute($binds);
    }
}
