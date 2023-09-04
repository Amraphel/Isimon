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
    <link rel="stylesheet" href="../view/design/style_log.css">
    <link rel="icon" href="../images/pokeball.ico" >    
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
            <div class="bouton "> <div></div></div>
    </div>
    </header>
    <div class="center">
        <div class="centerF">
            <div class="Cg"></div>
            <div class="Cc">
            <form action="pokedex.ctrl.php" method="post">
            <h2>Se connecter</h2>
            <label for="log">Nom d'utilisateur</label>
            <input type="text" name="login" id="log">
            
            <button type="submit"> Valider</button>
        </form>

        <form action="pokedex.ctrl.php" method="post">
            <h2>Inscrivez vous</h2>
            <label for="sig">Nom d'utilisateur</label>
            <input type="text" name="signin" id="sig">
            <label for="log">Nom </label>
            <input type="text" name="nom" id="log">
            <label for="log">Prénom</label>
            <input type="text" name="prenom" id="log">
            <button type="submit"> Valider</button>
        </form>

            </div>
            <div class="Cd"></div>
        </div>

    </div>


        
    <div class="end">
    <div></div>
    </div>

</body>

</html>