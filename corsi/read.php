<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// includiamo database.php e corso.php per poterli usare
include_once '../config/database.php';
include_once '../models/corso.php';
// creiamo un nuovo oggetto Database e ci colleghiamo al nostro database
$database = new Database();
$db = $database->getConnection();
// Creiamo un nuovo oggetto Corso
$corso = new Corso($db);
// query products
$stmt = $corso->readWithMateria();
$num = $stmt->rowCount();
// se vengono trovati materie nel database
if($num>0){
    // array di materie
    $corsi_arr = array();
    $corsi_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $corsi_item = array(
            "id_corso" => $id_corso,
            "nome_corso" => $nome_corso,
            "posti_disponibili" => $posti_disponibili,
            "nome_materia" => $nome_materia,
            "id_materia" => $id_materia
        );
        array_push($corsi_arr["records"], $corsi_item);
    }
    echo json_encode($corsi_arr);
}else{
    echo json_encode(
        array("message" => "Nessun Corso Trovato.")
    );
}
?>