<?php
require_once __DIR__ . '/../core/Model.php';

class User extends Model {

    private $table = "users";

    public function create($data) {

        $sql = "INSERT INTO {$this->table}
                (nom, prenom, email, sexe, date_naissance, adresse, password)
                VALUES (:nom, :prenom, :email, :sexe, :date_naissance, :adresse, :password)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nom' => $data['nom'],
            ':prenom' => $data['prenom'],
            ':email' => $data['email'],
            ':sexe' => $data['sexe'],
            ':date_naissance' => $data['date_naissance'],
            ':adresse' => $data['adresse'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }

    public function findForLogin($nom, $prenom, $email) {

        $sql = "SELECT * FROM {$this->table}
                WHERE nom = :nom AND prenom = :prenom AND email = :email
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {

        $sql = "UPDATE {$this->table}
                SET nom=:nom, prenom=:prenom, email=:email,
                    sexe=:sexe, date_naissance=:date_naissance,
                    adresse=:adresse
                WHERE id=:id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nom'=>$data['nom'],
            ':prenom'=>$data['prenom'],
            ':email'=>$data['email'],
            ':sexe'=>$data['sexe'],
            ':date_naissance'=>$data['date_naissance'],
            ':adresse'=>$data['adresse'],
            ':id'=>$id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute([':id'=>$id]);
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email=:email");
        $stmt->execute([':email'=>$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}