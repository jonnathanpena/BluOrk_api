<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/countries.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$countries = new Countries($db);
 
// query de lectura
$stmt = $countries->read();
$num = $stmt->rowCount();

//countries array
$countries_arr=array();
$countries_arr["data"]=array();
 
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
        $countries_item=array(
            "id_countries"=>$id_countries, 
            "name_countries"=>$name_countries
        );
 
        array_push($countries_arr["data"], $countries_item);
    }
}

echo json_encode($countries_arr);

?>