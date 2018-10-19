<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/profiles.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$profiles = new Profiles($db);

// get posted data
$data = json_decode(file_get_contents('php://input'), true);

// configura los valores recibidos en post de la app
$profiles->users_id= $data["users_id"];

// query de lectura
$stmt = $profiles->readByUser();
$num = $stmt->rowCount();

//profiles array
$profiles_arr=array();
$profiles_arr["data"]=array();
 
// check if more than 0 record found
if($num>0){ 
    
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        //Los nombres acá son iguales a los de la clase iguales a las columnas de la BD
        $profiles_item=array(
            "id_prof"=>$id_prof,
            "users_id"=>$users_id,
            "avatar_prof"=>$avatar_prof,
            "phone_prof"=>$phone_prof,
            "type_prof"=>$type_prof,
            "provider_prof"=>$provider_prof,
            "provider_id"=>$provider_id
        );
 
        array_push($profiles_arr["data"], $profiles_item);
    }
}

echo json_encode($profiles_arr);

?>