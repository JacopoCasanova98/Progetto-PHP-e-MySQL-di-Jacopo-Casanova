<?php
class Materia
	{
	private $conn;
	private $table_name = "materie";
	// proprietà di una materia 
    public $id_materia;
	public $nome_materia;
	// costruttore
	public function __construct($db)
		{
		$this->conn = $db;
		}
	// READ materia
	function read()
		{
		// select all
		$query = "SELECT
                        materie.id_materia, materie.nome_materia
                    FROM
                   " . $this->table_name . " materie ";
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
		}

		function create() {
			$query = "INSERT INTO " . $this->table_name . "
					  SET id_materia=:id_materia, nome_materia=:nome_materia";
		
			$stmt = $this->conn->prepare($query);
		
			$this->id_materia = htmlspecialchars(strip_tags($this->id_materia));
			$this->nome_materia = htmlspecialchars(strip_tags($this->nome_materia));
		
			// binding
			$stmt->bindParam(":id_materia", $this->id_materia);
			$stmt->bindParam(":nome_materia", $this->nome_materia);
		
			// execute query
			if ($stmt->execute()) {
				return true;
			}
		
			return false;
		}

		function update(){
 
			$query = "UPDATE " . $this->table_name . "
          		SET id_materia=:id_materia, nome_materia=:nome_materia
          		WHERE id_materia = :id_materia";
		 
			$stmt = $this->conn->prepare($query);
		 
			$this->id_materia = htmlspecialchars(strip_tags($this->id_materia));
			$this->nome_materia = htmlspecialchars(strip_tags($this->nome_materia));
		
			// binding
			$stmt->bindParam(":id_materia", $this->id_materia);
			$stmt->bindParam(":nome_materia", $this->nome_materia);
		 
			// execute the query
			if($stmt->execute()){
				return true;
			}
		 
			return false;
		}

		function delete(){
 
			$query = "DELETE FROM " . $this->table_name . " WHERE id_materia = ?";
		 
		 
			$stmt = $this->conn->prepare($query);
		 
			$this->id_materia = htmlspecialchars(strip_tags($this->id_materia));
		 
		 
			$stmt->bindParam(1, $this->id_materia);
		 
			// execute query
			if($stmt->execute()){
				return true;
			}
		 
			return false;
			 
		}
		 
	}
?>