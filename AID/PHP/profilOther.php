<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profil.css">
    <title>Document</title>
</head>
<body>
    
    <?php
    include 'header.php';
    $idUser = $_GET['id'];
    ?>

    <div class="block">

        <div class="infos">

            <div class="infos_user">
                <?php
                $c = $db->prepare("SELECT * FROM `users` WHERE id_user = :idUser");

                $c->execute([
                    'idUser' => $idUser,
                ]);
                
                $result = $c -> rowCount();
                
                if($result != 0)
                {
                
                    while($users = $c -> fetch())
                    {
                        $userName = strtoupper($users['name']) . " " . ucfirst($users['surname']);

                        if(file_exists("../img/users/" . $users['id_user'] . ".png")){

                            ?>
                            <img class="img_publi" src="../img/users/<?=$users['id_user']?>.png" alt="">
                            <?php

                        }else{

                            ?>
                            <img class="img_publi" src="../img/users/profilnone.webp" alt="">
                            <?php

                        }
                        ?>

                        <h2><?=$userName?></h2>

                        <?php
                    }
                }
                ?>
            </div>

            <?php
            $c = $db->prepare("SELECT * FROM `publi` WHERE made = 0 and id_user = :idUser");

            $c->execute([
                'idUser' => $idUser,
            ]);
            
            $result = $c -> rowCount();
            
            $nbrPubli = $result;

            ?>
            
            <h3><?=$nbrPubli?> publications</h3>

            <div class="vote">

                <h3 id="voteValue"></h3>
                <div class="point point1" id="pointNote1"></div>
                <div class="point point2" id="pointNote2"></div>
                <div class="point point3" id="pointNote3"></div>
                <div class="point point4" id="pointNote4"></div>
                <div class="point point5" id="pointNote5"></div>
                <button onclick="document.getElementById('myVote').style.display = 'flex'">Noter</button>

                <script>calcNote('<?=$idUser?>')</script>
                
            </div>

            <div class="sendMess">

                <a href="chat.php?id=<?=$idUser?>">Envoyer un message</a>

            </div>

            <div class="myVote" id="myVote">

                <?php
                $c = $db->prepare("SELECT * FROM `notes` WHERE id_user_note = :idUser and id_user_noted = :idUserNoted");

                $c->execute([
                    'idUser' => $_SESSION['unique'],
                    'idUserNoted' => $idUser,
                ]);
                
                $result = $c -> rowCount();

                $note = 0;
                
                if($result != 0)
                {
                
                    while($notes = $c -> fetch())
                    {
                        $note = $notes['note'];

                        ?>
                        <div class="vote">
                            <div class="point point1 <?php if($note >= 1){echo 'pointChecked';} ?>" id="point1" onclick="addNote('<?=$_SESSION['unique']?>','<?=$idUser?>',1)"></div>
                            <div class="point point2 <?php if($note >= 2){echo 'pointChecked';} ?>" id="point2" onclick="addNote('<?=$_SESSION['unique']?>','<?=$idUser?>',2)"></div>
                            <div class="point point3 <?php if($note >= 3){echo 'pointChecked';} ?>" id="point3" onclick="addNote('<?=$_SESSION['unique']?>','<?=$idUser?>',3)"></div>
                            <div class="point point4 <?php if($note >= 4){echo 'pointChecked';} ?>" id="point4" onclick="addNote('<?=$_SESSION['unique']?>','<?=$idUser?>',4)"></div>
                            <div class="point point5 <?php if($note >= 5){echo 'pointChecked';} ?>" id="point5" onclick="addNote('<?=$_SESSION['unique']?>','<?=$idUser?>',5)"></div>
                        </div>
                        <button onclick="document.getElementById('myVote').style.display = 'none'">Valider</button>
                        <?php

                    }

                }else{

                    ?>
                    <div class="vote">
                        <div class="point point1 <?php if($note >= 1){echo 'pointChecked';} ?>" id="point1" onclick="addNote('<?=$_SESSION['unique']?>','<?=$idUser?>',1)"></div>
                        <div class="point point2 <?php if($note >= 2){echo 'pointChecked';} ?>" id="point2" onclick="addNote('<?=$_SESSION['unique']?>','<?=$idUser?>',2)"></div>
                        <div class="point point3 <?php if($note >= 3){echo 'pointChecked';} ?>" id="point3" onclick="addNote('<?=$_SESSION['unique']?>','<?=$idUser?>',3)"></div>
                        <div class="point point4 <?php if($note >= 4){echo 'pointChecked';} ?>" id="point4" onclick="addNote('<?=$_SESSION['unique']?>','<?=$idUser?>',4)"></div>
                        <div class="point point5 <?php if($note >= 5){echo 'pointChecked';} ?>" id="point5" onclick="addNote('<?=$_SESSION['unique']?>','<?=$idUser?>',5)"></div>
                    </div>
                    <button onclick="document.getElementById('myVote').style.display = 'none'">Valider</button>
                    <?php

                }
                ?>

            </div>

        </div>

        <div class="block_publi">

            <?php
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

    </div>

</body>
</html>