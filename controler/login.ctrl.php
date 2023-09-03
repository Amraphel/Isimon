<?php
require_once('../framework/view.class.php');
require_once('../model/utilisateur.class.php');

//vérification de l'existence de la session
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

//vérification de l'existence de l'utilisateur
    if(isset($_SESSION['utilisateur'])){
        $utilisateur=$_SESSION['utilisateur'];
    } else{
        $utilisateur= new utilisateur;
        $_SESSION['utilisateur']=$utilisateur;
    }

    $errorlog="";
    $errorsign="";

//vérification lors de l'autentification
    if(isset($_POST['login'])){
        $user=$_POST['login'];
        if($utilisateur->checkLogin($user)){
            $_SESSION['login']=$user;
            $errorlog="";
        } else {
            $errorlog="Nom d'utilisateur inconnu";
        }
    }

//vérification lors de l'inscription
    if(isset($_POST['signin'])){
        $user=$_POST['signin'];
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        if($utilisateur->creerLogin($user,$nom,$prenom)){
            $_SESSION['login']=$user;
            $errorsign="";
        } else {
            $errorsign="Il existe déjà un compte avec ce login";
        }
    }

    if(!isset($_SESSION['login'])){
        $isSession=0;
     }else{
        $isSession=1;
     }


    //fermeture de l'écriture de la session
    session_write_close();

    $view=new view;
    $winfoString="";

    $view->assign('winfoString',$winfoString);
    //vérifie l'existence de la session
    if(!$isSession){
        $view->assign('errorsign',$errorsign);
        $view->assign('errorlog',$errorlog);
        $view->display("login.view.php");
     }else{
        $view->display("connexion.view.php");
     }
    
 ?>