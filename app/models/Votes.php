<?php

class Vote {

    private $conn;
    private $table = "votes";

    public function __construct($db){
        $this->conn = $db;
    }

    public function addVote($user_id, $submission_id){

        $query = "INSERT INTO " . $this->table . " (user_id, submission_id)
                  VALUES (:user_id, :submission_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':submission_id', $submission_id);

        return $stmt->execute();
    }

    public function checkUserVote($user_id, $submission_id){

        $query = "SELECT * FROM votes 
                  WHERE user_id = :user_id 
                  AND submission_id = :submission_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':submission_id', $submission_id);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function countVotes($submission_id){

        $query = "SELECT COUNT(*) as total 
                  FROM votes 
                  WHERE submission_id = :submission_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':submission_id', $submission_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}