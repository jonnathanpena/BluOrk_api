<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/users.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$users = new Users($db);
 
// query de lectura
$stmt = $users->read();
$num = $stmt->rowCount();

//user array
$user_arr=array();
$user_arr["data"]=array();
 
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
        $user_item=array(
            "id_users"=>$id_users,
            "firstName_users"=>$firstName_users,
            "lastName_users"=>$lastName_users,
            "email_users"=>$email_users,
            "password_users"=>base64_decode($password_users),
            "createAt_users"=>$createAt_users,
            "updateAt_users"=>$updateAt_users
        );
 
        array_push($user_arr["data"], $user_item);
    }
}

echo json_encode($user_arr);

?>