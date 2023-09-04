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

if(isset($_POST['signin'])){
    $user=$_POST['signin'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    if($user!='' && $utilisateur->creerLogin($user,$nom,$prenom)){
        $_SESSION['login']=$user;
        $errorsign="";
    } else {
        $errorsign="Il existe déjà un compte avec ce login";
    }
}
//Si l'utililisateur n'est pas connecté, il est ramené à la page de connexion
if(isset($loginerror)){
    $view->display("login.pokedex.view.php");
}


if(isset($_SESSION['login'])){
    $user=$_SESSION['login'];
} else{
    $loginerror='main.ctrl.php : utilisateur non connecté';
}

$pokemon = new pokemon;
$listPoke = $pokemon->getAllPoke($user);
$capture = new capture;

// Envoie sur la page principale si aucune des autres pages n'est solicitée
$view->assign('capture', $capture);
$view->assign('listPoke', $listPoke);
$view->assign('user', $user);
$view->display("pokedex.view.php");
