<?php
class Request {

    private $conn;

    public $id_req;
    public $detsubcat_id;
    public $avatar_req;
    public $title_req;
    public $description_req;
    public $city_id;
    public $zipcode_req;
    public $address_req;
    public $lat_req;
    public $long_req;
    public $employment_type_id;
    public $payAmount_req;
    public $createBy_req;
    public $createAt_req;
    public $updateAt_req;
    public $random;
    public $status_req;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        $query = "SELECT `id_req`, `detsubcat_id`, `avatar_req`, `title_req`, `description_req`, `city_id`, `zipcode_req`, `address_req`, 
                    `lat_req`, `long_req`, `employment_type_id`, `payAmount_req`, `createBy_req`, `createAt_req`, `updateAt_req`, `status_req`
                    FROM `bo_request`";
    
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
    
        return $stmt;
    }

    function readById(){
    
        $query = "SELECT `id_req`, `detsubcat_id`, `avatar_req`, `title_req`, `description_req`, `city_id`, `zipcode_req`, `address_req`, 
                    `lat_req`, `long_req`, `employment_type_id`, `payAmount_req`, `createBy_req`, `createAt_req`, `updateAt_req`, `status_req`
                    FROM `bo_request` WHERE `id_req` = ".$this->id_req;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }

    function readByUser(){
    
        $query = "SELECT `id_req`, `detsubcat_id`, `avatar_req`, `title_req`, `description_req`, `city_id`, `zipcode_req`, `address_req`, 
                    `lat_req`, `long_req`, `employment_type_id`, `payAmount_req`, `createBy_req`, `createAt_req`, `updateAt_req`, `status_req`
                    FROM `bo_request` WHERE `createBy_req` = ".$this->createBy_req;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }

    function readByFilters(){
    
        $query = "SELECT `id_req`, `detsubcat_id`, `avatar_req`, `title_req`, `description_req`, `city_id`, `zipcode_req`, 
                    `address_req`, `lat_req`, `long_req`, `employment_type_id`, `payAmount_req`, `createBy_req`, `createAt_req`, 
                    `updateAt_req`, `status_req` FROM `bo_request` 
                    WHERE `title_req` LIKE '%".$this->title_req."%' 
                    OR `address_req` LIKE '%".$this->address_req."%' 
                    OR `lat_req` LIKE '%".$this->lat_req."%' 
                    OR `long_req` LIKE '%".$this->long_req."%'
                    OR `city_id` = ".$this->city_id."
                    OR `zipcode_req` = ".$this->zipcode_req;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }

    function readByRandom(){
    
        $query = "SELECT `id_req`, `detsubcat_id`, `avatar_req`, `title_req`, `description_req`, `city_id`, `zipcode_req`, 
                    `address_req`, `lat_req`, `long_req`, `employment_type_id`, `payAmount_req`, `createBy_req`, `createAt_req`, 
                    `updateAt_req`, `status_req` FROM `bo_request` 
                    WHERE `title_req` LIKE '%".$this->random."%' 
                    OR `address_req` LIKE '%".$this->random."%' 
                    OR `lat_req` LIKE '%".$this->random."%' 
                    OR `long_req` LIKE '%".$this->random."%'";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }
    
    function insert(){
    
        $query = "INSERT INTO `bo_request`(`detsubcat_id`, `avatar_req`, `title_req`, `description_req`, `city_id`, `zipcode_req`, `address_req`, 
                    `lat_req`, `long_req`, `employment_type_id`, `payAmount_req`, `createBy_req`, `createAt_req`, `updateAt_req`, `status_req`) VALUES (
                        ".$this->detsubcat_id.",
                        '".$this->avatar_req."',
                        '".$this->title_req."',
                        '".$this->description_req."',
                        ".$this->city_id.",
                        ".$this->zipcode_req.",
                        '".$this->address_req."',
                        '".$this->lat_req."',
                        '".$this->long_req."',
                        ".$this->employment_type_id.",
                        ".$this->payAmount_req.",
                        ".$this->createBy_req.",
                        '".$this->createAt_req."',
                        null,
                        1
                    )";

        $stmt = $this->conn->prepare($query); 

        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }else{
            return false;
        }           
    }

    function update() {
        $query = "UPDATE `bo_request` SET 
                    `detsubcat_id`= ".$this->detsubcat_id.",
                    `avatar_req`= '".$this->avatar_req."',
                    `title_req`= '".$this->title_req."',
                    `description_req`= '".$this->description_req."',
                    `city_id`= ".$this->city_id.",
                    `zipcode_req`= ".$this->zipcode_req.",
                    `address_req`= '".$this->address_req."',
                    `lat_req`= '".$this->lat_req."',
                    `long_req`= '".$this->long_req."',
                    `employment_type_id`= ".$this->employment_type_id.",
                    `payAmount_req`= ".$this->payAmount_req.",
                    `updateAt_req`= '".$this->updateAt_req."',
                    `status_req`= ".$this->status_req.",
                    WHERE `id_req` = ".$this->id_req;
        
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }   
    }

    function delete() {
        
        $query = "DELETE FROM `bo_request` WHERE `id_req` = ".$this->id_req;

        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }  
    }
    
}
?>
