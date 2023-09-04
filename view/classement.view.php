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
    <link rel="stylesheet" href="../view/design/style_classeme.css">
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
                <div class="user">
                <h3>Classement</h3> <h3>Pseudo</h3> <h3>Nombre de Capture</h3>
                </div>
                
                <?php
                    $class=1;
                    foreach($classement as $uti){
                        $pseudo = $uti->getPseudo();
                        $nbCapt = $uti->getNBCap();
                        echo '<div class="user">';
                            echo '<h3>'.$class.'</h3><h3>'.$pseudo.'</h3><h3>'.$nbCapt.'</h3>';
                        echo '</div>';
                        $class=$class+1;
                    }
                    ?>

                    <h3>Mon classement</h3>
                    <div class="user">
                <h3></h3> <h3><?=$utilisateur[0]->getPseudo() ?></h3> <h3><?=$utilisateur[0]->getNBCap() ?></h3>
                </div>
                
            </div>
            <div class="Cd"></div>
        </div>

    </div>


        
    <div class="end">
    <div></div>
    </div>

</body>

</html>