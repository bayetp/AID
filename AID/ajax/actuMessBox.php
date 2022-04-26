<?php

    include '../php/database.php';
    include '../php/variables.php';

    $c = $db->prepare("SELECT * FROM `chat` WHERE (id_user_send = :send or id_user_received = :send) order by date_add DESC");

    $c->execute([
        'send' => $_SESSION['unique'],
    ]);

    $result = $c -> rowCount();
    $countTour = 0;

    $i = 0;
    $liste_envoi[$i] = "";

    if($result != 0)
    {
        
        while($chat = $c -> fetch())
        {

            $id_user_send = $chat["id_user_send"];
            $id_user = $chat["id_user_send"];
            $mess = htmlspecialchars($chat["message"]);
            $vu = $chat["vu"];

            if($id_user == $_SESSION["unique"]){

                $id_user = $chat["id_user_received"];

            }

            if(!in_array($id_user,$liste_envoi)){

                $liste_envoi[$i] = $id_user;

                $i++;

                $d = $db->prepare("SELECT * FROM `users` WHERE id_user = :idUser");

                $d->execute([
                    'idUser' => $id_user,
                ]);

                $result = $d -> rowCount();

                if($result != 0)
                {
                    
                    while($user = $d -> fetch())
                    {

                        $userName = strtoupper($user['name']) . " " . ucfirst($user['surname']);

                    }
                }

                if($vu == 0 && $id_user_send != $_SESSION['unique']){

                    ?>
                    <i class="fas fa-comments"><div class="notif"></div></i>
                    <?php

                }else{

                    ?>
                    <i class="fas fa-comments"></i>
                    <?php

                }

            }

        }
    }

    ?>