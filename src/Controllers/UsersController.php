<?php

use App\Models\UserModel;
use App\View\View;
use App\Commons\Codes\UserResponses;


class UsersController
{
    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    // GET /users
    public function index(): void
    {
        $res = $this->userModel->get();
        View::format_response(UserResponses::getCode('READ'), $res);
    }

    // GET /user/{id}
    public function show(string $id): void
    {
        $res = $this->userModel->where('id', $id)->get();
        View::format_response(UserResponses::getCode('READ'), $res);
    }

    // POST /users
    public function store(): void
    {
        $rawBody = file_get_contents("php://input");
        $data = json_decode($rawBody, true);

        
        // $this->userModel->create($data);
        $this->userModel->username = $data['username'];
        $this->userModel->password = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->userModel->first_name = $data['first_name'];
        $this->userModel->last_name = $data['last_name'];
        $this->userModel->email = $data['email'];
        $this->userModel->birthdate = $data['birhdate'];
        $this->userModel->age = $data['age'];

        $this->userModel->save();
        

        echo "Creando un nuevo usuario";
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