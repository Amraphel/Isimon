<?php
class utilisateur {
    private String $login;
    private String $nom;
    private String $prenom;
    private int $nbCapture;
    private bool $ban;

    function dbConnect(){
        try {
        $dbh = new PDO('sqlite:'.dirname(__FILE__).'/../isimon.db');
        if (!$dbh) { die ("Database error"); }
        } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage()."$this->database\n");
        }
        return $dbh;
    }

    function getPseudo(){
        return $this->login;
    }


    function checkLogin($login){
        $dbh=$this->dbConnect();
        $req=$dbh->prepare("SELECT * FROM user WHERE login='$login'");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_CLASS, "utilisateur");
        if(empty($result)){
            return 0;
        } else {
            return 1;
        }
    }

    function getClassement(){
        $dbh=$this->dbConnect();
        $req=$dbh->prepare("SELECT * FROM user WHERE ban=0 ORDER BY nbCapture DESC LIMIT 5");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_CLASS, "utilisateur");
        return $result;
    }

    function creerLogin($login,$nom, $prenom){
        $dbh=$this->dbConnect();
        $req=$dbh->prepare("SELECT * FROM user WHERE login='$login'");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_CLASS, "utilisateur");
        if(!empty($result))
        {
            return 0;
        } else {
            $reqinserf = $dbh->prepare('INSERT INTO user VALUES(:login,:nom,:prenom,0,false)');
            $reqinserf->execute(array(
                'login' => $login,
                'nom' => $nom,
                'prenom' => $prenom
            ));
            return 1;
        }
    }

    function banUser($login){
        $dbh=$this->dbConnect();
        $req=$dbh->prepare("UPDATE user SET ban=1 WHERE login='$login'");
        $req->execute();
    }



    function getUser($login){
        $dbh=$this->dbConnect();
        $req=$dbh->prepare("SELECT * FROM user WHERE login='$login'");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_CLASS, "utilisateur");
        return $result;
    }



    function getNBCap(){
        return $this->nbCapture;
    }

}

?>