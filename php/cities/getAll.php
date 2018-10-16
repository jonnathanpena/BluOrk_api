<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/cities.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$cities = new Cities($db);
 
// query de lectura
$stmt = $cities->read();
$num = $stmt->rowCount();

//cities array
$cities_arr=array();
$cities_arr["data"]=array();
 
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
        $cities_item=array(
            "id_cities"=>$id_cities,
            "states_id"=>$states_id,
            "name_cities"=>$name_cities
        );
 
        array_push($cities_arr["data"], $cities_item);
    }
}

echo json_encode($cities_arr);

?>