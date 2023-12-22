<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../models/materia.php';
 
$database = new Database();
$db = $database->getConnection();
$materia = new Materia($db);
$data = json_decode(file_get_contents("php://input"));
if (
    !empty($data->id_materia) &&
    !empty($data->nome_materia)
) {
    $materia->id_materia = $data->id_materia;
    $materia->nome_materia = $data->nome_materia;
 
    if ($materia->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Materia creata correttamente."));
    } else {
        //503 servizio non disponibile
        http_response_code(503);
        echo json_encode(array("message" => "Impossibile creare la materia."));
    }
} else {
    //400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Impossibile creare la materia, i dati sono incompleti."));
}
?>
