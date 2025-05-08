<?php

use App\Models\InscriptionModel;

class AttendeeService
{
    private $inscriptionModel;

    public function __construct(){
        $this->inscriptionModel = new InscriptionModel();
    }

    public function createAttendee(){
        // Validate inscription 
        
    }

}