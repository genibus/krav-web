<?php include_once 'asset/lib/include.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">
	<meta name="description" content="<?= $description ?>">
	<title><?= $title ?></title>
	<link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
<header>
	<nav class="col-auto text-center nav navbar navbar-light bg-light">
		<div class="container">
			<a href='article_create.php' class="nav-link-custom text-dark p-2">Créer un article</a>
			<a href='index.php' class="nav-link-custom text-dark p-2">Gestion des articles</a>
			<a href="categories.php" class="nav-link-custom text-dark p-2">Gestion des catégories</a>
			<a href='logout.php' class="nav-link-custom text-dark p-2">Se deconnecter</a>
		</div>
	</nav>
</header>
<main role="main" class="">
		<?= flash(); ?>
