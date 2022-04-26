<?php

    include '../php/database.php';
    include '../php/variables.php';

    $idUser = $_GET['id'];

    $c = $db->prepare("SELECT AVG(note) as note FROM `notes` WHERE id_user_noted = :idUserNoted");

    $c->execute([
        'idUserNoted' => $idUser,
    ]);
    
    $result = $c -> rowCount();

    $noteGlobale['value'] = 0;
    $noteGlobale['nbr'] = 0;
    
    if($result != 0)
    {
    
        while($notes = $c -> fetch())
        {

            $noteGlobale['value'] = $notes['note'];

        }

    }else{

        $noteGlobale['value'] = 0;

    }

    $c = $db->prepare("SELECT COUNT(note) as note FROM `notes` WHERE id_user_noted = :idUserNoted");

    $c->execute([
        'idUserNoted' => $idUser,
    ]);
    
    $result = $c -> rowCount();

    if($result != 0)
    {
    
        while($notes = $c -> fetch())
        {

            $noteGlobale['nbr'] = $notes['note'];

        }

    }else{

        $noteGlobale['nbr'] = 0;

    }

    echo json_encode($noteGlobale);

    ?>