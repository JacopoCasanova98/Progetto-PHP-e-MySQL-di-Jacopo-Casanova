<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// includiamo database.php e materia.php per poterli usare
include_once '../config/database.php';
include_once '../models/materia.php';
// creiamo un nuovo oggetto Database e ci colleghiamo al nostro database
$database = new Database();
$db = $database->getConnection();
// Creiamo un nuovo oggetto Materia
$materia = new Materia($db);
// query products
$stmt = $materia->read();
$num = $stmt->rowCount();
// se vengono trovati materie nel database
if($num>0){
    // array di materie
    $materie_arr = array();
    $materie_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $materie_item = array(
            "id_materie" => $id_materie,
            "nome_materia" => $nome_materia
        );
        array_push($materie_arr["records"], $materie_item);
    }
    echo json_encode($materie_arr);
}else{
    echo json_encode(
        array("message" => "Nessuna Materia Trovata.")
    );
}
?>