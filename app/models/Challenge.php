<?php

class Challenge {
    private int $id;
    private int $user_id;
    private string $titre;
    private string $description;
    private string $categorie;
    private string $date_limite;
    private ?string $image_path;
    private string $created_at;

    // Getters
    public function getId(): int                { return $this->id; }
    public function getUserId(): int            { return $this->user_id; }
    public function getTitre(): string          { return $this->titre; }
    public function getDescription(): string    { return $this->description; }
    public function getCategorie(): string      { return $this->categorie; }
    public function getDateLimite(): string     { return $this->date_limite; }
    public function getImagePath(): ?string     { return $this->image_path; }
    public function getCreatedAt(): string      { return $this->created_at; }

    public static function create(array $data, int $userId): bool {
        $pdo = Database::getInstance();

        $sql = "INSERT INTO challenges 
                (user_id, titre, description, categorie, date_limite, image_path)
                VALUES (:user_id, :titre, :description, :categorie, :date_limite, :image_path)";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':user_id'     => $userId,
            ':titre'       => $data['titre'],
            ':description' => $data['description'],
            ':categorie'   => $data['categorie'],
            ':date_limite' => $data['date_limite'],
            ':image_path'  => $data['image_path'] ?? null,
        ]);
    }

    public static function update(int $id, array $data, int $userId): bool {
        $pdo = Database::getInstance();

        $sql = "UPDATE challenges 
                SET titre       = :titre,
                    description = :description,
                    categorie   = :categorie,
                    date_limite = :date_limite,
                    image_path  = :image_path
                WHERE id = :id AND user_id = :user_id";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':id'          => $id,
            ':user_id'     => $userId,
            ':titre'       => $data['titre'],
            ':description' => $data['description'],
            ':categorie'   => $data['categorie'],
            ':date_limite' => $data['date_limite'],
            ':image_path'  => $data['image_path'] ?? null,
        ]);
    }

    public static function delete(int $id, int $userId): bool {
        $pdo = Database::getInstance();

        $sql = "DELETE FROM challenges WHERE id = :id AND user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':id'      => $id,
            ':user_id' => $userId
        ]);
    }

    public static function findById(int $id): ?Challenge {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM challenges WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        if (!$row) return null;

        $c = new self();
        $c->id          = (int)$row['id'];
        $c->user_id     = (int)$row['user_id'];
        $c->titre       = $row['titre'];
        $c->description = $row['description'];
        $c->categorie   = $row['categorie'];
        $c->date_limite = $row['date_limite'];
        $c->image_path  = $row['image_path'];
        $c->created_at  = $row['created_at'];

        return $c;
    }

    public static function findAll(): array {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM challenges ORDER BY created_at DESC");
        $results = [];

        foreach ($stmt->fetchAll() as $row) {
            $c = new self();
            $c->id          = (int)$row['id'];
            $c->user_id     = (int)$row['user_id'];
            $c->titre       = $row['titre'];
            $c->description = $row['description'];
            $c->categorie   = $row['categorie'];
            $c->date_limite = $row['date_limite'];
            $c->image_path  = $row['image_path'];
            $c->created_at  = $row['created_at'];
            $results[] = $c;
        }
        return $results;
    }
}