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
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$request = new Request($db);

// get posted data
$data = json_decode(file_get_contents('php://input'), true);

// configura los valores recibidos en post de la app
$request->id_req= $data["id_req"];

// query de lectura
$stmt = $request->readById();
$num = $stmt->rowCount();

//request array
$request_arr=array();
$request_arr["data"]=array();
 
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
        $request_item=array(
            "id_req"=>$id_req,
            "detsubcat_id"=>$detsubcat_id,
            "avatar_req"=>$avatar_req,
            "title_req"=>$title_req,
            "description_req"=>$description_req,
            "city_id"=>$city_id,
            "zipcode_req"=>$zipcode_req,
            "address_req"=>$address_req,
            "lat_req"=>$lat_req,
            "long_req"=>$long_req,
            "employment_type_id"=>$employment_type_id,
            "payAmount_req"=>$payAmount_req,
            "createBy_req"=>$createBy_req,
            "createAt_req"=>$createAt_req,
            "updateAt_req"=>$updateAt_req,
            "status_req"=>$status_req
        );
 
        array_push($request_arr["data"], $request_item);
    }
}

echo json_encode($request_arr);

?>