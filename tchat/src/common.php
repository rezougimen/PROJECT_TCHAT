<?php

function db_connect() {
    $host = "172.28.100.114";
    $dbase = "tchat";
    $user = "imen_r";
    $psw = "1306";
    $charset = "utf8";
    $dns = "mysql:host=$host;dbname=$dbase;charset=$charset";
    try {
        $dbase = new PDO($dns, $user, $psw);
        $dbase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'échec lors de la connexion : ' . $e->getMessage();
    }
    return $dbase;
}

function check_psw() {
    $password = htmlspecialchars($_POST['password']);
    $password_confirm = htmlspecialchars($_POST['password-repeat']);
    if ($password == $password_confirm) {
        $response = true;
    } else {
        $response = false;
    }
    return $response;
}

function crypt_psw ($password) {
    $psw_sha1 = sha1($password);
    $psw = md5($psw_sha1);
    return $psw;
}

function check_mail() {
    $dbase = db_connect();
    $mail = htmlspecialchars($_POST['email']);
    $query = $dbase->prepare('SELECT * FROM users WHERE email = :email');
    $query->execute(array('email' => $mail, ));
    $count = $query->rowCount();
    if ($count == 0) {
        $response = true;
    } else {
        $response = false;
    }
    return $response;
}

function register() {
    $check_mail = check_mail();
    if ($check_mail == true) {
        $check_psw = check_psw();
        if ($check_psw == true) {
            $dbase = db_connect();
            $query = $dbase->prepare("SELECT * FROM users WHERE username = :login");
            $query->execute(array('login' => htmlspecialchars($_POST['username'])));
            $count = $query->rowCount();
            
            if ($count == 0) {
                $insert = $dbase->prepare('INSERT INTO users (username, password, email) VALUES(:username, :password, :email)');
                $insert->execute(array(
                    'username' => htmlspecialchars($_POST['username']),
                    'password' => crypt_psw(htmlspecialchars($_POST['password'])),
                    'email' => htmlspecialchars($_POST['email']),
                ));
                $_SESSION['username'] = htmlspecialchars($_POST['username']);
                header('Location: ./home.php');
            }
            else {
                echo 'Ce pseudo existe déja  !';

                ?>
                <script language="javascript">
                    alert("Ce pseudo existe déja  !");
                    window.location.replace('../register.html');
                </script>
                <?php
            }
                
        } else {
            ?>
            <script language="javascript">
                alert("Mot de passe et mot de passe de confirmation différents !");
                window.location.replace('../register.html');
            </script>
            <?php
        }
        
    } else {
        ?>
        <script language="javascript">
            alert("Adresse mail déja utilisée !");
            window.location.replace('../register.html');
        </script>
        <?php
    }
                     
}

function login() {

    $dbase = db_connect();
    $pass_word = crypt_psw($_POST['password']);
    $user_name = htmlspecialchars($_POST['username']);
    $response_psw = $dbase->query('SELECT password FROM users WHERE username = ' . $dbase->quote($_POST['username']));
    $psw = $response_psw->fetchColumn();
    if (isset($_POST['password']) && $pass_word == $psw) {
        $_SESSION['username'] = htmlspecialchars($_POST['username']);
        header('Location: ./home.php');
    } else { 
        ?>
        <script language="javascript">
            alert("Mot de passe incorrect !");
            window.location.replace('../login.html');
        </script>
        <?php
    }
}

?>     
