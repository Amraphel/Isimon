<?php
require_once('../framework/view.class.php');
require_once('../model/utilisateur.class.php');
require_once('../model/pokemon.class.php');
require_once('../model/capture.class.php');

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

    $info='';
    $image='';
    $nom ='';
    $desc = '';
    $type='';
    if(isset($_GET['poke'])){
        $poke=$_GET['poke'];
        $pokemon= new pokemon;
        $pokemon = $pokemon->recherchePoke($poke);
        if(empty($pokemon)){
        } else{
            $nom =  $pokemon[0]->getNom();
            $num =  $pokemon[0]->getNum();
            $desc=  $pokemon[0]->getDesc();
            $type=  $pokemon[0]->getType();
            $image = $pokemon[0]->getImage();
            $image= '../images/'.$image;
            $info = 'nom='.$nom.'&num='.$num.'&desc='.$desc.'&type='.$type.'&image='.$image;
        }

        if($poke=='rBP3w8D8Dnq6iH9sW2QMxeJhh9nFAa29657LWEzfExQGpdq88c3Ut9EJ6734DY55Q47PH4Qkyuv99agL83smNsV88zD3u4PLb9B6zQg4gsD'){
            if(isset($_SESSION['login'])){
                $login=$_SESSION['login'];
                $userBan = new utilisateur;
                $userBan->banUser($login);
            }
        }

    }
    $errorlog="";
    $errorsign="";



    if(!isset($_SESSION['login'])){
        $isSession=0;
     }else{
        $isSession=1;
     }

    if($isSession ){
        if(!empty($pokemon)){
            $login=$_SESSION['login'];
            $capture = new capture;
            if(!$capture->pokeCapt($login,$pokemon[0]->getID())){
                $capture->capt($login,$pokemon[0]->getID());
            }
        }
    }

    if($isSession){
        if(isset($_GET['name'])){
            $pokeName=$_GET['name'];
            $pokemon= new pokemon;
            $pokemon = $pokemon->recherchePokeByName($pokeName);
            if(empty($pokemon)){
            } else{
                $nom =  $pokemon[0]->getNom();
                $num =  $pokemon[0]->getNum();
                $desc=  $pokemon[0]->getDesc();
                $type=  $pokemon[0]->getType();
                $image = $pokemon[0]->getImage();
                $image= '../images/'.$image;
                $info = 'nom='.$nom.'&num='.$num.'&desc='.$desc.'&type='.$type.'&image='.$image;
            }
        }
    }

    //fermeture de l'écriture de la session
    session_write_close();

    $view=new view;

    $view->assign('info',$info);
    //vérifie l'existence de la session
    if(!$isSession){
        $view->assign('errorsign',$errorsign);
        $view->assign('errorlog',$errorlog);
        $view->display("login.view.php");
     }else{
        if(empty($pokemon)){
            $view->display('404.view.php');
        }else{
            $view->assign('image', $image);
            $view->assign('nom', $nom);
            $view->assign('type', $type);
            $view->assign('desc', $desc);
            $view->display('pokemon.view.php');
        }

     }
    
 ?>