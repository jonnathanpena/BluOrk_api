<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/tags.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$tags = new Tags($db);
 
// query de lectura
$stmt = $tags->read();
$num = $stmt->rowCount();

//tags array
$tags_arr=array();
$tags_arr["data"]=array();
 
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
        $tags_item=array(
            "id_tags"=>$id_tags, 
            "name_tags"=>$name_tags
        );
 
        array_push($tags_arr["data"], $tags_item);
    }
}

echo json_encode($tags_arr);

?>