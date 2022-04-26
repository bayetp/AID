<?php

    include '../php/database.php';
    include '../php/variables.php';

    $titre = $_GET['titre'];
    $descript = $_GET['descript'];

    if($titre != "" && $descript != ""){

        $id = uniqid((double)microtime()*1000, true);

        $selectinfo = $db-> prepare("INSERT INTO `publi`(`id_user`, `id_publi`, `titre`, `descript`, `date_add`) VALUES (:idUser, :idPubli, :titre, :descript, now())");
        $selectinfo->execute([
            "idUser" => $_SESSION['unique'],
            "idPubli" => htmlspecialchars($id),
            "titre" => htmlspecialchars($titre),
            "descript" => htmlspecialchars($descript),
        ]);

        echo json_encode(1);
    
    }else{

        echo json_encode(0);

    }

?>