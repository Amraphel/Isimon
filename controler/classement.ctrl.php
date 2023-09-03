<?php
require_once('../framework/view.class.php');
require_once('../model/utilisateur.class.php');
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

$uti = new utilisateur;
$classement = $uti->getClassement();

$uti=$uti->getUser($user);


// Envoie sur la page principale si aucune des autres pages n'est solicitée
$view->assign('classement', $classement);
$view->assign('utilisateur', $uti);
$view->display("classement.view.php");
