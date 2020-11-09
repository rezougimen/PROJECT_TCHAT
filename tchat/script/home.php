<?php
session_start();
require ('common.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet"  media="screen"  type="text/css"  href="../style.css" />
        <title>Créer un compte</title>
        <script src="../message.js"></script>
    </head>
    <body>

        <div>
            <h1 class="title"> 
                <p>Bienvenue  <?php echo $_SESSION['username'] ?> !</p> 
                <form action="logout.php">
                <button type="submit" class="logoutbtn">Déconnexion</button>
                </form> 
            </h1>
        </div>
        
        
        <div class="container">
            <hr>
                <div class="messages">
                </div>
            <hr>
        </div>
        <div class="container">
            <div class="send-box">
                <textarea class="text_area" name="message" id="message"> </textarea>
                <button type="submit" class="sendbtn" onclick="postMessage()" >Envoyer</button>
            </div>
        </div>
    </body>
</html>
