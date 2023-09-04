<?php
require_once('../framework/view.class.php');
require_once('../model/utilisateur.class.php');
require_once('../model/pokemon.class.php');
require_once('../model/capture.class.php');
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
//vérification de l'existence de l'utilisateur
if(isset($_SESSION['utilisateur'])){
    $utilisateur=$_SESSION['utilisateur'];
} else{
    $utilisateur= new utilisateur;
    $_SESSION['utilisateur']=$utilisateur;
}


//vérification lors de l'autentification
if(isset($_POST['login'])){
    $user=$_POST['login'];
    if($user!='' && $utilisateur->checkLogin($user)){
        $_SESSION['login']=$user;
        $errorlog="";
    } else {
        $errorlog="Nom d'utilisateur inconnu";
    }
}
//Si l'utililisateur n'est pas connecté, il est ramené à la page de connexion
if(isset($loginerror)){
    $view->display("login.pokedex.view.php");
}


$pokemon = new pokemon;
$listPoke = $pokemon->getAllPoke($user);
$capture = new capture;

// Envoie sur la page principale si aucune des autres pages n'est solicitée
$view->assign('capture', $capture);
$view->assign('listPoke', $listPoke);
$view->assign('user', $user);
$view->display("pokedex.view.php");
