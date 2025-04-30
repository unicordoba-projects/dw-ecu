<?php

include ('db/UserDB.php');
include ('models/UserModel.php');
require_once 'views/View.php';
require_once("commons/codes/usuarios_responses.php");
require_once("response.php");

class UsersController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function list() { 
        $result = $this->userModel->getAll();
        View::format_response(UserResponses::getCode('READ'), $result);
    }
    
    public function create() {    
        return [
            "action" => "CREATE"
        ];
    }

    public function read() {    
        return [
            "action" => "READ"
        ];
    }

    public function update() {    

    }

    public function delete() {    

    }

}