<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <title>Document</title>
</head>
<body>
    
    <?php
    include 'header.php';

    if(!isset($_SESSION['unique'])){
        header('Location: connect.php');
    }

    ?>

    <div class="block">

        <?php
        $c = $db->prepare("SELECT * FROM `publi` WHERE made = 0 order by date_add DESC");

        $c->execute([
            
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

                        <a href="<?php if(isset($_SESSION['unique'])){if($publi['id_user'] == $_SESSION['unique']){echo 'profil.php';}else{echo 'profilOther.php?id=' . $publi['id_user'];}}else{echo 'connect.php';}?>" class="profil">

                            <?php
                            if(file_exists('../img/users/' . $publi['id_user'] . ".png")){

                                ?>
                                <img src="../img/users/<?=$publi['id_user']?>.png" alt="">
                                <?php

                            }else{

                                ?>
                                <img src="../img/users/profilnone.webp" alt="">
                                <?php

                            }
                            ?>
                            <h5><?=$userName?></h5>
                        </a>

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
                        <?php if($publi['id_user'] != $_SESSION['unique']){
                            ?>
                        <a href="chat.php?id=<?=$publi['id_user']?>&publi=<?=$publi['id_publi']?>">Repondre</a>
                        <?php
                        }
                        ?>
                        <a><h5 onclick="document.getElementById('popUpPubli<?=$publi['id']?>').style.display = 'flex'">lire la suite -></h5></a>
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

    </div>

</body>
</html>