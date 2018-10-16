<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/employmetTypes.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$employmetTypes = new EmploymentTypes($db);
 
// query de lectura
$stmt = $employmetTypes->read();
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