<?php
$auth = 0;
include 'asset/lib/include.php';
$idsIncorrect ='';

	if(isset($_POST['user']) && isset($_POST['pass'])){ // si user et pass sont défini

		$user = htmlspecialchars($_POST['user']); // protection contre les injections SQL
		$pass = md5($_POST['pass']); // cryptage de caractères

		$req = $db->prepare('SELECT * FROM users WHERE user_name = :user_name AND password = :password'); // préparation de la requête
		$req->bindParam(':user_name', $user);
		$req->bindParam(':password', $pass);
		$req->execute(); // execution de la requête
		if($req->rowCount() == 1){ // si le rowCount vaut 1 -> 1 signifie TRUE
			$_SESSION['auth'] = $req->fetch(); /*
			fetch() attribut tout les éléments de la requete BDD à $_SESSION['auth'] :
					- ['id']
					- ['user_name']
					-['password']
				*/
					header('Location:index.php?p=0');
				}else{
					$idsIncorrect ="<div class='idsIncorrect'><p>identifiants incorrect</p></div>";
				}
			}
			?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="noindex, nofollow">
		<title>Page de connexion admin</title>
		<link href="asset/css/style.css" rel="stylesheet">
	</head>
<body>
	<main>
		<div class="content">
			<p class="pLogo">
				<img src="../asset/img/logo-krav.png" alt="logo krav" class="logoAdmin">
			</p>

			<div class="formMain">
				<form action="#" method="post">
					<p>
						<input type="text" name="user" placeholder="Identifiant" class="champAdmin">
					</p>
					<p>
						<input type="password" name="pass" placeholder="mot de passe" class="champAdmin">
					</p>
						<?= $idsIncorrect; ?>
					<button type="submit" name="send">Se connecter</button>
				</form>
				<a href="../index.php" class="iconeAccueil fa fa-home fa-5x" aria-hidden="true"></a>
			</div>
		</div>
	</main>
<script src="https://use.fontawesome.com/7db2ee7987.js"></script>
</body>
</html>