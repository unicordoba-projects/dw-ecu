<?php

include ("../models/UserModel.php");
require_once '../views/View.php';
require_once("../commons/codes/usuarios_responses.php");
require_once("../commons/request.php");
require_once("../commons/validate_user_request.php");
require_once("response.php");

class UsersController
{
    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    // GET /users
    public function index(): void
    {
        $res = $this->userModel->getAll();
        View::format_response(UserResponses::getCode('READ'), $res);
    }

    // GET /user/{id}
    public function show(string $id): void
    {
        echo "Mostrando usuario con ID = {$id}";
    }

    // POST /users
    public function store(): void
    {
        $data = Request::get_data_request();

        // print_r($data);

        $res = ValidateUserRequest::validate_user_request($data);

        if ( count( $res ) > 0) {
            View::format_response(UserResponses::getCode('VALIDATION_ERROR'), $res);
            return;
        }

        $data = ValidateUserRequest::sanitise($data);
        print_r($data);
        View::format_response(UserResponses::getCode('VALIDATION_ERROR'), $data);
        return;

        
        
        
        // $this->userModel->create($data);

        // echo "Creando un nuevo usuario";
    }
}


// include ('db/UserDB.php');
// include ('models/UserModel.php');
// require_once 'views/View.php';
// require_once("commons/codes/usuarios_responses.php");
// require_once("response.php");

// class UsersController {

//     private $userModel;

//     public function __construct() {
//         $this->userModel = new UserModel();
//     }

//     public function index() { 
//         $result = $this->userModel->getAll();
//         View::format_response(UserResponses::getCode('READ'), $result);
//     }
    
//     public function create() {    
//         return [
//             "action" => "CREATE"
//         ];
//     }

//     public function read() {    
//         return [
//             "action" => "READ"
//         ];
//     }

//     public function update() {    

//     }

//     public function delete() {    

//     }

// }