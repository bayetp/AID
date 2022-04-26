<div class="block_nvmessage">

    <div class="infos_nvmess">
        <a href=""><i class="fas fa-pen"></i></a>
    </div>

</div>

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

                ?>
                <a href="chat.php?id=<?=$id_user?>" class="block_message">

                    <?php
                    if(file_exists("../img/users/" . $id_user . ".png")){

                        ?>

                        <img src="../img/users/<?=$id_user?>.png" alt="">

                        <?php

                    }else{

                        ?>

                        <img src="../img/users/profilnone.webp" alt="">

                        <?php

                    }
                    ?>

                    <div class="infos">
                        <span><?=$userName?></span>
                        <p><?=$mess?></p>
                    </div>

                    <?php
                    if($vu == 0 && $id_user_send != $_SESSION['unique']){

                        ?>
                        <div class="notif"></div>
                        <?php

                    }
                    ?>

                </a>
                <?php

            }

        }
    }

    ?>