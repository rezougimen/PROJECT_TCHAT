<?php

session_start();
require ('common.php');

$param = "list";

if(array_key_exists("param", $_GET)){
    $param = $_GET['param'];
}

if($param == "write"){
    postMessage();
} else {
    getMessages();
}

function getMessages() {
    $db = db_connect();
    $resultats = $db->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 20");
    $messages = $resultats->fetchAll();
    echo json_encode($messages);
}

function postMessage() {
    $db = db_connect();
    if(!array_key_exists('message', $_POST)){
        echo json_encode(["status" => "error", "message" => "One field or many have not been sent"]);
        return;
    }
    $query = $db->prepare('INSERT INTO messages SET username = :username, message = :message, created_at = NOW()');
    $query->execute(array(
        'username' => $_SESSION['username'],
        'message' => $_POST['message'],
    ));
    echo json_encode(["status" => "success"]);
}
