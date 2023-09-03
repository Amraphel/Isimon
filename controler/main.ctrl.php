<?php
require_once('../framework/view.class.php');

// Vérification que la session soit bien lancée
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

$view = new View();

// Vérification que l'utilisateur est bien connecté
if(isset($_SESSION['login'])){
    $user=$_SESSION['login'];
} else{
    $loginerror='main.ctrl.php : utilisateur non connecté';
}

//Si l'utililisateur n'est pas connecté, il est ramené à la page de connexion
if(isset($loginerror)){
    $view->display("login.view.php");
}

if (isset($_GET['secret'])){
    $view->display("secret.view.php");
}

// Si l'utilisateur souhaite se déconnecter, le renvoie à la page de connexion
if (isset($_GET['logout'])){
    session_destroy();
    $view->display("login.view.php");
}


// Envoie sur la page principale si aucune des autres pages n'est solicitée
$view->display("main.view.php");
