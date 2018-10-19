<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/user_types.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$user_types = new UserType($db);
 
// query de lectura
$stmt = $user_types->read();
$num = $stmt->rowCount();

//user_types array
$user_types_arr=array();
$user_types_arr["data"]=array();
 
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
        $user_types_item=array(
            "id_usrtype"=>$id_usrtype, 
            "name_usrtype"=>$name_usrtype
        );
 
        array_push($user_types_arr["data"], $user_types_item);
    }
}

echo json_encode($user_types_arr);

?>