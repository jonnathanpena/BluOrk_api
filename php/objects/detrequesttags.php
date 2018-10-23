<?php
class DetRequestTags {

    private $conn;

    public $id_detreqtags;
    public $request_id;
    public $tags_id;

    public function __construct($db){
        $this->conn = $db;
    }

    function readRequestByTags() {

        $query = "SELECT `id_detreqtags`, `request_id`, `tags_id` 
                    FROM `bo_detrequesttags` 
                    WHERE `tags_id` = ".$this->tags_id;
    }
    
    function insert(){
    
        $query = "INSERT INTO `bo_detrequesttags`(`request_id`, `tags_id`) 
                    VALUES (
                        ".$this->request_id.",
                        ".$this->tags_id."
                    )";

        $stmt = $this->conn->prepare($query); 

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }           
    }

    function delete() {
        $query = "DELETE FROM `bo_detrequesttags` WHERE `id_detreqtags` = ".$this->id_detreqtags;
        $stmt = $this->conn->prepare($query);
        if($stmt->exceute()) {
            return true;
        } else {
            return false;
        }
    }
    
}
?>