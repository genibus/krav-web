<?php
$auth = 0;
include 'asset/lib/include.php';
$idsIncorrect ='';

if(isset($_POST['user']) && isset($_POST['password'])){ // si user et pass sont défini

	$user = htmlspecialchars($_POST['user']); // protection contre les injections SQL
	$pass = md5($_POST['password']); // cryptage de caractères

	$req = $db->prepare('SELECT * FROM users WHERE user_name = :user_name AND password = :password'); // préparation de la requête
	$req->bindParam(':user_name', $user);
	$req->bindParam(':password', $pass);
	$req->execute(); // execution de la requête
	if($req->rowCount() == 1){ // si le rowCount vaut 1 -> 1 signifie TRUE
		$_SESSION['auth'] = $req->fetch(); // fetch() attribut tout les éléments de la requete BDD à $_SESSION['auth'] : -['id'] -['user_name'] -['password']
		header('Location:index.php');
		}else{
			setFlash('Identifiants incorrect', 'danger');
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
	<link rel="stylesheet" href="../asset/css/style.css">
	</head>
<body class="bg-dark">
	<main class="pt-5">

	<?= flash(); ?>
		<div class="row pt-5">
			<div class="col-4 offset-4 mt-5">
				<p class="text-center pr-3">
					<img src="../asset/img/logo-krav.png" alt="logo krav" class="logoAdmin" width="100%">
				</p>
				<form action="" method="post">
					<div class="form-group">
						<label for="user" class="text-center text-light">Identifiant</label>
						<input type="text" name="user" placeholder="Identifiant" class="form-control">
					</div>
					<div class="form-group">
						<label for="password" class="text-light">Mot de passe</label>
						<input type="password" name="password" placeholder="mot de passe" class="form-control">
					</div>
					<button type="submit" name="send" class="btn btn-info btn-block">Se connecter</button>
				</form>
				<p class="text-center mt-4">
					<a href="../index.php" class="p-4 fa fa-home fa-5x" aria-hidden="true"></a>
				</p>
			</div>
			</div>
		</div>
	</main>
<script src="https://use.fontawesome.com/7db2ee7987.js"></script>
</body>
</html>