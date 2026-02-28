<?php

require_once __DIR__ . "/../../config/database.php";

class Comment {

    private $conn;
    private $table = "comments";

    public function __construct() {

        $database = new Database();
        $this->conn = $database->connect();

        if(!$this->conn){
            die("Database connection failed");
        }
    }

    // 🔹 Ajouter un commentaire
    public function create($id_sub, $id_user, $content) {

        $query = "INSERT INTO " . $this->table . " 
                  (id_sub, id_user, content) 
                  VALUES (:id_sub, :id_user, :content)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_sub', $id_sub);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':content', $content);

        return $stmt->execute();
    }

    // 🔹 Récupérer commentaires submission
    public function getBySubmission($id_sub) {

        $query = "SELECT * FROM " . $this->table . " 
                  WHERE id_sub = :id_sub
                  ORDER BY id_comm DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_sub', $id_sub);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Supprimer commentaire
    public function delete($id_comm) {

        $query = "DELETE FROM " . $this->table . " 
                  WHERE id_comm = :id_comm";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_comm', $id_comm);

        return $stmt->execute();
    }
}