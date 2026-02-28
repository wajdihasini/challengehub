<?php



class Vote {
    private PDO $db;

    private ?int $id = null;
    private int $submission_id;
    private int $user_id;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // --- Getters ---
    public function getId(): ?int { return $this->id; }
    public function getSubmissionId(): int { return $this->submission_id; }
    public function getUserId(): int { return $this->user_id; }

    // --- Setters ---
    public function setSubmissionId(int $submission_id): void { $this->submission_id = $submission_id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }




     //Voter pour une participation

    public function voter(): bool {
        // Vérifier si l'utilisateur a déjà voté
        if ($this->aDejaVote($this->user_id, $this->submission_id)) {
            return false;
        }

        $sql = "INSERT INTO votes (submission_id, user_id) VALUES (:submission_id, :user_id)";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':submission_id' => $this->submission_id,
            ':user_id'       => $this->user_id
        ]);
    }


//Retirer un vote

    public function annulerVote(int $user_id, int $submission_id): bool {
        $sql = "DELETE FROM votes WHERE user_id = :user_id AND submission_id = :submission_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user_id'       => $user_id,
            ':submission_id' => $submission_id
        ]);
    }


    //Vérifier si un utilisateur a déjà voté pour une participation

    public function aDejaVote(int $user_id, int $submission_id): bool {
        $sql = "SELECT COUNT(*) FROM votes WHERE user_id = :user_id AND submission_id = :submission_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $user_id, ':submission_id' => $submission_id]);
        return $stmt->fetchColumn() > 0;
    }


    //Compter les votes d'une participation

    public function compterVotes(int $submission_id): int {
        $sql = "SELECT COUNT(*) FROM votes WHERE submission_id = :submission_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':submission_id' => $submission_id]);
        return (int) $stmt->fetchColumn();
    }
}
