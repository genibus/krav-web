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
	<div class="container-fluid">
			<div class="row">
				<header class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
						<nav class="nav nav-pills flex-column nav-admin mt-5">
							<div class="nav-item mt-5">
								<a href="categories.php" class="nav-link nav-link-custom">Gestion des catégories</a>
							</div>
							<div class="nav-item mt-5">
								<a href='index.php' class="nav-link nav-link-custom">Gestion des articles</a>
							</div>
							<div class="nav-item mt-5">
								<a href='article_create.php' class="nav-link nav-link-custom">Créer un article</a>
							</div>
							<div class="nav-item mt-5">
								<a href='logout.php' class="nav-link nav-link-custom">Se deconnecter</a>
							</div>
						</nav>
				</header>
	<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">	
		<?= flash(); ?>		