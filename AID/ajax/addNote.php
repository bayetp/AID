<?php    

    include '../php/database.php';
    include '../php/variables.php';

    $idUserMe = $_GET['me'];
    $idUserReceived = $_GET['recieved'];

    $note = $_GET['note'];

    $c = $db->prepare("SELECT * FROM `notes` WHERE id_user_note = :send and id_user_noted = :received");

    $c->execute([
        'received' => $idUserReceived,
        'send' => $idUserMe,
    ]);
    
    $result = $c -> rowCount();
    
    if($result == 0)
    {

        $c = $db->prepare("INSERT INTO `notes`(`id_user_note`, `id_user_noted`, `note`) VALUES (:send, :received, :note)");

        $c->execute([
            'received' => $idUserReceived,
            'send' => $idUserMe,
            'note' => $note,
        ]);

    }else{

        $c = $db->prepare("UPDATE `notes` SET `note`= :note WHERE id_user_note = :send and id_user_noted = :received");

        $c->execute([
            'received' => $idUserReceived,
            'send' => $idUserMe,
            'note' => $note,
        ]);

    }

?>