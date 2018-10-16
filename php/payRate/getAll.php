<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/payRate.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$payRate = new PayRate($db);
 
// query de lectura
$stmt = $payRate->read();
$num = $stmt->rowCount();

//payRate array
$payRate_arr=array();
$payRate_arr["data"]=array();
 
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
        $payRate_item=array(
            "id_et"=>$id_et, 
            "name_et"=>$name_et
        );
 
        array_push($payRate_arr["data"], $payRate_item);
    }
}

echo json_encode($payRate_arr);

?>