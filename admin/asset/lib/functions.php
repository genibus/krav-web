<?php

function baliseForm($id, $nomLabel, $balise, $type = "")
{
	//Si la condition est définie tu affiche $_POST['$id'] sinon rien...
	$value = isset($_POST[$id]) ? $_POST[$id] : '';	
	if($balise == 'textarea')
	{		
		return "<textarea name='$id' id='$id' class='validate'>$value</textarea>
				<label for='$id' class='active'>$nomLabel</label>";	
	}
	elseif($balise == 'input')
	{		
		return "<input type='$type' name='$id' id='$id' value='$value' class='validate'>
				<label for='$id' class='active'>$nomLabel</label>";	
	}
}

function flash()
{
	if(isset($_SESSION['flash']))
	{
		extract($_SESSION['flash']);
		unset($_SESSION['flash']);
		return "<div class='card-panel $color'><p class='white-text'>$msg</p></div>";
	}
}

function setFlash($msg, $color = '')
{
	$_SESSION['flash']['msg'] = $msg;
	$_SESSION['flash']['color'] = $color;
}

function verification_extension_photo() 
{
	$extension = strrchr($_FILES['photo']['name'], '.'); // cette fonction prédéfinie permet de remonter une chaine en partant de la fin du fichier. Dès que la fonction trouve le caractère fourni en 2 eme argument ici le '.' cette fonction coupe la chaine et nous renvoie tout à partir du '.'
	
	$extension = strtolower($extension); // on transforme la chaine de caractère en minuscule au cas où il y aurait des majuscules.
	
	$extension = substr($extension, 1); // avec substr on coupe la chaine de caractère en enlevant le '.'
	
	$tableau_extension_valide = array('jpg', 'jpeg', 'png', 'gif');
	// on crée un tableau contenant les extensions autorisées
	
	$verif_extension = in_array($extension, $tableau_extension_valide); // in_array() vérifie si la valeur fournie en 1er argument se trouve dans une des valeurs d'un tableau array fourni en 2eme argument.
	// valeur de retour => true ou false
	
	return $verif_extension; // on renvoi donc true ou false
	
}

// Ajout des titles et meta descriptions


/* function metaTitle(){
	
	$getFile = explode("/", $_SERVER['SCRIPT_NAME']);
	$getFile = explode(".", $getFile[2]);
	$title = $getFile[0];

	switch ($title){
		case "index" :
		echo "Portfolio Krav web design Paris";
		break;

		case "article" :
		echo "Mes réalisations";
		break;

		case "view" :
		echo "Page réalisation";
		break;

		case "mentions_legales" :
		echo "Mentions légales";
		break;
	}
	return $title;
}

function metaDescription(){
	
	$getFile = explode("/", $_SERVER['SCRIPT_NAME']);
	$getFile = explode(".", $getFile[2]);
	$description = $getFile[0];

	switch ($description){
		case "index" :
		echo "Graphiste webdesigner freelance Paris ou île de france: identité visuelle, site vitrine, application, optimisation de l'expérience utilisateur";
		break;

		case "article" :
		echo "Description de la page des réalisations";
		break;

		case "view" :
		echo "Description de la page d'une réalisation";
		break;

		case "mentions_legales" :
		echo "Description de la page des mentions légales";
		break;
	}
	return $description;
} */