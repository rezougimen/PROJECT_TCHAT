<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet"  media="screen"  type="text/css"  href="style.css" />
    <title>Créer un compte</title>
    </head>
    <body>
        <h1 class="title"> <p>Bienvenue dans le super TCHAT !</p> </h1>
        <form action="/action_page.php">
            <div class="container">
                <h1>Créer un compte</h1>
                <p>Remplissez ces champs pour créer un compte.</p>
                <hr>

                <label class="label" for="name"><b>Pseudo</b></label>
                <input class="input" type="text" placeholder="Enter votre Pseudo" name="name" id="name" required>

                <label class="label" for="email"><b>Email</b></label>
                <input class="input" type="text" placeholder="Enter votre email" name="email" id="email" required>

                <label class="label" for="psw"><b>Mot de passe</b></label>
                <input class="input" type="password" placeholder="Enter le mot de passe" name="psw" id="psw" required>

                <label class="label" for="psw-repeat"><b>Confirmation du mot de passe</b></label>
                <input class="input" type="password" placeholder="Confirmer votre mot de passe" name="psw-repeat" id="psw-repeat" required>
                <hr>
                
                <button type="submit" class="registerbtn">Valider</button>
            </div>
            
            <div class="container signin">
                <p>Vous avez déja un compte ? <a href="./login.php">Se connecter</a>.</p>
            </div>
        </form>
    </body>
</html>
