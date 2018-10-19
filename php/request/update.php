<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/request.php';

date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d H:i:s");
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$request = new Request($db);
 
// get posted data
$data = json_decode(file_get_contents('php://input'), true);

// configura los valores recibidos en post de la app
$users->detsubcat_id= $data["detsubcat_id"];
$users->avatar_req= $data["avatar_req"];
$users->title_req= $data["title_req"];
$users->description_req= $data["description_req"];
$users->city_id= $data["city_id"];
$users->zipcode_req= $data["zipcode_req"];
$users->address_req= $data["address_req"];
$users->lat_req= $data["lat_req"];
$users->long_req= $data["long_req"];
$users->employment_type_id= $data["employment_type_id"];
$users->payAmount_req= $data["payAmount_req"];
$users->updateAt_req= $data["updateAt_req"];
$users->status_req= $data["status_req"];
$users->id_req= $data["id_req"];

// update request
$response = $request->update();
if($response == true){
    echo json_encode(true);
}else{
    // Error en caso de que no se pueda modificar
    echo json_encode(false); 
}
?>