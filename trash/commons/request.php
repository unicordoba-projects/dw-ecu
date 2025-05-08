<?php


class Request {

    public static function get_data_request(){
        $rawBody = file_get_contents("php://input");
        $data = json_decode($rawBody, true);
        return $data;
    }
}