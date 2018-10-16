<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/categories.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$categories = new Categories($db);
 
// query de lectura
$stmt = $categories->read();
$num = $stmt->rowCount();

//categories array
$categories_arr=array();
$categories_arr["data"]=array();
 
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
        $categories_item=array(
            "id_cat"=>$id_cat,
            "name_cat"=>$name_cat
        );
 
        array_push($categories_arr["data"], $categories_item);
    }
}

echo json_encode($categories_arr);

?>