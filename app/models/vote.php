<?php

class Vote {

    private $conn;
    private $table = "votes";

    public function __construct($db){
        $this->conn = $db;
    }

    public function addVote($id_user, $id_sub){

        $query = "INSERT INTO " . $this->table . " (id_user, id_sub)
                  VALUES (:id_user, :id_sub)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_sub', $id_sub);

        return $stmt->execute();
    }

    public function checkUserVote($id_user, $id_sub){

        $query = "SELECT * FROM " . $this->table . "
                  WHERE id_user = :id_user 
                  AND id_sub = :id_sub";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_sub', $id_sub);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function countVotes($id_sub){

        $query = "SELECT COUNT(*) as total 
                  FROM " . $this->table . "
                  WHERE id_sub = :id_sub";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_sub', $id_sub);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}