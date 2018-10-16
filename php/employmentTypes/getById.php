<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/employmentTypes.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$employmentTypes = new EmploymentTypes($db);

// get posted data
$data = json_decode(file_get_contents('php://input'), true);

// configura los valores recibidos en post de la app
$employmentTypes->id_et= $data["id_et"];

// query de lectura
$stmt = $employmentTypes->readById();
$num = $stmt->rowCount();

//employmetTypes array
$employmetTypes_arr=array();
$employmetTypes_arr["data"]=array();
 
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
        $employmetTypes_item=array(
            "id_et"=>$id_et, 
            "name_et"=>$name_et
        );
 
        array_push($employmetTypes_arr["data"], $employmetTypes_item);
    }
}

echo json_encode($employmetTypes_arr);

?>