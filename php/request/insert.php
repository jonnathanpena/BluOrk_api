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
$request->detsubcat_id= $data["detsubcat_id"];
$request->avatar_req= $data["avatar_req"];
$request->title_req= $data["title_req"];
$request->description_req= $data["description_req"];
$request->city_id= $data["city_id"];
$request->zipcode_req= $data["zipcode_req"];
$request->address_req= $data["address_req"];
$request->lat_req= $data["lat_req"];
$request->long_req= $data["long_req"];
$request->employment_type_id= $data["employment_type_id"];
$request->payAmount_req= $data["payAmount_req"];
$request->createBy_req= $data["createBy_req"];
$request->createAt_req= $fecha;

// insert request
$response = $request->insert();
if($response != false){
    $response = $response * 1;
    echo json_encode($response); 
}else{
    // Error en caso de que no se pueda modificar
    echo json_encode(false); 
}
?>