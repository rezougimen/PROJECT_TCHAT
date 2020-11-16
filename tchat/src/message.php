<?php
// ouverture de session
session_start();
require ('common.php');

// initialisation de la variable $param
$param = "list";

// on verifi si la cle param et dans le tableu $_GET
if(array_key_exists("param", $_GET)){
    $param = $_GET['param'];
}

// si on fait appel a postMessage() avec le paramtre passé dan l'url sinon on appel getMessage()
if($param == "write"){
    postMessage();
} else {
    getMessages();
}

// return les derniers 20 messages trié par date de creation en DESC 
function getMessages() {
    $db = db_connect();
    $resultats = $db->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 20");
    $messages = $resultats->fetchAll();
    echo json_encode($messages);
}

// enregistrer le message envoyé en base de données 
function postMessage() {
    $db = db_connect();
    // si le message est vide on renvoie une erreure
    if( strlen($_POST['message']) === 0 ){
        echo json_encode(["status" => "error", "message" => "One field or many have not been sent"]);
        return;
    }
    // sinon on enregistre le message dans la base de donnée
    $query = $db->prepare('INSERT INTO messages SET username = :username, message = :message, created_at = NOW()');
    $query->execute(array(
        // l'utilisateur connecté
        'username' => $_SESSION['username'],
        'message' => $_POST['message'],
    ));
    echo json_encode(["status" => "success"]);
}
