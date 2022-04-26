<?php

    include '../php/database.php';
    include '../php/variables.php';

    $id = $_GET['id'];

    $c = $db->prepare("DELETE FROM `chat` WHERE id = :id");

    $c->execute([
        'id' => $id,
    ]);