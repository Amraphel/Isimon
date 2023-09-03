
<?php
class capture {
    private String $idPoke;
    private String $pseudoUser;



    function dbConnect(){
        try {
        $dbh = new PDO('sqlite:'.dirname(__FILE__).'/../isimon.db');
        if (!$dbh) { die ("Database error"); }
        } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage()."$this->database\n");
        }
        return $dbh;
    }


function pokeCapt($login,$idPoke){
        $dbh=$this->dbConnect();
        $req=$dbh->prepare("SELECT * FROM capture WHERE pseudoUser='$login' AND idPoke='$idPoke'");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_CLASS, "utilisateur");
        if(!empty($result))
        {
            return 1;
        } else {
            return 0;
        }
    }

    function capt($login,$idPoke){
        $dbh=$this->dbConnect();
        $reqinserf = $dbh->prepare('INSERT INTO capture VALUES(:idPoke,:login)');
            $reqinserf->execute(array(
                'idPoke' => $idPoke,
                'login' => $login
            ));

        $req = $dbh->prepare("UPDATE user SET nbCapture = nbCapture + 1 WHERE login='$login'");
            $req->execute();}

    }
     ?>