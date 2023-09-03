<?php

class pokemon{
    private string $id;
    private String $nom;
    private String $image;
    private String $type;
    private String $description;
    private int $numero;
    
 
    function dbConnect(){
        try {
        $dbh = new PDO('sqlite:'.dirname(__FILE__).'/../isimon.db');
        if (!$dbh) { die ("Database error"); }
        } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage()."$this->database\n");
        }
        return $dbh;
    }


function recherchePoke($id){
        $dbh=$this->dbConnect();
        $req=$dbh->prepare("SELECT * FROM pokemon WHERE id='$id'");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_CLASS, "pokemon");
        return $result;
}

function recherchePokeByName($name){
    $dbh=$this->dbConnect();
    $req=$dbh->prepare("SELECT * FROM pokemon WHERE nom='$name'");
    $req->execute();
    $result = $req->fetchAll(PDO::FETCH_CLASS, "pokemon");
    return $result;
}

function getAllPoke(){
    $dbh=$this->dbConnect();
    $req=$dbh->prepare("SELECT * FROM pokemon ORDER BY numero");
    $req->execute();
    $result = $req->fetchAll(PDO::FETCH_CLASS, "pokemon");
    return $result;
}

    //retourne un objet de type nouvelle
function getPokemon(){
    return $this;
}

    //retourne l'id de la nouvelle
function getID(){
    return $this->id;
}
    //retourne le nom de la nouvelle
function getNom(){
    return $this->nom;
}


    //retourne le lien vers l'image associé à la nouvelle 
function getImage(){
    return $this->image;
}

function getType(){
    return $this->type;
}

function getNum(){
    return $this->numero;
}

function getDesc(){
    return $this->description;
}


}

?>