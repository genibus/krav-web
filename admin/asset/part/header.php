<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">
	<title>Administration</title>
	<!-- <link rel="stylesheet" href="asset/css/style.css"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
</head>
<body>
	<header>    
		<nav>
			<div class="nav-wrapper blue-grey">				
			<ul id="nav-mobile" class="right hide-on-med-and-down blue-grey">
					<li><a href='categories.php'>Gestion des catégories</a></li>
					<li><a href='index.php'>Gestion des articles</a></li>
					<li><a href='logout.php'>Se deconnecter</a></li>
				</ul>
			</div>
		</nav>
		<?= flash(); ?>
	</header>
