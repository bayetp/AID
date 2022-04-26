<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/chat.css">
    <title>Document</title>
</head>
<body>
    <?php
    include 'header.php';
    $idUserReceived = $_GET['id'];

    $publi = "";

    if(isset($_GET['publi'])) {
        $publi = $_GET['publi'];
    }

    ?>

    <div class="block" onmouseup="closeOptionMess(document.getElementById('nbrMess').value)">

        <div class="header">

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

                    $userName = strtoupper($user['name']) . " " . ucfirst($user['surname']);

                }
            }

            if(file_exists("../img/users/" . $idUserReceived . ".png")){

                ?>

                <a href="profilOther.php?id=<?=$idUserReceived?>" class="profil">
                    <img src="../img/users/<?=$idUserReceived?>.png" alt="">
                    <h5><?=$userName?></h5>
                </a>
               

                <?php

            }else{

                ?>

                <a href="profilOther.php?id=<?=$idUserReceived?>" class="profil">
                    <img src="../img/users/profilnone.webp" alt="">
                    <h5><?=$userName?></h5>
                </a>

                <?php

            }

            ?>

        </div>

        <div class="mess_zone" id="mess_zone">

            <script>setVu('<?=$_SESSION['unique']?>', '<?=$idUserReceived?>')</script>
            <script>actuMess('<?=$_SESSION['unique']?>', '<?=$idUserReceived?>')</script>

        </div>

        <div class="send_zone">

            <?php
            if($publi != ""){
            ?>
            
            <div class="publi_zone">

                <?php

                $d = $db->prepare("SELECT * FROM `publi` WHERE id_publi = :idPubli");

                    $d->execute([
                        'idPubli' => $publi,
                    ]);
                    
                    $result = $d -> rowCount();
                    
                    if($result != 0)
                    {
                    
                        while($publie = $d -> fetch())
                        {

                        ?>

                        <div class="publi_block">

                            <div class="publi publi_right">

                                <div class="img">

                                    <?php
                                        if(file_exists("../img/publi/" . $publie['id_publi'] . "1.png")){

                                            ?>
                                            <img class="img_publi" src="../img/publi/<?=$publie['id_publi']?>1.png" alt="">
                                            <?php

                                        }else{

                                            ?>
                                            <img class="img_publi" src="../img/publi/noimage.jpg" alt="">
                                            <?php

                                        }
                                    ?>

                                </div>
                            
                                <div class="titre">
                                    <h3><?=ucfirst($publie['titre'])?></h3>
                                </div>
                                <div class="descript">
                                    <p><?=ucfirst($publie['descript'])?></p>
                                </div>  

                            </div>

                        </div>

                <?php

                        }
                    }
                    ?>

            </div>

            <?php
            }
            ?>

            <textarea onkeyup="if(event.keyCode == 13){sendMess('<?=$_SESSION['unique']?>', '<?=$idUserReceived?>', document.getElementById('txt_mess').value, '<?=$publi?>');}" id="txt_mess"></textarea>
            <button onclick="sendMess('<?=$_SESSION['unique']?>', '<?=$idUserReceived?>', document.getElementById('txt_mess').value, '<?=$publi?>')"><i class="fas fa-paper-plane"></i></button>

        </div>

    </div>

    <script>

        var nbrMessMess = 0;
        var nbrLikeMess = 0;
        var nbrVuMess = 0;

        function checkMess() {
        
            $.ajax({
                
                type: "GET",
                dataType: 'json',
                url: "../ajax/checkMess.php",
                async: false,
                success: function(data) {

                    if(nbrMessMess != data['mess'] || nbrVuMess != data['vu'] || nbrLikeMess != data['like']){

                        if(nbrVuMess != data['vu']){

                            nbrVuMess = data['vu'];
                            setVu('<?=$_SESSION['unique']?>', '<?=$idUserReceived?>');

                        }

                        actuMess('<?=$_SESSION['unique']?>', '<?=$idUserReceived?>');

                        nbrMessMess = data['mess'];
                        nbrLikeMess = data['like'];

                    }

                }

            });

        }

        setInterval(checkMess,1000);

    </script>

</body>
</html>