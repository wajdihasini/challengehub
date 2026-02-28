<?php

require_once __DIR__ . "/../../config/database.php";

class Submission {

    private $conn;
    private $table = "submissions";

    public function __construct() {

        $database = new Database();
        $this->conn = $database->connect();
    
        if(!$this->conn){
            die("Database connection failed");
        }
    }
    // 🔹 Ajouter une submission
    public function create($id_ch, $id_user, $description, $image) {

        $query = "INSERT INTO " . $this->table . " 
                  (id_ch, id_user, description, image) 
                  VALUES (:id_ch, :id_user, :description, :image)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_ch', $id_ch);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);

        return $stmt->execute();
    }

    // 🔹 Récupérer toutes les submissions
    public function getAll() {

        $query = "SELECT * FROM " . $this->table . " ORDER BY id_sub DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Récupérer une submission par ID
    public function getById($id_sub) {

        $query = "SELECT * FROM " . $this->table . " WHERE id_sub = :id_sub";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sub', $id_sub);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Supprimer une submission
    public function delete($id_sub) {

        $query = "DELETE FROM " . $this->table . " WHERE id_sub = :id_sub";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sub', $id_sub);

        return $stmt->execute();
    }
}