<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../models/corso.php';
 
$database = new Database();
$db = $database->getConnection();
 
$corso = new Corso($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$corso->id_corso = $data->id_corso;
 
if($id_corso->delete()){
    http_response_code(200);
    echo json_encode(array("risposta" => "Il corso e' stato eliminato"));
}else{
    //503 service unavailable
    http_response_code(503);
    echo json_encode(array("risposta" => "Impossibile eliminare il corso."));
}
?>