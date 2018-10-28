<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get posted data
$data = json_decode(file_get_contents('php://input'), true);

// configura los valores recibidos en post de la app
$request_id = $data["request_id"];
$file_name = $data["file_name"];

// move file
$path = "../documentos/imagenes/request/".$request_id."/";
if (!file_exists($path)) {
    mkdir($path, 0777);
    rename('../documentos/temp/'.$file_name, $path.$file_name);
    echo json_encode(array('success'=>true, 'tipo'=>'NUevo directorio'));
} else {
    rename('../documentos/temp/'.$file_name, $path.$file_name);
    echo json_encode(array('success'=>true, 'tipo'=>'Directorio existente'));
}

?>