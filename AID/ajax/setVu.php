<?php

    include '../php/database.php';
    include '../php/variables.php';

    $idUserMe = $_GET['me'];
    $idUserReceived = $_GET['recieved'];

    $c = $db->prepare("UPDATE `chat` SET `vu`= 1 WHERE id_user_send = :received and id_user_received = :send");

    $c->execute([
        'received' => $idUserReceived,
        'send' => $idUserMe,
    ]);