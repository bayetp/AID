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
    $idUser = $_SESSION['unique'];
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

                <script>calcNote('<?=$idUser?>')</script>
                
            </div>

            <div class="sendMess">

                <a href="modifProfil.php">Modifier</a>
                <a href="deconnect.php">Déconnexion</a>

            </div>

        </div>

        <div class="block_publi" id="block_publi">

            

        </div>

        <script>affPubliProfil('<?=$idUser?>')</script>

    </div>

</body>
</html>