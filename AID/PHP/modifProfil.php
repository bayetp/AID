<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/modifProfil.css">
    <title>Document</title>
</head>
<body>

    <?php
    include 'header.php';
    ?>
    
    <div class="block">

        <?php
        $selectinfo = $db-> prepare("SELECT * FROM users WHERE id_user = :idUser");
        $selectinfo->execute([
            "idUser" => $_SESSION['unique'],
        ]);

        $result = $selectinfo -> rowCount();

        if ($result > 0){
            
            while($users = $selectinfo -> fetch()){

                ?>

                <form action="" method="POST" enctype="multipart/form-data">

                    <a href="../image_cropper/index.php" class="labelImg">
                        <?php
                        if(file_exists("../img/users/" . $users['id_user'] . ".png")){

                            ?>
                            <img src="../img/users/<?=$users['id_user']?>.png" alt="" id="previewImgProfil">
                            <?php

                        }else{

                            ?>
                            <img src="../img/users/profilnone.webp" alt="" id="previewImgProfil">
                            <?php

                        }
                        ?>
                        <div class="logoModif">
                            <i class="fas fa-pen"></i>
                        </div>
                    </a>

                    <div class="champ">
                        <label for="">Nom</label>
                        <input type="text" name="name" value="<?=$users['name']?>">
                    </div>

                    <div class="champ">
                        <label for="">Prénom</label>
                        <input type="text" name="surname" value="<?=$users['surname']?>">
                    </div>

                    <input type="submit" name="formsend" value="Enregister">

                </form>

                <?php

            }
        }

        ?>

        <a href="">Modifier le mot de passe</a>

        <?php

            if(isset($_POST["formsend"])){

                extract($_POST);

                if (!empty(htmlspecialchars($name)) && !empty(htmlspecialchars($surname))){

                    $selectinfo = $db-> prepare("UPDATE `users` SET `name`= :name,`surname`= :surname WHERE id_user = :idUser");
                    $selectinfo->execute([
                        "idUser" => $_SESSION['unique'],
                        "name" => htmlspecialchars($name),
                        "surname" => htmlspecialchars($surname),
                    ]);

                }

                if(isset($_FILES["new_img_profil"])){

                    $uploaddir = '../img/users/';
                    $uploadfile = $uploaddir . $_SESSION['unique'] . '.png';

                    move_uploaded_file($_FILES['new_img_profil']['tmp_name'], $uploadfile);

                }

                header('Location: profil.php');

            }

        ?>

    </div>

</body>
</html>