<?php

require_once("util.php");

$dsn = 'sqlite:newsDB.db'; // Data source name

try {
    $dbh = new PDO($dsn);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}


$urls = array(
    "https://www.lemonde.fr/rss/une.xml",
    "https://www.lemonde.fr/sciences/rss_full.xml",
    "https://www.lemonde.fr/sport/rss_full.xml",
    "https://investir.lesechos.fr/RSS/matieres-premieres.xml",
    "https://www.lemonde.fr/campus/rss_full.xml",
    "https://www.francetvinfo.fr/sports.rss",
    "https://www.telerama.fr/rss/television.xml",
    "https://www.lefigaro.fr/rss/figaro_politique.xml",
    "https://www.courrierinternational.com/feed/category/6681/rss.xml",
    "http://rss.allocine.fr/ac/actualites/cine?format=xml",
    "https://www.usine-digitale.fr/informatique/rss",
    "http://radiofrance-podcast.net/podcast09/rss_10212.xml"
);

//boucle sur les urls pour les recupérer chacunes indépendaments
for ($i = 0; $i < 12; $i++) {
    $url = $urls[$i];

    //récupération de la totalité du flux
    $xml = simplexml_load_file($url);

    $req1 = "Select * from flux where url=$url";
    if (!$dbh->query($req1)) {
        //insertion de la nouvelle url dans la table des flux 
        $reqinserf = $dbh->prepare('INSERT INTO flux(flux) VALUES(:url)');
        $reqinserf->execute(array(
            'url' => $url
        ));
    }
    // on récupère les nouvelles du flux
    $nouvelles = $xml->xpath("//item");
    foreach ($nouvelles as $nouvelle) {
        $titre = $nouvelle->title;
        $desc = $nouvelle->description;
         $titreq = $dbh->quote($titre);
         $descq = $dbh->quote($desc);

        //On vérifie que la nouvelle n'existe pas déjà dans la base
        $req2 = "Select count(*) from nouvelles where titre=$titreq and description=$descq";

        //On récupère le nombre de nouvelles présentes dans la base
        $resultat=$dbh->query($req2);

        //je sais pas trop comment ça marche mais visiblement ça passe
        if ($resultat->columnCount()) {
            $req3 = "Select Count(*) from nouvelles";
            //On créer un nouvel id pour la nouvelle à rajouter
            $resid = $dbh->query($req3);
            $id = $resid->fetch(PDO::FETCH_ASSOC) ;
            $id = $id['Count(*)'] +1 ;
            //On récupère les informations de la nouvelle
            $date = strtotime($nouvelle->pubDate);
            $link = $nouvelle->link;

            //insertion de la nouvelle a rajouté dans la table nouvelles
            $reqinsernouv = $dbh->prepare('INSERT INTO nouvelles(date,titre,description,lien,flux) 
                                        VALUES(:date,:titre,:description,:lien,:flux)');
            $reqinsernouv->execute(array(
                'date' => $date,
                'titre' => $titre,
                'description' => $desc,
                'lien' => $link,
                'flux'=> $url
            ));

            $url_image = getURLImage($nouvelle);
            if ($url_image != "") {
                $img = 'images/image' . $id . '.' . extensionImage($url_image);
                file_put_contents($img, file_get_contents($url_image));

                $requpnouv = $dbh->prepare('UPDATE nouvelles SET image = :image WHERE id=:id');
                $requpnouv->execute(array(
                    'image' => $img,
                    'id' => $id
                ));
            }
        }
    }
}
