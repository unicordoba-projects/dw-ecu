<?php

include ("DB.php");

class UserDB{

    private $db;

    public function __construct(){
        $this->db = DB::getConnection();
    }

    public function get_all(){
        $sql = "SELECT * FROM users";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function get_by_id($id){
        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $this->db->prepare($sql);
        $statement->bindParam("id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}