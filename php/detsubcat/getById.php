<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/detsubcat.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$detsubcat = new DetSubcat($db);

// get posted data
$data = json_decode(file_get_contents('php://input'), true);

// configura los valores recibidos en post de la app
$detsubcat->id_detsubcat= $data["id_detsubcat"];

// query de lectura
$stmt = $detsubcat->readById();
$num = $stmt->rowCount();

//detsubcat array
$detsubcat_arr=array();
$detsubcat_arr["data"]=array();
 
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
        $detsubcat_item=array(
            "id_detsubcat"=>$id_detsubcat,
            "category_id"=>$category_id,
            "subcategory_id"=>$subcategory_id
        );
 
        array_push($detsubcat_arr["data"], $detsubcat_item);
    }
}

echo json_encode($detsubcat_arr);

?>