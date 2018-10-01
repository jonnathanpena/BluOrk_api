<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/users.php';

date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d H:i:s");
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$users = new Users($db);
 
// get posted data
$data = json_decode(file_get_contents('php://input'), true);

// configura los valores recibidos en post de la app
$users->id_users= $data["id_users"];
$users->updateAt_users= $fecha;
$users->password_users= base64_encode($data["password_users"]);

// update user
$response = $users->update();
if($response == true){
    echo json_encode(true);
}else{
    // Error en caso de que no se pueda modificar
    echo json_encode(false); 
}
?>