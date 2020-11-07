<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet"  media="screen"  type="text/css"  href="style.css" />
    <title>Connection</title>
    </head>
    <body>
        <h1 class="title"> <p>Bienvenue dans le super TCHAT !</p> </h1>
        <form action="/action_page.php">
            <div class="container">
                <h1>Connection</h1>
                <p>Remplissez ces champs pour vous connecter.</p>
                <hr>

                <label class="label" for="name"><b>Pseudo</b></label>
                <input class="input" type="text" placeholder="Enter votre Pseudo" name="name" id="name" required>

                <label class="label" for="psw"><b>Mot de passe</b></label>
                <input class="input" type="password" placeholder="Enter le mot de passe" name="psw" id="psw" required>
                
                <hr>
                
                <button type="submit" class="registerbtn">Se connecer</button>
            </div>
            
            <div class="container signin">
                <p>Vous n'avez pas de compte ? <a href="./register.php">Créez votre compte</a>.</p>
            </div>
        </form>
    </body>
</html>
