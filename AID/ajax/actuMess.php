<?php

    include '../php/database.php';
    include '../php/variables.php';

    $idUserMe = $_GET['me'];
    $idUserReceived = $_GET['recieved'];

    $c = $db->prepare("SELECT * FROM `chat` WHERE (id_user_send = :send and id_user_received = :received) or (id_user_send = :received and id_user_received = :send) order by date_add");

    $c->execute([
        'received' => $idUserReceived,
        'send' => $idUserMe,
    ]);
    
    $result = $c -> rowCount();
    $countTour = 0;
    
    ?><input type="text" value="<?=$result?>" id="nbrMess"><?php

    if($result != 0)
    {
        
        while($chat = $c -> fetch())
        {

            $countTour++;

            $heure = substr($chat['date_add'],11,5);
            $mess = ucfirst(htmlspecialchars($chat['message']));

            if($chat['id_user_send'] == $idUserMe){

                if($chat['publi'] != ""){

                    $d = $db->prepare("SELECT * FROM `publi` WHERE id_publi = :idPubli");

                    $d->execute([
                        'idPubli' => $chat['publi'],
                    ]);
                    
                    $result = $d -> rowCount();
                    
                    if($result != 0)
                    {
                    
                        while($publi = $d -> fetch())
                        {

                        ?>

                        <div class="publi_block publi_right">

                            <div class="publi">

                                <div class="img">

                                    <?php
                                        if(file_exists("../img/publi/" . $publi['id_publi'] . "1.png")){

                                            ?>
                                            <img class="img_publi" src="../img/publi/<?=$publi['id_publi']?>1.png" alt="">
                                            <?php

                                        }else{

                                            ?>
                                            <img class="img_publi" src="../img/publi/noimage.jpg" alt="">
                                            <?php

                                        }
                                    ?>

                                </div>
                            
                                <div class="titre">
                                    <h3><?=ucfirst($publi['titre'])?></h3>
                                </div>
                                <div class="descript">
                                    <p><?=ucfirst($publi['descript'])?></p>
                                </div>  

                            </div>

                        </div>

                <?php

                        }
                    }

                }
                ?>

                <?php
                if($mess != ""){
                ?>

                <div class="mess mess_right">

                    <h5><?=$heure?></h5>

                    <div class="infos">

                        <p><?=$mess?></p>

                        <span id="spanOptions<?=$countTour?>">
                            <i class="fas fa-ellipsis-v" onclick="document.getElementById('optionMess<?=$countTour?>').style.display = 'flex'; document.getElementById('spanOptions<?=$countTour?>').style.display = 'block';"></i>
                            <div class="options" id="optionMess<?=$countTour?>">
                                <i class="fas fa-trash" onclick="supprMess(<?=$chat['id']?>); document.getElementById('optionMess<?=$countTour?>').style.display = 'none'; document.getElementById('spanOptions<?=$countTour?>').style.display = 'none';"></i>
                            </div>
                        </span>

                    </div>

                </div>

                <?php
                }
                ?>

                <?php
                if($countTour == $result && $chat['vu'] == 1){

                    ?>
                    <div class="vu"><i class="fas fa-eye"></i></div>
                    <?php

                }
                ?>

                <?php

            }else{

                if($chat['publi'] != ""){

                    $d = $db->prepare("SELECT * FROM `publi` WHERE id_publi = :idPubli");

                    $d->execute([
                        'idPubli' => $chat['publi'],
                    ]);
                    
                    $result = $d -> rowCount();
                    
                    if($result != 0)
                    {
                    
                        while($publi = $d -> fetch())
                        {

                        ?>

                        <div class="publi_block publi_left">

                            <div class="publi">

                                <div class="img">

                                    <?php
                                        if(file_exists("../img/publi/" . $publi['id_publi'] . "1.png")){

                                            ?>
                                            <img class="img_publi" src="../img/publi/<?=$publi['id_publi']?>1.png" alt="">
                                            <?php

                                        }else{

                                            ?>
                                            <img class="img_publi" src="../img/publi/noimage.jpg" alt="">
                                            <?php

                                        }
                                    ?>

                                </div>
                            
                                <div class="titre">
                                    <h3><?=ucfirst($publi['titre'])?></h3>
                                </div>
                                <div class="descript">
                                    <p><?=ucfirst($publi['descript'])?></p>
                                </div>  

                            </div>

                        </div>

                <?php

                        }
                    }

                }
                ?>

                <?php
                if($mess != ""){
                ?>

                <div class="mess mess_left">

                    <h5><?=$heure?></h5>

                    <div class="infos">

                        <p><?=$mess?></p>

                        <span id="spanOptions<?=$countTour?>">
                            <i class="fas fa-ellipsis-v" onclick="document.getElementById('optionMess<?=$countTour?>').style.display = 'flex'; document.getElementById('spanOptions<?=$countTour?>').style.display = 'block';"></i>
                            <div class="options" id="optionMess<?=$countTour?>">
                                
                            </div>
                        </span>

                    </div>

                </div>

                <?php
                }
                ?>

                <?php
                if($countTour == $result && $chat['vu'] == 1){

                    ?>
                    <div class="vu"><i class="fas fa-eye"></i></div>
                    <?php

                }
                ?>

                <?php

            }

        }

    }else{

        ?>

        <div class="no_mess">

            <h2>Envoyer votre premier message à</h2>

            <?php

            $c = $db->prepare("SELECT * FROM `users` WHERE id_user = :idUser");

            $c->execute([
                'idUser' => $idUserReceived,
            ]);

            $result = $c -> rowCount();

            if($result != 0)
            {
                
                while($user = $c -> fetch())
                {

                    $userName = strtoupper(htmlspecialchars($user['name'])) . " " . ucfirst(htmlspecialchars($user['surname']));

                }
            }

            if(file_exists("../img/users/" . $idUserReceived . ".png")){

                ?>

                <img src="../img/users/<?=$idUserReceived?>.png" alt="">
                <h2><?=$userName?></h2>

                <?php

            }else{

                ?>

                <img src="../img/users/profilnone.webp" alt="">
                <h2><?=$userName?></h2>

                <?php

            }

            ?>

        </div>

        <?php

    }
?>