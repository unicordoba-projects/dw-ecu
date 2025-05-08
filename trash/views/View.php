<?php

class View
{
    public static function returnJSON($data)
    {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode($data);
    }

    public static function format_response($response, $data=null){
        header('Content-type:application/json;charset=utf-8');
        if ( !is_null($data)) {
            $response['data'] = $data;
        }
        echo json_encode($response);
    }
}