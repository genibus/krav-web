<title><?= $title; ?></title>
	<meta name="description" content="<?= $description; ?>"/>
	<meta name="viewport" content="initial-scale=1"/>
<link rel="stylesheet" href="<?= RACINE ?>asset/css/knacss.css">
</head>
<body>
<header>
			<div id="menu-hamburger" class="flex-container open">
				<p><i class="fa fa-bars fa-3x" aria-hidden="true"></i></p>
			</div>
			<nav class="flex-container-v menu">
				<i class="fa fa-times fa-3x close" aria-hidden="true"></i>
				<a href="<?= RACINE ?>">Accueil</a>
				<a href="<?= RACINE ?>article.php">Portfolio</a>
				<a href="#" class="contact btn-contact">Contact</a>
				<a href="<?= RACINE ?>mentions_legales.php">Mentions légales</a>
			</nav>
		</header>