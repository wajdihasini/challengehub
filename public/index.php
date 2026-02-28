<?php
session_start();

// Activer le buffering des sorties pour permettre les redirections header() même
// si du contenu a été envoyé accidentellement avant l'appel à header().
ob_start();

if(empty($_SESSION['csrf_token']))
    $_SESSION['csrf_token']=bin2hex(random_bytes(32));

require_once '../app/controllers/UserController.php';
$controller=new UserController();

$url=$_GET['url']??'register';

switch($url){

case 'register': require '../app/views/users/register.php'; break;
case 'registerAction': $controller->register(); break;
case 'login': require '../app/views/users/login.php'; break;
case 'loginAction': $controller->login(); break;
case 'profile': $controller->profile(); break;
case 'edit': $controller->edit(); break;
case 'update': $controller->update(); break;
case 'delete': $controller->delete(); break;
default: echo "404";
}