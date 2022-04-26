<?php    

    include '../php/database.php';
    include '../php/variables.php';

    $idUserMe = $_GET['me'];
    $idUserReceived = $_GET['recieved'];
    $publi = $_GET['publi'];

    $mess = htmlspecialchars($_GET['mess']);

    $c = $db->prepare("INSERT INTO `chat`(`id_user_send`, `id_user_received`, `message`, `like`, `date_add`, `vu`, `publi`) VALUES (:send, :received, :mess, '', now(), 0, :publi)");

    $c->execute([
        'received' => $idUserReceived,
        'send' => $idUserMe,
        'mess' => $mess,
        'publi' => $publi,
    ]);

    $c = $db->prepare("INSERT INTO `archiveChat`(`id_user_send`, `id_user_received`, `message`, `like`, `date_add`, `vu`, `publi`) VALUES (:send, :received, :mess, '', now(), 0, :publi)");

    $c->execute([
        'received' => $idUserReceived,
        'send' => $idUserMe,
        'mess' => $mess,
        'publi' => $publi,
    ]);

?>