<?php

require_once __DIR__ . "/../models/Submission.php";
require_once __DIR__ . "/../models/Comment.php";

class SubmissionController {

    private $submissionModel;
    private $commentModel;

    public function __construct() {
        $this->submissionModel = new Submission();
        $this->commentModel = new Comment();
    }

    // 🔹 Liste submissions
    public function index() {

        $submissions = $this->submissionModel->getAll();
    
        require_once __DIR__ . "/../views/Submissions/Index.php";
    }

    // 🔹 Form create
    public function create() {

        require_once __DIR__ . "/../views/Submissions/Create.php";
    }

    // 🔹 Store submission
    public function store() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST['description']) && isset($_POST['image'])) {

                $id_ch = 1;
                $id_user = 1;

                $description = $_POST['description'];
                $image = $_POST['image'];

                $this->submissionModel->create(
                    $id_ch,
                    $id_user,
                    $description,
                    $image
                );
            }

            header("Location: index.php?action=index");
            exit();
        }
    }

    // 🔹 Show submission
    public function show() {

        if (isset($_GET['id'])) {
    
            $id_sub = $_GET['id'];
    
            $submission = $this->submissionModel->getById($id_sub);
            $comments = $this->commentModel->getBySubmission($id_sub);
    
            require_once __DIR__ . "/../views/Submissions/Show.php";
        }
    }

    // 🔹 Ajouter commentaire
    public function addComment() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST['submission_id']) && isset($_POST['content'])) {

                $id_sub = $_POST['submission_id'];
                $id_user = 1;
                $content = $_POST['content'];

                $this->commentModel->create(
                    $id_sub,
                    $id_user,
                    $content
                );
            }

            header("Location: index.php?action=show&id=" . $id_sub);
            exit();
        }
    }

    // 🔹 Supprimer submission
    public function deleteSubmission() {

        if (isset($_GET['id'])) {

            $this->submissionModel->delete($_GET['id']);

            header("Location: index.php?action=index");
            exit();
        }
    }

    // 🔹 Supprimer commentaire
    public function deleteComment() {

        if (isset($_GET['id']) && isset($_GET['sub'])) {

            $this->commentModel->delete($_GET['id']);

            header("Location: index.php?action=show&id=" . $_GET['sub']);
            exit();
        }
    }
}