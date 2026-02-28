<?php
require_once __DIR__ . '/../models/User.php';

class UserController {

    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {

        if($_SERVER['REQUEST_METHOD']==='POST') {

            if($_POST['csrf_token']!==$_SESSION['csrf_token']) die("CSRF Error");

            $data = [
                'nom'=>trim($_POST['nom']),
                'prenom'=>trim($_POST['prenom']),
                'email'=>trim($_POST['email']),
                'sexe'=>$_POST['sexe'],
                'date_naissance'=>$_POST['date_naissance'],
                'adresse'=>trim($_POST['adresse']),
                'password'=>$_POST['password']
            ];

            if($data['password']!==$_POST['confirm_password']) {
                $errors[]="Les mots de passe ne correspondent pas";
                require __DIR__ . '/../views/users/register.php';
                return;
            }

            if($this->userModel->findByEmail($data['email'])) {
                $errors[]="Email déjà utilisé";
                require __DIR__ . '/../views/users/register.php';
                return;
            }

            $this->userModel->create($data);
            header("Location: index.php?url=login");
            exit;
        }
    }

    public function login() {

        if($_SERVER['REQUEST_METHOD']==='POST') {

            if($_POST['csrf_token']!==$_SESSION['csrf_token']) die("CSRF Error");

            $user = $this->userModel->findForLogin(
                trim($_POST['nom']),
                trim($_POST['prenom']),
                trim($_POST['email'])
            );

            if($user && password_verify($_POST['password'],$user['password'])) {

                session_regenerate_id(true);

                $_SESSION['id_user']=$user['id'];

                if(!headers_sent()) {
                    header("Location: index.php?url=profile");
                    exit;
                } else {
                    // Fallback: use JavaScript and meta refresh if headers already sent
                    echo '<script>window.location.href="index.php?url=profile";</script>';
                    echo '<noscript><meta http-equiv="refresh" content="0;url=index.php?url=profile"></noscript>';
                    exit;
                }
            }

            $errors[]="Informations incorrectes";
            require __DIR__ . '/../views/users/login.php';
        }
    }

    public function profile() {

        if(!isset($_SESSION['id_user'])) {
            header("Location: index.php?url=login");
            exit;
        }

        $user=$this->userModel->findById($_SESSION['id_user']);
        require __DIR__ . '/../views/users/profile.php';
    }

    public function edit() {

        if(!isset($_SESSION['id_user'])) {
            header("Location: index.php?url=login");
            exit;
        }

        $user=$this->userModel->findById($_SESSION['id_user']);
        require __DIR__ . '/../views/users/edit.php';
    }

    public function update() {

        if($_POST['csrf_token']!==$_SESSION['csrf_token']) die("CSRF Error");

        $this->userModel->update($_SESSION['id_user'],[
            'nom'=>trim($_POST['nom']),
            'prenom'=>trim($_POST['prenom']),
            'email'=>trim($_POST['email']),
            'sexe'=>$_POST['sexe'],
            'date_naissance'=>$_POST['date_naissance'],
            'adresse'=>trim($_POST['adresse'])
        ]);

        header("Location: index.php?url=profile");
    }

    public function delete() {
        $this->userModel->delete($_SESSION['id_user']);
        session_destroy();
        header("Location: index.php?url=register");
    }
}