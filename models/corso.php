<?php
class Corso
{
    private $conn;
    private $table_name = "corsi";

    public $id_corso;
    public $nome_corso;
    public $id_materia;
    public $nome_materia;
    public $posti_disponibili;

    public function __construct($db)
    {
        $this->conn = $db;
    }
	
    function readWithMateria()
    {
        $query = "SELECT corsi.id_corso, corsi.nome_corso, corsi.posti_disponibili, materie.nome_materia
                  FROM " . $this->table_name . " corsi
                  INNER JOIN materie ON corsi.id_materia = materie.id_materia";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
                  SET nome_corso=:nome_corso, id_materia=:id_materia, posti_disponibili=:posti_disponibili";

        $stmt = $this->conn->prepare($query);

        $this->nome_corso = htmlspecialchars(strip_tags($this->nome_corso));
        $this->posti_disponibili = htmlspecialchars(strip_tags($this->posti_disponibili));
        $this->id_materia = htmlspecialchars(strip_tags($this->id_materia));

        // binding
        $stmt->bindParam(":nome_corso", $this->nome_corso);
        $stmt->bindParam(":posti_disponibili", $this->posti_disponibili);
        $stmt->bindParam(":id_materia", $this->id_materia);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function update()
    {
        $query = "UPDATE " . $this->table_name . "
                  SET nome_corso=:nome_corso, posti_disponibili=:posti_disponibili
                  WHERE id_corso = :id_corso";

        $stmt = $this->conn->prepare($query);

        $this->id_corso = htmlspecialchars(strip_tags($this->id_corso));
        $this->nome_corso = htmlspecialchars(strip_tags($this->nome_corso));
        $this->posti_disponibili = htmlspecialchars(strip_tags($this->posti_disponibili));

        // binding
        $stmt->bindParam(":id_corso", $this->id_corso);
        $stmt->bindParam(":nome_corso", $this->nome_corso);
        $stmt->bindParam(":posti_disponibili", $this->posti_disponibili);

        // execute the query
        return $stmt->execute();
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_corso = ?";

        $stmt = $this->conn->prepare($query);

        $this->id_corso = htmlspecialchars(strip_tags($this->id_corso));

        $stmt->bindParam(1, $this->id_corso);

        // execute query
        return $stmt->execute();
    }
}
?>
