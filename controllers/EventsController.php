<?php

include ('db/UserDB.php');
include ('models/EventModel.php');
require_once 'views/View.php';
require_once("commons/codes/usuarios_responses.php");
require_once("response.php");

class EventsController {

    private $eventModel;

    public function __construct() {
        $this->eventModel = new EventModel();
    }

    public function list() { 
        $result = $this->eventModel->getAll();
        View::format_response(UserResponses::getCode('READ'), $result);
    }
    
    public function searchId($id) { 
        $result = $this->eventModel->getById($id);
        View::format_response(UserResponses::getCode('READ'), $result);
    }
    
    public function create($id) { 
        $rawBody = file_get_contents('php://input');
        $data = json_decode($rawBody, true);

        $result = $this->eventModel->create($data);
        View::format_response(UserResponses::getCode('CREATE'), $result);
    }
    
   

}