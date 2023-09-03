<!-- session_start toujours avant le html a mettre sur toutes les pages ! -->
<?php
if (!isset($_SESSION)) {
    session_start();
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/design/style_pokedx.css">
    <link rel="icon" href="/view/images/moonFeederIcon.ico" >    
    <title>Isimon</title>
</head>

<body>
    <header>
        <div class="menu">
            <div class="rondB">
                <div></div>
            </div>
            <div class="barre">
                <div class="rondR">
                </div>
                <div class="rondJ">
                </div>
                <div class="rondV">
                </div>
            </div>
            <div class="sep"><div></div></div>
            <div class="bouton "> <div>
            <a href="../controler/main.ctrl.php" class="myButton">menu</a>
            </div></div>
    </div>
    </header>
    <div class="center">
        <div class="centerF">
            <div class="Cg"></div>
            <div class="Cc">
                <?php
                    foreach($listPoke as $poke){
                        $image = $poke->getImage();
                        $image= '../images/'.$image;
                        $nom= $poke->getNom();
                        if($capture->pokeCapt($user, $poke->getID())){
                            echo '<a href="poke.ctrl.php?name='.$nom.'"><img src="'.$image.'" alt="'.$image.'" class="norm"></a>';
                        } else{
                            echo '<img src="'.$image.'" alt="'.$image.'" class="dark">';
                        }
                            
                        
                    }
                 ?>
            </div>
            <div class="Cd"></div>
        </div>

    </div>


        
    <div class="end">
    <div></div>
    </div>

</body>

</html>