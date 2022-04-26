<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/connect.css" media="screen" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <title>Connexion</title>
</head>
<body>
<html>
    <body>
        <?php
        include 'header.php';
        ?>

        <div class="screen">
            <div id="container">
                <form method="POST">
                    <h1>Connexion</h1>
                    
                    <label><b>Nom d'utilisateur</b></label>
                    <input type="text" placeholder="Entrer le nom d'utilisateur ou l'adresse mail" name="username" required>

                    <label><b>Mot de passe</b></label>
                    <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                    <input name="formsend" type="submit" id='submit' value='SE CONNECTER' >

                    <a href="register.php" class="btn-connect-a"><div class="btn-connect">

                        INSCRIPTION

                    </div></a>

                    <?php
                        if(isset($_POST["formsend"])){
                            extract($_POST);
                            if (!empty(htmlspecialchars($username)) && !empty(htmlspecialchars($password))){

                                $selectinfo = $db-> prepare("SELECT * FROM users WHERE mail_connect = :username");
                                $selectinfo->execute([
                                    "username" => $username
                                ]);

                                $result = $selectinfo -> rowCount();

                                if ($result > 0){
                                    
                                    while($users = $selectinfo -> fetch()){
                                        $hash = htmlspecialchars($users["mdp"]);
                                        $unique = htmlspecialchars($users["id_user"]);
                                    }

                                    if(password_verify(htmlspecialchars($password),$hash)){
                                        $_SESSION["unique"] = htmlspecialchars($unique);

                                        ?>
                                        <script language="Javascript">

                                            document.location.replace("index.php");

                                        </script>
                                        <?php
                                    }
                                }

                            }
                        }
                    ?>
                </form>
            </div>
        </div>
    </body>
</html>


    
</body>
</html>