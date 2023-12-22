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
$corso->nome_corso = $data->nome_corso;
$corso->posti_disponibili = $data->posti_disponibili;
$corso->id_materia = $data->id_materia;
$corso->nome_materia =$data->nome_materia;
 
if($corso->update()){
    http_response_code(200);
    echo json_encode(array("risposta" => "Corso aggiornato"));
}else{
    //503 service unavailable
    http_response_code(503);
    echo json_encode(array("risposta" => "Impossibile aggiornare il corso"));
}
?>