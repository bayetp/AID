<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/connect.css">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <title>Inscription</title>
</head>
<body>

<?php

include 'header.php';

?>

<div class="screen">
	
	<div class="block" id="container">

		<!-- formulaire de connexion -->

		<form method="post" class="formulaire">

				<h1>Créé un compte</h1>

				<label>Nom</label><br>
				<input onkeyup="supprespace(this)" type="text" name="name" class="field-long" placeholder="Entrer votre nom" required /><br>

				<label>Prénom</label><br>
				<input onkeyup="supprespace(this)" type="text" name="surname" class="field-long" placeholder="Entrer votre prénom" required /><br>

				<label>Email</label><br>
				<input type="email" name="email" class="field-long" placeholder="Entrer votre adresse mail" required /><br>

				<label>Mot de passe</label><br>
				<input type="password" name="password" class='field-password' placeholder="Entrez votre mot de passe" required /><br>

				<label>Confirmer le Mot de passe</label><br>
				<input type="password" name="passwordconfirm" class='field-password' placeholder="Confirmez votre mot de passe" required /><br>

				<input type="submit" name="formsend" value="ENREGISTRER" /><br>

				<a href="connect.php" class="btn-connect-a"><div class="btn-connect">

					CONNEXION

				</div></a>

		</form>

			<?php

			if(isset($_POST['formsend']))
			{

				extract($_POST);

				if(!empty($email) && !empty($password) && !empty($name) && !empty($surname) && !empty($passwordconfirm))
				{

					if(htmlspecialchars($password) == htmlspecialchars($passwordconfirm))
					{

						$options = [
							'cost' => 12,
						];

						$hashpass = password_hash(htmlspecialchars($password), PASSWORD_BCRYPT, $options);

						$c = $db->prepare("SELECT mail_connect FROM users WHERE mail_connect = :email");

						$c->execute([
							'email' => htmlspecialchars($email),
						]);

						$result = $c -> rowCount();

						if($result == 0)
						{

							$id = uniqid((double)microtime()*1000000, true);

							$q = $db->prepare("INSERT INTO `users`(`name`, `surname`, `mail`, `mdp`, `id_user`, date_add, mail_connect) VALUES(:name,:surname,:mail,:mdp,:id, now(),:mail)");

							$q->execute([
								'name' => htmlspecialchars($name),
								'surname' => htmlspecialchars($surname),
								'mail' => htmlspecialchars($email),
								'mdp' => htmlspecialchars($hashpass),
								'id' => htmlspecialchars($id),
							]);

							$_SESSION['unique'] = $id;

							?>
							<script language="Javascript">

								document.location.replace("Index.php");

							</script>
							<?php

						}
					}
				}
			}

			?>

	</div>

</div>

<script>

	function supprespace(txtbox) {
		
		var txt = txtbox.value;
		var txt2 = sansAccent(txt);

		let char = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "y", "x", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "Y", "X", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "_", "-", ".", " "];

		var position = false;

		for(var i= 0; i < txt.length; i++)
		{

			position = false;

			for(var j= 0; j <= char.length; j++)
			{
				
				if(char[j] == txt[i]){

					position = true;

				}

			}

			if(position == false){

				txt2 = txt2 = txt2.replace(txt[i], '');

			}

		}

		txtbox.value = brid(txt2, 30);

	}

	function brid(txt, nbr) {

		txt = txt.substring(0, nbr);

		return txt;
		
	}

	function sansAccent(str){

		var accent = [
			/[\300-\306]/g, /[\340-\346]/g, // A, a
			/[\310-\313]/g, /[\350-\353]/g, // E, e
			/[\314-\317]/g, /[\354-\357]/g, // I, i
			/[\322-\330]/g, /[\362-\370]/g, // O, o
			/[\331-\334]/g, /[\371-\374]/g, // U, u
			/[\321]/g, /[\361]/g, // N, n
			/[\307]/g, /[\347]/g, // C, c
		];
		var noaccent = ['A','a','E','e','I','i','O','o','U','u','N','n','C','c'];

		for(var i = 0; i < accent.length; i++){
			str = str.replace(accent[i], noaccent[i]);
		}
		
		return str;
	}

</script>



</body>
</html>