<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/subcategories.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$subcategories = new Subcategories($db);

// get posted data
$data = json_decode(file_get_contents('php://input'), true);

// configura los valores recibidos en post de la app
$subcategories->category_id= $data["category_id"];

// query de lectura
$stmt = $subcategories->readByCategory();
$num = $stmt->rowCount();

//subcategories array
$subcategories_arr=array();
$subcategories_arr["data"]=array();
 
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
        $subcategories_item=array(
            "id_subcat"=>$id_subcat, 
            "name_subcat"=>$name_subcat,
            "id_detsubcat"=>$id_detsubcat,
            "category_id"=>$category_id,
            "subcategory_id"=>$subcategory_id
        );
 
        array_push($subcategories_arr["data"], $subcategories_item);
    }
}

echo json_encode($subcategories_arr);

?>