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
if (
    !empty($data->nome_corso) &&
    !empty($data->posti_disponibili) &&
    !empty($data->id_materia)  
) {
    $corso->nome_corso = $data->nome_corso;
    $corso->posti_disponibili = $data->posti_disponibili;
    $corso->id_materia = $data->id_materia; 

    if ($corso->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Corso creato correttamente."));
    } else {
        //503 servizio non disponibile
        http_response_code(503);
        echo json_encode(array("message" => "Impossibile creare il corso."));
    }
} else {
    //400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Impossibile creare il corso, i dati sono incompleti."));
}
?>