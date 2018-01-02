<title><?= $title; ?></title>
	<meta name="description" content="<?= $description; ?>"/>
	<meta name="viewport" content="initial-scale=1"/>
<link rel="stylesheet" href="asset/css/style.css">
<link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700" rel="stylesheet">
<link rel="icon" type="image/png" sizes="32x32" href="asset/img/favicon-32x32.png">
</head>
<body>
<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-nav fixed-top">
			<div class="container">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fa fa-bars navbar-toggler-icon text-light"></i>
				</button>
				<div class="collapse navbar-collapse justify-content-center" id="navigation">
					<div class="navbar-nav">
						<a href="<?= RACINE ?>" class="nav-item nav-link text-white">Accueil</a>
						<a href="<?= RACINE ?>#portfolio" class="nav-item nav-link text-white">Portfolio</a>
						<a href="<?= RACINE ?>about.php" class="nav-item nav-link text-white">Mon parcours</a>
						<a href="<?= RACINE ?>contact.php" class="nav-item nav-link text-white">Contact</a>
						<a href="<?= RACINE ?>mentions_legales.php" class="nav-item nav-link text-white">Mentions légales</a>
					</div>
				</div>
			</div>
	</nav>
</header>
