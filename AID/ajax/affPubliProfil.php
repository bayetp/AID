<?php

    include '../PHP/database.php';

    $idUser = $_GET['id'];

    $c = $db->prepare("SELECT * FROM `publi` WHERE id_user = :idUser and made = 0 order by date_add DESC");

    $c->execute([
        'idUser' => $idUser,
    ]);
    
    $result = $c -> rowCount();
    
    if($result != 0)
    {
    
        while($publi = $c -> fetch())
        {

            $d = $db->prepare("SELECT * FROM `users` WHERE id_user = :idUser");

            $d->execute([
                'idUser' => $publi['id_user'],
            ]);
            
            $result = $d -> rowCount();
            
            if($result != 0)
            {
                
                while($user = $d -> fetch())
                {

                    $userName = strtoupper($user['name']) . " " . ucfirst($user['surname']);

                }
            }

            $countImg = 0;

            for($i = 1; $i < 5; $i++){

                if(file_exists("../img/publi/" . $publi['id_publi'] . $i . ".png")){

                    $countImg++;

                }

            }

    ?>

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

                    <?php

                    if($countImg > 1){

                        ?>
                        <div class="nbr_img">
                            <h5><?=$countImg?> images</h5>
                        </div>
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
                <div class="more">
                    <a><h5 onclick="document.getElementById('popUpPubli<?=$publi['id']?>').style.display = 'flex'">lire la suite -></h5></a>
                    <a href=""><h5 class="modifPubli">Modifier</h5></a>
                </div>

            </div>  

            <div class="popUpPubli" id="popUpPubli<?=$publi['id']?>">

                <div class="popUp">

                    <div class="close">
                        <i class="fas fa-window-close" onclick="document.getElementById('popUpPubli<?=$publi['id']?>').style.display = 'none'"></i>
                    </div>

                    <div class="img">

                        <?php

                        if($countImg > 1){

                            ?>

                            <div id="arrowPrec<?=$publi['id']?>" class="arrow arrowPrec<?=$publi['id']?>" onclick="imgPrec('<?=$publi['id_publi']?>1', <?=$publi['id']?>)">
                                <
                            </div>

                            <?php

                        }

                        ?>

                        <?php
                        if(file_exists("../img/publi/" . $publi['id_publi'] . "1.png")){

                            ?>
                            <img id="img_publi<?=$publi['id']?>" class="img_publi" src="../img/publi/<?=$publi['id_publi']?>1.png" alt="">
                            <?php

                        }else{

                            ?>
                            <img class="img_publi" src="../img/publi/noimage.jpg" alt="">
                            <?php

                        }
                        ?>

                        <?php

                        if($countImg > 1){

                            ?>

                            <div id="arrowSuiv<?=$publi['id']?>" class="arrow arrowSuiv" id="arrowSuiv<?=$publi['id']?>" onclick="imgSuiv('<?=$publi['id_publi']?>1', <?=$publi['id']?>)">
                                >
                            </div>

                            <?php

                        }

                        ?>

                    </div>

                    <div class="champs">
                        <div class="champ">
                            <h2><?=ucfirst($publi['titre'])?></h2>
                        </div>
                        <div class="champ">
                            <p><?=ucfirst($publi['descript'])?></p>
                        </div>
                    </div>  

                </div>

            </div>

    <?php
        }

    }
    ?>