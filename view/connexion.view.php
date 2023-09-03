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
    <link rel="stylesheet" href="../view/design/style_transit.css">
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
                <h1>Vous êtes bien connecté(e)</h1>
                <div class="loadingio-spinner-spinner-ld7rr8sipu">
        <div class="ldio-e48hdzncs4o">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
            </div>
            <div class="Cd"></div>
        </div>

    </div>

    <script>
        setTimeout(function() {
            window.location.href = 'main.ctrl.php';
        }, 500);
    </script>
        
    <div class="end">
    <div></div>
    </div>

</body>

</html>