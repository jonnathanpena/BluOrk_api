<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/states.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$states = new States($db);
 
// query de lectura
$stmt = $states->read();
$num = $stmt->rowCount();

//states array
$states_arr=array();
$states_arr["data"]=array();
 
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
        $states_item=array(
            "id_states"=>$id_states, 
            "country_id"=>$country_id,
            "name_states"=>$name_states
        );
 
        array_push($states_arr["data"], $states_item);
    }
}

echo json_encode($states_arr);

?>