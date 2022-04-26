<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Header.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Document</title>
</head>
<body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../JS/script.js"></script>

    <?php

        include 'variables.php';
        include 'database.php';

    ?>

    <div class="navbar">

        <a href="index.php"><div class="name_site">

            <h2>A<span>I</span>D</h2>

        </div></a>

        <div class="menu_navbar">

            <?php

            if(isset($_SESSION['unique'])){

                ?>
                <a onclick="document.getElementById('add_publi').style.display = 'flex'"><i class="fas fa-plus-circle"></i></a>
                <a href="chatbox.php" id="messBox"><script>actuMessBox()</script></a>
                <a href="profil.php"><i class="fas fa-user"></i></a>
                <?php

            }else{

                ?>
                <a href="connect.php">Connexion</a>
                <?php

            }

            ?>

        </div>

    </div>

    <div class="add_publi" id="add_publi">

        <div class="block_add_publi">
 
            <div class="close">
                <i class="fas fa-window-close" onclick="document.getElementById('add_publi').style.display = 'none'"></i>
            </div>

            <h2>Ajouter une publication</h2>

            <div class="champs">
                <div class="champ">
                    <label for="">Titre</label>
                    <input type="text" id="titre">
                </div>
                <div class="champ">
                    <label for="">Description</label>
                    <textarea id="descript"></textarea>
                </div>
            </div>  
            
            <button onclick="document.getElementById('add_publi').style.display = 'none'; document.getElementById('add_publi_img').style.display = 'flex';">Publier</button>

        </div>

    </div>

    <div class="add_publi" id="add_publi_img">

        <div class="block_add_publi_img">
            
            <button onclick="addPubli(document.getElementById('titre').value,document.getElementById('descript').value, '<?=$_SESSION['unique']?>')">Publier</button>

        </div>

    </div>

    <script>

        var nbrMess = 0;
        var nbrLike = 0;
        var nbrVu = 0;

        function checkMess() {

            $.ajax({
                
                type: "GET",
                dataType: 'json',
                url: "../ajax/checkMess.php",
                async: false,
                success: function(data) {

                    if(nbrMess != data['mess'] || nbrVu != data['vu'] || nbrLike != data['like']){

                        actuMessBox()

                        nbrMess = data['mess'];
                        nbrVu = data['vu'];
                        nbrLike = data['like'];

                    }

                }

            });

        }

        setInterval(checkMess,1000);

    </script>

</body>
</html>